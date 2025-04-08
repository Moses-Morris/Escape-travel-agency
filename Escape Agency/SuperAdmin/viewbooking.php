<?php
    include 'base.php';
?>
<?php
//The details of the Booking
?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="bookings.php" type="button" >Go Back to Bookings ></a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Booking Details</h4>
                    <form class="forms-sample">
                      <?php
                          //get the id from url and
                          if (isset($_GET['bookid']) && filter_var($_GET['bookid'], FILTER_VALIDATE_INT)) {
                              $id = $_GET['bookid'];
                              //echo "Received ID: " . htmlspecialchars($id);
                          } else {
                              echo "Invalid ID!";
                          }
                      ?>

                      <?php
                          //get booking details
                          $result = mysqli_query($conn,"SELECT * FROM Bookings b
                                                                            JOIN Destinations d ON b.DestinationID = d.DestinationID
                                                                            JOIN Agents a ON d.AgentID = a.AgentID
                                                                            WHERE  b.BookingID=$id ");
                            while($row = mysqli_fetch_array($result)){
                              $ID = $row["BookingID"];
                              $Client = $row["UserID"];
                              $destination = $row["DestinationID"];
                              $Hosting = $row["HostingID"];
                              $Type = $row["BookingType"];
                              $travel = $row["TravelID"];
                              $People = $row["NumOfPeople"];
                              $start = $row["StartDate"];
                              $end = $row["EndDate"];
                              $price = $row["TotalPrice"];
                              $paid = $row["Paid"];
                              $sttus = $row['Active'];
                              $feature = $row["FeatureID"];
                              $createddate = $row["Created_at"];
                              $agent = $row["AgentID"];
                              //echo $travel;
                              //$diff =  DATE($end) - DATE($start);
                              // echo "$sttus ";
                              if ($sttus == "active"){
                                $approved = "Active";
                             
                              }else{
                                $approved = "Cancelled";
                              }

                              if ($paid == 1){
                                $value1 = "Already Paid";
                              } else{
                                $value1 = "Not Yet Paid";
                              }
                              
                              
                              //GEt the destination name
                              $dest_name = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$destination");
                              $row2 = mysqli_fetch_array($dest_name);
                              $destinationName = $row2["Name"];
                              $destImage =  $row2["ImageURL"];
                              $location =  $row2["Location"];
                              $country =  $row2["Country"];
                              $destdetails = "$destinationName -"." $location, "."$country. ";

                              //get the Hosting name
                              $host_name = mysqli_query($conn,"SELECT * FROM accomodation WHERE HostingID=$Hosting");
                              $row3 = mysqli_fetch_array($host_name);
                              $HostingName = $row3["Name"];

          

                              //get the user who has placed the booking
                              $user_name = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$Client");
                              $row4 = mysqli_fetch_array($user_name);
                              $UserName = $row4["Email"]; //use email as name


                              //get the featured details
                              $feature = mysqli_query($conn,"SELECT * FROM featured WHERE FeatureID=$feature");
                              $row5= mysqli_fetch_array($feature);
                              $desc = $row5["Description"];
                              $discount = $row5["Discount"];
                              $featureDetails = "$desc "." of $discount";


                               //get the Travel Details details
                               $travelop = mysqli_query($conn,"SELECT * FROM Traveloptions WHERE TravelID=$travel");
                               $row6= mysqli_fetch_array($travelop);
                               $mode = $row6["TravelMode"];
                               $details = $row6["Details"];
                               $travelDetails = "($mode) -  "." via a $details";
                               //echo $mode;
                               //echo $travelDetails;

                               //get the agent who has placed this booking
                               //$check=$_SESSION['Email'];
                                $session=mysqli_query($conn, "SELECT AgentID,Email, CompanyName from Agents where AgentID=$agent ");
                                $row=mysqli_fetch_array($session);
                                $login_session=$row['Email'];
                                $Company = $row['CompanyName'];
                                $agentID = $row['AgentID']; 
                            }
                      ?>
                      <style> 
                        .form-group input{
                          
                        }
                      </style>
                      <div class="form-group">
                        <label for="Booked Destination">Destination Booked</label>
                        <input type="text" class="form-control" name="destination" value="<?php echo $destdetails; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Booked By - User : Email address</label>
                        <input type="email" class="form-control"name="username" value="<?php echo $UserName; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Number Of People</label>
                        <input type="text" class="form-control" name="numofpeople" value="<?php echo $People; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Type of Booking</label>
                        <input type="text" class="form-control" name="type" value="<?php echo $Type; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Travel Option</label>
                        <input type="text" class="form-control" name="travel" value="<?php echo $travel; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Featured</label>
                        <input type="text" class="form-control" name="feature" value="<?php echo $featureDetails; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $createddate; ?>">
                      </div>
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Starting Date</label>
                        <input type="text" class="form-control" name="start" value="<?php echo $start; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Ending Date   </label>
                        <input type="email" class="form-control" name="end" value="<?php echo $end; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Price : Total Amount </label>
                        <input type="text" class="form-control"  name="price" value="<?php echo $price; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" class="form-control" name="status" value="<?php echo $approved; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Paid</label>
                        <input type="text" class="form-control" name="paid" value="<?php echo $value1; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Travel Option</label>
                        <input type="text" class="form-control"  name="travel" value="<?php echo $travelDetails; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Created By : Agent Name</label>
                        <input type="text" class="form-control"  name="agent" value="<?php echo $Company; ?>" >
                      </div>
                      
                      
                        
                        <p> Do not confirm yet if the client has not paid </p>
                        <p> Deactivate the booking if you do not wish to proceed with the request </p>
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2 btn-lg"  name="confirm">Confirm</button>
                        <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2 btn-lg" name="deactivate">Deactivate</button>
                        
                     
                    </form>
                    
                  </div>
                </div>
              </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>




<?php
    include 'footer.php';
?>