
<?php
// Start session and protect the page from unauthorised access.
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// Connect to the database.
require_once "settings.php";
$conn = mysqli_connect($host, $user, $pwd, $sql_db);
if (!$conn) die("Database connection failed.");
mysqli_set_charset($conn, "utf8mb4");

// Escape text before displaying it in HTML (prevents XSS).
function h($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, "UTF-8");
}

// Create a security token to protect forms from CSRF attacks.
if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(random_bytes(32));
}

// --------------------------------------------------
// PROCESS FORM ACTIONS
// --------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check that the form has the correct security token.
    $token = $_POST["token"] ?? "";
    if (!is_string($token) || !hash_equals($_SESSION["token"], $token)) {
        die("Invalid request.");
    }

    $action = $_POST["action"] ?? "";
    $message = "Invalid request.";

    // LOGOUT: End the session and return to login.
    if ($action == "logout") {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    // UPDATE: Change one EOI's status using its number.
    if ($action == "update") {
        $id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);
        $status = $_POST["status"] ?? "";

        if ($id && in_array($status, ["New", "Current", "Final"], true)) {
            $stmt = mysqli_prepare($conn,
                "UPDATE eoi SET status = ? WHERE EOInumber = ?");
            mysqli_stmt_bind_param($stmt, "si", $status, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            $message = "Status update processed.";
        }
    }

    // DELETE: Remove all EOIs with the specified job reference.
    if ($action == "delete") {
        $ref = $_POST["ref"] ?? "";
        $ref = is_string($ref) ? strtoupper(trim($ref)) : "";

        if (preg_match("/^[A-Z0-9]{6}$/", $ref)) {
            $stmt = mysqli_prepare($conn,
                "DELETE FROM eoi WHERE jobref = ?");
            mysqli_stmt_bind_param($stmt, "s", $ref);
            mysqli_stmt_execute($stmt);
            $message = mysqli_stmt_affected_rows($stmt) . " EOIs deleted.";
            mysqli_stmt_close($stmt);
        }
    }

    // Save feedback and redirect to prevent form resubmission.
    $_SESSION["message"] = $message;
    header("Location: manage.php");
    exit();
}

$message = $_SESSION["message"] ?? "";
unset($_SESSION["message"]);

// --------------------------------------------------
// SEARCH AND SORT EOIS
// --------------------------------------------------

// Retrieve search values. Empty fields match all records.
$ref = $_GET["ref"] ?? "";
$first = $_GET["first"] ?? "";
$last = $_GET["last"] ?? "";

$ref = is_string($ref) ? strtoupper(trim($ref)) : "";
$refLike = "%" . $ref . "%";
$first = is_string($first) ? "%" . trim($first) . "%" : "%";
$last = is_string($last) ? "%" . trim($last) . "%" : "%";


// Database column names => Display labels.
$sorts = [
    "EOInumber" => "EOI Number",
    "jobref" => "Job Reference",
    "fname" => "First Name",
    "lname" => "Last Name",
    "status" => "Status"
];

// Get the selected sorting method.
$sort = $_GET["sort"] ?? "EOInumber";

// Only allow valid database columns.
if (!array_key_exists($sort, $sorts)) {
    $sort = "EOInumber";
}


// Retrieve matching EOIs using a prepared SQL statement.
// LIKE allows partial first and last name searches.
$sql = "SELECT * FROM eoi
        WHERE (? = '' OR jobref LIKE ?)
        AND fname LIKE ?
        AND lname LIKE ?
        ORDER BY $sort";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $ref, $refLike, $first, $last);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Include the existing website header.
$page_title = "HR Management";
include "header.inc";
?>

<!-- Page layout without modifying the shared stylesheet. -->
<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        margin: 0;
    }

    main {
        flex: 1;
    }

    /* Keep search fields in organised rows. */
    .search-row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    /* Keep each label and its input together. */
    .search-row label {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }



</style>

<main>

    <!-- One large article containing the full management interface. -->
    <article class="application-section">

        <h1>HR Management</h1>

        <?php if ($message != "") { ?>
            <p><?= h($message) ?></p>
        <?php } ?>

        <hr>

        <!-- SEARCH AND SORT -->
        <h2>Search EOIs</h2>

        <form method="get">

            <!-- First row: Job reference and sorting. -->
            <div class="search-row">
                <label>Job Reference:
                    <input name="ref" value="<?= h($ref) ?>">
                </label>

                
            <label>Sort By:
                <select name="sort">
                    <?php foreach ($sorts as $column => $label) { ?>
                        <option value="<?= h($column) ?>"
                            <?= $sort == $column ? "selected" : "" ?>>
                            <?= h($label) ?>
                        </option>
                    <?php } ?>
                </select>
            </label>
            </div>

            <!-- Second row: Applicant name filters. -->
            <div class="search-row">
                <label>First Name:
                    <input name="first" value="<?= h($_GET["first"] ?? "") ?>">
                </label>

                <label>Last Name:
                    <input name="last" value="<?= h($_GET["last"] ?? "") ?>">
                </label>
            </div>

            <!-- Third row: Search and reset. -->
            <div class="search-row">
                <button type="submit">Search</button>
                <a href="manage.php">Show All EOIs</a>
            </div>

        </form>

        <hr>

        <!-- EOI TABLE -->
        <h2>EOI Records</h2>

        <div style="overflow-x: auto;">
            <table border="1" cellpadding="5">
                <tr>
                    <?php
                    // Automatically display database column names.
                    foreach (mysqli_fetch_fields($result) as $field) {
                        echo "<th>" . h($field->name) . "</th>";
                    }
                    ?>
                </tr>

                <?php
                // Display each matching EOI and all its fields.
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";

                    foreach ($row as $value) {
                        echo "<td>" . h($value) . "</td>";
                    }

                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <hr>

        <!-- UPDATE STATUS -->
        <h2>Change EOI Status</h2>

        <form method="post">
            <input type="hidden" name="token" value="<?= h($_SESSION["token"]) ?>">

            <label>EOI Number:
                <input type="number" name="id" min="1"
                       style="width: 55px;" required>
            </label>

            <label>Status:
                <select name="status">
                    <option>New</option>
                    <option>Current</option>
                    <option>Final</option>
                </select>
            </label>

            <button name="action" value="update">Update Status</button>
        </form>

        <hr>

        <!-- DELETE BY JOB REFERENCE -->
        <h2>Delete EOIs</h2>

        <p>Warning: Deletes all EOIs for the entered job reference.</p>

        <form method="post">
            <input type="hidden" name="token" value="<?= h($_SESSION["token"]) ?>">

            <label>Job Reference:
                <input name="ref" maxlength="6" required>
            </label>

            <button name="action" value="delete">Delete EOI</button>
        </form>

        <hr>

        <!-- LOGOUT AT THE BOTTOM -->
        <form method="post">
            <input type="hidden" name="token" value="<?= h($_SESSION["token"]) ?>">
            <button name="action" value="logout">Log Out</button>
        </form>

    </article>

</main>

<?php include "footer.inc"; ?>

<?php
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
