<?php
    include 'base.php';
?>
            <aside class="dashboard-content">
                <div>
                    <h5>Dashboard <i class="fa chevron-right"></i></h5>
                </div>
                <div class="dash-form">
                    <form>
                        
                        <div class="dash-input-area">
                            <i class="fa fa-location"></i>
                            <input class="" type="text" placeholder="Location">
                            <i class="fa arrow-down"></i>
                        </div>
                        <div class="dash-input-area">
                            <i class="fa fa-activities"></i>
                            <input class="" type="text" placeholder="Activities">
                            <i class="fa arrow-down"></i>
                        </div>
                        <div class="dash-input-area">
                            <i class="fa fa-price"></i>
                            <input class="" type="text" placeholder="Price">
                            <i class="fa arrow-down"></i>
                        </div>
                        <div class="dash-button-area">
                            <button>Discover Places <i class="fa fa-chevron-right"></i></button>
                            
                        </div>

                    </form>
                </div>

                <section>
                    <div class="details-nav">
                        <div class="proceed">
                            <button>Proceed With Booking</button>
                        </div>
                        <div class="discarded">
                            <button>Discarded Bookings</button>
                        </div>
                    </div>
                    <!--Proceed with bookings-->
                    <div class="bookings-dashboard-proceed">
                        <!-- aside content goes here -->
                        <div class="destination-cards">
                            <div class="dest-1">
                                <div class="dest-image">
                                    <img src="../media/pexels-darina-belonogova-9159898.jpg" alt="Mt Everest">
                                </div>
                                <div class="dest-info">
                                    <div class="dest-data">
                                        <h4>Getting to the Pinnacle of Mt Everest</h4>
                                        <p><i class="fa fa-star"></i> 4.0</p>
                                    </div>
                                    <div class="dest-more">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="dest-1">
                                <div class="dest-image">
                                    <img src="../media/pexels-anupshrestha-28926732.jpg" alt="Mt Everest">
                                </div>
                                <div class="dest-info">
                                    <div class="dest-data">
                                        <h4>Palmas Beach Resort</h4>
                                        <p><i class="fa fa-star"></i> 4.0</p>
                                    </div>
                                    <div class="dest-more">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </div>
                            
                            </div>

                            <div class="dest-1">
                                <div class="dest-image">
                                    <img src="../media/pexels-icon0-209740.jpg" alt="Mt Everest">
                                </div>
                                <div class="dest-info">
                                    <div class="dest-data">
                                        <h4>China</h4>
                                        <p><i class="fa fa-star"></i> 4.6</p>
                                    </div>
                                    <div class="dest-more">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Discarded Bookings-->
                    <div class="bookings-dashboard-discarded">

                    </div>


                </section>



            </aside>
        </article>
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