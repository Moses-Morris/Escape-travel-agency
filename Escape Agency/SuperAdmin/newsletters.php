<?php
  include 'base.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-file-document-box  text-primary ml-auto"></i> Newsletter Reports  </h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Newsletter Emails</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+3.5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Subscriptions</h6>";
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
                    <h5>Active Subscription Emails</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters WHERE SubscriptionStatus=1");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+3.5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Active Subscriptions</h6>";
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
                    <h5>Inactive Subscription Emails</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters WHERE SubscriptionStatus=0");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+3.5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Inactive Subscriptions</h6>";
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




            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <?php
                              $date = date('Y-m-d');
                              //check details of the newsletters
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters WHERE Created_at=$date");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h3 class='mb-0'>". $nr."</h3>";
                              
                              ?>
                              
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Subscribed Today</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <?php
                              $date = date('Y-m-d');
                              //check details of the newsletters
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters WHERE Created_at=$date");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h3 class='mb-0'>". $nr."</h3>";
                              
                              ?>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Unsubscribed Today</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <?php
                              $date = date('Y-m-d');
                              //check details of the newsletters
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters WHERE Enable=1");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h3 class='mb-0'>". $nr."</h3>";
                              
                              ?>
                          <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Enabled Notifications</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <?php
                              $date = date('Y-m-d');
                              //check details of the newsletters
                              $newsl = mysqli_query($conn,"SELECT COUNT(*) FROM  newsletters WHERE Enable=1 AND SubscriptionStatus=1");
                              $r = mysqli_fetch_row($newsl);
                              $nr = $r[0];

                              print "<h3 class='mb-0'>". $nr."</h3>";
                              
                              ?>
                          <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Active Emails User Accounts</h6>
                  </div>
                </div>
              </div>
            </div>





            





            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Newsletter Emails</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                           
                            <th> ID </th>
                            <th> User Email </th>
                            <th> Date</th>
                            <th> Notifications </th>
                            
                         
                            <th>  Status </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                                <?php
                                      $result = mysqli_query($conn,"SELECT * FROM newsletters ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["NewsletterID"];
                                        $email = $row["Email"];
                                        $status = $row["SubscriptionStatus"];
                                        $date = $row["Created_at"];
                                        $enable = $row["Enable"];
                                        
                                        if ($status == 1){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Subscribed</i>";
                                          $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Deactivate</a>";
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Unsubscribed</i> ";
                                          $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Activate</a>";
                                        }

                                        if ($enable == 1){
                                          $data = "Notifications Enabled";
                                        } else{
                                          $data = "Notifications Not Enabled";
                                        }

                                        

                                        


                                        
                                     
                                        print "
                                              <td> ".$id."</td>
                                              <td> ".$email."</td>
                                              
                                              <td> ".$date."</td>
                                              <td>".$data."</td>
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