<?php
include('../config/connection.php');
session_start();
$check=$_SESSION['username'];
$session=mysqli_query($mysqli, "select Email from users where Email='$check' ");
$row=mysqli_fetch_array($session);
$login_session=$row['Email'];
if(!isset($login_session))
{
    echo "You Failed !!";
    header('Location: login.php');
}
// In base.php or a config file
$session_lifetime = 1800; // 30 minutes
session_set_cookie_params($session_lifetime);

// Check session age during page loads
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $session_lifetime)) {
    // Session expired
    session_unset();
    session_destroy();
    header("Location: login.php?msg=" . urlencode("Session expired. Please login again."));
    exit();
}
//include("session.php"); in dashboard to only allow logged in users
?>