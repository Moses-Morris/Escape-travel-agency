
<?php
session_start(); // Always start session to access session variables
include('User/config/connection.php');

//include('User/auth/usersession.php');
?>

<!DOCTYPE html>
<html prefix="og: https://ogp.me/ns#" lang="en">
<head>
    <!--------------------------Open Graph-------------------------------------->
    <meta property="og:url"                content="https://escapeagency.com/" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Escape Tours and Travel Agency" />
    <meta property="og:description"        content="Your Gateway to Unforgettable and Stressfree Travel and Adventures." />
    <meta property="og:image" content="https://escapeagency.com/media/pexels-elvis-mkera-14909652 (1).jpg" />

    <!--------------------------Meta-------------------------------------->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover new destinations with Us. Escape with us.">
    <meta name="author" content="mosesmorrisdev@gmail.com">
    <meta name="keywords" content="travel, tours, Adventures, escape, discover, food, hosting, activities, teambuilding, ">
    <title>Escape Tours and Travel Agency</title>

    <!--------------------------Favicon-------------------------------------->
    



    <!---------------------------CSS Linking---------------------------------------------->
    <link rel="stylesheet" href="dashboard/css/index.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/mobile.css">
    <link rel="stylesheet" href="css/tablet.css">
    <link rel="stylesheet" href="css/large.css">
    <link rel="stylesheet" href="css/nav.css">
    <!---->
    <link rel="stylesheet" href="dashboard/css/dashboard.css">
    <link rel="stylesheet" href="dashboard/css/destination.css">
    <link rel="stylesheet" href="dashboard/css/destinationinfo.css">
    

    

    <!---------------------------Icon Linking---------------------------------------------->
    <script src="https://kit.fontawesome.com/6c6f1b6f8c.js" crossorigin="anonymous"></script>

    <!---------------------------Animations Linking---------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!---------------------------Fullpage.js Linking---------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.js"></script>

    <!---------------------------------CDNS---------------------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!----Swiper.js CDN-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!----Scroll Animations and GSAP-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>


