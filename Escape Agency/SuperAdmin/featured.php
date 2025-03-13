<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-dice-5  text-primary ml-auto"></i>  Featured Destinations Details</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Features</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $feature = mysqli_query($conn,"SELECT COUNT(*) FROM  featured");
                              $r = mysqli_fetch_row($feature);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $feature2 = mysqli_query($conn,"SELECT COUNT(*) FROM  featured WHERE StartDate>'$date' ");
                              $r2 = mysqli_fetch_row($feature2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              if ($perc <=  1){
                                $sperc = 1;
                              }else{
                                $sperc = $perc;
                              }
                              $currperc = $sperc / $nr;
                              
                              if ($currperc > 0) {
                                $sign = "+";
                              }else {
                                $sign = "";
                              }

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." Featured This month</h6>";
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
                    <h5>Active Features</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $date = date('Y-m-d', strtotime('0 days'));
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  featured WHERE EndDate>'$date'");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('0 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $activities2 = mysqli_query($conn,"SELECT COUNT(*) FROM  featured WHERE EndDate>'$date' ");
                              $r2 = mysqli_fetch_row($activities2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." Featured This month</h6>";
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
                    <h5>Expired Features</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $date = date('Y-m-d', strtotime('0 days'));
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  featured WHERE EndDate<'$date'");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('0 days'));
                              
                              

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." Featured This month</h6>";
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
                    <h4 class="card-title">All running Featured Events</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                           
                            <th> Feature Name </th>
                            <th> Discount </th>
                            <th> Destination Name </th>
                            <th> Starting </th>
                            <th> Ends On </th>
                            <th> Created By: Agent </th>
                            <th> Status </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM featured ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["FeatureID"];
                                        $dest = $row["DestinationID"];
                                        $name = $row["Name"];
                                        $descr = $row["Description"];
                                        $start = $row["StartDate"];
                                        $end = $row["EndDate"];
                                        $status = $row["Status"];
                                        $agent = $row["AgentID"];
                                        $discount = $row["Discount"];
                                        
                                        if ($status == 1){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Active</i>";
                                          $button = "<a href='./Viewactivity.php' class='badge badge-outline-success'>Deactivate</a>";
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
                                          $button = "<a href='./Viewactivity.php' class='badge badge-outline-success'>Activate</a>";
                                        }

                                        

                                        


                                        //gET dest NAME
                                        $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                                        $ddname = mysqli_fetch_array($destname);
                                        $getddname = $ddname['Name'];

                                        //gET agent anme
                                        $agents = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                                        $dd = mysqli_fetch_array($agents);
                                        $getdd = $dd['CompanyName'];

                                     
                                        print "
                                              <td> ".$name."</td>
                                              <td> ".$discount."</td>
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$getddname."</span>
                                              </td>
                                              <td> ".$start ."</td>
                                              <td> ".$end ."</td>
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$getdd."</span>
                                              </td>
                                              
                                              <td> ".$icon."</td>
                                              
                                              
                                              <td>
                                                 ".$button."
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