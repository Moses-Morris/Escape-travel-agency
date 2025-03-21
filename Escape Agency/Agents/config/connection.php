
<?php
$dbname = "escapeagency";
$dbservername = "localhost";
$dbusername = "root";
$bdpassword = "";


$conn= mysqli_connect($dbservername, $dbusername,$bdpassword, $dbname);
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
date_default_timezone_set('Africa/Nairobi');
?>
