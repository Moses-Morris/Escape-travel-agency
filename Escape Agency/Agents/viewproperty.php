<?php
    include 'base.php';
?>
<?php
 $msg="";
    //get the id from url and
    if (isset($_GET['propid']) && filter_var($_GET['propid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['propid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>
<?php
//Actions on Property
 // Handle Form Actions

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $propid = isset($_POST['propid']) ? intval($_POST['propid']) : 0;
    $name = trim($_POST['property']);
    $desc = trim($_POST['description']);
    $services = trim($_POST['services']);
    $location = trim($_POST['location']);
    $type = trim($_POST['type']);
    $status = ($_POST['icon'] === "Approved") ? "active" : "inactive";
    $price = floatval(preg_replace("/[^0-9.]/", "", $_POST['price']));
    $feature = trim($_POST['features']);
    $avg = trim($_POST['avg']);
    $date = trim($_POST['date']);
    //$target_file = null;

    // --- Handle Image Upload ---
    $target_file = null;

        if (!empty($_FILES['img']['name']) && $_FILES['img']['error'] === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            $filetype = $_FILES['img']['type']; // fallback to this if mime_content_type fails
            $tmp_name = $_FILES['img']['tmp_name'];

            if (!in_array($filetype, $allowed)) {
                die("<div class='alert alert-warning'>Invalid image format: $filetype. Use jpg, png, or gif.</div>");
            }

            $filename = uniqid() . '_' . basename($_FILES['img']['name']);
            $target_file = "uploads/" . $filename;

            // Create uploads directory if not exists
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }

            if (move_uploaded_file($tmp_name, $target_file)) {
                $msg=  "<div class='alert alert-success'>Image uploaded successfully: $target_file</div>";
            } else {
              $msg = "<div class='alert alert-danger'>Failed to move uploaded file.</div>";
                $target_file = null; // prevent incorrect save
            }
        } else {
          $msg =  "<div class='alert alert-warning'>No image selected or upload error.</div>";
        }

    // --- Update Property ---
    
        if ($target_file) {
            $stmt = $conn->prepare("UPDATE agentproperties 
                SET PropertyName=?, AgentID=?, Status=?, Services=?, Features=?, Description=?, Price=?, Location=?, OptionType=?, ImageURL=? 
                WHERE PropertyID=? AND AgentID=?");
            $stmt->bind_param("ssssssssssii", $name, $agentID, $status, $services, $feature, $desc, $price, $location, $type, $target_file, $propid, $agentID);
        } else {
            $stmt = $conn->prepare("UPDATE agentproperties 
                SET PropertyName=?, AgentID=?, Status=?, Services=?, Features=?, Description=?, Price=?, Location=?, OptionType=? 
                WHERE PropertyID=? AND AgentID=?");
            $stmt->bind_param("ssssssssiii", $name, $agentID, $status, $services, $feature, $desc, $price, $location, $type, $propid, $agentID);
        }

        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Property updated successfully.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Update failed: " . $stmt->error . "</div>";
        }
        $stmt->close();
    
      }
    // --- Deactivate Property ---
    elseif (isset($_POST['deactivate'])) {
        $stmt = $conn->prepare("UPDATE agentproperties SET Status = 'inactive' WHERE PropertyID = ? AND AgentID = ?");
        $stmt->bind_param("ii", $propid, $agentID);
        if ($stmt->execute()) {
            $msg = "<div class='alert alert-info'>Property deactivated.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

    // --- Delete Property ---
    elseif (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM agentproperties WHERE PropertyID = ? AND AgentID = ?");
        $stmt->bind_param("ii", $propid, $agentID);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Property deleted successfully.</div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'properties.php';
                    }, 3000);
                  </script>";
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Delete failed: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }

?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="listings.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Listings</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Property Details</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?propid=' . $id; ?>" method="post" enctype="multipart/form-data">
                      <?php
                       
                          if($msg){
                            print $msg;
                          }
                      ?>

                      <?php
                          //get destination details
                          $result = mysqli_query($conn,"SELECT * FROM agentproperties d 
                                                                            JOIN Agents a ON d.AgentID = a.AgentID
                                                                            WHERE a.AgentID = $agentID  AND d.PropertyID = $id");
                          while($row = mysqli_fetch_array($result)){
                                $ID = $row["PropertyID"];
                                $Name = $row["PropertyName"];
                                $approv = $row["Status"];
                                $created = $row["Created_at"];
                                $avg = $row["RatingAVG"];
                                $services = $row["Services"];
                                $location = $row["Location"];
                                $img = $row["ImageURL"];
                                $desc = $row["Description"];
                                $price = $row["Price"];
                                $feature = $row["Features"];
                                $Agent = $row["AgentType"];
                                $type = $row["OptionType"];
                                
                                if ($approv == "active"){
                                    $icon = "Approved";
                                }else{
                                    $icon = "Not approved";
                                }
                            }
                      ?>
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                   
                      <input type="text" class="form-control" name="propid" value="<?php echo $propid; ?>" hidden>
                      
                      <div class="form-group">
                        <label for="">Property Name</label>
                        <input type="text" class="form-control" name="property" value="<?php echo $Name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Services</label>
                        <input type="text" class="form-control"name="services" value="<?php echo $services; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" name="location" value="<?php echo $location; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Property Type</label>
                        <input type="text" class="form-control" name="type" value="<?php echo $type; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Features</label>
                        <input type="text" class="form-control" name="features" value="<?php echo $feature; ?>">
                      </div>
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Property Image</label>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:30vh; width:30vw; object-fit:center;background-position:center;">
                        <input type="file" class="form-control" name="img" >
                      </div>
                      <div class="form-group">
                        <label for="">Approved  By Admin </label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Price : Total Amount </label>
                        <input type="text" class="form-control"  name="price" value="<?php echo $price; ?> USD">
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
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="update">Update</button>
                        <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="deactivate">Deactivate</button>
                        
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>




<?php
    include 'footer.php';
?>