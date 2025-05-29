<?php
    include 'base.php';
?>
        <style>
            .navbar {
                    box-shadow:0px 3px 4px rgb(155, 155, 155); ;
                }
                .hero{
                    background: none !important;
                    background-repeat: no-repeat !important; /* Prevent the image from repeating */
                    height: 100% !important; /* Use 100vh to ensure the hero section takes the full viewport height */
                    color: #fff !important;
                    background-color: var(--tertiary) !important;
                }
        </style>
    </section>



    <!---------------------------Hostings section--------------------------------------------------->
    <section class="hosting-hero-section">
        <div class="hero-pics-grid">
            <div>
                <img src="media/pexels-axlsm-19168388.jpg" alt="airbnb" class="one">
            </div>
            <div>
                <img src="media/pexels-pixabay-262048.jpg" alt=" villa" class="two">
            </div>  
            <div>
                <img src="media/pexels-valeriya-827528.jpg" alt="hotel" class="three">
            </div>
        </div>
    </section>


    <!---------------------------Hosting Listings  section--------------------------------------------------->
    <section class="Hosting-Listing">
        <div class="hosting-header">
            <div>
                <h7>Hostings </h7>
            </div>
            <div class="hostings-filter">
                <form>
                    <div>
                        <input type="text" placeholder="Location/Price/Type">
                        <button>
                            <i class="fa fa-filter fa-xl"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <div class="hosting-places">

            <div class="hosting-place">
                <img src="media/pexels-julieaagaard-2467285.jpg" alt="place to stay image">
                <div class="hosting-place-infos">
                    <div>
                        <h4>Unique Villa</h4>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small>14000 reviews</small></p>
                    </div>
                    <div class="hosting-place-info">
                        <div>
                            <h5>Company Hotel Villas, China</h5>
                            <p><bold>$100 - $400 per night</bold></p>
                        </div>
                        <a class="more-linking" href="hostinginfo.php">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hosting-place">
                <img src="media/pexels-julieaagaard-2467285.jpg" alt="place to stay image">
                <div class="hosting-place-infos">
                    <div>
                        <h4>Unique Villa</h4>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small>14000 reviews</small></p>
                    </div>
                    <div class="hosting-place-info">
                        <div>
                            <h5>Company Hotel Villas, China</h5>
                            <p><bold>$100 - $400 per night</bold></p>
                        </div>
                        <a class="more-linking">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hosting-place">
                <img src="media/pexels-julieaagaard-2467285.jpg" alt="place to stay image">
                <div class="hosting-place-infos">
                    <div>
                        <h4>Unique Villa</h4>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small>14000 reviews</small></p>
                    </div>
                    <div class="hosting-place-info">
                        <div>
                            <h5>Company Hotel Villas, China</h5>
                            <p><bold>$100 - $400 per night</bold></p>
                        </div>
                        <a class="more-linking">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hosting-place">
                <img src="media/pexels-julieaagaard-2467285.jpg" alt="place to stay image">
                <div class="hosting-place-infos">
                    <div>
                        <h4>Unique Villa</h4>
                        <p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> <small>14000 reviews</small></p>
                    </div>
                    <div class="hosting-place-info">
                        <div>
                            <h5>Company Hotel Villas, China</h5>
                            <p><bold>$100 - $400 per night</bold></p>
                        </div>
                        <a class="more-linking">
                            <i class="fa fa-arrow-right fa-xl"></i>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </section>




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
        