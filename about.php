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

              <h3>Eddy Lemos:</h3>
              <p>
                  <strong>Roman:</strong>
                  "Dum spiro spero" - Cicero
              </p>
              <p>
                  <strong>English:</strong>
                  "While I breathe I hope"
              </p>


              <h3>Alisha Khokhar:</h3>
              <p>
                  <strong>French:</strong>  "L'esprit est toujours la dupe du cœur"
              </p>
              <p>
                  <strong>English:</strong> The intellect is always the fool of the heart
              </p>


              <h3>Cam Yardy:</h3>
              <p>
                  <strong>Irish:</strong> "Is fearr Gaeilge briste, ná Béarla clíste"
              </p>
              <p>
                  <strong>English:</strong> Better broken Irish than clever English
              </p>

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

                  <tr>
                      <th scope="row">Eddy Lemos</th>
                      <td>
                          I've been playing guitar for 15 years; <br>I'm a Japanese speaker and lived there for 3 years;<br>Canadian but moved to Aus at 18 <br>I also like cooking and weightlifting; <br>fav authors: Jules Verne, Yukio Mishima; <br>fav games: Halo, Bioshock, portal
                      </td>
                  </tr>

                  <tr>
                      <th scope="row">Alisha Khokhar</th>
                      <td>
                           I love playing games, and my favourite game or game series is Resident Evil
                      </td>
                  </tr>

                  <tr>
                      <th scope="row">Cam Yardy</th>
                      <td>
                          Before going to Swinburne I did a gap year working the snow season at Mt Hotham.
                      </td>
                  </tr>

              </tbody>

          </table>

      </section>

  </main>

<?php include 'footer.inc'; ?>