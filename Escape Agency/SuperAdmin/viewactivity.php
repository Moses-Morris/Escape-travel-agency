<?php
    include 'base.php';
?>
<?php
    $msg="";
    //get the id from url and
    if (isset($_GET['actid']) && filter_var($_GET['actid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['actid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>

<?php


    $result = mysqli_query($conn,"SELECT * FROM activities WHERE  ActivityID=$id ");
    while($row = mysqli_fetch_array($result)){
    $id = $row["ActivityID"];
    $Name = $row["Name"];
    $desc = $row["Description"];
    $img = $row["ImageURL"];
    $amount = $row["Price"];
    $dest = $row["DestinationID"];
    $agent = $row["AgentID"];
    $duration = $row["Duration"];
    $status = $row["Status"];
    $rating = $row['RatingAVG'];
    $date = $row['Created_at'];
    
    if ($status == "active"){
        $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Running</i>";
        
    }else{
        $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
    }

    

    //gET agent anme
    $agents = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
    $dd = mysqli_fetch_array($agents);
    $getdd = $dd['CompanyName'];


    //gET dest NAME
    $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
    $ddname = mysqli_fetch_array($destname);
    $getddname = $ddname['Name'];
  
    };

                    
?>
<?php
   
    if (!$id) {
      die("Error : Activity not found.");
    }

    // Handle Form Actions
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (isset($_POST['update'])) {
          $name = $_POST['name'];
          $desc = $_POST['description'];
          $duration = $_POST['duration'];
          $price = $_POST['price'];
          $status = $_POST['icon'];
          $destination = $_POST['DestinationID'];
          $ratings = $_POST['ratings'];
          
          $uploadOk = true;
          $target_file = $img; // default to existing image if new one is not uploaded
          $imageUpdated = false;
      
          // Image upload logic
          if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
              $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
              $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
      
              $fileTmpPath = $_FILES['img']['tmp_name'];
              $originalName = $_FILES['img']['name'];
              $fileSize = $_FILES['img']['size'];
              $fileMimeType = mime_content_type($fileTmpPath);
              $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
      
              // Validate type and extension
              if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExt, $allowedExtensions)) {
                  $msg = "<div class='alert alert-warning'>Invalid file type. Only JPG, PNG, or GIF allowed.</div>";
                  $uploadOk = false;
              }
      
              // Limit file size (e.g., 5MB)
              if ($fileSize > 5 * 1024 * 1024) {
                  $msg = "<div class='alert alert-warning'>File is too large. Max 5MB allowed.</div>";
                  $uploadOk = false;
              }
      
              // Move file if all good
              if ($uploadOk) {
                  $uniqueName = uniqid('img_', true) . '.' . $fileExt;
                  $uploadDir = "uploads/";
                  $target_file = $uploadDir . $uniqueName;
      
                  if (!move_uploaded_file($fileTmpPath, $target_file)) {
                      $msg = "<div class='alert alert-danger'>Failed to move uploaded file.</div>";
                      $uploadOk = false;
                  } else {
                      $imageUpdated = true;
                  }
              }
          }
             // Only continue if image passed or no image was uploaded
            if ($uploadOk) {
              if ($imageUpdated) {
                  $stmt = $conn->prepare("UPDATE activities SET Name=?, Description=?, Duration=?, Price=?, Status=?, ImageURL=?, DestinationID=? WHERE ActivityID=?");
                  $stmt->bind_param("sssssssi", $name, $desc, $duration, $price, $status, $target_file, $destination, $id);
              } else {
                  $stmt = $conn->prepare("UPDATE activities SET Name=?, Description=?, Duration=?, Price=?, Status=?, DestinationID=? WHERE ActivityID=? ");
                  $stmt->bind_param("ssssssi", $name, $desc, $duration, $price, $status, $destination, $id);
              }

              if ($stmt->execute()) {
                  $msg = "<div class='alert alert-success'>Activity updated successfully.</div>";
              } else {
                  $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
              }

              $stmt->close();
          }
              

      } elseif (isset($_POST['deactivate'])) {
          $stmt = $conn->prepare("UPDATE activities SET Status = 'inactive' WHERE ActivityID = ?  ");
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              $msg =  "<div class='alert alert-info'>Activity deactivated.</div>";
          } else {
             $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
          }
          $stmt->close();
      } elseif (isset($_POST['delete'])) {
          $stmt = $conn->prepare("DELETE FROM Activities WHERE ActivityID = ? " );
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              echo "<div class='col-md-6 d-flex '>
                          Activity Deleted Sucessfully
                              ";

                echo "<script>
                setTimeout(function() {
                    window.location.href = 'activities.php';
                }, 3000);
            </script>";
              exit;
          } else {
            $msg =   "<div class='alert alert-danger'>Delete failed: " . $stmt->error . "</div>";
          }
          $stmt->close();
      }
    }

