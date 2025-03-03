
<?php

include_once '../model/user.php';
include_once '../model/validator.php';

// Handling Registration Form Submission
if (isset($_POST['register']) ) {
    $database = new Database();
    $db = $database->connection();
    $user = new User($db);

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $location = $_POST['location'] ?? '';
    $password = $_POST['password'] ?? '';
    $phone = $_POST['phone'] ?? '';
    //$image = $_FILES['image'] ?? null;

    $targetDir = "../../uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $role = "customer";
    $created_at = date('Y-m-d H:i:s');
    $country = 'US';

    // Check file type
    $allowedTypes = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Only JPG, PNG, JPEG, and GIF files are allowed.");
    }





    //Validate the Entries
    // Instantiate the Validator class
    $validator = new Validator();

    // Validate inputs
    $validator->isNotEmpty($name, 'name');
    $validator->isValidName($name);
    $validator->isNotEmpty($email, 'email');
    $validator->emailValid($email, $db);
    $validator->isNotEmpty($phone, 'phone');
    $validator->phoneValid($phone, $db);
    $validator->isNotEmpty($location, 'location');
    $validator->isNotEmpty($password, 'password');
    $validator->validatePassValid($password);
    $validator->ImageValid($image);


    // If there are errors, redirect back to register page with error messages
    if ($validator->hasErrors()) {
        $errorMessages = implode("<br>", $validator->getErrors());
        $_SESSION['errors'] = $errorMessages;
        header("Location: ../../register.php");
        exit();
    }
    
    // Upload file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        if ($user->register($name, $email, $password, $phone, $role, $created_at, $country, $location, $targetFilePath)) {
            //echo "User added successfully!";
            /*print "
            <script language='javascript'>
              window.location = 'login.php';
            </script>
          ";*/
          header("Location: login.php");
          exit();
        } else {
            echo "Failed to add User.";
            $_SESSION['errors'] = "Failed to register user.";
            header("Location: ../../register.php");
            exit();
        }
    } else {
        //echo "Image upload failed.";
        $_SESSION['errors'] = "Image upload failed.";
        header("Location: ../../register.php");
        exit();
    }
} else {
    // If no form submission, redirect to register page
    header("Location: ../../register.php");
    exit();
    /*$msg = "No file uploaded. Empty Fields are not allowed.";
    $errormsg="<p class='Errors_Red'>"
     .$msg."</p>";
     print "
     <script language='javascript'>
       window.location = '../../register.php';
     </script>
   ";*/
}
?>




















<?php

/*
  include('config.php');
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $location = $_POST['location'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];

  $sql="INSERT INTO customer (Name, Email, PasswordHash, Phone, Role, Created_at, Country, Location, ProfileImg) 
  VALUES ($name, $email, $password, $phone, $role, $created_at, $country, $location, $targetFilePath)";

  if (!mysqli_query($mysqli,$sql))
    {
    die('Error: ' . mysqli_error($mysqli));
    }
    header("location: index.php");
    echo "1 record added";

  mysqli_close($mysqli);
*/
?>










