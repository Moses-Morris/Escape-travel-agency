<?php
    include 'base.php';
?>
<?php
   //Create a destination
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['deactivate'])) {
        $name = $_POST['Name'];
        $stmt = $conn->prepare("INSERT INTO destinations (Name, Location, Country, Description, ImageURL, Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at)  VALUES(
        )" );
        $stmt->bind_param("it", $value,$id);
        if ($stmt->execute()) {
            $msg =  "<div class='alert alert-info'>Booking Deactivated and Cancelled.</div>";
        } else {
            $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
        }
        $stmt->close();
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
                            if ($msg){
                              echo $msg;
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
                      
                        
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="create" onclick="return confirm('Are the Details correct? Review. If Okay, Proceed');">Create</button>
                        <p>- Create a new destination. -</p>
                        <p>- Wait For it to be approved by The Escape Agency Admin. -</p>
                        
                     
                    </form>
                    
                  </div>
                </div>
              </div>





<?php
    include 'footer.php';
?>