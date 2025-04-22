<?php
    include 'base.php';
?>

<?php
    //Create an Event
    //echo $agentID;
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])) {
      
        $travel = mysqli_real_escape_string($conn,$_POST['travel']);
        $details = mysqli_real_escape_string($conn,$_POST['details']);
        $destination = mysqli_real_escape_string($conn,$_POST['destination']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $booking = mysqli_real_escape_string($conn,$_POST['booking']);
        //$img = $_POST['img'];

        
        
        $msg = " ";
        $state = "OK";
        $status = "active";
        
        $date =  date('Y-m-d H:i');
        //echo $name.$desc.$destination.$location.$country.$price.$tag.$activities.$end.$start.$target_file.$rating.$status.$likes.$date;   
        if (empty($name) || empty($details) || empty($destination) || empty($price) ){
          $msg = "<div class='alert alert-danger'>Do not send empty fields: </div>";
          //$state= "NOTOK";
        } else{
          //$stmt = "INSERT INTO destinations ( Name, Description, Location, Country,   Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at, ImageURL)  VALUES
          //('$name', '$desc', '$location', '$country', '$price', '$rating', '$rating', '$rating', '$activities', '$travel', '$dist', '$agentID',  '$status', '$date', '$target_file')";
          //$stmt->bind_params();
          $stmt = $conn->prepare("INSERT INTO traveloptions (BookingID, DestinationID, AgentID, TravelMode, Details, Prices,   Status, Created_at)  
          VALUES (?,?,?,?,?,?,?,?)" );
          $stmt->bind_param("ssssssss", $booking, $destination,  $agentID, $travel, $details, $price, $status, $date);
          if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Activity Created Successfully. Proceeding to All Events
                          </div>";
            echo "<script>
                          setTimeout(function() {
                              window.location.href = 'activities.php';
                          }, 3000);
                        </script>";
            //header("Refresh:2; url=destinations.php");
            exit;
          }else{
            $msg =   "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
          }

        }

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
                    <h4 class="card-title">Create A New Travel Option</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" >
                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        </style>
                        <div class="form-group ">
                        <label for="">Travel Mode </label>
                        <input list="travel" id="travel" name="travel" placeholder="travel" class="form-control">
                        <datalist  id="travel">
                            <option value="air">Air<option>
                            <option value="water">Water<option>
                            <option value="road">Road<option>
                        </datalist>
                       </div>
                      <div class="form-group">
                        <label for="Activity">Travel Details</label>
                        <input type="text" class="form-control" name="details" placeholder="e.g Direct Flight from Mombasa to Nairobi">
                      </div>
                      <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" >
                      </div>
                      
                      

                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    <div class="form-group">
                        <label for="">Booking Refence if any </label>
                        <input type="booking" class="form-control" name="booking" placeholder="Leave it null if there is no booking associated with this travel option">
                      </div>
                      
                      <div class="form-group">
                        <label for="Booked Destination">Destination Name</label>
                        <input list='destinations' id='destination' name='destination' placeholder='Destination' class='form-control'>
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