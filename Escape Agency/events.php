<?php
    include 'base.php';
?>
        
        <article class="hero-data hero-data-events">
            <main>
                <h1>Upcoming Events and Activities</h1>
                <h2>Your Gateway to Unforgettable and Stressfree <span>Travel</span> and <span>Adventures</span></h2>
                <h3>Stay updated with our upcoming travel events, promotions, and exclusive Activities.</h3>
                <form class="background-color-type">
                    <div>
                        <input type="text" placeholder="Location">
                    </div>
                    <div>
                        <input type="text" placeholder="Events To Attend">
                    </div>
                    <div>
                        <input type="text" placeholder="Activities">
                    </div>
                    <div>
                        <button>
                            <i></i>
                            Discover Events
                        </button>
                    </div>
                </form>
                <div class="priest">
                    <img src="media/review-image.png" alt="Various destinations images">
                </div>
            </main>
            <aside>

            </aside>

        </article>
    </section>





     <!--------------------------Events Section------------------------------------------------------------>
     <?php
        //$conn = mysqli_connect("localhost", "root", "", "escape_agency");
        if (!$conn) {
            die("DB connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT EventID, Name, Location, StartDate, EndDate, ImageURL, LikesAVG, Description 
                FROM events 
                ORDER BY Created_at DESC 
                LIMIT 3"; 
        $result = mysqli_query($conn, $sql);
        ?>

        <section class="Events">
        <h4>Upcoming Events</h4>
        <div class="Events-container">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="event">
                <div class="event-images">
                <img src="<?php echo htmlspecialchars($row['ImageURL']); ?>">
                </div>
                <div class="event-info">
                <div class="event-info-top">
                    <h3><?php echo htmlspecialchars($row['Name']); ?></h3>
                    <div style="text-align:center;">
                    <i class="fa fa-heart fa-2xl heart-btn" data-event-id="<?php echo $row['EventID']; ?>"></i>
                    
                    <span class="favorite-count" id="count-<?php echo $row['EventID']; ?>">
                        <?php echo htmlspecialchars((int)$row['LikesAVG']); ?>
                    </span>
                    </div>
                </div>
                <div>
                    <p><?php echo htmlspecialchars($row['Description']); ?></p>
                </div>
                <div class="event-info-bottom">
                        <div class="voice-out">
                            <div>
                                <p><i class="fa fa-location"></i> Maasai Mara, Kenya</p>
                            </div>
                            <div>
                                <p><i class="fa fa-calendar"></i>July September</p>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
        </section>
     <!--section class="Events">
        <h4>Upcoming Events</h4>
        <div class="Events-container">
            <div class="event">
                <div class="event-images">
                    <img src="media/pexels-zeynep-sude-emek-193601188-28137496.jpg">
                </div>
                <div class="event-info">
                    <div class="event-info-top">
                        <h3>WildBeast Migration</h3>
                        <div style="text-align:center;">
                                <i class="fa fa-heart fa-2xl heart-btn" data-event-id="1"></i>
                                <span class="favorite-count" id="count-1">0</span>
                            </div>
                    </div>
                    <div>
                        <p>A perfect view of the biggest
                            herd of wildbeast migration.</p>
                    </div>
                    <div class="event-info-bottom">
                        <div class="voice-out">
                            <div>
                                <p><i class="fa fa-location"></i> Maasai Mara, Kenya</p>
                            </div>
                            <div>
                                <p><i class="fa fa-calendar"></i>July September</p>
                            </div>
                        </div>
                        <div class="more-linking">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="event">
                <div class="event-images">
                    <img src="media/pexels-valdemaras-d-784301-3871773.jpg">
                </div>
                <div class="event-info">
                    <div class="event-info-top">
                        <h3>Aurora Borealis Viewing
                            Experience</h3>
                            <div style="text-align:center;">
                                <i class="fa fa-heart fa-2xl heart-btn" data-event-id="2"></i>
                                <span class="favorite-count" id="count-2">0</span>
                            </div>
                    </div>
                    <div>
                        <p>Experience the magic of the
                            Northern Lights in Norway.</p>
                    </div>
                    <div class="event-info-bottom">
                        <div class="voice-out">
                            <div>
                                <p><i class="fa fa-location"></i> Tromsø, Norway</p>
                            </div>
                            <div>
                                <p><i class="fa fa-calendar"></i>November–March</p>
                            </div>
                        </div>
                        <div class="more-linking">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event">
                <div class="event-images">
                    <img src="media/pexels-alex-andra-2029432172-29109299.jpg">
                </div>
                <div class="event-info">
                    <div class="event-info-top">
                        <h3>Venice Carnival</h3>
                        <div style="text-align:center;">
                                <i class="fa fa-heart fa-2xl heart-btn" data-event-id="3"></i>
                                <span class="favorite-count" id="count-3">0</span>
                            </div>
                    </div>
                    <div>
                        <p>Extravagance of Venice Carnival,
                            streets fill with intricate masks.</p>
                    </div>
                    <div class="event-info-bottom">
                        <div class="voice-out">
                            <div>
                                <p><i class="fa fa-location"></i> Venice, Italy</p>
                            </div>
                            <div>
                                <p><i class="fa fa-calendar"></i>February (Before Lent )</p>
                            </div>
                        </div>
                        <div class="more-linking">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </div>
                    </div>
                </div>
            </div>


            

        </div>
    </section -->








    <!--------------------------Subscribe Section------------------------------------------------------------>
    <section class="newsletter-subscription">

        <div>
            <h7>Subscribe to Our newsletter. <br><br>
                    Stay informed of unlocked and hidden gems of destinations. Look out to escaping with us for various destinations</h7>
        </div>
        <div class="subscribe-form">
            <form>
                <div>
                    <input type="email" placeholder="usertraveller@gmail.com">
                </div>
                <div>
                    <button>Subscribe</button>
                </div>
            </form>

        </div>
    </section>


    


    <!--Footer-->
    <?php
        include 'footer.php';
    ?>
        