<?php
    include 'base.php';
?>

        <article class="loginpage">
            <main>
                <img src="media/Escape Agency adventures Company Logo.png" alt="travel with us login">
            </main>
            <aside>
                <h4>Travel With Us</h4>
                <p>Travel with Us without worrying about
                    Visa: Register with Us.</p>
                <form action="php/user/UserController.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <input type="text" placeholder="Name" name="name">
                    </div>
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
                        <input type="file" placeholder="Image" name="image"  value="text.jpeg" >
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