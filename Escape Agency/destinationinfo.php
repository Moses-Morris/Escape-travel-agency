
<?php
session_start(); // Always start session to access session variables
include('User/config/connection.php');

//include('User/auth/usersession.php');
?>
<?php
//Get the details if the destination
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
        <?php

                        //Destination details
                         if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
                                $Desid = $_GET['id'];
                                //echo "Received ID: " . htmlspecialchars($id);
                            } else {
                                echo "Invalid ID!";
                            }
                        // ✅ Destination details
                        $result = mysqli_query($conn, "SELECT * FROM destinations WHERE Status='approved' AND DestinationID=$Desid");

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $ID = $row["DestinationID"];
                            $destDesc = $row["Description"];
                            $Name = htmlspecialchars($row["Name"]);
                            $location = htmlspecialchars($row["Location"]);
                            $country = htmlspecialchars($row["Country"]);
                            $img = $row["ImageURL"];
                            $price = $row["Price"];
                            $rating = $row["RatingAVG"];
                            $Agent = $row["AgentID"];
                            $travel = $row["TravelID"];
                        } else {
                            echo "Unapproved and unverified destination. Go Back";
                        }
                       
        ?>
        <div class="dest-detail-info">
            <h3><i class="fa fa-location-dot"></i> <?php echo $Name; ?></h3>
        </div>
        <section class="destination-images">
            <div class="dest-info-images">
                <div class="disp-one main-image gallery">
                    <img src="media/<?php echo $img; ?>" class="gallery-img">
                </div>
                <div class="gallery-images">
                    <?php
                        $gallery = mysqli_query($conn, "SELECT * FROM destinationgallery WHERE DestinationID=$ID ");
                        if (mysqli_num_rows($gallery) > 0) {
                            $row = mysqli_fetch_assoc($gallery);
                            $desc = $row['Description'];
                            $image1 = $row['Image1'];
                            $image2 = $row['Image2'];
                            $image3 = $row['Image3'];
                            $image4 = $row['Image4'];
                            

                        }else{
                            echo "No destination images;";
                        }
                        
                    ?>
                    <div class="disp-two gallery">
                        <img src="media/<?php echo $image2; ?>" alt="<?php echo $desc; ?>" class="gallery-img">
                    </div>
                    <div class="disp-three gallery">
                        <img src="media/<?php echo $image3; ?>" alt="<?php echo $desc; ?>" class="gallery-img">
                    </div>
                    <div class="disp-four gallery">
                        <img src="media/<?php echo $image4; ?>" alt="<?php echo $desc; ?>" class="gallery-img">
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
                            <h3><i class="fa fa-location"></i>     <?php echo $Name;?></h3>
                            <p><i class="fa fa-star" style="color: orange;"></i>        <?php echo $rating;?> star ratings</p>
                        </div>
                        <div>
                            <h2>USD <?php echo $price;?></h2>
                        </div>
                    </div>
                    <div class="dest-description">
                        <h4><?php echo $destDesc; ?></h4>
                        <br>
                        <p>Wait for confirmation on the Dashboard. Escape Agency also provides a list of documents needed
                            For the adventure and everything needed for the trip. It listed on the Dashboard</p>
                        <a href="bookingdetails.php?dest=<?php echo $ID; ?>">
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
                        <?php
                            $activities = mysqli_query($conn, "SELECT * FROM activities WHERE DestinationID=$ID LIMIT 4");
                            if (mysqli_num_rows($activities) > 0) {
                                 while ($act = mysqli_fetch_assoc($activities)) {
                                        $aName = htmlspecialchars($act['Name']);
                                        echo "  <div>
                                                        <p>". $aName."</p>
                                                    </div>";
                                    }
                            }else{
                                echo "No available activities for this destination";
                            }

                        ?>
                        

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
                            <i class="fa-solid fa-plane-circle-check"></i>
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
                        <?php
                                $reviews = mysqli_query($conn, "SELECT * FROM reviews WHERE DestinationID=$ID LIMIT 4");
                                 if (mysqli_num_rows($reviews) > 0) {
                                    while ($r = mysqli_fetch_assoc($reviews)) {
                                        $user = htmlspecialchars($r['UserID']);
                                        $comment = htmlspecialchars($r['ReviewComment']);
                                        $stars = $r['RatingAVG'];
                                          //get the user who has placed the booking
                                        $user_name = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$user");
                                        $row4 = mysqli_fetch_array($user_name);
                                        $UserName = $row4["Email"]; //use email as name
                                        $userDetail = $row4["Name"]; 
                                        $userImage = $row4["ProfileImg"];
                                        echo "<div class='review-card' style='width: 100% !important;'>
                                                        <div class='client-data'>
                                                            <img src='media/".$userImage."' alt='client profile image' style='border-radius: 50%;'> 
                                                            <p>".$userDetail."</p>
                                                        </div>
                                                        <div>
                                                            <p>
                                                                ".$comment."
                                                            </p>
                                                        </div>
                                                    </div>";

                                       
                                    }
                                } else {
                                    echo "<p>No reviews yet.</p>";
                                }
                        ?>
                        
                        
                    </div>
                </main>
                <aside class="hostings">
                    <h4>Local Hostings</h4>
                    <div class="hostings-cards">
                        <?php 
                             $hosting = mysqli_query($conn, "SELECT * FROM accomodation WHERE DestinationID=$ID ");
                                if (mysqli_num_rows($hosting) > 0) {
                                    while ($h = mysqli_fetch_assoc($hosting)) {
                                        $hostID = $h['HostingID'];
                                        $hName = htmlspecialchars($h['Name']);
                                        $hDesc = htmlspecialchars($h['Description']);
                                        $hPrice = $h['PricePerNight'];
                                        $hImg = $h['ImageURL'];
                                        $hRating = $h['RatingAVG'];
                                        $hImgPath = "accomodation/" . $hImg;
                                        if (!file_exists($hImgPath) || empty($hImg)) {
                                            $hImgPath = "media/default-hosting.jpg";
                                        }

                                        echo "
                                                    <div class='hosting-place-card'>
                                                        <div class='hosting-name-more'>
                                                            <div>
                                                                <h3>".$hName."</h3>
                                                                <p><i class='fa fa-star'></i>   ".$hRating." reviews</p>
                                                            </div>
                                                            <div>
                                                                <a href='hostinginfo.php?host=".$hostID." class='more-details'>More </a>
                                                            </div>
                                                        </div>
                                                        <div class='hostings-info'>
                                                            <div>
                                                                <p>".$hDesc."</p>
                                                                <p>Estimated Price Per Night : $".$hPrice."  </p>
                                                            </div>
                                                            <div>
                                                                <i class='fa fa-chevron-right'></i>
                                                            </div>
                                                        </div>

                                                    </div>
                                        ";
                                    }
                                }else{
                                    echo "No hostings created for this Destination.";
                                }
                            ?>
                        
                        

                       
                    </div>
                </aside>
            </article>

        </section>

        <!--Destination Gallery-->
        <section>
            <h4>Destination Gallery</h4>
            <div class="destination-imgs">
                <?php 
                        $gallery = mysqli_query($conn, "SELECT * FROM destinationgallery WHERE DestinationID=$ID ");
                        if (mysqli_num_rows($gallery) > 0) {
                            $row = mysqli_fetch_assoc($gallery);
                            $desc = $row['Description'];
                            $image1 = $row['Image1'];
                            $image2 = $row['Image2'];
                            $image3 = $row['Image3'];
                            $image4 = $row['Image4'];
                            

                        }else{
                            echo "No destination images in the Destination Gallery;";
                        }
                ?>
                <div>
                    <img src="media/<?php echo $image1; ?>" alt="<?php echo $desc; ?>">
                </div>
                <div>
                    <img src="media/<?php echo $image2; ?>" alt="<?php echo $desc; ?>">
                </div>
                <div>
                    <img src="media/<?php echo $image3; ?>" alt="<?php echo $desc; ?>">
                </div>
                <div>
                    <img src="media/<?php echo $image4; ?>" alt="<?php echo $desc; ?>">
                </div>
            </div>
        </section>

    </main>

                        <!-- Popup Overlay -->
