<?php
    include 'base.php';
?>
<?php
//The details of the Booking
?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="discounts.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Discounts</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Event Details</h4>
                    <form class="forms-sample" multipart="enctype">
                      <?php
                          //get the id from url and
                          if (isset($_GET['adid']) && filter_var($_GET['adid'], FILTER_VALIDATE_INT)) {
                              $id = $_GET['adid'];
                              //echo "Received ID: " . htmlspecialchars($id);
                          } else {
                              echo "Invalid ID!";
                          }
                      ?>


                                <?php
                                       $today = date('Y-m-d');

                                       $result = mysqli_query($conn,"SELECT * FROM Discounts
                                                                                                WHERE AgentID = $agentID  ");
                                        
                                        while($row = mysqli_fetch_array($result)){
                                            $ID = $row["DiscountID"];
                                            $name = $row["DiscountName"];
                                            $dest = $row["DestinationID"];
                                            $code = $row["Code"];
                                            $desc = $row["Description"];
                                            $discount = $row["Discount"];
                                            $active = $row["Status"];
                                            $Sdate = $row['StartDate'];
                                            $Edate = $row['EndDate'];
                                            $num = $row['NumOfCodes'];
                                            $date = $row["Created_at"];
                                           
                                            if ($Edate > $today){
                                              $it = "Running";
                                            }else{
                                              $it = "Over/Ended";
                                            }

                                            if ($active == "active"){
                                                $icon = "Approved and Running";
                                            }else{
                                                $icon = "Not approved";
                                            }
                                    
                                    
                                            
                                             //Get destination through destinations
                                             $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                                             $r3 = mysqli_fetch_array($dest);
                                             $nr3 = $r3["Name"];
                                        }
                                     ?>





                        <style> 
                            .form-group input{
                            font-weight:900;
                            font-size: medium;
                            }
                      </style>
                      <div class="form-group">
                        <label for="Booked Destination">Discount Name</label>
                        <input type="text" class="form-control" name="discount" value="<?php echo $name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Destination</label>
                        <input type="text" class="form-control"name="destination" value="<?php echo $nr3; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Discount Amount</label>
                        <input type="text" class="form-control" name="discount" value="<?php echo $discount; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Discount Voucher Code</label>
                        <input type="text" class="form-control" name="code" value="<?php echo $code; ?>">
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
                        <input type="text" class="form-control" name="start" value="<?php echo $Sdate; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Ending On Date</label>
                        <input type="text" class="form-control" name="end" value="<?php echo $Edate; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Approved  By Admin </label>
                        <input type="email" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Number of Voucher Codes</label>
                        <input type="text" class="form-control"  name="num" value="<?php echo $num; ?> ">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
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