<?php
    include 'base.php';
?>
<?php
//The details of the Booking
?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="destinations.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Events</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Event Details</h4>
                    <form class="forms-sample" multipart="enctype">
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
                          //get destination details
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
                                        }else{
                                          $icon = "Not approved";
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
                      ?>
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                      <div class="form-group">
                        <label for="Booked Destination">Event Name</label>
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
                        <label for="">Destination</label>
                        <input type="text" class="form-control" name="travel" value="<?php echo $destdetails; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Destination Image</label>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>">
                        <input type="file" class="form-control" name="img" >
                      </div>
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $created; ?>">
                      </div>
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Starting On Date</label>
                        <input type="text" class="form-control" name="start" value="<?php echo $Start; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Ending On Date</label>
                        <input type="text" class="form-control" name="end" value="<?php echo $End; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Approved  By Admin </label>
                        <input type="email" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Price : Total Amount </label>
                        <input type="text" class="form-control"  name="price" value="<?php echo $price; ?> USD">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Average Likes</label>
                        <input type="text" class="form-control" name="avglikes" value="<?php echo $likes; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Average Ratings</label>
                        <input type="text" class="form-control" name="avgratings" value="<?php echo $rating; ?>">
                      </div>
                     
                      
                      <div class="form-group">
                      <p>- You can update the Event details -</p>
                      <p>- Deactivate the Event if you do not wish to proceed with the request -</p>
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