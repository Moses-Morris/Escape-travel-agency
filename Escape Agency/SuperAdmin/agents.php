<?php
  include 'base.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-table-large  text-primary ml-auto"></i> Travel and Hosting Agents </h4>
          <br>
          <h4>Travel</h4>
            <div class="row">
                
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Agents</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $agents = mysqli_query($conn,"SELECT COUNT(*) FROM  agents ");
                              $r = mysqli_fetch_row($agents);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $hostings2 = mysqli_query($conn,"SELECT COUNT(*) FROM  agents WHERE Created_at<'$date' ");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Agents This month</h6>";
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
                    <h5>Approved Agents</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $agents = mysqli_query($conn,"SELECT COUNT(*) FROM  agents WHERE Status='active'");
                              $r = mysqli_fetch_row($agents);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $hostings2 = mysqli_query($conn,"SELECT COUNT(*) FROM  agents WHERE Created_at<'$date' ");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." Active Agents</h6>";
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
                    <h5>Unapproved Agents</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $agents = mysqli_query($conn,"SELECT COUNT(*) FROM  agents WHERE Status='inactive'");
                              $r = mysqli_fetch_row($agents);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              
                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>InActive Agents</h6>";
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings ");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>  
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Booked Agents</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE Paid=1");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>  
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Paid Agents Bookings</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE Paid=0");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Unpaid Travel Trips for Agents</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM agents WHERE AgentType='Travel'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Travel Agents</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM agents WHERE AgentType='Hosting'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Hosting Agents</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM agents WHERE AgentType='Adventure'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Adventure Agents</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM agents WHERE AgentType='Transport'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Transport Agents</h6>
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
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM agents WHERE AgentType='Cruise'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Cruise Agents</h6>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Search For An Agent</h4>
                    <form class="forms-sample">
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Search by Name or Type">
                      </div>
                      
                      <button type="submit" class="btn btn-primary mr-4 btn-lg">Search</button>
                    </form>
                  </div>
                </div>
              </div>


            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Active Agents - Services</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
                            <th> Company Name </th>
                            <th> Location </th>
                            <th> Email </th>
                            <th> Phone</th>
                            <th> Type of Agent </th>
                            <th> Status </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM agents");
                                      while($row = mysqli_fetch_array($result)){
                                       
                                        $Name = $row["CompanyName"];
                                        $email = $row["Email"];
                                        $phone = $row["Phone"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ProfileImg"];
                                        $type = $row["AgentType"];
                                        $status = $row["Status"];
                                        
                                        if ($status == "active"){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Verified</i>";
                                          
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Unverified</i> ";
                                        }

                                        
                                     
                                        print "
                                              
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                              <td> ".$location.", ".$country."</td>
                                              <td> ". $email."</td>
                                              <td> ".$phone."</td>
                                              <td> ".$type."</td>
                                              <td> ".$icon."</td>
                                              <td>
                                                <a href='./Viewagent.php' class='badge badge-outline-success'>View Agent</a>
                                              </td>
                                            </tr>";



                                      };

                                    ?>
                            <td>
                              <img src="assets/images/faces/face1.jpg" alt="image" />
                              <span class="pl-2">Henry Klein</span>
                            </td>
                            <td> 02312 </td>
                            <td> $14,500 </td>
                            <td> Dashboard </td>
                            <td> Credit card </td>
                            <td> 04 Dec 2019 </td>
                            <td>
                              <div class="badge badge-outline-success">Approved</div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </td>
                            <td>
                              <img src="assets/images/faces/face2.jpg" alt="image" />
                              <span class="pl-2">Estella Bryan</span>
                            </td>
                            <td> 02312 </td>
                            <td> $14,500 </td>
                            <td> Website </td>
                            <td> Cash on delivered </td>
                            <td> 04 Dec 2019 </td>
                            <td>
                              <div class="badge badge-outline-warning">Pending</div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </td>
                            <td>
                              <img src="assets/images/faces/face5.jpg" alt="image" />
                              <span class="pl-2">Lucy Abbott</span>
                            </td>
                            <td> 02312 </td>
                            <td> $14,500 </td>
                            <td> App design </td>
                            <td> Credit card </td>
                            <td> 04 Dec 2019 </td>
                            <td>
                              <div class="badge badge-outline-danger">Rejected</div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </td>
                            <td>
                              <img src="assets/images/faces/face3.jpg" alt="image" />
                              <span class="pl-2">Peter Gill</span>
                            </td>
                            <td> 02312 </td>
                            <td> $14,500 </td>
                            <td> Development </td>
                            <td> Online Payment </td>
                            <td> 04 Dec 2019 </td>
                            <td>
                              <div class="badge badge-outline-success">Approved</div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input">
                                </label>
                              </div>
                            </td>
                            <td>
                              <img src="assets/images/faces/face4.jpg" alt="image" />
                              <span class="pl-2">Sallie Reyes</span>
                            </td>
                            <td> 02312 </td>
                            <td> $14,500 </td>
                            <td> Website </td>
                            <td> Credit card </td>
                            <td> 04 Dec 2019 </td>
                            <td>
                              <div class="badge badge-outline-success">Approved</div>
                            </td>
                          </tr>
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