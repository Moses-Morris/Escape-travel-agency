<?php
    include 'base.php';
?>
<?php
  $msg = " ";
  //get the id from url and
    if (isset($_GET['hostid']) && filter_var($_GET['hostid'], FILTER_VALIDATE_INT)) {
        $hostid = $_GET['hostid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>
<?php
  //get Hosting details
  // Get Hosting details
$name = "";
$existing_images = array();
if ($hostid > 0) {
    $result = mysqli_query($conn, "SELECT * FROM accomodation d 
                                  JOIN Agents a ON d.AgentID = a.AgentID
                                  WHERE a.AgentID = $agentID AND d.HostingID = $hostid");
    
    if ($row = mysqli_fetch_array($result)) {
        $name = $row['Name'];
    }
    
    // Get existing gallery images
    $gallery_result = mysqli_query($conn, "SELECT * FROM AccomodationGallery WHERE HostingID = $hostid");
    if ($gallery_row = mysqli_fetch_array($gallery_result)) {
        $existing_images = array(
            'main' => $gallery_row['Image1'],
            'img1' => $gallery_row['Image2'],
            'img2' => $gallery_row['Image3'],
            'img3' => $gallery_row['Image4'],
            'img4' => $gallery_row['Image5'],
            'img5' => '',
            'gallery_id' => $gallery_row['ID']
        );
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $hostid > 0) {
    
    // Create uploads directory if it doesn't exist
    $upload_dir = "uploads/accommodations/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Function to handle file upload
    function uploadImage($file, $upload_dir, $prefix = "") {
        if (isset($file) && $file['error'] == 0) {
            $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
            $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            
            if (in_array($file_extension, $allowed_types)) {
                $new_filename = $prefix . time() . '_' . uniqid() . '.' . $file_extension;
                $target_path = $upload_dir . $new_filename;
                
                if (move_uploaded_file($file['tmp_name'], $target_path)) {
                    return $target_path;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        return null;
    }
    
    // CREATE ACTION
    if (isset($_POST['create'])) {
        $image_paths = array();
        
        // Upload main image
        if (isset($_FILES['main_img'])) {
            $image_paths['main'] = uploadImage($_FILES['main_img'], $upload_dir, "main_");
        }
        
        // Upload additional images
        for ($i = 1; $i <= 5; $i++) {
            if (isset($_FILES["img_$i"])) {
                $image_paths["img_$i"] = uploadImage($_FILES["img_$i"], $upload_dir, "img{$i}_");
            }
        }
        
        // Check if at least main image is uploaded
        if (isset($image_paths['main']) && $image_paths['main'] !== false) {
            $img1 = mysqli_real_escape_string($conn, $image_paths['main']);
            $img2 = isset($image_paths['img_1']) && $image_paths['img_1'] ? mysqli_real_escape_string($conn, $image_paths['img_1']) : '';
            $img3 = isset($image_paths['img_2']) && $image_paths['img_2'] ? mysqli_real_escape_string($conn, $image_paths['img_2']) : '';
            $img4 = isset($image_paths['img_3']) && $image_paths['img_3'] ? mysqli_real_escape_string($conn, $image_paths['img_3']) : '';
            $img5 = isset($image_paths['img_4']) && $image_paths['img_4'] ? mysqli_real_escape_string($conn, $image_paths['img_4']) : '';
            
            $description = mysqli_real_escape_string($conn, $_POST['description'] ?? $name);
            $added_by = mysqli_real_escape_string($conn, $_SESSION['username'] ?? 'System');
            
            $insert_query = "INSERT INTO AccomodationGallery 
                           (HostingID, Description, Added_By, Image1, Image2, Image3, Image4, Image5) 
                           VALUES 
                           ($hostid, '$description', '$added_by', '$img1', '$img2', '$img3', '$img4', '$img5')";
            
            if (mysqli_query($conn, $insert_query)) {
                $msg = "<div class='alert alert-success'>Images uploaded successfully!</div>";
                // Refresh existing images
                $gallery_result = mysqli_query($conn, "SELECT * FROM AccomodationGallery WHERE HostingID = $hostid ORDER BY ID DESC LIMIT 1");
                if ($gallery_row = mysqli_fetch_array($gallery_result)) {
                    $existing_images = array(
                        'main' => $gallery_row['Image1'],
                        'img1' => $gallery_row['Image2'],
                        'img2' => $gallery_row['Image3'],
                        'img3' => $gallery_row['Image4'],
                        'img4' => $gallery_row['Image5'],
                        'img5' => '',
                        'gallery_id' => $gallery_row['ID']
                    );
                }
            } else {
                $msg = "<div class='alert alert-danger'>Error uploading images: " . mysqli_error($conn) . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Please upload at least the main image!</div>";
        }
    }
    
    // UPDATE ACTION
    if (isset($_POST['update']) && isset($existing_images['gallery_id'])) {
        $gallery_id = $existing_images['gallery_id'];
        $update_fields = array();
        
        // Handle main image update
        if (isset($_FILES['main_img']) && $_FILES['main_img']['error'] == 0) {
            $new_main = uploadImage($_FILES['main_img'], $upload_dir, "main_");
            if ($new_main) {
                // Delete old main image
                if ($existing_images['main'] && file_exists($existing_images['main'])) {
                    unlink($existing_images['main']);
                }
                $update_fields[] = "Image1 = '" . mysqli_real_escape_string($conn, $new_main) . "'";
            }
        }
        
        // Handle additional images update
        for ($i = 1; $i <= 4; $i++) {
            if (isset($_FILES["img_$i"]) && $_FILES["img_$i"]['error'] == 0) {
                $new_img = uploadImage($_FILES["img_$i"], $upload_dir, "img{$i}_");
                if ($new_img) {
                    // Delete old image
                    $old_img_key = "img" . $i;
                    if (isset($existing_images[$old_img_key]) && $existing_images[$old_img_key] && file_exists($existing_images[$old_img_key])) {
                        unlink($existing_images[$old_img_key]);
                    }
                    $img_column = "Image" . ($i + 1);
                    $update_fields[] = "$img_column = '" . mysqli_real_escape_string($conn, $new_img) . "'";
                }
            }
        }
        
        // Update description if provided
        if (isset($_POST['description']) && !empty($_POST['description'])) {
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $update_fields[] = "Description = '$description'";
        }
        
        if (!empty($update_fields)) {
            $update_query = "UPDATE AccomodationGallery SET " . implode(', ', $update_fields) . " WHERE ID = $gallery_id";
            
            if (mysqli_query($conn, $update_query)) {
                $msg = "<div class='alert alert-success'>Images updated successfully!</div>";
                // Refresh existing images
                $gallery_result = mysqli_query($conn, "SELECT * FROM AccomodationGallery WHERE ID = $gallery_id");
                if ($gallery_row = mysqli_fetch_array($gallery_result)) {
                    $existing_images = array(
                        'main' => $gallery_row['Image1'],
                        'img1' => $gallery_row['Image2'],
                        'img2' => $gallery_row['Image3'],
                        'img3' => $gallery_row['Image4'],
                        'img4' => $gallery_row['Image5'],
                        'img5' => '',
                        'gallery_id' => $gallery_row['ID']
                    );
                }
            } else {
                $msg = "<div class='alert alert-danger'>Error updating images: " . mysqli_error($conn) . "</div>";
            }
        } else {
            $msg = "<div class='alert alert-warning'>No new images were uploaded!</div>";
        }
    }
    
    // DELETE ACTION
    if (isset($_POST['delete']) && isset($existing_images['gallery_id'])) {
        $gallery_id = $existing_images['gallery_id'];
        
        // Delete all associated image files
        foreach ($existing_images as $key => $image_path) {
            if ($key != 'gallery_id' && $image_path && file_exists($image_path)) {
                unlink($image_path);
            }
        }
        
        // Delete database record
        $delete_query = "DELETE FROM AccomodationGallery WHERE ID = $gallery_id";
        
        if (mysqli_query($conn, $delete_query)) {
            $msg = "<div class='alert alert-success'>Gallery deleted successfully!</div>";
            $existing_images = array(); // Clear existing images
        } else {
            $msg = "<div class='alert alert-danger'>Error deleting gallery: " . mysqli_error($conn) . "</div>";
        }
    }
    
    // DEACTIVATE ACTION
    if (isset($_POST['deactivate']) && isset($existing_images['gallery_id'])) {
        $gallery_id = $existing_images['gallery_id'];
        $deactivate_query = "UPDATE AccomodationGallery SET Status = 'inactive' WHERE ID = $gallery_id";
        
        if (mysqli_query($conn, $deactivate_query)) {
            $msg = "<div class='alert alert-success'>Gallery deactivated successfully!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error deactivating gallery: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>
<?php
//deactivate Current Hosting
//Done above in the php code
?>

<!-- partial -->
<!-- HTML Form -->
<div class="main-panel">
    <div class="content-wrapper">
        <a href="listings.php#hostings" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Listings</a>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload Hosting Images of Hotel or AirBnB or Resort</h4>
                        
                        <?php echo $msg; ?>
                        
                        <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?hostid=' . $hostid; ?>" method="post" enctype="multipart/form-data">
                            
                            <style>
                                .form-group input {
                                    font-weight: 900;
                                    font-size: medium;
                                }
                                .image-preview {
                                    height: auto;
                                    width: 30vw;
                                    background-position: center;
                                    object-fit: cover;
                                    border: 1px solid #ddd;
                                    margin-bottom: 10px;
                                }
                            </style>
                            
                            <div class="form-group">
                                <label>Hosting Place Name</label>
                                <input type="text" class="form-control" name="hosting" value="<?php echo htmlspecialchars($name); ?>" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" placeholder="Enter gallery description">
                            </div>
                            
                            <div class="form-group">
                                <label>Main Image *</label><br>
                                <?php if (isset($existing_images['main']) && $existing_images['main']): ?>
                                    <img src="<?php echo htmlspecialchars($existing_images['main']); ?>" alt="Main Image" class="image-preview">
                                    <p><small>Current main image</small></p>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="main_img" accept="image/*">
                            </div>
                            
                            <?php for ($i = 1; $i <= 4; $i++): ?>
                            <div class="form-group">
                                <label>Image <?php echo $i; ?></label><br>
                                <?php 
                                $img_key = "img" . $i;
                                if (isset($existing_images[$img_key]) && $existing_images[$img_key]): 
                                ?>
                                    <img src="<?php echo htmlspecialchars($existing_images[$img_key]); ?>" alt="Image <?php echo $i; ?>" class="image-preview">
                                    <p><small>Current image <?php echo $i; ?></small></p>
                                <?php endif; ?>
                                <input type="file" class="form-control" name="img_<?php echo $i; ?>" accept="image/*">
                            </div>
                            <?php endfor; ?>
                            
                            <div class="form-group">
                                <p>- You can create, update, or delete the hosting gallery -</p>
                                <p>- Deactivate the gallery if you do not wish to display these images -</p>
                                
                                <?php if (empty($existing_images) || !isset($existing_images['gallery_id'])): ?>
                                    <button type="submit" class="btn btn-info btn-rounded btn-fw me-2" name="create">Create Gallery</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2" name="update">Update Gallery</button>
                                    <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="delete" onclick="return confirm('Are you sure you want to delete this gallery? This action cannot be undone.')">Delete Gallery</button>
                                    <button type="submit" class="btn btn-warning btn-rounded btn-fw me-2" name="deactivate" onclick="return confirm('Are you sure you want to deactivate this gallery?')">Deactivate Gallery</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                </div>


<?php
    include 'footer.php';
?>