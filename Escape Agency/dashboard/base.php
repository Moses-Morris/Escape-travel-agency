<?php
session_start(); // Always start session to access session variables
include('../User/config/connection.php');

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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <link rel="stylesheet" href="../css/tablet.css">
    <link rel="stylesheet" href="../css/large.css">
    <link rel="stylesheet" href="../css/nav.css">
    <!---->
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/destination.css">
    <link rel="stylesheet" href="./css/mybooking.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/myprofile.css">
    

    <link rel="stylesheet" href="./css/mynotification.css">

    

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
    <section class="hero" style="background:none !important;">
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
                    <li><a href="../index.php#Home">Home</a></li>
                    <li><a href="../tours.php">Destinations</a></li>
                    <li><a href="../hostings.php">Hostings</a></li>  
                    <li><a href="../blogs.php">Blogs</a></li>
                    <li><a href="../events.php">Activities</a></li>
                    <li><a href="../about.php">About Us</a></li>
                    <li><a href="../resources.php">Resources</a></li>
                    
                </ul>

                <div class="cta-button dash">
                    <a href="">
                        <button type="button" class="notification-btn">
                            <i class="fa fa-notification"></i>
                        </button>
                    </a>
                    <div class="cta-button">
                
                    <?php
                        // Check if the user is logged in by checking session variables
                        
                        
                        if (isset($_SESSION['username'])) {
                            // User is logged in
                            echo "<a href='../User/auth/logout.php'>Logout</a>";
                            echo "<a class='useraccount' href='dashboard/dashboard.php'>
                                            <i class='fa fa-user'></i>
                                            <p>".$_SESSION['username']."</p>       
                                        </a>";

                            
                        } else {
                            // Not logged in
                            session_unset();
                            session_destroy();
                            header("Location: ../login.php?msg=" . urlencode("Session expired. Please login again."));
                            exit();
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

    <main class="no-padding">
        <article class="dashboard">
            <main class="dashboard-menu-left ">
                <div class="dash-top">
                    <ul>
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-menu fa-fw">&#9776;</i>
                                <p>General Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="mybookings.php">
                                <i class="fa fa-menu fa-fw"></i>
                            <p>My Bookings</p>
                            </a>
                        </li>
                        <li>
                            <a href="mydestination.php">
                                <i class="fa fa-menu fa-fw">&#9776;</i>
                                <p>My Destinations</p>
                            </a>
                        </li>
                        <li>
                            <a href="myevents.php">
                                <i class="fa fa-menu fa-fw"></i>
                                <p>My Trips/Events</p>
                            </a>
                        </li>
                        
                        
                        <li>
                            <a href="mypayments.php">
                                <i class="fa fa-menu fa-fw"></i>
                            <p> Payments</p>
                            </a>
                        </li>
                        <li>
                            <a href="myprofile.php">
                                <i class="fa fa-menu fa-fw"></i>
                            <p> My Profile</p>
                            </a>
                        </li>
                        
                        <li>
                            <a href="mynotifications.php">
                                <i class="fa fa-menu fa-fw"></i>
                                <p>Notifications</p>
                            </a>
                        </li>
                        <li>
                            <a href="newdiscovery.php">
                                <i class="fa fa-menu fa-fw"></i>
                            <p> New Discovery</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="dash-bot">
                    <a href="../blogs.php">
                        <i class="fa fa-menu fa-fw"></i>
                        <p>Read Travel Blogs</p>
                    </a>
                </div>

            </main>