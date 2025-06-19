<?php
// update_profile.php
include 'base.php'; // Assuming this contains your database connection
// Initialize variables
$errors = array();
$success_message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Get form data and sanitize
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $country = trim($_POST['country']);
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session
   // $_SESSION['username'] = $user['Email'];
    // Validation
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($phone)) {
        $errors[] = "Phone number is required";
    } elseif (!preg_match('/^[0-9+\-\s()]+$/', $phone)) {
        $errors[] = "Invalid phone number format";
    }
    
    if (empty($location)) {
        $errors[] = "Location is required";
    }
    
    if (empty($country)) {
        $errors[] = "Country is required";
    }
    
    // Check if email already exists for other users
    $email_check_query = "SELECT UserID FROM users WHERE Email = ? AND UserID != ?";
    $stmt = mysqli_prepare($mysqli, $email_check_query);
    mysqli_stmt_bind_param($stmt, "si", $email, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Email already exists";
    }
    
    // Handle file upload
    $profile_image = "";
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "../media/profiles/";
        $file_extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
        $new_filename = "profile_" . $user_id . "_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        // Check if image file is actual image
        $check = getimagesize($_FILES['profile_image']['tmp_name']);
        if ($check === false) {
            $errors[] = "File is not an image";
        }
        
        // Check file size (5MB limit)
        if ($_FILES['profile_image']['size'] > 5000000) {
            $errors[] = "File is too large (max 5MB)";
        }
        
        // Allow certain file formats
        if (!in_array($file_extension, array("jpg", "jpeg", "png", "gif"))) {
            $errors[] = "Only JPG, JPEG, PNG & GIF files are allowed";
        }
        
        // Create directory if it doesn't exist
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        
        // If no errors, upload file
        if (empty($errors)) {
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
                $profile_image = $new_filename;
                
                // Delete old profile image if exists
                $old_image_query = "SELECT ProfileImg FROM users WHERE UserID = ?";
                $stmt = mysqli_prepare($mysqli, $old_image_query);
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $old_result = mysqli_stmt_get_result($stmt);
                $old_data = mysqli_fetch_assoc($old_result);
                
                if (!empty($old_data['profile_image']) && file_exists($target_dir . $old_data['profile_image'])) {
                    unlink($target_dir . $old_data['profile_image']);
                }
            } else {
                $errors[] = "Error uploading file";
            }
        }
    }
    
    // If no errors, update database
    if (empty($errors)) {
        // Build update query based on whether image was uploaded
        if (!empty($profile_image)) {
            $update_query = "UPDATE users SET Name = ?, Email = ?, Phone = ?, Location = ?, Country = ?, ProfileImg = ? WHERE UserID = ?";
            $stmt = mysqli_prepare($mysqli, $update_query);
            mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $phone, $location, $country, $profile_image, $user_id);
        } else {
            $update_query = "UPDATE users SET Name = ?, Email = ?, Phone = ?, Location = ?, Country = ? WHERE UserID = ?";
            $stmt = mysqli_prepare($mysqli, $update_query);
            mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $phone, $location, $country, $user_id);
        }
        
        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Profile updated successfully!";
            
            // Update session data if needed
            //$_SESSION['user_name'] = $name;
           // $_SESSION['user_email'] = $email;
        } else {
            $errors[] = "Error updating profile: " . mysqli_error($mysqli);
        }
    }
}

// Get current user data for form display
$userid = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE UserID = ?";
$stmt = mysqli_prepare($mysqli, $user_query);
mysqli_stmt_bind_param($stmt, "i", $userid);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($user_result);
?>
<?php
    //get User Profile  details
    $userid = $_SESSION['user_id'];
    //echo $_SESSION['user_id'];
   //echo $userid;
    $result = mysqli_query($mysqli,"SELECT * FROM users WHERE UserID=$userid");
    
    while($row = mysqli_fetch_array($result)){
        $name = $row['Name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $location = $row['Location'];
        $country = $row['Country'];
        $profile_image = $row['ProfileImg'];
        //echo $profile_image;
      }
?>

<aside class="dashboard-content profile">
    <div>
        <h5>My Profile <i class="fa chevron-right"></i></h5>
    </div>

    <!-- Display Messages -->
    <?php if (!empty($errors)): ?>
        <div class="error-messages">
            <?php foreach ($errors as $error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success_message)): ?>
        <div class="success-message">
            <p style="color: green;"><?php echo htmlspecialchars($success_message); ?></p>
        </div>
    <?php endif; ?>

    <section>
        <div class="agonize-items"> 
            <div class="prof-img">
                <img src="../media/profiles/<?php echo $profile_image; ?>" alt="profile image user">
            </div>
            <div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-alignment">
                        <div class="form-right">
                            <div class="form-info">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
                            </div>
                            <div class="form-info">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                            <div class="form-info">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                            </div>
                        </div>
                        <div class="form-left">
                            <div class="form-info">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" value="<?php echo $location; ?>" required>
                            </div>
                            <div class="form-info">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" value="<?php echo htmlspecialchars($country); ?>" required>
                            </div>
                            <div class="form-info">
                                <label for="profile_image">Update Profile Image</label>
                                <input type="file" name="profile_image" id="profile_image" >
                            </div>
                            <div class="form-info">
                                <div style="text-align:center;">
                                    <a href="">Request Password change</a>

                                </div>
                                <br>
                                <button type="submit" class="profile-update-button">Update</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </section>
</aside>
                </article>
                </main>
<?php 
    include 'footer.php'; 
?>