<div id="imagePopup" class="image-popup fade">
  <span class="close-popup">&times;</span>
  <img class="popup-content" id="popupImage" alt="Popup Image" />
</div>

<style>
  /* ===== GALLERY GRID ===== */
  

  .gallery-img {
    width: 100%;
    border-radius: 10px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .gallery-img:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }

  /* ===== POPUP OVERLAY ===== */
  .image-popup {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
    transition: opacity 0.35s ease;
  }

  .popup-content {
    max-width: 90%;
    max-height: 85vh;
    border-radius: 12px;
    box-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
    transform: scale(0.8);
    opacity: 0;
    transition: all 0.35s ease;
  }

  .image-popup.show {
    display: flex;
    opacity: 1;
  }

  .image-popup.show .popup-content {
    transform: scale(1);
    opacity: 1;
  }

  /* ===== CLOSE BUTTON ===== */
  .close-popup {
    position: absolute;
    top: 25px;
    right: 35px;
    color: #fff;
    font-size: 38px;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s ease, color 0.3s ease;
  }

  .close-popup:hover {
    color: #ccc;
    transform: scale(1.1);
  }

  /* Optional Fade Animation */
  @keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
  }

  @keyframes fadeOut {
    from {opacity: 1;}
    to {opacity: 0;}
  }
</style>

<script>
  const popup = document.getElementById('imagePopup');
  const popupImg = document.getElementById('popupImage');
  const closeBtn = document.querySelector('.close-popup');
  const body = document.body;

  // Open popup
  document.querySelectorAll('.gallery-img').forEach(img => {
    img.addEventListener('click', () => {
      popupImg.src = img.src;
      popup.classList.add('show');
      body.style.overflow = 'hidden'; // disable page scroll
    });
  });

  // Close popup
  function closePopup() {
    popup.classList.remove('show');
    setTimeout(() => {
      popup.style.display = 'none';
      body.style.overflow = ''; // re-enable scroll
    }, 300);
  }

  closeBtn.addEventListener('click', closePopup);
  popup.addEventListener('click', (e) => {
    if (e.target === popup) closePopup();
  });

  // Automatically show display:flex before fade-in
  const observer = new MutationObserver(() => {
    if (popup.classList.contains('show')) {
      popup.style.display = 'flex';
    }
  });
  observer.observe(popup, { attributes: true });
</script>

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