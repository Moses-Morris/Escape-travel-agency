<?php
  include 'base.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


          <h4><i class="mdi mdi-laptop  text-primary ml-auto"></i>  Hostings & Accomodations</h4>
          <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Number Of Hostings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $hostings = mysqli_query($conn,"SELECT COUNT(*) FROM  accomodation ");
                              $r = mysqli_fetch_row($hostings);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $hostings2 = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($hostings2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Hostings This month</h6>";
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
                    <h5>Active Hostings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the Hostings and Accomodation Services
                              $hotel = mysqli_query($conn,"SELECT COUNT(*) FROM  accomodation  WHERE Type='hotel'");
                              $r = mysqli_fetch_row($hotel);
                              $nr = $r[0];


                              $airbnb = mysqli_query($conn,"SELECT COUNT(*) FROM  accomodation  WHERE Type='airbnb'");
                              $r1 = mysqli_fetch_row($airbnb);
                              $nr2 = $r1[0];


                              $resort = mysqli_query($conn,"SELECT COUNT(*) FROM  accomodation  WHERE Type='resort'");
                              $r2 = mysqli_fetch_row($resort);
                              $nr3 = $r2[0];

                             // print "<h2 class='mb-0'>". $nr."</h2>";
                              //$date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month


                              print "</div>
                                  <h4 class='text-muted font-weight-normal'>".$nr." Hotels</h4>";
                              print "
                              <h4 class='text-muted font-weight-normal'>".$nr2." AirBnBs</h4>";
                              print "
                              <h4 class='text-muted font-weight-normal'>".$nr3." Resorts</h4>";
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
                    <h5>Inactive Hostings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <?php
                              //check details of the Hostings and Accomodation Services
                              $hostings = mysqli_query($conn,"SELECT COUNT(*) FROM  accomodation  WHERE active='inactive'");
                              $r = mysqli_fetch_row($hostings);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              print "</div>
                              <h4 class='text-muted font-weight-normal'>".$nr." Inactive Hostings</h4>";


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
                    <h4 class="card-title">Search For A Hosting or Accomodation</h4>
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
                    <h4 class="card-title">Accomodation Information - Active Hostings</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Hosting Name </th>
                            <th> Type </th>
                            <th> Location </th>
                            <th> Price Per Night </th>
                            <th> Closest Destination </th>
                            <th> Agent </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                            $result = mysqli_query($conn,"SELECT * FROM accomodation WHERE active='active'");
                            while($row = mysqli_fetch_array($result)){
                              $name = $row['Name'];
                              $dest = $row['DestinationID'];
                              $type = $row['Type'];
                              $price = $row['PricePerNight'];
                              $img = $row['ImageURL'];
                              $location = $row['Location'];
                              $Dist = $row['DistFromOrigin'];  //distance from destination
                              $agent = $row['AgentID'];

                              //Get image of agent 
                              $agentimg = mysqli_query($conn,"SELECT * FROM  agents  WHERE AgentID=$agent AND Status='active'");
                              $a_img = mysqli_fetch_array($agentimg);
                              $image_agent = $a_img['ProfileImg'];
                              $name_agent = $a_img['CompanyName'];


                              //Destination which is closest to the accomodation location
                              $destination = mysqli_query($conn,"SELECT * FROM  destinations  WHERE DestinationID=$dest AND Status='approved'");
                              $a_dest = mysqli_fetch_array($destination);
                              $image_dest = $a_dest['ImageURL'];
                              $name_dest = $a_dest['Name'];

                              if ($name_agent == ""){
                                $agentname= "Escape Agency";
                              }else{
                                $agentname = $name_agent ;
                              }

                              print "
                              
                                    <td>
                                      <img src='assets/images/faces/face1.jpg' alt='image' />
                                      <span class='pl-2'>".$name."</span>
                                    </td>
                                    <td>". $type." </td>
                                    <td> ".$location." </td>
                                    <td> ". $price."</td>
                                    <td> ".$name_dest."</td>
                                    <td> ".$agentname."</td>
                                    <td>
                                      <div class='badge badge-outline-success'>Active</div>
                                    </td>
                                    <td>
                                      <a href='./' class='badge badge-outline-success'>View More Details</a>
                                    </td>
                                  </tr>";


                            }
                          ?>
                          </tr>
                          
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
                    <h4 class="card-title">Most Visited Hostings </h4>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                            <thead>
                                <tr>
                                  <th> Hosting </th>
                                  <th> Name </th>
                                  <th> Visits </th>
                                  <th> GrowthRate </th>
                                  
                                </tr>
                              </thead>
                              <?php
                                  // Get the most visited hostings
                                  /*1-first  get all hostings. 
                                  2. Count each hosting has been booked  how many times.
                                  3. Get the top 6
                                  */
                                  /*$result = mysqli_query($conn, "SELECT * FROM  accomodation WHERE active='active'");
                                  while($row = mysqli_fetch_array($result)){
                                    $HostingID = $row["HostingID"];

                                    $count = mysqli_query($conn, "SELECT COUNT(*) FROM bookings WHERE HostingID='$HostingID'");
                                    $num = mysqli_fetch_row($count);
                                    $times = $num[0];

                                    print $times;
                                    $store = [];
                                  }
                                    */

                                    $result = mysqli_query($conn, "SELECT a.HostingID, a.Name, a.ImageURL, 
                                                                                              COUNT(b.BookingID) AS BookingCount, 
                                                                                              ROUND((COUNT(b.BookingID) / (SELECT COUNT(*) FROM Bookings)) * 100, 2) AS BookingPercentage
                                                                                        FROM Accomodation a
                                                                                        LEFT JOIN Bookings b ON a.HostingID = b.HostingID
                                                                                        GROUP BY a.HostingID
                                                                                        ORDER BY BookingCount DESC
                                                                                        LIMIT 6");
                                    while($row = mysqli_fetch_array($result)){
                                      if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $HostingName = $row["Name"];
                                            $count = $row["BookingCount"];
                                            $percent = $row["BookingPercentage"];

                                      
                                            print "
                                                      <tr>
                                                        <td>
                                                          <i class='flag-icon flag-icon-us'></i>
                                                        </td>
                                                        <td>".$HostingName."</td>
                                                        <td class='text-right'> ".$count." </td>
                                                        <td class='text-right font-weight-medium'> ".$percent."% </td>
                                                      </tr>
                                            ";
                                        }
                                        } else {
                                            echo "No results found.";
                                        }
                                    
                                    }

                              ?>


                              
                              
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