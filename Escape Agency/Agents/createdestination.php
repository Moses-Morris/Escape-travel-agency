<?php
    include 'base.php';
?>
<?php
   //Create a destination
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])) {
      
        $name = mysqli_real_escape_string($conn,$_POST['destination']);
        $desc = mysqli_real_escape_string($conn,$_POST['desc']);
        $location = mysqli_real_escape_string($conn,$_POST['location']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $travel = mysqli_real_escape_string($conn,$_POST['travel']);
        $activities = mysqli_real_escape_string($conn,$_POST['activities']);
        $dist = mysqli_real_escape_string($conn,$_POST['dist']);
        //$img = $_POST['img'];

        
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

        $msg = "";
        $state = "OK";
        $rating = 0;
        $status = "approved";
        $featured = 0;
        $ranking = 0;
        $date =  date('Y-m-d H:i');
        if (empty($name) || empty($desc) || empty($location) || empty($country) || empty($price) || empty($travel) || empty($activities) || empty($dist)){
          $msg = "<div class='alert alert-danger'>Do not send empty fields: </div>";
          $state= "NOTOK";
        } else{
          //$stmt = "INSERT INTO destinations ( Name, Description, Location, Country,   Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at, ImageURL)  VALUES
          //('$name', '$desc', '$location', '$country', '$price', '$rating', '$rating', '$rating', '$activities', '$travel', '$dist', '$agentID',  '$status', '$date', '$target_file')";
          //$stmt->bind_params();
          $stmt = $conn->prepare("INSERT INTO destinations ( Name, Description, Location, Country,   Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at, ImageURL)  
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)" );
          $stmt->bind_param("sssssssssssssss", $name, $desc, $location, $country, $price, $rating, $featured, $ranking,$activities, $travel, $dist, $agentID,  $status, $date,$target_file);
          if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Destination Created Successfully. Proceeding to All Destinations
                          </div>";
            echo "<script>
                          setTimeout(function() {
                              window.location.href = 'destinations.php';
                          }, 3000);
                        </script>";
            //header("Refresh:2; url=destinations.php");
            exit;
          }else{
            $msg =   "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
          }
          /*$stmt->bind_params();
          if (!mysqli_query($conn,$stmt)){
            die('Error: ' . mysqli_error($conn));
            $state= "NOTOK";
            $msg =   "<div class='alert alert-danger'>Failed to Create destination: " . "</div>";
          }else{
            $msg =  "<div class='alert alert-info'>A New Destination is created.</div>";
            //echo "<div class='alert alert-success'>Destination Created.</div>";
          }*/

        }
        
        /*
        if ($stmt->execute()) {
          $msg =  "<div class='alert alert-info'>A New Destination is created.</div>";
        } else {
            $msg =   "<div class='alert alert-danger'>Failed to Create destination: " . $stmt->error . "</div>";
        }
            */
        //$stmt->close();
        mysqli_close($conn);
        }
   }

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="row">

            
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create A New Destination</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        <?php
                               if($_SERVER['REQUEST_METHOD'] == 'POST' && ($state=="NOTOK")){
                                  print $msg;
                               } else{
                                print $msg;
                               }
                               if($msg){
                                print "msg";
                               }
                        ?>
                      </style>
                      <div class="form-group ">
                        <label for="">Destination Image</label>
                        <input type="file" class="form-control" name="img" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                       </div>
                      <div class="form-group">
                        <label for="Booked Destination">Destination Name</label>
                        <input type="text" class="form-control" name="destination" >
                      </div>
                      <div class="form-group">
                        <label for="">Description Of Destination</label>
                        <input type="text" class="form-control" name="desc" >
                      </div>
                      <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" name="location" >
                      </div>
                      <div class="form-group">
                        <label for="">Country</label>
                        <input type="text"  class="form-control" name="country" >
                      </div>

                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Price : Total Amount </label>
                        <input type="number" class="form-control"  name="price" >
                      </div>
                      <div class="form-group">
                        <label for="">Travel Option</label>
                        <input list='travels' id='travel' name='travel' placeholder='Travel Option' class='form-control'>
                            <datalist id='travels'>
                        <?php
                            //Select some elements from  the database
                            $result = mysqli_query($conn,"SELECT * FROM traveloptions
                                                                                WHERE AgentID = $agentID AND Status='active'");
                            while($row = mysqli_fetch_array($result)){
                                $ID = $row["TravelID"];
                                $mode = $row["TravelMode"];
                                $destination = $row["DestinationID"];
                                $price = $row["Prices"];
                                $details = $row["Details"];

                                //GEt the destination name
                                $dest_name = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$destination");
                                $row2 = mysqli_fetch_array($dest_name);
                                $destinationName = $row2["Name"];
                                $destImage =  $row2["ImageURL"];
                                $location =  $row2["Location"];
                                $country =  $row2["Country"];
                                $destdetails = "$destinationName -"." $location, "."$country. ";

                                print "
                                
                                    <option value=".$ID."> ".$mode." - ".$details." at ".$price." USD To " .$destdetails." </option>
                                    
                                ";
                            }
                        
                        ?>
                            </datalist>
                      </div>
                      <div class="form-group">
                        <label for="">Activities</label>
                        <input type="text" class="form-control" name="activities" >
                      </div>
                      <div class="form-group">
                        <label for="">Distance From Origin to City</label>
                        <input type="text" class="form-control" name="dist" >
                      </div>
                      
                        
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="submit" onclick="return confirm('Are the Details correct? Review. If Okay, Proceed');">Create</button>
                        <p>- Create a new destination. -</p>
                        <p>- You should not have empty fields. -</p>
                        <p>- Wait For it to be approved by The Escape Agency Admin. -</p>
                        
                     
                    </form>
                    
                  </div>
                </div>
              </div>





<?php
    include 'footer.php';
?>