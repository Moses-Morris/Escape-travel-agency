<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-contact-mail  text-primary ml-auto"></i>  Discounts Reports</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>All Discounts</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $disc = mysqli_query($conn,"SELECT COUNT(*) FROM  Discounts");
                              $r = mysqli_fetch_row($disc);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $disc2 = mysqli_query($conn,"SELECT COUNT(*) FROM  Discounts WHERE Created_at<'$date' ");
                              $r2 = mysqli_fetch_row($disc2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Discounts This month</h6>";
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
                    <h5>Active Discounts</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $disc = mysqli_query($conn,"SELECT COUNT(*) FROM  Discounts WHERE Status='active'");
                              $r = mysqli_fetch_row($disc);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $disc2 = mysqli_query($conn,"SELECT COUNT(*) FROM  Discounts WHERE Created_at<'$date'  AND Status='active'");
                              $r2 = mysqli_fetch_row($disc2);
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." Active Discounts This month</h6>";
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
                    <h5>Expired Discounts</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $disc = mysqli_query($conn,"SELECT COUNT(*) FROM  Discounts WHERE Status='inactive'");
                              $r = mysqli_fetch_row($disc);
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
                    <h4 class="card-title">All Discounts</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              ID
                            </th>
                            <th> Discount Name </th>
                            <th> Destination</th>
                            <th> CODE</th>
                            <th> Discount </th>
                            <th> No. of Vouchers </th>
                            <th> Description</th>
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Created On </th>
                            <th> Created BY: Agent </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM Discounts ORDER BY Created_at ASC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["DiscountID"];
                                        $dest = $row["DestinationID"];
                                        $name = $row["DiscountName"];
                                        $code = $row["Code"];
                                        $desc = $row["Description"];
                                        $discount = $row["Discount"];
                                        $start = $row['StartDate'];
                                        $end = $row['EndDate'];
                                        $num= $row['NumOfCodes'];
                                        $date = $row["Created_at"];
                                        $status = $row["Status"];
                                        $agent = $row["AgentID"];
                                        
                                        if ($status == 'active'){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Active</i>";
                                          $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Deactivate</a>";
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
                                          $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Activate</a>";
                                        }

                                        

                                        


                                        //gET dest NAME
                                        $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                                        $ddname = mysqli_fetch_array($destname);
                                        $getddname = $ddname['Name'];
                                        $getddimage = $ddname['ImageURL'];

                                        //gET agent anme
                                        $agent = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                                        $dd = mysqli_fetch_array($agent);
                                        $getddn = $dd['CompanyName'];

                                        if (($getddn == "") || ($agent == "0")){
                                          $company = "Escape Agency";
                                        } else{
                                          $company = $getddn;
                                        }
                                        print "
                                              <td> ".$id."</td>
                                              <td> ".$name."</td>
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$getddname."</span>
                                              </td>
                                              <td> ".$code."</td>
                                              <td> ".$discount ."</td>
                                              <td> ".$num."</td>
                                              <td> ".$desc."</td>
                                              <td> ".$start."</td>
                                              <td> ".$end."</td>
                                              <td> ".$date."</td>
                                              <td> ".$company  ."</td>
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