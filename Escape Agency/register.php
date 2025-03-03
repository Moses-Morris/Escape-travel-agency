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
                <form action="user/controllers/UserController.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <input type="text" placeholder="Name" name="name">
                    </div>
                    <div class="error"><?= $errors['name'] ?? '' ?></div>
                    <div>
                        <input type="text" placeholder="email" name="email">
                    </div>
                    <div>
                        <input type="password" placeholder="password" name="password">
                    </div>
                    <div>
                        <input type="text" placeholder="Location" name="location">
                    </div>
                    <div>
                        <input type="number" placeholder="Phone" name="phone">
                    </div>
                    <div>
                        <input type="file" placeholder="Image" name="image">
                    </div>
                    <div>
                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg != ""))
                            {
                            print "<p class='Errors_Red'>".$errormsg."</p>";
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





<?php
    include 'footer.php';

?>