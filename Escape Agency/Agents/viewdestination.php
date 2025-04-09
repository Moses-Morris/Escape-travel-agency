<?php
    include 'base.php';
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
                    <form class="forms-sample" enctype="multipart/form-data" action="updatedestination.php" method="post">
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
                                        $desc = $row["Description"];
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
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <div class="form-group">
                        <label for="Booked Destination">Destination Name</label>
                        <input type="text" class="form-control" name="destination" value="<?php echo $Name; ?>">
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
                        <label for="">Country</label>
                        <input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Travel Option</label>
                        <input type="text" class="form-control" name="travel" value="<?php echo $travelDetails; ?>">
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
                        <label for="">Destination Image</label>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>">
                        <input type="file" class="form-control" name="img" >
                      </div>
                      <div class="form-group">
                        <label for="">Approved  By Admin </label>
                        <input type="email" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Price : Total Amount </label>
                        <input type="text" class="form-control"  name="price" value="<?php echo $price; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Distance From Location to Destination</label>
                        <input type="text" class="form-control" name="dist" value="<?php echo $dist; ?> km">
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
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="update" onclick="return confirm('Update this destination?')">Update</button>
                        <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="deactivate">Deactivate</button>
                        
                        </div>
                     
                  </form>
                    
                  </div>
                </div>
              </div>




<?php
    include 'footer.php';
?>