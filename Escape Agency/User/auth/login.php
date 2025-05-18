<?php
session_start();
include("../config/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = $_POST['pass']; // Don't escape the password before verification

    $query = "SELECT Email, PasswordHash FROM users WHERE Email='$email' AND Role='customer'";
    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Use password_verify to check if the entered password matches the hash
        if (password_verify($password, $user['PasswordHash'])) {
            $_SESSION['username'] = $user['Email'];
            header("Location: ../../index.php");
            exit();
        } else {
            header("Location: ../../login.php?msg=" . urlencode("Invalid Email or Password"));
            exit();
        }
    } else {
        header("Location: ../../login.php?msg=" . urlencode("Invalid Email or Password"));
        exit();
    }
}

?>


<?php
/*
session_start();
include("../config/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = mysqli_real_escape_string($mysqli, $_POST['pass']);

    $query = "SELECT Email, PasswordHash FROM users WHERE Email='$email' AND Role='customer'";
    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password === $user['PasswordHash']) {
            $_SESSION['username'] = $user['Email'];
            header("Location: ../../index.php");
            exit();
        } else {
            header("Location: ../../login.php?msg=" . urlencode("Invalid Email or Password"));
            exit();
        }
    } else {
        header("Location: ../../login.php?msg=" . urlencode("Invalid Email or Password"));
        exit();
    }
}*/
?>
