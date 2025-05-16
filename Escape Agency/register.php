<?php
    include 'base.php';
    //session_start(); // Start the session to access errors
    /*if (isset($_SESSION['errors'])) {
        echo "<div class='error-messages'>" . $_SESSION['errors'] . "</div>";
        unset($_SESSION['errors']);  // Clear the error messages after display
    }//*/
    //Retrieve errors if they exist
    /*$errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']); // Clear errors after displaying them
    //
    */

?>

        <article class="loginpage">
            <main>
                <img src="media/Escape Agency adventures Company Logo.png" alt="travel with us login">
            </main>
            <aside>
                <h4>Travel With Us</h4>
                <p>Travel with Us without worrying about
                    Visa: Register with Us.</p>
                <form action="User/auth/register.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    
                <div>
                        <input type="text" placeholder="Name" name="name">
                    </div>
                    
                    <div>
                        <input type="email" placeholder="email" name="email">
                    </div>
                    <div>
                        <input type="password" placeholder="password" name="password">
                    </div>
                    <div>
                        <label>Country</label>
                        <script type="text/javascript" src="js/countries.js"></script>
                        <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country"></select>
                    </div>
                    <div>
                        <label>Location/State</label>
                        <select name="location" id ="state" placeholder="Location"></select>
                        <script language="javascript">print_country("country");</script>
                        
                    </div>
                    <div>
                        <input type="number" placeholder="Phone" name="phone">
                    </div>
                    <div>
                        <input type="file" placeholder="Image" name="image">
                    </div>
                    <div>
                        <?php
                            if (isset($_GET['msg'])) {
                                echo htmlspecialchars($_GET['msg']);
                            }
                        ?>
                    </div>
                    <div>
                        <button name="register">Register</button>
                        <p>Already have an Account? <a href="login.php">Login Here</a></p>

                    </div>
                </form>
            </aside>
        </article>

    </section>

    <!---jquery --->
    <script src="js/jquery-1.6.2.min.js" type="text/javascript" charset="utf-8"></script>




<?php
    include 'footer.php';
?>