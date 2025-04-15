<?php
    include 'base.php';
?>
<?php
    //get the id from url and
    if (isset($_GET['destid']) && filter_var($_GET['destid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['destid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>

<?php
    //get destination details
    $result = mysqli_query($conn,"SELECT * FROM Destinations d 
                                                      JOIN Agents a ON d.AgentID = a.AgentID
                                                      WHERE a.AgentID = $agentID  AND d.DestinationID = $id");
                while($row = mysqli_fetch_array($result)){
                  $ID = $row["DestinationID"];
                  $Name = $row["Name"];
                  $location = $row["Location"];
                  $country = $row["Country"];
                  $img = $row["ImageURL"];
                  $desc1 = $row["Description"];
                  $price = $row["Price"];
                  $feature = $row["Featured"];
                  $Agent = $row["AgentID"];
                  $travel = $row["TravelID"];
                  $approv = $row["Status"];
                  $created = $row["Created_at"];
                  $dist = $row["DistFromOrigin"];
                  $avg = $row["RatingAVG"];
                  $destDetails = "$Name -"." $location , "."$country";
                  //echo "$approv";
                  // echo "$desc ";
                  //approved or not
                  if ($approv == "active"){
                    $icon = "Approved";
                  }else{
                    $icon = "Not approved";
                  }


                  //get the Travel Details details
                  $travelop = mysqli_query($conn,"SELECT * FROM Traveloptions WHERE TravelID=$travel");
                  $row6= mysqli_fetch_array($travelop);
                  $mode = $row6["TravelMode"];
                  $details = $row6["Details"];
                  $travelDetails = "($mode) -  "." via a $details";

                  //get the featured details
                  $feature = mysqli_query($conn,"SELECT * FROM featured WHERE FeatureID=$feature");
                  $row5= mysqli_fetch_array($feature);
                  $desc = $row5["Description"];
                  $discount = $row5["Discount"];
                  
                  if(($row5 == " ") OR ($row5 == 0)){
                      $featureDetails = "Not Featured";
                  }else{
                      $featureDetails = "$desc "." of $discount";
                  }

      }
?>
<?php
    // Validate and fetch destination ID from URL
    if (!isset($_GET['destid']) || !filter_var($_GET['destid'], FILTER_VALIDATE_INT)) {
      die("Invalid or missing destination ID.");
    }
    $id = intval($_GET['destid']);
    $msg = " ";
    // Fetch current destination data
    $stmt = $conn->prepare("SELECT * FROM destinations WHERE DestinationID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $destination = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$destination) {
      die("Destination not found.");
    }

    // Handle Form Actions
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (isset($_POST['update'])) {
          $name = $_POST['destination'];
          $desc = $_POST['description'];
          $location = $_POST['location'];
          $country = $_POST['country'];
          $travel = $_POST['travel'];
          $price = $_POST['price'];
          $dist = $_POST['dist'];
          /*$image = $_FILES['img'];
          
          // Handle optional image upload
          $imgPath = $destination['ImageURL']; // Default to existing image
          if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
              $allowed = ['image/jpeg', 'image/png', 'image/gif'];
              if (in_array($image['type'], $allowed)) {
                  $uniqueName = time() . '_' . basename($image['name']);
                  $uploadPath = 'uploads/' . $uniqueName;
                  if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                      $imgPath = $uploadPath;
                  } else {
                      die("Failed to upload image.");
                  }
              } else {
                  die("Invalid image format.");
              }
          }*/
          $target_file = null;

        if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            $filetype = mime_content_type($_FILES['img']['tmp_name']);

            if (!in_array($filetype, $allowed)) {
                die("<div class='alert alert-warning'>Invalid image format. Use jpg, png, or gif.</div>");
            }

            $filename = uniqid() . '_' . basename($_FILES['img']['name']);
            $target_file = "uploads/" . $filename;

            if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                die("<div class='alert alert-warning'>Image upload failed.</div>");
            }
        }


          // SQL update with or without image
            if ($target_file) {
              $stmt = $conn->prepare("UPDATE destinations SET Name=?, Description=?, Location=?, Country=?, Price=?, DistFromOrigin=?, ImageURL=? WHERE DestinationID=? AND AgentID=$agentID");
              $stmt->bind_param("sssssdsi", $name, $desc, $location, $country, $price, $dist, $target_file, $id);
          } else {
              $stmt = $conn->prepare("UPDATE destinations SET Name=?, Description=?, Location=?, Country=?, Price=?, DistFromOrigin=? WHERE DestinationID=? AND AgentID=$agentID");
              $stmt->bind_param("sssssdi", $name, $desc, $location, $country, $price, $dist, $id);
          }
          
          if ($stmt->execute()) {
              $msg = "<div class='alert alert-success'>Destination updated successfully.</div>";
          } else {
              $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
          }
          $stmt->close();

      } elseif (isset($_POST['deactivate'])) {
          $stmt = $conn->prepare("UPDATE destinations SET Status = 'unapproved' WHERE DestinationID = ?  AND AgentID=$agentID");
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              $msg =  "<div class='alert alert-info'>Destination deactivated.</div>";
          } else {
             $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
          }
          $stmt->close();
      } elseif (isset($_POST['delete'])) {
          $stmt = $conn->prepare("DELETE FROM destinations WHERE DestinationID = ? AND AgentID=$agentID" );
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              echo "<div class='alert alert-success'>Destination deleted.</div>";
              header("Refresh:2; url=destinations.php");
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
        <a href="destinations.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Destinations</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body">
                <h4 class="card-title">Destination Details</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?destid=' . $id; ?>" method="post" enctype="multipart/form-data">


                      
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
                                <label for="">Destination Image</label>
                                <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                                <input type="file" class="form-control" name="img" >
                              </div>
                      <div class="form-group">
                        <label for="Booked Destination">Destination Name</label>
                        <input type="text" class="form-control" name="destination" value="<?php echo $Name; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc1; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control"name="location" value="<?php echo $location; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Travel Option</label>
                        <input type="text" class="form-control" name="travel" placeholder="<?php echo $travelDetails; ?>" value="<?php echo $travelDetails; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Featured</label>
                        <input type="text" class="form-control" name="feature" value="<?php echo $featureDetails; ?>">
                      </div>
                      
                    
                    
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">.</h4>

                              
                              <div class="form-group">
                                <label for="">Approved  By Admin </label>
                                <input type="text" class="form-control" name="icon" value="<?php echo $icon; ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Price : Total Amount </label>
                                <input type="text" class="form-control"  name="price" value="<?php echo $price; ?>">
                              </div>
                              <div class="form-group">
                                <label for="">Distance From Location to Destination</label>
                                <input type="text" class="form-control" name="dist" value="<?php echo $dist; ?> ">
                              </div>
                              <div class="form-group">
                                <label for="">Average Ratings</label>
                                <input type="text" class="form-control" name="avg" value="<?php echo $avg; ?>">
                              </div>
                            
                              <div class="form-group">
                                <label for="">Created ON</label>
                                <input type="text" class="form-control" name="date" value="<?php echo $created; ?>">
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




<?php
    include 'footer.php';
?>