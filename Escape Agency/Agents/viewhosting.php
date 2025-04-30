<?php
    include 'base.php';
?>
<?php
  $msg = " ";
  //get the id from url and
    if (isset($_GET['hostid']) && filter_var($_GET['hostid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['hostid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>
<?php
  //get Hosting details
  $result = mysqli_query($conn, "SELECT * FROM accomodation d 
                                                    JOIN Agents a ON d.AgentID = a.AgentID
                                                    WHERE a.AgentID = $agentID  AND d.HostingID = $id");
/*
  if($row = mysqli_fetch_array($result)){
    print "True";
  }else{
    print "Shiet";
    }
    */
  while($row = mysqli_fetch_array($result)){
      $name = $row['Name'];
      $dest = $row['DestinationID'];
      $type = $row['Type'];
      $price = $row['PricePerNight'];
      $img = $row['ImageURL'];
      $location = $row['Location'];
      //$country = $row['Country'];
      $Dist = $row['DistFromOrigin'];  //distance from destination
      $agent = $row['AgentID'];
      $type = $row['Type'];
      $rating = $row['RatingAVG'];
      $location = $row['Location'];
      $feat = $row['Features'];
      $active = $row['active'];
      $desc = $row['Description'];
      $created = $row['Created_at'];
      
      //echo $created;
      if( $active == "active"){
        $icon = "Open For Booking : Approved";
      }else{
        $icon = "Not open for Booking : Not Yet Approved";
      }
      

      //Destination which is closest to the accomodation location
      $destination = mysqli_query($conn,"SELECT * FROM  destinations  WHERE DestinationID=$dest "); //AND Status='approved'
      $a_dest = mysqli_fetch_array($destination);
      $image_dest = $a_dest['ImageURL'];
      $name_dest = $a_dest['Name'];

      
  
  }
?>

<?php
//Update Current Hosting
// Handle Form Actions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['update'])) {
      $name = $_POST['hosting'];
      $desc = $_POST['description'];
      $location = $_POST['location'];
      $feature = $_POST['feature'];
      $price = $_POST['price'];
      $rating = $_POST['rating'];
      $destination = $_POST['destination'];
      $status= $_POST['icon'];
      $dist = $_POST['dist'];
      $date = $_POST['date'];
      $type =  $_POST['type'];
      $target_file = $_POST['hostingimg']; 

        if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            $filetype = mime_content_type($_FILES['img']['tmp_name']);

            if (!in_array($filetype, $allowed)) {
                die("<div class='alert alert-warning '>Invalid image format. Use jpg, png, or gif.</div>");
            }

            $filename = uniqid() . '_' . basename($_FILES['img']['name']);
            $target_file = "uploads/" . $filename;

            if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                die("<div class='alert alert-warning'>Image upload failed.</div>");
            }
        }


          // SQL update with or without image
            if ($target_file) {
              $stmt = $conn->prepare("UPDATE accomodation SET Name=?, DestinationID=?, Type=?,  PricePerNight=?, RatingAVG=?, ImageURL=?, Location=? , DistFromOrigin=?, Features=?, active=?, Description=?, Created_at=?
               WHERE HostingID=? AND AgentID=$agentID");
              $stmt->bind_param("sisddssissssii", $name, $destination, $type, $price, $rating, $target_file,  $location,   $dist, $feat, $active,  $desc, $created, $id, $agentID);
          } else {
              $stmt = $conn->prepare("UPDATE accomodation SET Name=?, DestinationID=?, Type=?,  PricePerNight=?, RatingAVG=?, ImageURL=?, Location=? , DistFromOrigin=?, Features=?, active=?, Description=?, Created_at=?
               WHERE HostingID=? AND AgentID=$agentID");
              $stmt->bind_param("sisddssissssii", $name, $destination, $type, $price, $rating, $target_file,  $location,   $dist, $feat, $active,  $desc, $created, $id, $agentID);
          }
          
          if ($stmt->execute()) {
              $msg = "<div class='alert alert-success'>Hosting updated successfully.</div>";
              
          } else {
              $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
          }
          $stmt->close();

      } elseif (isset($_POST['deactivate'])) {
          $stmt = $conn->prepare("UPDATE accomodation SET active = 'inactive' WHERE HostingID = ?  AND AgentID=$agentID");
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              $msg =  "<div class='alert alert-info'>Hosting deactivated. It can no longer be booked and is not visible to the client.</div>";
          } else {
             $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
          }
          $stmt->close();
      }/* elseif (isset($_POST['delete'])) {
          $stmt = $conn->prepare("DELETE FROM destinations WHERE DestinationID = ? AND AgentID=$agentID" );
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              echo "<div class='col-md-6 d-flex '>
                          Destination Deleted Sucessfully
                              ";

                              echo "<script>
                              setTimeout(function() {
                                  window.location.href = 'destinations.php';
                              }, 3000);
                            </script>";
              exit;
          } else {
            $msg =   "<div class='alert alert-danger'>Delete failed: " . $stmt->error . "</div>";
          }
          $stmt->close();
      }*/
    }


?>

<?php
//deactivate Current Hosting
//Done above in the php code
?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="listings.php#hostings" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Listings</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Accomodation and Hosting Details</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?hostid=' . $id; ?>" method="post" enctype="multipart/form-data">
                      

                      <?php
                            if($msg){
                              echo $msg;
                            }
                      ?>
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                      <div class="form-group">
                        <label for="Booked Destination">Hosting Place Name</label>
                        <input type="text" class="form-control" name="hosting" value="<?php echo $name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="Booked Destination">Hosting Place Image</label>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                        <input type="file" class="form-control" name="hostingimg" value="<?php echo $img; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control"name="location" value="<?php echo $location; ?> ">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Features</label>
                        <input type="text" class="form-control" name="feature" value="<?php echo $feat; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Price Per Night </label>
                        <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Current Rating </label>
                        <input type="number" class="form-control" name="rating" value="<?php echo $rating; ?>">
                      </div>
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                    <div class="form-group">
                        <label for="">Destination Name</label>
                        <!--input type="text" class="form-control" name="destination" value="<?php echo $name_dest; ?>"-->
                        <input list='destinations' id='destination' name='destination' placeholder='Destination' class='form-control' value="<?php echo $name_dest; ?>">
                            <datalist id='destinations'>
                                <?php
                                    //Select some elements from  the database
                                    //echo $agentID;
                                    $result = mysqli_query($conn,"SELECT * FROM Destinations WHERE AgentID=$agentID");
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
                            <small>To change destination, remove(delete) current input and select new from the list.</small>
                   
                      </div>
                      <div class="form-group">
                        <label for="">Destination Image</label>
                        <img src="<?php echo $image_dest; ?>" alt="<?php echo $image_dest; ?>" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                        
                      </div>
                      <div class="form-group">
                        <label for="">Approved  By Admin </label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Distance From Hosting to Destination</label>
                        <input type="text" class="form-control" name="dist" value="<?php echo $Dist; ?> km">
                      </div>
                 
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $created; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Change type of hosting</label>
                        <input list="type" type="text" class="form-control" name="type" value="<?php echo $type; ?>">
                            <datalist id="type">
                                <option value="resort">Resort</option>
                                <option value="airbnb">AirBnB</option>
                                <option value="hotel">Hotel</option>
                            </datalist list=type>
                      </div>
                      <div class="form-group">
                      <p>- You can update the Hosting details -</p>
                      <p>- Deactivate the Hosting if you do not wish to proceed with the location or hosting -</p>
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