</head>
<body>

    <!---------------------------The top section with header--------------------------------------------------->
    <section class="hero" style="background:none; !important">
        <!---Header Nav-->
        <header>
            <nav class="navbar">
                <div class="logo">
                    <img src="media/Escape Agency adventures Company Logo.png" alt="Company Logo Escape Ventures Agency">
                    <!--p>Travel Agency</p-->
                </div>
                <div class="menu-toggle" >
                    &#9776;
                </div>

                <ul class="nav-links">
                    <li ><a href="#" class="x-icon-menu"><i class="fa-solid fa-xmark fa-xl"></i></a></li>
                    <li><a href="index.php#Home">Home</a></li>
                    <li><a href="tours.php">Destinations</a></li>
                    <li><a href="hostings.php">Hostings</a></li>  
                    <li><a href="blogs.php">Blogs</a></li>
                    <li><a href="events.php">Activities</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="resources.php">Resources</a></li>
                    
                </ul>

                <div class="cta-button dash">
                    <?php
                    /*
                     if (isset($_SESSION['username'])) {
                        echo "
                             <a href=''>
                               <button type='button' class='notification-btn'>
                                   <i class='fa fa-notification'></i>
                               </button>
                             </a>
                              ";
                     }*/
                    ?>
                    
                    <div class="cta-button">
                
                    <?php
                        // Check if the user is logged in by checking session variables
                        
                        
                        if (isset($_SESSION['username'])) {
                            // User is logged in
                            echo "<a href='User/auth/logout.php'>Logout</a>";
                            echo "<a class='useraccount' href='dashboard/dashboard.php'>
                                            <i class='fa fa-user'></i>
                                            <p>".$_SESSION['username']."</p>       
                                        </a>";

                            
                        } else {
                            /* Not logged in
                            session_unset();
                            session_destroy();
                            header("Location: ../login.php?msg=" . urlencode("Session expired. Please login again."));
                            exit();*/
                            echo "<a href='login.php'>
                                            <button class='login'>Book Now</button>
                                        </a>";
                        }
                    
                    ?>
                    
                </div>
                </div>
            </nav>
        </header>
    </section>


    <main class="destination-page-main">
        <!--destination images-->
        <div class="dest-detail-info">
            <h3><i class="fa fa-location"></i>Mt Kilimanjaro</h3>
        </div>
        <section class="destination-images">
            <div class="dest-info-images">
                <div class="disp-one main-image">
                    <img src="media/pexels-marius-nacu-376246-11342444.jpg">
                </div>
                <div class="gallery-images">
                    <div class="disp-two">
                        <img src="media/pexels-mikhail-nilov-7706438.jpg">
                    </div>
                    <div class="disp-three">
                        <img src="media/pexels-zachary-gudakov-2063605-4243684.jpg">
                    </div>
                    <div class="disp-four">
                        <img src="media/pexels-pixabay-262978.jpg">
                    </div>
                </div>

            </div>
        </section>
        
        <!--destination information and bookings-->
        <section>
            <article class="dest-map">
                <main>
                    <div class="dest-detail-data">
                        <div class="dest-detail-info">
                            <h3><i class="fa fa-"></i>Mt Kilimanjaro</h3>
                            <p><i class="fa fa-star"></i>4.8</p>
                        </div>
                        <div>
                            <h2>USD 900</h2>
                        </div>
                    </div>
                    <div class="dest-description">
                        <p>Wait for confirmation on the Dashboard. Escape Agency also provides a list of documents needed
                            For the adventure and everything needed for the trip. It listed on the Dashboard</p>
                        <a href="bookingdetails.php">
                            Book Now
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>

                </main>
                <aside>
                    <div class="gps-map-data">
                        <p>Show on map</p>
                        <img src="media/Screenshot (2570) 1.png" alt="Placeholder Image of maps">
                    </div>
                </aside>
            </article>
        </section>

        <!--destination Activities and travel options-->
        <section class="travel-activities-section">
            <article class="travel-activities">
                <main>
                    <h4>Activities Available</h4>
                    <div class="dest-activities-info">
                        <div>
                            <p>Swimming</p>
                        </div>
                        <div>
                            <p>Hiking</p>
                        </div>
                        <div>
                            <p>Sports</p>
                        </div>
                        <div>
                            <p>Team-Building</p>
                        </div>
                        <div>
                            <p>Camping</p>
                        </div>
                        <div>
                            <p>Rafting</p>
                        </div>

                    </div>
                </main>
                <aside>
                    <h4>Travelling Options</h4>
                    <div class="dest-travel-info">
                        <div class="travel-type">
                            <p>Train Bookings</p>
                            <i class="fa fa-train"></i>
                        </div>
                        <div class="travel-type">
                            <p>Bus Bookings</p>
                            <i class="fa fa-bus"></i>
                        </div>
                        <div class="travel-type">
                            <p>Flights</p>
                            <i class="fa fa-aeroplane"></i>
                        </div>
                    </div>
                </aside>
            </article>
        </section>

        <!--destination reviews and hostings-->
        <section class="reviews-hostings">
            <article class="review-hosting">
                <main>
                    <h4>Customer Reviews</h4>
                    <div class="dest-client-reviews">
                        <div class="review-card">
                            <div class="client-data">
                                <img src="" alt="client profile image"> 
                                <p>Client Name</p>
                            </div>
                            <div>
                                <p>Mt Kilimanjaro has been the best experience .
                                    Since I went there I keep feeling the urge to go
                                    back
                                </p>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="client-data">
                                <img src="" alt="client profile image"> 
                                <p>Client Name</p>
                            </div>
                            <div>
                                <p>Mt Kilimanjaro has been the best experience .
                                    Since I went there I keep feeling the urge to go
                                    back
                                </p>
                            </div>
                        </div>
                    </div>
                </main>
                <aside class="hostings">
                    <h4>Local Hostings</h4>
                    <div class="hostings-cards">
                        <div class="hosting-place-card">
                            <div class="hosting-name-more">
                                <div>
                                    <h5>Prime Luxury Suites</h5>
                                    <p><i class="fa fa-star"></i>1400 reviews</p>
                                </div>
                                <div>
                                    <a href="" class="more-details">More </a>
                                </div>
                            </div>
                            <div class="hostings-info">
                                <div>
                                    <p>Business hotel in Tanzania</p>
                                    <p>$100–$400 per night</p>
                                </div>
                                <div>
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>

                        </div>
                        <div class="hosting-place-card">
                            <div class="hosting-name-more">
                                <div>
                                    <h5>Prime Luxury Suites</h5>
                                    <p><i class="fa fa-star"></i>1400 reviews</p>
                                </div>
                                <div>
                                    <a href="" class="more-details">More </a>
                                </div>
                            </div>
                            <div class="hostings-info">
                                <div>
                                    <p>Business hotel in Tanzania</p>
                                    <p>$100–$400 per night</p>
                                </div>
                                <div>
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>

                        </div>

                        <div class="hosting-place-card">
                            <div class="hosting-name-more">
                                <div>
                                    <h5>Prime Luxury Suites</h5>
                                    <p><i class="fa fa-star"></i>1400 reviews</p>
                                </div>
                                <div>
                                    <a href="" class="more-details">More </a>
                                </div>
                            </div>
                            <div class="hostings-info">
                                <div>
                                    <p>Business hotel in Tanzania</p>
                                    <p>$100–$400 per night</p>
                                </div>
                                <div>
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </aside>
            </article>

        </section>

        <!--Destination Gallery-->
        <section>
            <h4>Destination Gallery</h4>
            <div class="destination-imgs">
                <div>
                    <img src="media/pexels-marius-nacu-376246-11342444.jpg">
                </div>
                <div>
                    <img src="media/pexels-quang-nguyen-vinh-222549-4078053.jpg">
                </div>
                <div>
                    <img src="media/pexels-valdemaras-d-784301-3871773.jpg">
                </div>
                <div>
                    <img src="media/pexels-pixabay-260922.jpg">
                </div>
            </div>
        </section>

    </main>



    <footer class="pad-5">
        <div class="footer-content">
            <div>
                <img src="media/Escape Agency adventures Company Logo.png">
                <h4>Escape Tours and Travel Agency Limited</h4>
                <h1>Discover and
                    book your next
                    escape with us.</h1>
            </div>
            <div>
                <h7>Our Offices</h7>
                <p>- New York, USA</p>
                <p>- London, UK</p>
                <p>- Sydney, Australia</p>
    
                <h7>Contact Information</h7>
                <p>Email: support@escapeagency.com</p>
                <p>Phone: +1 (800) 123-4567</p>
            </div>
            <div>
                <div class="footer-newsletter">
                    <h4>Subscribe to our newsletter</h4>
                    <form>
                        <input type="email" placeholder="travel@gmail.com">
                    </form>
                </div>
                <div class="socials">
                    <a href="">
                        <i></i>
                    </a>
                    <a href="">
                        <i></i>
                    </a>
                    <a href="">
                        <i></i>
                    </a>
                </div>
            </div>
    
        </div>
    </footer>
    
    <!---------------------------JS Linking---------------------------------------------->
    <script src="js/index.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/gsap.js"></script>
    
    
    
    </body>
    </html>