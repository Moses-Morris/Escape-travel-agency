<?php

include_once("config/connection.php");


//LOGIN THE SUPERADMIN USER
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
{
    $status = "OK"; //initial status
    $msg="";
    $email=mysqli_real_escape_string($conn,$_POST['email']); //fetching details through post method
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $errormsg ="";

    if ( strlen($email) < 4 ){
    $msg=$msg."Email should be more than 4 characters.<BR>";
    $status= "NOTOK";}

    if ( strlen($password) < 4 ){ //checking if password is greater then 8 or not
    $msg=$msg."Password must be more than 4 character length<BR>";
    $status= "NOTOK";}
        
    $query3 ="SELECT password FROM users WHERE (email = '" . mysqli_real_escape_string($conn,$_POST['email']) . "')";
    $result3 = mysqli_query($conn,$query3);
    $dbpassword=0;
    while($row = mysqli_fetch_array($result3))
    {
    $dbpassword="$row[password]";
    }   

    if ($dbpassword !== $password) {
    $msg=$msg."Password is Incorrect";
    $status= "NOTOK";
    }

    if($status=="OK"){
        // Retrieve username and password from database according to user's input, preventing sql injection
        $query ="SELECT * FROM users WHERE (email = '" . mysqli_real_escape_string($conn,$_POST['email']) . "') AND (passwordHash = '" . mysqli_real_escape_string($conn,$_POST['password']) . "')";
        
        if ($stmt = mysqli_prepare($conn, $query)) {

            /* execute query */
            mysqli_stmt_execute($stmt);

            /* store result */
            mysqli_stmt_store_result($stmt);

            $num=mysqli_stmt_num_rows($stmt);

            /* close statement */
            mysqli_stmt_close($stmt);
        }
        //mysqli_close($con);
        // Check username and password match
    else{
            session_start();
            // Set username session variable
            $_SESSION['email'] =$email;
        
            // Jump to secured page
            print "
            <script language='javascript'>
            window.location = 'index.php?email=$email';
            </script>";   
        }

    }
      else {
            $errormsg= "<p class='Errors_Red'>".$msg."</p>";           
      }
}






?>
<!DOCTYPE html>
<html lang="en"><head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Escape Agency SuperAdmin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <!--h3 class="card-title text-left mb-3">Escape Agency SuperAdmin</h3--->
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Login</h3>
                <h4 class="card-title text-left mb-3">Escape Agency SuperAdmin</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                  <div class="form-group">
                    <label>Email *</label>
                    <input type="text" class="form-control p_input" name="email">
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" class="form-control p_input" name="password">
                  </div>
                  <div>
                  <?php 
                          if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg != ""))
                          {
                          print $errormsg;
                          print $msg;
                          }
                      ?> 

                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me <i class="input-helper"></i></label>    
                      </div>

                    <a href="#" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="login" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook mr-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="register.php"> Sign Up</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
  
</body></html>