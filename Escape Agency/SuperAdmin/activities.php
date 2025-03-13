<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-laptop  text-primary ml-auto"></i>  Activities</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Activities</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  activities");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $activities2 = mysqli_query($conn,"SELECT COUNT(*) FROM  activities WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($activities2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              if ($perc<=0){
                                $perc = 1;
                              }
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Activities This month</h6>";
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
                    <h5>Active Activities</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  activities WHERE Status='active'");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $activities2 = mysqli_query($conn,"SELECT COUNT(*) FROM  activities WHERE Created_at<'$date' AND Status='active'");
                              $r2 = mysqli_fetch_row($activities2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              if ($perc<=0){
                                $perc = 1;
                              }
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Activities This month</h6>";
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
                    <h5>Inactive Activities</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  activities WHERE Status='inactive'");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $activities2 = mysqli_query($conn,"SELECT COUNT(*) FROM  activities WHERE Created_at<'$date' AND Status='inactive' ");
                              $r2 = mysqli_fetch_row($activities2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>Inactive Activities This month</h6>";
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
                    <h4 class="card-title">All running Activities</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> Activity Name </th>
                            <th> Details </th>
                            <th> Activity Duration</th>
                            <th> Cost </th>
                            <th> Destination </th>
                            <th> Created By : Agent </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                                      $result = mysqli_query($conn,"SELECT * FROM activities ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["ActivityID"];
                                        $Name = $row["Name"];
                                        $desc = $row["Description"];
                                        $img = $row["ImageURL"];
                                        $amount = $row["Price"];
                                        $dest = $row["DestinationID"];
                                        $agent = $row["AgentID"];
                                        $duration = $row["Duration"];
                                        $status = $row["Status"];
                                        
                                        if ($status == "active"){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Running</i>";
                                          
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
                                        }

                                        

                                        //gET agent anme
                                        $agents = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                                        $dd = mysqli_fetch_array($agents);
                                        $getdd = $dd['CompanyName'];


                                        //gET dest NAME
                                        $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                                        $ddname = mysqli_fetch_array($destname);
                                        $getddname = $ddname['Name'];

                                        
                                     
                                        print "
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                              
                                              <td> ".$getddname."</td>
                                              <td> ".$duration."</td>
                                              <td> ".$amount ."</td>
                                              <td> ".$getddname."</td>
                                              <td> ".$getdd."</td>
                                              <td> ".$icon."</td>
                                              
                                              
                                              <td>
                                                <a href='./Viewactivity.php' class='badge badge-outline-success'>View Activity</a>
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