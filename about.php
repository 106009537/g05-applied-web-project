<?php
$page_title = "About the Team - Quokka Recovery Program";
include 'settings.php';
$conn = mysqli_connect($host, $user, $pwd, $sql_db);
include 'header.inc';


?>

  <main>

        <h1 id="about-title" style="text-align: center;">About Our Team</h1>

        <section id="team">

          <article>

              

              <h2>Contributions</h2>

              <dl>
                <?php
                $members_query = "SELECT DISTINCT member_name
                                FROM team_contributions
                                ORDER BY contribution_id";

                $members_result = mysqli_query($conn, $members_query);

                while ($member = mysqli_fetch_assoc($members_result)) {
                    echo "<dt><strong>" . $member['member_name'] . ":</strong></dt>";

                    $member_name = $member['member_name'];

                    $contributions_query = "SELECT * FROM team_contributions
                                            WHERE member_name = '$member_name'
                                            ORDER BY project_number";

                    $contributions_result = mysqli_query($conn, $contributions_query);

                    while ($contribution = mysqli_fetch_assoc($contributions_result)) {
                        echo "<dd><strong>Project "
                            . $contribution['project_number']
                            . ":</strong> "
                            . $contribution['contribution_details']
                            . "</dd>";
                    }
                }
                ?>
              </dl>

          </article>


          <figure>
              <img src="images/rangers.png"
                    alt="Quokka Recovery Program team" />
                    <figcaption style="background-color: #cddbd7; color: #313534; padding: 10px; text-align: center; border-radius: 0 0 10px 10px;">
                        G05 - 404 Found team</figcaption>
          </figure>

      </section>


      <section id="team-details">

          <article>

            <h2>Favourite Non-English Quotes</h2>

            <?php
            $members_query = "SELECT DISTINCT member_name
                            FROM team_quotes
                            ORDER BY quote_id";

            $members_result = mysqli_query($conn, $members_query);

            while ($member = mysqli_fetch_assoc($members_result)) {
                echo "<h3>" . $member['member_name'] . ":</h3>";

                $member_name = $member['member_name'];

                $quotes_query = "SELECT * FROM team_quotes
                                WHERE member_name = '$member_name'
                                ORDER BY quote_id";

                $quotes_result = mysqli_query($conn, $quotes_query);

                while ($quote = mysqli_fetch_assoc($quotes_result)) {
                    echo "<p><strong>"
                        . $quote['language']
                        . ":</strong> \""
                        . $quote['quote_text']
                        . "\"</p>";

                    echo "<p><strong>English:</strong> "
                        . $quote['english_translation']
                        . "</p>";
                }
            }
            ?>

        </article>


        <table>
            <caption style="background-color: #cddbd7; color: #1B4D3E; font-weight: bold; padding: 15px; text-align: left;">
                Fun Facts About Our Team
            </caption>

            <thead>
                <tr>
                    <th scope="col">Team Member</th>
                    <th scope="col">Fun Facts</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $members_query = "SELECT DISTINCT member_name
                                FROM team_fun_facts
                                ORDER BY fact_id";

                $members_result = mysqli_query($conn, $members_query);

                while ($member = mysqli_fetch_assoc($members_result)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $member['member_name'] . "</th>";
                    echo "<td>";

                    $member_name = $member['member_name'];

                    $facts_query = "SELECT * FROM team_fun_facts
                                    WHERE member_name = '$member_name'
                                    ORDER BY fact_id";

                    $facts_result = mysqli_query($conn, $facts_query);

                    while ($fact = mysqli_fetch_assoc($facts_result)) {
                        echo $fact['fact_details'] . "<br>";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
</table>

      </section>

  </main>

<?php include 'footer.inc'; ?>