<?php
session_start();
// Delete certain session
unset($_SESSION['username']);
// Delete all session variables
session_destroy();

// Jump to login page
header('Location: ../../index.php'); //you can change this to the home page of website

?>