?>





<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="activities.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Activities</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body">
                <h4 class="card-title">Activity Details</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?actid=' . $id; ?>" method="post" enctype="multipart/form-data">


                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <?php
                            if ($msg){
                              echo $msg;
                            }
                      ?>
                      <div class="form-group ">
                                <label for="">Activity Image</label>
                                <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                                <input type="file" class="form-control" name="img" >
                              </div>
                      <div class="form-group">
                        <label for="Activity">Activity Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $Name; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc; ?>">
                      </div>
                      
                      
                      
                      
                    
                    
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">.</h4>
                              <div class="form-group">
                                    <label for="">Duration</label>
                                    <input type="text" class="form-control"name="duration" value="<?php echo $duration; ?> ">
                                </div>
                              <div class="form-group">
                                    <label for="destination">Destination Name</label>
                                    <input list='destinations' id='destination' name='DestinationID' placeholder='<?php echo $getddname; ?>' class='form-control' value="<?php echo $dest; ?> ">
                                        <datalist id='destinations'>
                                            <?php
                                                //Select some elements from  the database
                                                //echo $agentID;
                                                $result = mysqli_query($conn,"SELECT * FROM Destinations ");
                                                while($row = mysqli_fetch_array($result)){
                                                    $ID = $row["DestinationID"];
                                                    $destinationName = $row["Name"];
                                                    $destImage =  $row["ImageURL"];
                                                    $location =  $row["Location"];
                                                    $country =  $row["Country"];
                                                    $destdetails = "$destinationName -"." $location, "."$country. ";
                                                    echo "<option value=".$ID.">  " .$destdetails." </option>
                                                    ";
                                                }
                                            
                                            ?>
                                        </datalist>
                                </div>
                              
                              <div class="form-group">
                                <label for="">Approved  By Admin </label>
                                <input type="text" class="form-control" name="icon" value="<?php echo $status; ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Price : Total Amount </label>
                                <input type="text" class="form-control"  name="price" value="<?php echo $amount; ?>">
                              </div>
                              
                              <div class="form-group">
                                <label for="">Average Ratings</label>
                                <input type="text" class="form-control" name="ratings" value="<?php echo $rating; ?>">
                              </div>
                            
                              <div class="form-group">
                                <label for="">Created ON</label>
                                <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
                              </div>
                              <div class="form-group">
                                  <p>- You can update the destination details -</p>
                                  <p>- Deactivate the Destination if you do not wish to proceed with the request -</p>
                                  <br>
                                  <button type="submit" name="update" class="btn btn-primary btn-rounded btn-fw me-2">Update</button>
                                  <button type="submit" name="deactivate" class="btn btn-warning btn-rounded btn-fw me-2">Deactivate</button>
                                  <button type="submit" name="delete" class="btn btn-danger btn-rounded btn-fw me-2" onclick="return confirm('Are you sure you want to delete this destination?');">Delete</button>
                                  
                                </div>
                     
                  
                    
                    </div>
                  </div>
                </div>
              </form>


                                            </div>

<?php
    include 'footer.php';
?>