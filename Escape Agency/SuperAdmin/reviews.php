<?php
    include 'base.php';
?>

<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-arrow-up-bold-hexagon-outline  text-primary ml-auto"></i>  Reviews</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Reviews</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  reviews");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $activities2 = mysqli_query($conn,"SELECT COUNT(*) FROM  reviews WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($activities2);
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
                    <h5>Active Company Reviews</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  reviews WHERE Status = 'active'");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $activities2 = mysqli_query($conn,"SELECT COUNT(*) FROM  reviews WHERE Created_at<'$date' AND Status = 'active'");
                              $r2 = mysqli_fetch_row($activities2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Active Reviews This month</h6>";
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
                    <h5>Inactive Reviews</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $activities = mysqli_query($conn,"SELECT COUNT(*) FROM  reviews WHERE Status = 'inactive'");
                              $r = mysqli_fetch_row($activities);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              print "</div>
                              <h4 class='text-muted font-weight-normal'>".$nr." Inactive Reviews</h4>";
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
                    <h4 class="card-title">All Reviews</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                           
                            <th> Reviewer Name </th>
                            <th> Reviewer Email </th>
                            <th> Destination </th>
                            <th> Rating </th>
                            <th> Comment </th>
                            
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                        <?php
                                      $result = mysqli_query($conn,"SELECT * FROM reviews ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["ReviewID"];
                                        $dest = $row["DestinationID"];
                                        $user = $row["UserID"];
                                        $rating = $row["RatingAVG"];
                                        $comment = $row["ReviewComment"];
                                        $status = $row["Status"];
                                        
                                        if ($status == "active"){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Active</i>";
                                          $button = "<a href='./Viewactivity.php' class='badge badge-outline-success'>Deactivate</a>";
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
                                          $button = "<a href='./Viewactivity.php' class='badge badge-outline-success'>Activate</a>";
                                        }

                                        

                                        //gET user NAME
                                        $user = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $user");
                                        $aa = mysqli_fetch_array($user);
                                        $getaa = $aa['Email'];
                                        $getimg = $aa['ProfileImg'];
                                        $getaaname = $aa['Name'];


                                        //gET dest NAME
                                        $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                                        $ddname = mysqli_fetch_array($destname);
                                        $getddname = $ddname['Name'];

                                        
                                     
                                        print "
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$getaaname."</span>
                                              </td>
                                              
                                              <td> ".$getaa."</td>
                                              <td> ".$getddname ."</td>
                                              <td> ".$rating ."</td>
                                              <td> ".$comment ."</td>
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