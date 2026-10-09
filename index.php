   <?php
   $page_title = "Home - Quokka Recovery Program";
   include 'header.inc';
   ?>

    <section id="introduction">

        <figure>
            <img src="images/main-image.png"
                    alt="Quokka Recovery Program" />
        </figure>
    </section>



    <main>




        <section id="overview">

            <article>
                <h1>Program Overview</h1>

                <h3>What the program is</h3>
                <p>
                    The Quokka Recovery Program is a conservation initiative focused on protecting quokka populations and supporting their long-term survival through habitat protection, research and community involvement.
                </p>

                <h3>Where it operates</h3>
                <p>
                    The program operates in areas of Western Australia where quokkas live, with a focus on protecting important habitats and supporting healthy wild populations.
                </p>

                <h3>What it aims to achieve</h3>
                <p>
                    The program aims to increase quokka numbers, restore and protect their habitats, reduce threats to their survival and build greater awareness of quokka conservation.
                </p>
            </article>

            <figure>
                <img src="images/Island_vista.png"
                     alt="Quokka Recovery Program activities" />
            </figure>

        </section>


        <section id="impacts">

            <h2>Impacts</h2>

            <div class="impact-container">
                <article>
                    <figure>
                        <img src="images/increasing_population.png"
                            alt="Quokka population" />
                    </figure>

                    <p>
                        Through protection and breeding success, wild quokka populations are steadily increasing, with more quokkas being seen in their natural habitats.
                    </p>
                </article>


                <article>
                    <figure>
                        <img src="images/restoring_habitats.png"
                            alt="Quokka habitat" />
                    </figure>

                    <p>
                        The program's habitat restoration work focuses on creating and maintaining suitable environments for quokkas, including the removal of invasive species and the replanting of native vegetation.
                    </p>
                </article>
            </div>
        </section>

<!-- Adding inline styles for the donor section to satisfy the requirement -->
        <section id="donors">  

            <h2>High Donor Rankings</h2>
            <div class="donor-container">
            <article style="display: flex; justify-content: space-between; align-items: center; background-color: #1F3C27; color: white; padding: 10px; border-radius: 5px;">
                
                <div>
                    <h3>Donated: $10,000</h3>
                    <p>Keith Australia</p>
                    <p>Scaffolding Crew <br>Boss</p>
                </div>

                <img src="images/sillouhette.png"
                    alt="placeholder"
                    style="width: 70px; height: 70px; object-fit: contain; margin-left: 5px; flex-shrink: 0;">
            </article>
            <article style="display: flex; justify-content: space-between; align-items: center; background-color: #1F3C27; color: white; padding: 10px; border-radius: 5px;">
                
                <div>
                    <h3>Donated: $5,500</h3>
                    <p>Lockey Meatpies</p>
                    <p>Football Grounds <br>Overseer</p>
                </div>

                <img src="images/sillouhette.png"
                    alt="placeholder"
                    style="width: 70px; height: 70px; object-fit: contain; margin-left: 15px; flex-shrink: 0;">
            </article>
            <article style="display: flex; justify-content: space-between; align-items: center; background-color: #1F3C27; color: white; padding: 10px; border-radius: 5px;">
                
                <div>
                    <h3>Donated: $2300</h3>
                    <p>Sheila Footscray</p>
                    <p>Bunnings Store <br>Manager</p>
                </div>

                <img src="images/sillouhette.png"
                    alt="placeholder"
                    style="width: 70px; height: 70px; object-fit: contain; margin-left: 15px; flex-shrink: 0;">
            </article>
            </div>
    

        </section>

        <section id="recovery-table">
    <h2>Recovery Priorities</h2>

    <table>
        <thead>
            <tr>
                <th rowspan="2" scope="col" id="focus">Focus Area</th>
                <th colspan="2" scope="colgroup" id="actions">Recovery Actions</th>
            </tr>
            <tr>
                <th scope="col" id="activity">Activity</th>
                <th scope="col" id="goal">Goal</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th rowspan="2" scope="rowgroup" id="habitat">Habitat Protection</th>
                <td headers="habitat activity">Native vegetation restoration</td>
                <td headers="habitat goal">Improve quokka habitats</td>
            </tr>

            <tr>
                <td headers="habitat activity">Invasive species management</td>
                <td headers="habitat goal">Reduce threats to populations</td>
            </tr>

            <tr>
                <th scope="row" id="population">Population Recovery</th>
                <td headers="population activity">Population monitoring and protection</td>
                <td headers="population goal">Support healthy wild populations</td>
            </tr>

            <tr>
                <th scope="row" id="community">Community</th>
                <td headers="community activity">Education and conservation awareness</td>
                <td headers="community goal">Encourage long-term protection</td>
            </tr>
        </tbody>
    </table>
</section>


        <section id="acknowledgement">

            <img src="images/acknowledgement.png"
                alt="Acknowledgement of Country"
                style="border-radius: 10px;">

        </section>

    </main>

   <?php include 'footer.inc'; ?>