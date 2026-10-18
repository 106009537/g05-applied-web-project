<?php
/* process_eoi.php - receives the application form, validates it on the server
   and saves a valid Expression of Interest (EOI) into the eoi table.
   GenAI acknowledgement: Claude (Anthropic) was used to help write the server-side
   validation, the job reference check and the database insert in this file.
   Prompt used: "Help me with Task 4, process_eoi.php, for my Part 2 project".
   I reviewed and tested the code and can explain each part. */

require_once 'settings.php';
mysqli_report(MYSQLI_REPORT_OFF);   // no raw database errors shown to visitors

// 1. Block direct access: this page only works when the form has been posted
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['jobref'])) {
    header('Location: apply.php');
    exit();
}

// 2. Sanitise: trim spaces and strip slashes
function get_field($key) {
    return (isset($_POST[$key]) && is_string($_POST[$key])) ? trim(stripslashes($_POST[$key])) : '';
}

$jobref = get_field('jobref');     $fname = get_field('fname');
$lname = get_field('lname');       $dob = get_field('dob');
$gender = get_field('gender');     $street = get_field('street');
$suburb = get_field('suburb');     $state = get_field('state');
$postcode = get_field('postcode'); $email = get_field('email');
$phone = get_field('phone');       $otherskills = get_field('otherskills');
$skills_in = (isset($_POST['skills']) && is_array($_POST['skills'])) ? $_POST['skills'] : [];

// 3. Validate on the server (never trust the browser)
$errors = [];
$allowed_genders = ['Female', 'Male', 'Non-binary', 'Prefer not to say'];
$allowed_states  = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
$allowed_skills  = ['Social Media / Content Creation', 'Environmental Education', 'Volunteer Coordination',
                    'Community Engagement', 'Event Planning', 'Public Speaking / Presentations'];

if (!preg_match('/^[A-Za-z0-9]{6}$/', $jobref)) { $errors[] = "Job reference must be exactly 6 letters or numbers."; }
if (!preg_match('/^[A-Za-z]{1,20}$/', $fname))  { $errors[] = "First name must be 1 to 20 letters only."; }
if (!preg_match('/^[A-Za-z]{1,20}$/', $lname))  { $errors[] = "Last name must be 1 to 20 letters only."; }

$dob_sql = '';
if (preg_match('#^(\d{2})/(\d{2})/(\d{4})$#', $dob, $m) && checkdate((int)$m[2], (int)$m[1], (int)$m[3])) {
    $dob_sql = $m[3] . '-' . $m[2] . '-' . $m[1];
    if ($dob_sql > date('Y-m-d')) { $errors[] = "Date of birth cannot be in the future."; }
} else {
    $errors[] = "Date of birth must be a real date in dd/mm/yyyy format.";
}

if (!in_array($gender, $allowed_genders, true)) { $errors[] = "Please select a gender."; }
if ($street === '' || strlen($street) > 40)     { $errors[] = "Street address is required (maximum 40 characters)."; }
if ($suburb === '' || strlen($suburb) > 40)     { $errors[] = "Suburb/Town is required (maximum 40 characters)."; }
if (!in_array($state, $allowed_states, true))   { $errors[] = "Please select a valid state."; }
if (!preg_match('/^\d{4}$/', $postcode))        { $errors[] = "Postcode must be exactly 4 digits."; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 40) { $errors[] = "Please enter a valid email address (maximum 40 characters)."; }
if (!preg_match('/^\d{8,12}$/', $phone))        { $errors[] = "Phone number must be 8 to 12 digits."; }

$skills = array_values(array_intersect($skills_in, $allowed_skills));   // removes any faked values
if (count($skills) === 0)                       { $errors[] = "Please select at least one skill."; }
if (strlen($otherskills) > 500)                 { $errors[] = "Other skills must be 500 characters or fewer."; }

// 4. Connect to the database (needed for the job check and the save)
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) {
    $page_title = "Application Result - Quokka Recovery Program";
    include 'header.inc';
    echo "<main><h1>Sorry</h1><p>We could not process your application right now. Please try again later.</p></main>";
    include 'footer.inc';
    exit();
}
mysqli_set_charset($conn, 'utf8mb4');

// 5. Check that the job reference really exists in the jobs table
if (preg_match('/^[A-Za-z0-9]{6}$/', $jobref)) {
    $check = mysqli_prepare($conn, "SELECT job_ref FROM jobs WHERE job_ref = ?");
    if ($check) {
        mysqli_stmt_bind_param($check, "s", $jobref);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);
        if (mysqli_stmt_num_rows($check) === 0) { $errors[] = "That job reference does not match any current position."; }
        mysqli_stmt_close($check);
    }
}

// 6. If there are errors, show them all and stop
$page_title = "Application Result - Quokka Recovery Program";
if ($errors) {
    include 'header.inc';
    echo "<main><h1>Application not submitted</h1><ul>";
    foreach ($errors as $err) { echo "<li>" . htmlspecialchars($err) . "</li>"; }
    echo "</ul><p><a href=\"apply.php\">Go back to the form</a></p></main>";
    include 'footer.inc';
    mysqli_close($conn);
    exit();
}

// 7. Create the eoi table if it does not exist (same layout as g05db.sql)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jobref CHAR(6) NOT NULL,
    fname VARCHAR(20) NOT NULL,
    lname VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(20) NOT NULL,
    street VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state CHAR(3) NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(40) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    skills TEXT DEFAULT NULL,
    otherskills TEXT DEFAULT NULL,
    status ENUM('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// 8. Save with a prepared statement (stops SQL injection). HTML is escaped before storing.
$e = fn($v) => htmlspecialchars($v);
$j  = $e($jobref);  $f  = $e($fname);   $l  = $e($lname);   $g  = $e($gender);
$st = $e($street);  $su = $e($suburb);  $em = $e($email);   $os = $e($otherskills);
$skills_str = $e(implode(', ', $skills));

$stmt = mysqli_prepare($conn, "INSERT INTO eoi (jobref, fname, lname, dob, gender, street, suburb, state, postcode, email, phone, skills, otherskills)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssssssssss", $j, $f, $l, $dob_sql, $g, $st, $su, $state, $postcode, $em, $phone, $skills_str, $os);

include 'header.inc';
if (mysqli_stmt_execute($stmt)) {
    $eoi_number = mysqli_insert_id($conn);
    echo "<main><h1>Application received</h1>";
    echo "<p>Thank you, " . $f . ". Your Expression of Interest number is <strong>" . (int)$eoi_number . "</strong>.</p>";
    echo "<p><a href=\"index.php\">Back to the home page</a></p></main>";
} else {
    echo "<main><h1>Sorry</h1><p>Your application could not be saved. Please try again.</p></main>";
}
include 'footer.inc';
mysqli_stmt_close($stmt);
mysqli_close($conn);