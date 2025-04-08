<?php
  include 'base.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


          <h4><i class="mdi mdi-debug-step-into  text-primary ml-auto"></i>  Destinations</h4>
          <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Number Of Destinations</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Status='approved'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Created_at<'$date' AND Status='approved'");
                              $r2 = mysqli_fetch_row($dest2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Listed Destinations This month</h6>";
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
                    <h5>Active Destinations</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($dest2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Listed Destinations This month</h6>";
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
                    <h5>Inactive Destinations</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Status!='approved'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Created_at<'$date' AND Status!='approved'");
                              $r2 = mysqli_fetch_row($dest2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              if ($perc == 0) {
                                $currperc = 1;
                              }else{
                                $currperc = $perc / $nr;
                              }
                              
                              if ($currperc > 0) {
                                $sign = "+";
                              }else {
                                $sign = "";
                              }

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Destinations This month</h6>";
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
                    <h4 class="card-title">Search For A Destination</h4>
                    <form class="forms-sample">
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
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
                    <h4 class="card-title">Destinations Information</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                        
                            <th> Destination Name </th>
                            <th> Country </th>
                            <th> Price </th>
                            <th> Agent Name </th>
                            <th> Travel </th>
                            <th> Destination Bookings </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           
                          
                                    <?php
                                      $result = mysqli_query($conn,"SELECT * FROM destinations WHERE Status='approved'");
                                      while($row = mysqli_fetch_array($result)){
                                        $ID = $row["DestinationID"];
                                        $Name = $row["Name"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ImageURL"];
                                        $price = $row["Price"];
                                        $Agent = $row["AgentID"];
                                        $travel = $row["TravelID"];
                                        

                                         //get the user who has placed the booking
                                         $agent_name = mysqli_query($conn,"SELECT * FROM agents WHERE AgentID=$Agent");
                                         $row5 = mysqli_fetch_array($agent_name);
                                         $AgentName = $row5["CompanyName"]; //use email as name

                                        //Count bookings for destination
                                        $dest_amt = mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE DestinationID=$ID ");
                                        $r2 = mysqli_fetch_row($dest_amt);
                                        $nr2 = $r2[0];

                                     
                                        print "
                                              
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                              <td> ".$location.", ".$country."</td>
                                              <td> ". $price."</td>
                                              <td> ".$AgentName."</td>
                                              <td> ".$travel."</td>
                                              <td> ".$nr2."</td>
                                              <td>
                                                <div class='badge badge-outline-success'>Active</div>
                                              </td>
                                              <td>
                                                <a href='./Viewdestination.php' class='badge badge-outline-success'>View Destination</a>
                                              </td>
                                            </tr>";



                                      };

                                    ?>
                                      
                         
                            
                        </tbody>
                      </table>
                    </div>




                    <div class="table-responsive">
                      <h6>Unapproved Bookings</h6>
                      <table class="table">
                        <thead>
                          <tr>
                        
                            <th> Destination Name </th>
                            <th> Country </th>
                            <th> Price </th>
                            <th> Agent Name </th>
                            <th> Travel </th>
                            <th> Destination Bookings </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           
                          
                                    <?php
                                      $result = mysqli_query($conn,"SELECT * FROM destinations WHERE Status!='approved'");
                                      while($row = mysqli_fetch_array($result)){
                                        $ID = $row["DestinationID"];
                                        $Name = $row["Name"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ImageURL"];
                                        $price = $row["Price"];
                                        $Agent = $row["AgentID"];
                                        $travel = $row["TravelID"];
                                        

                                         //get the user who has placed the booking
                                         $agent_name = mysqli_query($conn,"SELECT * FROM agents WHERE AgentID=$Agent");
                                         $row5 = mysqli_fetch_array($agent_name);
                                         $AgentName = $row5["CompanyName"]; //use email as name

                                        //Count bookings for destination
                                        $dest_amt = mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE DestinationID=$ID ");
                                        $r2 = mysqli_fetch_row($dest_amt);
                                        $nr2 = $r2[0];

                                     
                                        print "
                                              
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                              <td> ".$location.", ".$country."</td>
                                              <td> ". $price."</td>
                                              <td> ".$AgentName."</td>
                                              <td> ".$travel."</td>
                                              <td> ".$nr2."</td>
                                              <td>
                                                <a href='./approveDestination.php' class='badge badge-outline-success'>Approve</a>
                                              </td>
                                              <td>
                                                <a href='./Viewdestination.php' class='badge badge-outline-success'>View Destination</a>
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
              
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Most Visited Countries Yearly</h4>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-us"></i>
                                </td>
                                <td>USA</td>
                                <td class="text-right"> 1500 </td>
                                <td class="text-right font-weight-medium"> 56.35% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-de"></i>
                                </td>
                                <td>Germany</td>
                                <td class="text-right"> 800 </td>
                                <td class="text-right font-weight-medium"> 33.25% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-au"></i>
                                </td>
                                <td>Australia</td>
                                <td class="text-right"> 760 </td>
                                <td class="text-right font-weight-medium"> 15.45% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-gb"></i>
                                </td>
                                <td>United Kingdom</td>
                                <td class="text-right"> 450 </td>
                                <td class="text-right font-weight-medium"> 25.00% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-ro"></i>
                                </td>
                                <td>Romania</td>
                                <td class="text-right"> 620 </td>
                                <td class="text-right font-weight-medium"> 10.25% </td>
                              </tr>
                              <tr>
                                <td>
                                  <i class="flag-icon flag-icon-br"></i>
                                </td>
                                <td>Brasil</td>
                                <td class="text-right"> 230 </td>
                                <td class="text-right font-weight-medium"> 75.00% </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div id="audience-map" class="vector-map"></div>
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