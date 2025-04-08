<?php
    include 'base.php';
?>
<?php
//The details of the Booking
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
                    <form class="forms-sample" multipart="enctype">
                      <?php
                          //get the id from url and
                          if (isset($_GET['propid']) && filter_var($_GET['propid'], FILTER_VALIDATE_INT)) {
                              $id = $_GET['propid'];
                              //echo "Received ID: " . htmlspecialchars($id);
                          } else {
                              echo "Invalid ID!";
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
                      <div class="form-group">
                        <label for="Booked Destination">Destination Name</label>
                        <input type="text" class="form-control" name="destination" value="<?php echo $Name; ?>">
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
                        <label for="">Featured</label>
                        <input type="text" class="form-control" name="feature" value="<?php echo $feature; ?>">
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