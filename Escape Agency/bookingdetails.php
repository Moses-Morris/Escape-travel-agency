

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
    <link rel="stylesheet" href="dashboard/css/booking.css">
    

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
<body class="bookingdetails">

    <!---------------------------The top section with header--------------------------------------------------->
    <section class="hero " style="background:none !important;">
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
                    
                     if (isset($_SESSION['username'])) {
                        echo "
                             <a href=''>
                               <button type='button' class='notification-btn'>
                                   <i class='fa fa-notification'></i>
                               </button>
                             </a>
                              ";
                     }
                    ?>
                    <?php
                        // Check if the user is logged in by checking session variables
                        
                        
                        if (isset($_SESSION['username'])) {
                            // User is logged in
                            echo "<a href='./User/auth/logout.php'>Logout</a>";
                            echo "<a class='useraccount' href='dashboard/dashboard.php'>
                                            <i class='fa fa-user'></i>
                                            <p>".$_SESSION['username']."</p>       
                                        </a>";

                            
                        } else {
                            // Not logged in
                            echo "<a href='login.php'>
                                            <button class='login'>Book Now</button>
                                        </a>";
                        }
                    
                    ?>
                    </div>
            </nav>
        </header>
    </section>


    <main>

        <section>
            <article class="destination-booking">
                <aside>
                    <div class="dest-location">
                        <h4>Destination : Mt Kilimanjaro</h4>
                        <img src="media/pexels-robshumski-6129457.jpg" alt="destination image">
                        <h5>Lemosho , Tanzania</h5>
                        <h4>USD 900</h4>
                    </div>

                </aside>
                <main>
                    <div class="dest-info-form">
                        <form id="bookingForm" method="POST" action="process_booking.php">
                            <div id="step1">
                                <h3> Travel Account Details</h3>
                                <div class="splitform">
                                    
                                    <div class="one-side">
                                        
                                        <div>
                                            <input type="text" placeholder="Full names">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Email">
                                        </div>
                                        
                                        <div class="">
                                            
                                            <input type="number" placeholder="Country Code and Your Phone number" >
                                        </div>
            
                                    </div>
                                    <div class="two-side">
                                        
                                        <div>
                                            <input type="text" placeholder="Type of Travel : Friends, Family, Group, Couple">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Country">
                                        </div>
                                        <div>
                                            <input type="text" placeholder="Location">
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="checkout-btn">
                                    <button   type="button" onclick="nextStep(1)">
                                        Proceed 
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                           
                            <!-- Step 2: Select Activities -->
                            <div id="step2" style="display:none;" >
                                <div class="step2">
                                    <div class="select-activities">
                                        <h3>Select Your Activities</h3>
                                        <div class="all-activities-cards">
                                            <div class="activity-card">
                                                <img src="media/pexels-carmen-cobo-338021-1103808.jpg" alt="">
                                                <div class="activity-details">
                                                    <div class="activity-top">
                                                        <h4>Hiking at top of mountain</h4>
                                                        <span class="type"></span>
                                                    </div>
                                                    <p>Price : 100$ - 400$</p>
                                                    <div class="activity-bottom">
                                                        <div class="plus">
                                                            <div>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <div>
                                                                <p>4.5</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button>
                                                                + Add
                                                            </button>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                            </div>
    
                                            <div class="activity-card">
                                                <img src="media/pexels-carmen-cobo-338021-1103808.jpg" alt="">
                                                <div class="activity-details">
                                                    <div class="activity-top">
                                                        <h4>Hiking at top</h4>
                                                        <span class="type"></span>
                                                    </div>
                                                    <p>Price : 100$ - 400$</p>
                                                    <div class="activity-bottom">
                                                        <div class="plus">
                                                            <div>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <div>
                                                                <p>4.5</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button>
                                                                + Add
                                                            </button>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                            </div>
                                            
    
                                            <div class="activity-card">
                                                <img src="media/pexels-carmen-cobo-338021-1103808.jpg" alt="">
                                                <div class="activity-details">
                                                    <div class="activity-top">
                                                        <h4>Hiking at top</h4>
                                                        <span class="type"></span>
                                                    </div>
                                                    <p>Price : 100$ - 400$</p>
                                                    <div class="activity-bottom">
                                                        <div class="plus">
                                                            <div>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <div>
                                                                <p>4.5</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button>
                                                                + Add
                                                            </button>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                            </div>
    
    
    
                                        </div>
                                    </div>
                                    <div class="jj">
                                        <div class="one-side">
                                            
                                            <div>
                                                <input type="text" placeholder="Activity">
                                            </div>
                                            <div class="checkout-btn">
                                                <button  type="button" onclick="prevStep(2)">
                                                    <i class="fa fa-arrow-left"></i>
                                                    Previous 
                                                </button>
                                                <button   type="button" onclick="nextStep(2)">
                                                    Proceed 
                                                    <i class="fa fa-arrow-right"></i>
                                                </button>
    
                                            </div>
                                            
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                           

                            <!-- Step 3: Select Hosting -->
                            <div id="step3" style="display:none;">
                                <h3>Select Hosting</h3>
                                <div class="host-ti">
                                    <div class="select-activities">
                                        <div class="all-activities-cards">
                                            <div class="activity-card">
                                                <img src="media/pexels-carmen-cobo-338021-1103808.jpg" alt="">
                                                <div class="activity-details">
                                                    <div class="activity-top">
                                                        <h4>Zulu house</h4>
                                                        <span class="type">AirBnB</span>
                                                    </div>
                                                    <p>Price : 100$ - 400$</p>
                                                    <div class="activity-bottom">
                                                        <div class="plus">
                                                            <div>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <div>
                                                                <p>4.5</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button>
                                                                + Reserve
                                                            </button>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                            </div>
    
                                            <div class="activity-card">
                                                <img src="media/pexels-carmen-cobo-338021-1103808.jpg" alt="">
                                                <div class="activity-details">
                                                    <div class="activity-top">
                                                        <h4>Maskani</h4>
                                                        <span class="type">Resort</span>
                                                    </div>
                                                    <p>Price : 100$ - 400$ Per night</p>
                                                    <div class="activity-bottom">
                                                        <div class="plus">
                                                            <div>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                            <div>
                                                                <p>4.5</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button>
                                                                + Reserve
                                                            </button>
                                                        </div>
                                                    </div>
    
                                                </div>
    
                                            </div>
                                            
    
                                            <div class="activity-card">
                                                <img src="media/pexels-carmen-cobo-338021-1103808.jpg" alt="">
                                                <div class="activity-details">
                                                    <div class="activity-top">
                                                        <h4>Top Villa</h4>
                                                        <span class="type">Hotel</span>
                                                    </div>
                                                    <p>Price : 100$ - 400$</p>
                                                    <div class="activity-bottom">
                                                        <div>
                                                            <i class="fa fa-star"></i>
                                                            <p>4.5</p>
                                                        </div>
                                                        <div>
                                                            <button>
                                                                + Reserve
                                                            </button>
                                                        </div>
                                                    </div>
    
                                                
    
                                            </div>
                                            </div>
                                            
                                            </div>
    
                                        </div>
                                        <div>
                                            <div class="one-side">
                                                <h3>Select Your Hosting Option</h3>
                                                <div>
                                                    <input type="number" placeholder="Number Of People">
                                                </div>
                                                <div>
                                                    <input type="date" placeholder="Starting From">
                                                </div>
                                                <div>
                                                    <input type="date" placeholder="Check Out On">
                                                </div>
                                                <div>
                                                    <div class="checkout-btn">
                                                        <button  type="button" onclick="prevStep(3)">
                                                            <i class="fa fa-arrow-left"></i>
                                                            Previous 
                                                        </button>
                                                        <button   type="button" onclick="nextStep(3)">
                                                            Proceed 
                                                            <i class="fa fa-arrow-right"></i>
                                                        </button>
                
                                                    </div>
                                                </div>
                                        
                                            </div>
                                    </div>
                                    
                                </div>
                                
                            </div>




                            <!-- Step 4: Select Travel -->
                            <div id="step4" style="display:none;">
                                <h3>Select Travel Option</h3>
                                <div class="travel-split">
                                    <div>
                                        <img src="media/pexels-freestockpro-1008155.jpg">
                                    </div>
                                    <div>
                                        <div>
                                            <select type="text" placeholder="Check Out On" name="travel" id="travel" onchange="updateTotal()">
                                                <option value="">sdfghjk</option>
                                            </select>
                                        </div>
                                        <div class="checkout-btn">
                                            <button  type="button" onclick="prevStep(4)">
                                                <i class="fa fa-arrow-left"></i>
                                                Previous 
                                            </button>
                                            <button   type="button" onclick="nextStep(4)">
                                                Proceed
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                   
                                
                                
                            </div>

                            
                            <!-- Step 5: Review and Confirm -->
                            <div id="step5" style="display:none;">
                                <h3>Review Your Booking :Payment Summary</h3>
                                <p><strong>Destination:</strong> <?= $_SESSION['booking']['destination'] ?></p>
                                <p><strong>Activities:</strong> <?= implode(", ", $_SESSION['booking']['activities']) ?></p>
                                <p><strong>Hosting:</strong> <?= $_SESSION['booking']['hosting'] ?></p>
                                <p><strong>Travel Option:</strong> <?= $_SESSION['booking']['travel'] ?></p>
                                <hr>
                                <p><strong>Total Amount:</strong> $<span id="totalAmount"><?= $_SESSION['booking']['total'] ?></span></p>
                                <!--button type="button" onclick="prevStep(5)">Previous</button-->
                                <p href="" onclick="openPopup('international')">Remember to read this guide on recommended documents : </p>
                                <div class="links-container">
                                    <span class="advice-link" onclick="openPopup('international')"  type="button" class="">🌍 For International Travelers</span>
                                    <!--a href="local_travel_advice.php" target="_blank" class="advice-link">🇰🇪 For Local (Kenyan) Travelers</a--->
                                </div>
                                <div class="checkout-btn">
                                    <button  type="button" onclick="prevStep(5)">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous
                                    </button>
                                    <button  type="button" >
                                        Proceed to checkout
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>



                        </form>
                        
                        <!-- Popup Container -->
                        <div id="popupOverlay" class="popup-overlay">
                            <div class="popup-content" id="popupContent">
                            <!-- Content loaded dynamically -->
                            
                            </div>
                        </div>
                            
                        </div>
                    </div>
                    
                        
                </main>
            </article>
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
    <script src="dashboard/js/nav.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/gsap.js"></script>
    <script src="dashboard/js/script.js"></script>
    <script src="dashboard/js/pass.js"></script>
    <script src="dashboard/js/popup.js"></script>
    
    
    </body>
    </html>