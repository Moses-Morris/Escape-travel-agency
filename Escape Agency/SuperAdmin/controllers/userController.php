<?php
if(!isset($_SESSION)){
    session_start();
}
include_once("../config/connection.php");

//session_start();

//REGISTER THE SUPERADMIN USER
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register']))
{
    // Collect the data from post method of form submission // 

    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $country=mysqli_real_escape_string($conn,$_POST['country']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $referedby=mysqli_real_escape_string($conn,$_POST['referedby']);

    $created_at=date("Y-m-d");
    $status = "OK";
    $msg="";
    //validation starts
    // if userid is less than 6 char then status is not ok
    if(!isset($name) or strlen($name) < 4){
    $msg=$msg."Your name Should Contain Minimum 4 CHARACTERS.<BR>";
    $status= "NOTOK";}          

    if(!ctype_alnum($name)){
    $msg=$msg."Username Should Contain Alphanumeric Chars Only.<BR>";
    $status= "NOTOK";}          


    $check=mysqli_query($conn,"SELECT COUNT(*) FROM users WHERE email = '$email'");
    $r = mysqli_fetch_row($check);
    $nr = $r[0];
    if($nr>=1){
    $msg=$msg."Email Already Exists. Please Try Another One.<BR>";
    $status= "NOTOK";
    } 

    $confirm=mysqli_query($conn,"SELECT COUNT(*) FROM users WHERE phone = '$phone'");
    $rr= mysqli_fetch_row($confirm);
    $nrr = $rr[0];
    if($nrr>=1){
    $msg=$msg."Phone number Already Exist. Please Try Another One.<BR>";
    $status= "NOTOK";
    } 
      

    



    if ( strlen($password) < 8 ){
    $msg=$msg."Password Must Be More Than 8 Char Length.<BR>";
    $status= "NOTOK";}  




    if ( strlen($email) < 1 ){
    $msg=$msg."Please Enter Your Email Account.<BR>";
    $status= "NOTOK";}
          
    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))){
    $msg=$msg."Email Id Not Valid, Please Enter The Correct Email Id .<BR>";
    $status= "NOTOK";}

      


    if ( $country == "" ){
    $msg=$msg."Please Enter Your Country Name.<BR>";
    $status= "NOTOK";}  

    if (strlen($phone) <= 11 ){
    $msg=$msg."Please Enter a valid Mobile number with country Code.<BR>";
    $status= "NOTOK";
    } 





    $query="INSERT INTO users (Name, Email, PasswordHash, Phone, Role, Created_at, Country, Location, ProfileImg) 
      VALUES ($name, $email, $password, $phone, $role, $created_at, $country, $location, $targetFilePath)";



    if (!mysqli_query($conn,$query)) {
        printf("Error: %s\n", mysqli_error($conn));
        $errormsg="<p class='Errors_Red'>".$msg."</p>";//printing error if found in validation
        exit();
    }else{
        //echo "Success registering";
        print "
                <script language='javascript'>
                window.location = 'login.php?username=$username';
                </script>
            ";
    }
   
    }
?>















<?php
 
 include_once("../config/connection.php");
//LOGIN THE SUPERADMIN USER
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
{
    $status = "OK"; //initial status
    $msg="";
    $email=mysqli_real_escape_string($conn,$_POST['email']); //fetching details through post method
    $password = mysqli_real_escape_string($conn,$_POST['password']);

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

    }else {

        $errormsg= "<p class='Errors_Red'>".$msg."</p>"; 
        //printing error if found in validation
        if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg != "")){

        }       
   
}
}






?>