<?php
session_start();
include("../config/connection.php");

// Define upload directory constants
define('UPLOAD_DIR', '../uploads/profile_images/');
define('THUMB_DIR', '../uploads/profile_images/thumbnails/');

// Create directories if they don't exist
if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}
if (!file_exists(THUMB_DIR)) {
    mkdir(THUMB_DIR, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get form data and sanitize inputs
    $name = mysqli_real_escape_string($mysqli, $_POST['name']); // Full name
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $country = mysqli_real_escape_string($mysqli, $_POST['country']);
    $location = mysqli_real_escape_string($mysqli, $_POST['location']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirmPassword']);
    
    // Basic validation
    $errors = [];
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Password strength check (minimum 8 characters with at least one letter and one number)
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must be at least 8 characters and include both letters and numbers";
    }
    
    // Check if email already exists
    $checkEmailQuery = "SELECT Email FROM users WHERE Email = '$email'";
    $checkResult = mysqli_query($mysqli, $checkEmailQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $errors[] = "Email already registered";
    }
    
    // Handle profile image upload
    $profileImg = "default.jpg"; // Default profile image
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        // Check file size (limit to 5MB)
        if ($_FILES['profile_image']['size'] > 5000000) {
            $errors[] = "File size exceeds 5MB limit";
        }
        
        // Check file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_info = getimagesize($_FILES['profile_image']['tmp_name']);
        
        if (!in_array($file_info['mime'], $allowed_types)) {
            $errors[] = "Only JPG, PNG, and GIF files are allowed";
        } else {
            // Generate unique filename to prevent overwriting
            $file_extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('profile_') . '.' . $file_extension;
            $upload_path = UPLOAD_DIR . $filename;
            $thumb_path = THUMB_DIR . $filename;
            
            // Process and save the image
            if (processAndUploadImage($_FILES['profile_image']['tmp_name'], $upload_path, $thumb_path, $file_info['mime'])) {
                $profileImg = $filename;
            } else {
                $errors[] = "Failed to process image. Please try again.";
            }
        }
    }
    
    // If there are validation errors, redirect back with error messages
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: ../../register.php?msg=" . urlencode($errorString));
        exit();
    }
    
    // Hash the password for security
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // Set default values
    $role = "customer"; // Default role for new registrations
    
    // Insert new user into database
    $insertQuery = "INSERT INTO users (Name, Email, PasswordHash, Phone, Country, Location, ProfileImg, Role) 
                   VALUES ('$name', '$email', '$passwordHash', '$phone', '$country', '$location', '$profileImg', '$role')";
    
    if (mysqli_query($mysqli, $insertQuery)) {
        // Registration successful, set session and redirect
        $_SESSION['username'] = $email;
        header("Location: ../../index.php?welcome=1");
        exit();
    } else {
        // Log the error for debugging
        error_log("Registration error: " . mysqli_error($mysqli));
        // Registration failed
        header("Location: ../../register.php?msg=" . urlencode("Registration failed. Please try again."));
        exit();
    }
}

/**
 * Process and upload an image with compression
 * 
 * @param string $source_path Path to the source file
 * @param string $destination_path Path where the processed image will be saved
 * @param string $thumb_path Path where the thumbnail will be saved
 * @param string $mime_type MIME type of the image
 * @return bool True if successful, false otherwise
 */
function processAndUploadImage($source_path, $destination_path, $thumb_path, $mime_type) {
    try {
        // Create image from source based on mime type
        switch ($mime_type) {
            case 'image/jpeg':
                $source_img = imagecreatefromjpeg($source_path);
                break;
            case 'image/png':
                $source_img = imagecreatefrompng($source_path);
                break;
            case 'image/gif':
                $source_img = imagecreatefromgif($source_path);
                break;
            default:
                return false;
        }
        
        if (!$source_img) {
            return false;
        }
        
        // Get original dimensions
        $width = imagesx($source_img);
        $height = imagesy($source_img);
        
        // Preserve aspect ratio but limit maximum dimensions to 1200px
        $max_dimension = 1200;
        if ($width > $max_dimension || $height > $max_dimension) {
            if ($width > $height) {
                $new_width = $max_dimension;
                $new_height = intval($height * $max_dimension / $width);
            } else {
                $new_height = $max_dimension;
                $new_width = intval($width * $max_dimension / $height);
            }
        } else {
            $new_width = $width;
            $new_height = $height;
        }
        
        // Create a new image with the calculated dimensions
        $new_img = imagecreatetruecolor($new_width, $new_height);
        
        // Handle transparency for PNG and GIF
        if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
            imagealphablending($new_img, false);
            imagesavealpha($new_img, true);
            $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
            imagefilledrectangle($new_img, 0, 0, $new_width, $new_height, $transparent);
        }
        
        // Resize the image
        imagecopyresampled($new_img, $source_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        
        // Create thumbnail (150x150px)
        $thumb_img = imagecreatetruecolor(150, 150);
        
        // Handle transparency for thumbnail
        if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
            imagealphablending($thumb_img, false);
            imagesavealpha($thumb_img, true);
            $transparent = imagecolorallocatealpha($thumb_img, 255, 255, 255, 127);
            imagefilledrectangle($thumb_img, 0, 0, 150, 150, $transparent);
        }
        
        // Calculate and crop to square for thumbnail
        $thumb_dim = min($width, $height);
        $thumb_x = intval(($width - $thumb_dim) / 2);
        $thumb_y = intval(($height - $thumb_dim) / 2);
        
        // Create the thumbnail
        imagecopyresampled($thumb_img, $source_img, 0, 0, $thumb_x, $thumb_y, 150, 150, $thumb_dim, $thumb_dim);
        
        // Save the processed images
        $result = false;
        switch ($mime_type) {
            case 'image/jpeg':
                $result = imagejpeg($new_img, $destination_path, 90); // 90% quality
                imagejpeg($thumb_img, $thumb_path, 85);
                break;
            case 'image/png':
                // PNG compression level: 0 (no compression) to 9 (max compression)
                $result = imagepng($new_img, $destination_path, 6); // Medium compression
                imagepng($thumb_img, $thumb_path, 6);
                break;
            case 'image/gif':
                $result = imagegif($new_img, $destination_path);
                imagegif($thumb_img, $thumb_path);
                break;
        }
        
        // Free up memory
        imagedestroy($source_img);
        imagedestroy($new_img);
        imagedestroy($thumb_img);
        
        return $result;
    } catch (Exception $e) {
        error_log("Image processing error: " . $e->getMessage());
        return false;
    }
}
?>

