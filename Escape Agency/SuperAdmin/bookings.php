<?php
  include 'base.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-playlist-play  text-primary ml-auto"></i> Destination Bookings </h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Bookings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <?php
                              //check details of the destination
                              $bookings = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings ");
                              $r = mysqli_fetch_row($bookings);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $bookings2 = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($bookings2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              $currperc = $perc / $nr;
                              if ($currperc > 0) {
                                $sign = "+";
                              }else {
                                $sign = "";
                              }

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Bookings This month</h6>";
                            ?>   

                          
                        
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-format-align-left text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Paid Bookings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $bookings = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE Paid=1");
                              $r = mysqli_fetch_row($bookings);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $bookings2 = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE Created_at<'$date' AND Paid=1 ");
                              $r2 = mysqli_fetch_row($bookings2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              $currperc = $perc / $nr;
                              if ($currperc > 0) {
                                $sign = "+";
                              }else {
                                $sign = "";
                              }

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." Paid Bookings This month</h6>";
                            ?>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Inactive Bookings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $bookings = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE Paid=0 AND Active!='active'");
                              $r = mysqli_fetch_row($bookings);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $bookings2 = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE Created_at<'$date' AND Paid=0 AND Active!='active'");
                              $r2 = mysqli_fetch_row($bookings2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              $currperc = $perc / $nr;
                              if ($currperc > 0) {
                                $sign = "+";
                              }else {
                                $sign = "";
                              }

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." Inactive Bookings This month</h6>";
                            ?>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-account-card-details text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Search For Bookings</h4>
                    <form class="forms-sample">
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Destination or Client Name">
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-4 btn-lg">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Active Bookings</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                               ID
                            </th>
                            <th> Client Name </th>
                            <th> Destination </th>
                            <th> Hosting</th>
                            <th> Type </th>
                            
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Total Price </th>
                            <th> Paid </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>


                          <?php
                            $result = mysqli_query($conn,"SELECT * FROM bookings WHERE Active='active'");
                            while($row = mysqli_fetch_array($result)){
                              $ID = $row["BookingID"];
                              $Client = $row["UserID"];
                              $destination = $row["DestinationID"];
                              $Hosting = $row["HostingID"];
                              $Type = $row["BookingType"];
                              $People = $row["NumOfPeople"];
                              $start = $row["StartDate"];
                              $end = $row["EndDate"];
                              $price = $row["TotalPrice"];
                              $paid = $row["Paid"];
                              
                              //GEt the destination name
                              $dest_name = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$destination");
                              $row2 = mysqli_fetch_array($dest_name);
                              $destinationName = $row2["Name"];
                              $destImage =  $row2["ImageURL"];

                              //get the Hosting name
                              $host_name = mysqli_query($conn,"SELECT * FROM accomodation WHERE HostingID=$Hosting");
                              $row3 = mysqli_fetch_array($host_name);
                              $HostingName = $row3["Name"];

          

                              //get the user who has placed the booking
                              $user_name = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$Client");
                              $row4 = mysqli_fetch_array($user_name);
                              $UserName = $row4["Email"]; //use email as name


                              if($paid == 1){
                                $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'></i>";
                              }else{
                                $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'></i> ";
                              }
                              print "
                                    <td> ".$ID."</td>
                                    <td> ".$UserName ." </td>
                                    <td>
                                      <img src='assets/images/faces/face1.jpg' alt='image' />
                                      <span class='pl-2'>".$destinationName."</span>
                                    </td>
                                    <td> ".$HostingName." </td>
                                    <td>". $Type." (".$People." people) </td>
                                    <td> ".$start." </td>
                                    <td> ".$end." </td>
                                    <td> ". $price."</td>
                                    <td> ".$icon."</td>
                                    <td>
                                      <div class='badge badge-outline-success'>Active</div>
                                    </td>
                                  </tr>";



                            };

                          ?>
                            
                          
                        </tbody>
                      </table>




                      <!-- Second TABLE -->
                      <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                               ID
                            </th>
                            <th> Client Name </th>
                            <th> Destination </th>
                            <th> Hosting</th>
                            <th> Type </th>
                            
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Total Price </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>


                          <?php
                            $result = mysqli_query($conn,"SELECT * FROM bookings WHERE Active!='active'");
                            while($row = mysqli_fetch_array($result)){
                              $ID = $row["BookingID"];
                              $Client = $row["UserID"];
                              $destination = $row["DestinationID"];
                              $Hosting = $row["HostingID"];
                              $Type = $row["BookingType"];
                              $People = $row["NumOfPeople"];
                              $start = $row["StartDate"];
                              $end = $row["EndDate"];
                              $price = $row["TotalPrice"];
                              $active = $row["Active"];
                              
                              //GEt the destination name
                              $dest_name = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$destination");
                              $row2 = mysqli_fetch_array($dest_name);
                              $destinationName = $row2["Name"];
                              $destImage =  $row2["ImageURL"];

                              //get the Hosting name
                              $host_name = mysqli_query($conn,"SELECT * FROM accomodation WHERE HostingID=$Hosting");
                              $row3 = mysqli_fetch_array($host_name);
                              $HostingName = $row3["Name"];

          

                              //get the user who has placed the booking
                              $user_name = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$Client");
                              $row4 = mysqli_fetch_array($user_name);
                              $UserName = $row4["Email"]; //use email as name

                              if ($active=="active"){
                                $state = "Ongoing";
                              }
                              else {
                                $state = "Cancelled";
                              }

                              print "
                                    <td> ".$ID."</td>
                                    <td> ".$UserName ." </td>
                                    <td>
                                      <img src='assets/images/faces/face1.jpg' alt='image' />
                                      <span class='pl-2'>".$destinationName."</span>
                                    </td>
                                    <td> ".$HostingName." </td>
                                    <td>". $Type." (".$People." people) </td>
                                    <td> ".$start." </td>
                                    <td> ".$end." </td>
                                    <td> ". $price."</td>
                                    <td>
                                      <div class='badge badge-outline-success'>".$state."</div>
                                    </td>
                                  </tr>";



                            };

                          ?>
                            
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              
            
<?php
    include 'footer.php';
?>