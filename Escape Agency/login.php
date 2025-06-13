<?php
$msg = "";
    include 'base.php';
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

        <article class="loginpage">
            <main>
                <img src="media/Escape Agency adventures Company Logo.png" alt="travel with us login">
            </main>
            <aside>
                <h4>Travel With Us</h4>
                <p>Travel with Us without worrying about Visa: 
                    Login With Us.</p>
                    <form action="./User/auth/login.php" method="POST" autocomplete="off">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div>
                            <input type="email" placeholder="email" name="email" required>
                        </div>
                        <div>
                            <input type="password" placeholder="password" name="pass" required>
                        </div>
                        <small style="color:red; font-weight:600;">
                            <?php
                                if (isset($_GET['msg'])) {
                                    echo htmlspecialchars($_GET['msg']);
                                }
                                if($msg){
                                    echo $msg;
                                }
                            ?>
                        </small>
                        <div>
                            <button type="submit" name="submit">Login</button>
                            <p>Haven't Registered Yet? <a href="register.php">Register Here</a></p>
                        </div>
                    </form>

            </aside>
        </article>

    </section>


<?php
    include 'footer.php';

?>