<?php
/*
session_start();
include("../config/connection.php");

// Define upload directory constants
define('UPLOAD_DIR', '../uploads/profile_images/');
define('THUMB_DIR', '../uploads/profile_images/thumbnails/');

// Create directories if they don't exist
if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}
if (!file_exists(THUMB_DIR)) {
    mkdir(THUMB_DIR, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get form data and sanitize inputs
    $name = mysqli_real_escape_string($mysqli, $_POST['name']); // Full name
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $country = mysqli_real_escape_string($mysqli, $_POST['country']);
    $location = mysqli_real_escape_string($mysqli, $_POST['location']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirmPassword']);
    
    // Basic validation
    $errors = [];
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Password strength check (minimum 8 characters with at least one letter and one number)
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must be at least 8 characters and include both letters and numbers";
    }
    
    // Check if email already exists
    $checkEmailQuery = "SELECT Email FROM users WHERE Email = '$email'";
    $checkResult = mysqli_query($mysqli, $checkEmailQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $errors[] = "Email already registered";
    }
    
    // Handle profile image upload
    $profileImg = "default.jpg"; // Default profile image
    
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        // Check file size (limit to 5MB)
        if ($_FILES['profile_image']['size'] > 5000000) {
            $errors[] = "File size exceeds 5MB limit";
        }
        
        // Check file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_info = getimagesize($_FILES['profile_image']['tmp_name']);
        
        if (!in_array($file_info['mime'], $allowed_types)) {
            $errors[] = "Only JPG, PNG, and GIF files are allowed";
        } else {
            // Generate unique filename to prevent overwriting
            $file_extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('profile_') . '.' . $file_extension;
            $upload_path = UPLOAD_DIR . $filename;
            $thumb_path = THUMB_DIR . $filename;
            
            // Process and save the image
            if (processAndUploadImage($_FILES['profile_image']['tmp_name'], $upload_path, $thumb_path, $file_info['mime'])) {
                $profileImg = $filename;
            } else {
                $errors[] = "Failed to process image. Please try again.";
            }
        }
    }
    
    // If there are validation errors, redirect back with error messages
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: ../../register.php?msg=" . urlencode($errorString));
        exit();
    }
    
    // Hash the password for security
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // Set default values
    $role = "customer"; // Default role for new registrations
    
    // Insert new user into database
    $insertQuery = "INSERT INTO users (Name, Email, PasswordHash, Phone, Country, Location, ProfileImg, Role) 
                   VALUES ('$name', '$email', '$passwordHash', '$phone', '$country', '$location', '$profileImg', '$role')";
    
    if (mysqli_query($mysqli, $insertQuery)) {
        // Registration successful, set session and redirect
        $_SESSION['username'] = $email;
        header("Location: ../../index.php?welcome=1");
        exit();
    } else {
        // Log the error for debugging
        error_log("Registration error: " . mysqli_error($mysqli));
        // Registration failed
        header("Location: ../../register.php?msg=" . urlencode($errors));
        exit();
    }
}

/**
 * Process and upload an image with compression
 * 
 * @param string $source_path Path to the source file
 * @param string $destination_path Path where the processed image will be saved
 * @param string $thumb_path Path where the thumbnail will be saved
 * @param string $mime_type MIME type of the image
 * @return bool True if successful, false otherwise
 */

 /*
function processAndUploadImage($source_path, $destination_path, $thumb_path, $mime_type) {
    try {
        // Create image from source based on mime type
        switch ($mime_type) {
            case 'image/jpeg':
                $source_img = imagecreatefromjpeg($source_path);
                break;
            case 'image/png':
                $source_img = imagecreatefrompng($source_path);
                break;
            case 'image/gif':
                $source_img = imagecreatefromgif($source_path);
                break;
            default:
                return false;
        }
        
        if (!$source_img) {
            return false;
        }
        
        // Get original dimensions
        $width = imagesx($source_img);
        $height = imagesy($source_img);
        
        // Preserve aspect ratio but limit maximum dimensions to 1200px
        $max_dimension = 1200;
        if ($width > $max_dimension || $height > $max_dimension) {
            if ($width > $height) {
                $new_width = $max_dimension;
                $new_height = intval($height * $max_dimension / $width);
            } else {
                $new_height = $max_dimension;
                $new_width = intval($width * $max_dimension / $height);
            }
        } else {
            $new_width = $width;
            $new_height = $height;
        }
        
        // Create a new image with the calculated dimensions
        $new_img = imagecreatetruecolor($new_width, $new_height);
        
        // Handle transparency for PNG and GIF
        if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
            imagealphablending($new_img, false);
            imagesavealpha($new_img, true);
            $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
            imagefilledrectangle($new_img, 0, 0, $new_width, $new_height, $transparent);
        }
        
        // Resize the image
        imagecopyresampled($new_img, $source_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        
        // Create thumbnail (150x150px)
        $thumb_img = imagecreatetruecolor(150, 150);
        
        // Handle transparency for thumbnail
        if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
            imagealphablending($thumb_img, false);
            imagesavealpha($thumb_img, true);
            $transparent = imagecolorallocatealpha($thumb_img, 255, 255, 255, 127);
            imagefilledrectangle($thumb_img, 0, 0, 150, 150, $transparent);
        }
        
        // Calculate and crop to square for thumbnail
        $thumb_dim = min($width, $height);
        $thumb_x = intval(($width - $thumb_dim) / 2);
        $thumb_y = intval(($height - $thumb_dim) / 2);
        
        // Create the thumbnail
        imagecopyresampled($thumb_img, $source_img, 0, 0, $thumb_x, $thumb_y, 150, 150, $thumb_dim, $thumb_dim);
        
        // Save the processed images
        $result = false;
        switch ($mime_type) {
            case 'image/jpeg':
                $result = imagejpeg($new_img, $destination_path, 90); // 90% quality
                imagejpeg($thumb_img, $thumb_path, 85);
                break;
            case 'image/png':
                // PNG compression level: 0 (no compression) to 9 (max compression)
                $result = imagepng($new_img, $destination_path, 6); // Medium compression
                imagepng($thumb_img, $thumb_path, 6);
                break;
            case 'image/gif':
                $result = imagegif($new_img, $destination_path);
                imagegif($thumb_img, $thumb_path);
                break;
        }
        
        // Free up memory
        imagedestroy($source_img);
        imagedestroy($new_img);
        imagedestroy($thumb_img);
        
        return $result;
    } catch (Exception $e) {
        error_log("Image processing error: " . $e->getMessage());
        return false;
    }
}*/
?>
<?php
/*
session_start();
include("../config/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Get form data and sanitize inputs
    $name = mysqli_real_escape_string($mysqli, $_POST['name']); // Full name
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $country = mysqli_real_escape_string($mysqli, $_POST['country']);
    $location = mysqli_real_escape_string($mysqli, $_POST['location']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirmPassword']);
    
    // Basic validation
    $errors = [];
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Password strength check (minimum 8 characters with at least one letter and one number)
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must be at least 8 characters and include both letters and numbers";
    }
    
    // Check if email already exists
    $checkEmailQuery = "SELECT Email FROM users WHERE Email = '$email'";
    $checkResult = mysqli_query($mysqli, $checkEmailQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        $errors[] = "Email already registered";
    }
    
    // If there are validation errors, redirect back with error messages
    if (!empty($errors)) {
        $errorString = implode(", ", $errors);
        header("Location: ../../register.php?msg=" . urlencode($errorString));
        exit();
    }
    
    // Optional: Hash the password (recommended for security)
    // Uncomment this line to use password hashing (strongly recommended)
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    // For now, storing password as plain text to match your current login system
    $passwordHash = $password;
    
    // Set default values
    $role = "customer"; // Default role for new registrations
    $profileImg = "No Image"; // Default profile image
    
    // Insert new user into database - matching your table structure
    $insertQuery = "INSERT INTO users (Name, Email, PasswordHash, Phone, Country, Location, ProfileImg, Role) 
                   VALUES ('$name', '$email', '$passwordHash', '$phone', '$country', '$location', '$profileImg', '$role')";
    
    if (mysqli_query($mysqli, $insertQuery)) {
        // Registration successful, set session and redirect
        $_SESSION['username'] = $email;
        header("Location: ../../index.php?welcome=1");
        exit();
    } else {
        // Log the error for debugging
        error_log("Registration error: " . mysqli_error($mysqli));
        // Registration failed
        header("Location: ../../register.php?msg=" . urlencode("Registration failed. Please try again."));
        exit();
    }
}*/
?>