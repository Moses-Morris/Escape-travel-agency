<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-notification-clear-all  text-primary ml-auto"></i>  Notifications & Messages</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Messages</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $noti = mysqli_query($conn,"SELECT COUNT(*) FROM  Notifications");
                              $r = mysqli_fetch_row($noti);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $noti2 = mysqli_query($conn,"SELECT COUNT(*) FROM  notifications WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($noti2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Reviews This month</h6>";
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
                    <h5>Read Messages</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $noti = mysqli_query($conn,"SELECT COUNT(*) FROM  Notifications WHERE Status='read'");
                              $r = mysqli_fetch_row($noti);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                          ?>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
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
                    <h5>UnRead Messages</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $noti = mysqli_query($conn,"SELECT COUNT(*) FROM  Notifications WHERE Status='unread'");
                              $r = mysqli_fetch_row($noti);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                          ?>
                          <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p>
                        </div>
                        <h6 class="text-muted font-weight-normal">2.27% Since last month</h6>
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
                    <h4 class="card-title">All Notifications and Messages</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> ID </th>
                            <th> To ->User </th>
                            <th> Message </th>
                            <th> Read/Unread </th>
                            <th> Urgency </th>
                            <th> From -> Agent </th>
                            <th> Dated </th>
                            <th> Type </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                        <?php
                                      $result = mysqli_query($conn,"SELECT * FROM Notifications WHERE  active=1 ORDER BY Created_at DESC ");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["NotificationID"];
                                        $messa = $row["Message"];
                                        $user = $row["UserID"];
                                        $date = $row["Created_at"];
                                        $status = $row["Status"];
                                       
                                        $agent = $row["AgentID"];
                                        $urgency = $row["Urgency"];
                                        $type = $row["Type"];
                                        $active = $row["active"];
                                        
                                        if ($status == 'read'){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Viewed</i>";
                                          //$button = "<a href='./deactivy.php' class='badge badge-outline-success'>Deactivate</a>";
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close text-primary ml-auto'>Not Viewed</i>";
                                          //$button = "<a href='./deactivy.php' class='badge badge-outline-success'>Activate</a>";
                                        }

                                        if($type == 'promo'){
                                          $data = "Promotion";
                                        } else{
                                          $data = "Alert";
                                        }

                                        if ($urgency == 0){
                                          $urge = "Not Urgent";
                                        } else if ($urgency == 1){
                                          $urge = "Urgent";
                                        } else {
                                          $urge = "Late: Must Reply";
                                        }

                                        if ($active == 1){
                                          $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Deactivate</a>";
                                        } else{
                                          $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Activate</a>";
                                        }

                                        //gET agent anme
                                        $agents2 = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                                        $ddn = mysqli_fetch_array($agents2);
                                        $getddn = $ddn['CompanyName'];

                                        if ($getddn == ""){
                                          $company = "Escape Agency";
                                        } else{
                                          $company = $getddn;
                                        }
                                       
                                        //GET user name
                                        $users = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $user");
                                        $dd = mysqli_fetch_array($users);
                                        $getdd = $dd['Email'];

                                     
                                        print "
                                              <td> ".$id."</td>
                                              
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$getdd."</span>
                                              </td>
                                              <td> ".$messa."</td>
                                              <td> ".$status."</td>
                                              <td> ".$urge ."</td>
                                              <td> ".$company."</td>
                                              <td> ".$date."</td>
                                              <td> ".$data."</td>
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