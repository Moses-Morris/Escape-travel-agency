<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-basket  text-primary ml-auto"></i>  Events</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Events</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM events ");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  events WHERE Created_at<'$date' ");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Events This month</h6>";
                           
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
                    <h5>Active Avents</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM events WHERE Status='active' ");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  events WHERE Created_at<'$date' AND Status='active'");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Events This month</h6>";
                           
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
                    <h5>Inactive Events</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM events WHERE Status='inactive' ");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                             

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Events This month</h6>";
                           
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
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Events</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                  
                            <th> Event Name </th>
                            <th> Location </th>
                            <th> Destination </th>
                            <th> Price </th>
                            <th> Dates </th>
                            <th> Likes </th>
                            <th> AgentName</th>
                            <th> Status </th>
                            <th> Actions </th>

                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM events ORDER BY Created_at DESC ");
                                      while($row = mysqli_fetch_array($result)){
                                       
                                        $Name = $row["Name"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ImageURL"];
                                        $agent = $row["AgentID"];
                                        $status = $row["Status"];
                                        $dest = $row["DestinationID"];
                                        $start = $row["StartDate"];
                                        $end = $row["EndDate"];
                                        $price = $row["Price"];
                                        $likes = $row["LikesAVG"];

                                        //Get Destination name if it exist and is linked to a destination
                                        if($dest == ""){
                                          $getdd = "No Destination";
                                        }else {
                                          $destination = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                                          $dd = mysqli_fetch_array($destination);
                                          $getdd = $dd['Name'];
                                        }

                                        //gET aGENT NAME
                                        $agents = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                                        $aa = mysqli_fetch_array($agents);
                                        $getaa = $aa['CompanyName'];
                                        

                                        
                                        if ($status == "active"){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Running</i>";
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Ended</i> ";
                                        }
                                    

                                      print "
                                              
                                              
                                      <td>
                                        <img src='assets/images/faces/face1.jpg' alt='image' />
                                        <span class='pl-2'>".$Name."</span>
                                      </td>
                                      <td> ".$location.", ".$country."</td>
                                      <td> ".$getdd."</td>
                                      <td> ".$price."</td>
                                      <td> ".$start." - ".$end."</td>
                                      <td> ".$likes."</td>
                                      <td> ".$getaa."</td>
                                    
                                      <td>
                                        <a href='./' class='badge badge-outline-success'>".$icon."</a>
                                      </td>
                                      <td>
                                        <a href='./Viewdestination.php' class='badge badge-outline-success'>View More</a>
                                      </td>
                                    </tr>";

                                      }

                                        
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