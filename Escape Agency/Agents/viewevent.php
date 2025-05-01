<?php
    include 'base.php';
?>
<?php
    //get the id from url and
    if (isset($_GET['eventid']) && filter_var($_GET['eventid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['eventid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>
<?php
 $msg = " ";
//The details of the event

    //get Event details
    $result = mysqli_query($conn,"SELECT * FROM Events d 
                                                      JOIN Agents a ON d.AgentID = a.AgentID
                                                      WHERE a.AgentID = $agentID  AND d.EventID = $id");
                while($row = mysqli_fetch_array($result)){
                  $event = $row["EventID"];
                  $dest = $row["DestinationID"];
                  $Name = $row["Name"];
                  $location = $row["Location"];
                  $country = $row["Country"];
                  $img = $row["ImageURL"];
                  $desc = $row["Description"];
                  $price = $row["Price"];
                  $tag = $row["Tagline"];
                  $Agent = $row["AgentID"];
                  $Activities = $row["Activities"];
                  $approv = $row["Status"];
                  $created = $row["Created_at"];
                  
                  $likes = $row["LikesAVG"];
                  $rating = $row["RatingAVG"];
                  $Start = $row['StartDate'];
                  $End = $row['EndDate'];
                  
                  $eventDetails = "$Name -"." $location , "."$country";
                  //echo "$approv";
                  // echo "$desc ";
                  //approved or not
                  if ($approv == "active"){
                    $icon = "Approved and Active";
                    $todobutton = "<button onclick='return confirm('Are you sure You want to Deactivate?')' class='btn btn-primary btn-rounded btn-fw me-2'  name='deactivate'>Deactivate</a>";
                  }else{
                    $icon = "Not approved";
                    $todobutton = "<button onclick='return confirm('Are you sure You want to Activate?')' class='btn btn-warning btn-rounded btn-fw me-2'  name='activate'>Activate</a>";
                  }


                  

                  
        //GEt the destination name
        $dest_name = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest");
        $row2 = mysqli_fetch_array($dest_name);
        $destinationName = $row2["Name"];
        $destImage =  $row2["ImageURL"];
        $location =  $row2["Location"];
        $country =  $row2["Country"];
        $destdetails = "$destinationName -"." $location, "."$country. ";

      }

   
    /*
    $result = mysqli_query($conn,"SELECT * FROM Events d 
                                                      JOIN Agents a ON d.EventID = a.AgentID
                                                      WHERE a.AgentID = $agentID  AND d.EventID = $id");
                while($row = mysqli_fetch_array($result)){
                  $ID = $row["EventID"];
                  $Name = $row["Name"];
                  $desc = $row["Description"];
                  $tag = $row["Tagline"];
                  $activities = $row["Activities"];
                  $location = $row["Location"];
                  $country = $row["Country"];
                  $dest = $row["DestinationID"];
                  $price = $row["Price"];
                  $status = $row["Status"];
                  //$active = $row["Status"];
                  $Sdate = $row["StartDate"];
                  $Edate = $row["EndDate"];
                  $img = $row["ImageURL"];
                  
          
          
                  //Get destination through booking
                  $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                  $r3 = mysqli_fetch_array($dest);
                  $nr3 = $r3["Name"];
                  $destimg = $r3["ImageURL"];

      }
*/
?>

<?php
 $msg = "";
  // Handle Form Actions
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['update'])) {
      //$img = $_FILES["img2"];
      $Name = $_POST["event"];
      $desc = $_POST["description"];
      $location = $_POST["location"];
      $country = $_POST["country"];
      $tag = $_POST["Tagline"];
      $activities = $_POST["Activities"];
      $dest = $_POST["destination"];
      $price = $_POST["price"];
      $status = $_POST["icon"];
      //$Cdate= $_POST["date"];
      $Sdate = $_POST["start"];
      $Edate = $_POST["end"];
      
        
      $target_file = null;

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
            $stmt = $conn->prepare("UPDATE Events SET Name=?, Description=?, Tagline=?, Activities=?, Location=?,Price=?, Status=?, StartDate=?, EndDate=?,ImageURL=? WHERE EventID=? AND AgentID=$agentID");
            $stmt->bind_param("sssssdsisss", $Name, $desc, $tag, $activities, $location,  $price, $status, $Sdate, $Edate, $target_file, $id);
        } else {
            $stmt = $conn->prepare("UPDATE Events SET Name=?, Description=?, Tagline=?, Activities=?, Location=?,Price=?, Status=?, StartDate=?, EndDate=? WHERE EventID=? AND AgentID=$agentID");
            $stmt->bind_param("sssssdsiss", $Name, $desc, $tag, $activities, $location,  $price, $status, $Sdate, $Edate, $id);
        }
        
        if ($stmt->execute()) {
            $msg = "<div class='alert alert-success'>Event updated successfully.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
        }
        $stmt->close();

    } elseif (isset($_POST['deactivate'])) {
        $stmt = $conn->prepare("UPDATE Events SET Status = 'inactive' WHERE EventID = ?  AND AgentID=$agentID");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $msg =  "<div class='alert alert-info'>Event deactivated.</div>";
        } else {
           $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif (isset($_POST['activate'])) {
        $stmt = $conn->prepare("UPDATE Events SET Status = 'active' WHERE EventID = ?  AND AgentID=$agentID" );
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Event Activated Sucessfully
                          </div>";

            //header("Refresh:2; url=destinations.php");
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
        <a href="events.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Events</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Event Details</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?eventid=' . $id; ?>" method="post" enctype="multipart/form-data">
                     

                      <?php
                        if( $msg){
                          print $msg;
                        }
                      ?>
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                      
                      <div class="form-group">
                        <label for="">Event Image</label>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:30vh; width: auto; background-position: center; object-fit:center;">
                        <input type="file" class="form-control" name="img" >
                      </div>
                      <div class="form-group">
                        <label for="Booked Destination">Event Name</label>
                        <input type="text" class="form-control" name="event" value="<?php echo $Name; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Event Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc; ?>">
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
                        <label for="">Event TagLine Message</label>
                        <input type="text" class="form-control" name="Tagline" value="<?php echo $tag; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Activities</label>
                        <input type="text" class="form-control" name="Activities" value="<?php echo $Activities; ?>">
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
                        <input type="text" class="form-control" name="destination" value="<?php echo $destdetails; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Destination Image</label>
                        <img src="<?php echo $destImage; ?>" alt="<?php echo $destImage; ?>" style="height:30vh; width: auto; background-position: center; object-fit:center;">
                      </div>
                      <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $price; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Status  </label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $approv; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Starting Date of The Event </label>
                        <input type="text" class="form-control" name="start" value="<?php echo $Start; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">End Date of the Event  </label>
                        <input type="text" class="form-control" name="end" value="<?php echo $End; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Created  ON  </label>
                        <input type="text" class="form-control" name="date" value="<?php echo $created; ?>">
                      </div>
                      
                      
                     
                      
                      <div class="form-group">
                      <p>- You can update the Event details -</p>
                      <p>- Deactivate the Event if you do not wish to proceed with the request -</p>
                        <button onclick="return confirm('Are you sure You want to Update?')" class="btn btn-info btn-rounded btn-fw me-2"  name="update">Update</a>
                        
                        <?php
                            echo $todobutton;
                        ?>
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>



<?php
    include 'footer.php';
?>