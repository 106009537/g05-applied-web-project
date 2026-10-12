
<?php
$page_title = "Job Positions - Quokka Recovery Program";
include 'header.inc';
require_once 'settings.php';

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    die("Unable to connect to the database server.");
}

if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $sql = "SELECT * FROM jobs
            WHERE job_title LIKE '%$search%'
            OR job_ref LIKE '%$search%'";

} else {

    $sql = "SELECT * FROM jobs";

}

$result = mysqli_query($conn, $sql);
?>

<main>

    <section id="jobs-title">
        <h1>Current Hiring Position Descriptions</h1>

        <form action="jobs.php" method="get">
            <label for="search">Search by job title or reference:</label>

            <input
                type="text"
                id="search"
                name="search"
                value="<?php
                    if (isset($_GET['search'])) {
                        echo $_GET['search'];
                    }
                ?>">

            <input type="submit" value="Search">
        </form>
    </section>

    <aside id="jobs-info">
        <h2>Important Information</h2>

        <p>
            All paid positions are full time. Depending on the role,
            some positions may offer flexible work arrangements
            depending on the nature of the role.
        </p>

        <p>
            If the application is successful we will email you
            with further information.
        </p>

        <p>
            To apply head to the <a href="apply.php">apply</a> page.
        </p>
    </aside>

    <section>
        <h2 style="text-align: center;">Available Positions:</h2>
    </section>

    <div class="jobs-grid">

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                echo "<article class='job-block'>";

                echo "<div class='job-title-row'>";

                echo "<h3 class='job-heading'><strong>Job Title: </strong>"
                    . $row['job_title'] . "</h3>";

                echo "<a class='apply-here' href='apply.php'>Apply Here!</a>";

                echo "</div>";

                echo "<p><strong>Reference number: </strong>"
                    . $row['job_ref'] . "</p>";

                echo "<p><strong>Salary: </strong>"
                    . $row['salary'] . "</p>";

                echo "<h4>Position Description</h4>";
                echo "<p>" . $row['description'] . "</p>";

                echo "<h4>Reporting Line</h4>";
                echo "<p>Reports to " . $row['reporting_line'] . "</p>";

                echo "<h4>Key Responsibilities</h4>";
                echo "<p>" . $row['responsibilities'] . "</p>";

                echo "<h4>Essential Requirements</h4>";
                echo "<p>" . $row['essential_requirements'] . "</p>";

                echo "<h4>Preferred Skills</h4>";
                echo "<p>" . $row['preferred_skills'] . "</p>";

                echo "</article>";
            }

        } else {

            if (isset($_GET['search'])) {
                echo "<p>No matching jobs found.</p>";
            } else {
                echo "<p>No jobs are currently available.</p>";
            }

        }

        ?>

        <figure class="jobs-image">
            <img
                src="images/jobs-image.jpg"
                alt="Volunteers planting trees in a community park.">
        </figure>

    </div>

</main>

<?php
mysqli_close($conn);
include 'footer.inc';
?>
