<?php
    include 'base.php';
?>
<?php
//The details of the Booking
?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="destinations.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Listings</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Accomodation and Hosting Details</h4>
                    <form class="forms-sample" multipart="enctype">
                      <?php
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

                          if($row = mysqli_fetch_array($result)){
                            print "True";
                          }else{
                            print "Shiet";
                            }
                          while($row = mysqli_fetch_array($result)){
                              $name = $row['Name'];
                              $dest = $row['DestinationID'];
                              $type = $row['Type'];
                              $price = $row['PricePerNight'];
                              $img = $row['ImageURL'];
                              $location = $row['Location'];
                              $Dist = $row['DistFromOrigin'];  //distance from destination
                              $agent = $row['AgentID'];
                              $type = $row['Type'];
                              $rating = $row['RatingAVG'];
                              $location = $row['Location'];
                              $feat = $row['Features'];
                              $active = $row['Active'];
                              $desc = $row['Description'];
                              $created = $row['Created_at'];
                              
                              echo $created;
                              

                              //Destination which is closest to the accomodation location
                              $destination = mysqli_query($conn,"SELECT * FROM  destinations  WHERE DestinationID=$dest AND Status='approved'");
                              $a_dest = mysqli_fetch_array($destination);
                              $image_dest = $a_dest['ImageURL'];
                              $name_dest = $a_dest['Name'];

                             
                         
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
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="confirm">Update</button>
                        <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="deactivate">Deactivate</button>
                        
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>




<?php
    include 'footer.php';
?>