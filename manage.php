
<?php
// Start session and protect the page from unauthorised access.
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// Handle logout.
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["action"]) && $_POST["action"] == "logout") {

    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Include the existing website header.
$page_title = "HR Management";
include "header.inc";
?>

<!-- Keep the footer at the bottom of the page. -->
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

        <h1>HR Management</h1>

        <hr>

        <!-- Logout button. -->
        <form method="post">
            <button name="action" value="logout">Log Out</button>
        </form>

    </article>
</main>

<?php include "footer.inc"; ?>
