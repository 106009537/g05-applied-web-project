// --------------------------------------------------
// ADMIN ACCOUNT SETUP
// --------------------------------------------------
//This is a script to create the admin acc to login to manage.php
//You only need to run it once; it is hardcoded to just make the admin acc
//Enter in the terminal to run: C:\xampp\php\php.exe setup_admin_acc.php




<?php


// PHP_SAPI identifies how PHP is being executed.
// "cli" means command-line interface.
if (PHP_SAPI !== "cli") {
    http_response_code(403);
    exit("Access denied.");
}

// Load the existing database configuration.
require_once "settings.php";

// Connect to the MySQL database.
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Database connection failed.");
}

// Use UTF-8 when communicating with the database.
mysqli_set_charset($conn, "utf8mb4");

// Required credentials for the assignment.
$username = "admin";
$password = "admin";

// First check whether this username already exists.
// The ? is a placeholder for the username.
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind the username as a string ("s").
mysqli_stmt_bind_param($stmt, "s", $username);

// Execute the SQL query.
mysqli_stmt_execute($stmt);

// Store the result so we can count matching rows.
mysqli_stmt_store_result($stmt);

// Check whether any matching username was found.
$account_exists = mysqli_stmt_num_rows($stmt) > 0;

mysqli_stmt_close($stmt);

if ($account_exists) {

    // Do not overwrite an existing account.
    echo "Admin account already exists.";

} else {

    // Hash the password before storing it.
    // PASSWORD_DEFAULT uses PHP's recommended
    // password-hashing algorithm.
    $hashed_password = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    // Insert the username and password hash.
    $sql = "INSERT INTO users (username, password_hash)
            VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    // Both values are strings, hence "ss".
    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $username,
        $hashed_password
    );

    mysqli_stmt_execute($stmt);

    echo "Admin account created successfully.";

    mysqli_stmt_close($stmt);
}

// Close the database connection.
mysqli_close($conn);
?>
