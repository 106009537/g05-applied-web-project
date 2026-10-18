
<?php
// Start the session so PHP can remember the login.
ini_set("session.cookie_httponly", "1");
session_start();

// Skip login if already authenticated.
if (isset($_SESSION["admin_id"])) {
    header("Location: manage.php");
    exit();
}

$error = "";

// Check credentials when the form is submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "settings.php";
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) die("Database connection failed.");
    mysqli_set_charset($conn, "utf8mb4");

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    // Find the username using a prepared statement.
    $stmt = mysqli_prepare($conn,
        "SELECT id, password_hash FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $account = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    // Verify the password against its stored hash.
    if ($account && password_verify($password, $account["password_hash"])) {
        session_regenerate_id(true);
        $_SESSION["admin_id"] = $account["id"];
        header("Location: manage.php");
        exit();
    }

    $error = "Invalid username or password.";
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// Include the existing website header.
$page_title = "Manager Login";
include "header.inc";
?>

<!-- Keep the footer at the bottom without changing the shared CSS. -->
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
</style>

<main>
    <article class="application-section">
        <h1>Manager Login</h1>

        <form method="post">
            <label>Username:
                <input type="text" name="username" required>
            </label>

            <label>Password:
                <input type="password" name="password" required>
            </label>

            <!-- Only show the red error message after a failed login. -->
            <?php if ($error != "") { ?>
                <p style="color: red;">
                    <?= htmlspecialchars($error) ?>
                </p>
            <?php } ?>

            <button type="submit">Log In</button>
        </form>
    </article>
</main>

<?php include "footer.inc"; ?>
