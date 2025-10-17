<?php
    include 'base.php';
?>
        <article class="hero-data">
            <main>
                <h1>Escape Tiredness with <span class="enhance">Escape Travel Agency</span></h1>
                <h2>Your Gateway to Unforgettable and Stressfree <span class="enhance">Travel</span> and <span class="enhance">Adventures</span></h2>
                <h3>
                Join us on meticulously planned tours designed to create unforgettable memories. 
                <br>Whether you’re looking for solo adventures, romantic getaways, or family trips, we have something for everyone.
                <br>Discover and book your next Escape with Us.
            </h3>
                
                <form class="background-color-type" action="tours.php" method="get">
                    <div>
                        <input list="locations" id="location" name="location" placeholder="Location">
                        <datalist id="locations">
                            <option value="Maldives"></option>
                            <option value="Paris"></option>
                            <option value="Hawaii"></option>
                            <option value="Bali"></option>
                            <option value="Santorini"></option>
                        </datalist>
                    </div>
                    <div>
                        <input list="activities" id="activities" name="activities" placeholder="Activities">
                        <datalist id="activities">
                            <option value="Camping"></option>
                            <option value="Swimming"></option>
                            <option value="Surfing"></option>
                            <option value="Kayaking"></option>
                            <option value="Gliding"></option>
                        </datalist>
                    </div>
                    <div>
                        <button type="submit">
                            <i class="fa fa-search"></i>
                            Discover Places
                        </button>
                    </div>
                </form>

            </main>
            <aside>

            </aside>

        </article>
    </section>





    <!--------------------------Main Page Content------------------------------------------------------------>
    <main>
        <!--------------------------Destinations and Explore Section------------------------------------------------------------>
        <section>
            <article class="destinations">
                <main class="direct">
                  <!-- main content goes here -->
                  <h3>Popular Destinations</h3>
                  <p>Join us on meticulously planned tours designed to create unforgettable memories. Whether you’re looking for solo adventures, romantic getaways, or family trips, we have something for everyone.</p>
                  <a href="tours.php" >Tours and Destinations</a>
                </main>
                <aside>
                <div class="destination-cards">
                  <!-- aside content goes here -->
                   <?php 
                   //SELECT POPULAR DESTINATIONS.
                        $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE status='approved' AND featured=1 LIMIT 4");
                        while($row = mysqli_fetch_array($dest)){
                            $destId = $row['DestinationID'];
                            $desc = $row['Description'];
                            $rating = $row['RatingAVG'];
                            $image = $row['ImageURL'];
                            
                            echo "
                                            <div class='dest-1'>
                                                    <div class='dest-image'>
                                                        "; 
                                                        ?>
                            <img src="media/<?php echo $image; ?>" alt="<?php  echo $desc; ?> ">
                            <?php
                            echo "
                                                    </div>
                                                    <div class='dest-info'>
                                                        <div class='dest-data'>
                                                            <h4>".$desc."</h4>
                                                            <p><i class='fa fa-star'></i> ".$rating."</p>
                                                        </div>
                                                        
                                                        <div class='dest-more'>;"

                                                            ?>

                                                            <a href="destinationinfo.php?id=<?php echo $destId; ?>" style="text-decoration:none !important; margin:0 !important; padding: 0 !important; background-color: none !important; font-size: large !important;"> <i class="fa fa-arrow-right fa-2xl" style="background-color: none !important;"></i></a>

                                                            <?php echo "
                                                        </div>
                                                    </div>
                                                </div>
                                                ";
                                               
                        }
                   ?>
                  
                    

                   
                

                    
                    
                  </div>
                </aside>
                <!-- other elements can go here -->
            </article>


            <article class="explore">
                
                <main>
                    <header>
                        <h1>Explore with Us</h1>
                    </header>
                    <div class="explore-img">
                        <img src="media/pexels-zachary-gudakov-2063605-4243684.jpg">
                    </div>
                </main>
                <aside>
                    <h3>Having an ideal travel partner is the best decision ever
                        We are here for you and here is our unlimited services</h3>

                    <div class="activities">
                        
                        <div class="activities-card">
                            <i class="fa-solid fa-user-group fa-2xl"></i>
                            <p>Group Tours</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-passport fa-2xl"></i>
                            <p>Custom Travel Planning</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-compass fa-2xl"></i>
                            <p>Travel Insurance</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-plane fa-2xl"></i>
                            <p>Flights</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-bowl-food fa-2xl"></i>
                            <p>Food</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-clock fa-2xl"></i>
                            <p>24/7 Support</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-hotel fa-2xl"></i>
                            <p>Hotel</p>
                        </div>
                        <div class="activities-card">
                            <i class="fa-solid fa-bus fa-2xl"></i>
                            <p>School Tours</p>
                        </div>

                    </div>
                </aside>

            </article>
            

            <div class="explore-data pad-5">
                <div class="explore-data-cards">
                    <div class="explore-data-card">
                        <h5>400+ <br>Hotels</h5>
                    </div>
                    <div class="explore-data-card">
                        <h5>200+ <br>Destinations</h5>
                    </div>
                    <div class="explore-data-card">
                        <h5>300+ <br>Activities</h5>
                    </div>
                    <div class="explore-data-card">
                        <h5>4000+ <br>Satisfied Customers</h5>
                    </div>

                </div>

            </div>

        </section>

        <!--------------------------Adventures Section------------------------------------------------------------>
        <section class="ADVENTURES pad-5 ">
            <h3>Adventures that Await You</h3>
            <div class="adventures">
                <div class="adventures-navigation">
                    <div>
                        <h6>Activities</h6>
                    </div>
                    <div class="scrollable-menu">
                        <ul>
                            
                            <li><a href="">Culture</a></li>
                            <li><a href="">Wellness</a></li>
                            <li><a href="">Camping</a></li>
                            <li><a href=""><i></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="adventures-api-cards">
                    <?php
                            $act = mysqli_query($conn,"SELECT * FROM activities WHERE status='approved' || status='active'  LIMIT 8 ");
                            while($row = mysqli_fetch_array($act)){
                                $actimages = $row['ImageURL'];
                                $actname = $row['Name'];
                                $ratavg = $row['RatingAVG'];
                                $destID = $row['DestinationID']; //make sure the destid variable is differnent

                                $destDetails = mysqli_query($conn,"SELECT country FROM  destinations WHERE DestinationID=$destID ");
                                $r = mysqli_fetch_row($destDetails);
                                $nr = $r[0];
                                
                                echo "
                                    <div class='adventures-activity'> "; 
                                    ?>

                                        <img src='media/<?php echo $actimages; ?>'>
                                        <?php echo "
                                        <div class='adventure-info'>
                                            <h6>".$actname."</h6>
                                            <div>
                                                <h7><i class='fa fa-location-dot'></i>".$nr."</h7>
                                                <p><i class='fa fa-star'></i>".$ratavg."</p>
                                            </div>
                                            <div>
                                                <a href='destinationinfo.php?id=".$destID."'>View activity</a>
                                            </div>
                                        </div>
                                    </div>
                                ";

                            }
                        ?>
                    
                    

                </div>
            </div>
            
            
        </section>

          <!--------------------------Hosting and Travel Section------------------------------------------------------------>
          <section class="Hosting pad-5">
            <h3>Hosting and Travel</h3>
            <div class="hosting">
                
                <div class="hosting-options">
                    <div class="hosting-option">
                        <img class="" src="media/pexels-pixabay-164595.jpg">
                        <h4>Hotels</h4>
                    </div>
                    <div class="hosting-option">
                        <img class="" src="media/pexels-heyho-7746574.jpg">
                        <h4>AirBnB</h4>
                    </div>
                    <div class="hosting-option">
                        <img class="" src="media/pexels-pixabay-262047.jpg">
                        <h4>Resorts</h4>
                    </div>
                </div>
                <div class="hosting-cta">
                    <p>You dont have to worry about the place you will stay or how you will
                        travel. We have got you!!
                        from luxury resorts to budget-friendly hostels.</p>
                    <img src="media/pexels-pixabay-164595.jpg">
                    <button> <a href="hostings.php">View all Hostings</a> </button>
                    
                </div>

            </div>
        </section>


         <!--------------------------Testimonials Section------------------------------------------------------------>
        <section class="Testimonials pad-5">
            <h3>What our Clients Say</h3>
            <p>Escape Travel staff are skilled, passionate and specialists in their field. Be confident that the
                Escape Travel team deliver exceptionally high standards ensuring your tour is meticulously
                planned, stress and hassle free!</p>

            <div class="testimonials-info">
                <div class="client-testimonial">
                    <p>"Escape Agency planned the perfect
                        honeymoon for us in Bali. We loved
                        every moment!"</p>
                    <p><bold>~ Emily R</bold></p>
                </div>
                <div class="client-testimonial">
                    <p>"Great service and amazing activities.
                        Highly recommend Escape Agency for
                        Italian trips!"</p>
                    <p><bold>~ Mark T</bold></p>
                </div>

            </div>
        </section>

        <!--------------------------Book CTA Section------------------------------------------------------------>
        <section class="Booking pad-5">
            <h3>Ready To Start Your Next Adventure ?</h3>
            <p>Booking your adventure is easy. Choose your package, select your dates, and complete your booking online.
                Our support team is here to assist you every step of the way.
                Clear information on pricing for various packages and services.
            </p>
            <div class="booking-buttons">
                <?php
                    if(isset($_SESSION['username'])){
                        $link = "tours.php#dest-id";
                    }else{
                        $link = "login.php";
                    }
                ?>
                <a href="<?php echo $link ?>" class="booknow">Book Now</a>
                <a href="" class="contactus">Contact Us</a>
            </div>
        </section>


        <!--------------------------Contact Section------------------------------------------------------------>
        <section class="Contact pad-5">
            <h3>Get In Touch</h3>
            <div class="Contact-details">
                <form>
                    <p>Have questions or need assistance?
                        Fill out the form and we'll get back to you as soon as
                        possible.</p>
                    <div>
                        <input type="text" placeholder="your@gmail.com">
                    </div>
                    <div>
                        <input type="textarea"  placeholder="Your message" >
                    </div>
                    <div>
                        <button>Get In Touch</button>
                    </div>
                </form>
                <div>
                    <img src="media/pexels-pixabay-163688.jpg">
                </div>
            </div>
        </section>


    </main>


   <?php
        require 'footer.php';
   ?>