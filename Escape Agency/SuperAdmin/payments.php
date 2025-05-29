<?php
  include 'base.php';
?>
<?php
    //confirm payment
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-currency-usd  text-primary ml-auto"></i> Payments </h4>
            <div class="row">
                
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Payments</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND TransactionDate<'$date' ");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Payments This This month</h6>";
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
                    <h5>Completed Payments</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND Active='active'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND TransactionDate<'$date'  AND Active='active'");
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

                              //Count Paid
                              $numpaid = mysqli_query($conn,"SELECT COUNT(*) FROM  payments WHERE status='paid'   ");
                              $r4 = mysqli_fetch_row($numpaid);
                              $nr4 = $r4[0];
                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$nr4." New Payments This month</h6>";
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
                    <h5>Incomplete Payments</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='unpaid'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='unpaid' AND TransactionDate<'$date'  ");
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

                              $numpaid = mysqli_query($conn,"SELECT COUNT(*) FROM  payments WHERE status='unpaid'   ");
                              $r4 = mysqli_fetch_row($numpaid);
                              $nr4 = $r4[0];

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$nr4." Incomplete Payments This This month</h6>";
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
                            //Count Paid
                            $numpaid = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND PayMethod='Credit Card' ");
                            $r4 = mysqli_fetch_row($numpaid);
                            $nr4 = $r4[0];
                            if ($nr4==""){
                              $nr4=0;
                            }


                            print "<h3 class='mb-0'>".$nr4."</h3>";

                          ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"> CREDIT CARD</h6>
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
                            //Count Paid
                            $numpaid = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND PayMethod='Debit Card' ");
                            $r4 = mysqli_fetch_row($numpaid);
                            $nr4 = $r4[0];
                            if ($nr4==""){
                              $nr4=0;
                            }

                            print "<h3 class='mb-0'>".$nr4."</h3>";

                          ?>
                          
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">DEBIT CARD</h6>
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
                            //Count Paid
                            $numpaid = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND PayMethod='PayPal' ");
                            $r4 = mysqli_fetch_row($numpaid);
                            $nr4 = $r4[0];
                            if ($nr4==""){
                              $nr4=0;
                            }

                            print "<h3 class='mb-0'>".$nr4."</h3>";

                          ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">PayPal</h6>
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
                            //Count Paid
                            $numpaid = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND PayMethod='Stripe' ");
                            $r4 = mysqli_fetch_row($numpaid);
                            $nr4 = $r4[0];
                            if ($nr4==""){
                              $nr4=0;
                            }

                            print "<h3 class='mb-0'>".$nr4."</h3>";

                          ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Stripe</h6>
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
                            //Count Paid
                            $numpaid = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND PayMethod='Bank Transfer' ");
                            $r4 = mysqli_fetch_row($numpaid);
                            $nr4 = $r4[0];
                            if ($nr4==""){
                              $nr4=0;
                            }

                            print "<h3 class='mb-0'>".$nr4."</h3>";

                          ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Bank Transfer</h6>
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
                            //Count Paid
                            $numpaid = mysqli_query($conn,"SELECT SUM(Amount) FROM  payments WHERE status='paid' AND PayMethod='Bitcoin' ");
                            $r4 = mysqli_fetch_row($numpaid);
                            $nr4 = $r4[0];
                            if ($nr4==""){
                              $nr4=0;
                            }

                            print "<h3 class='mb-0'>".$nr4."</h3>";

                          ?>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Bitcoin</h6>
                  </div>
                </div>
              </div>
            </div>





            



            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Payments Data</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
                            <th> Order No </th>
                            <th> Payment Name </th>
                            <th> User  </th>
                            <th> Destination Booking </th>
                            <th> Amount  </th>
                            <th> Payment Mode </th>
                            <th> Payment Date </th>
                            <th> Payment Status </th>
                            <th> Summary </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM payments ORDER BY TransactionDate DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $payid=$row['PaymentID'];
                                        $orderno = $row["OrderNo"];
                                        $Name = $row["Name"];
                                        $user = $row["UserID"];
                                        $booking = $row["BookingID"];
                                        $amount = $row["Amount"];
                                        $method = $row["PayMethod"];
                                        $date = $row["TransactionDate"];
                                        $tsummary = $row["TransactionSummary"];
                                        $status = $row["Status"];
                                        
                                        if ($status == "paid"){
                                          $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Paid</i>";
                                          
                                        }else{
                                          $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Pending</i> ";
                                        }

                                        //gET user NAME
                                        $user = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $user");
                                        $aa = mysqli_fetch_array($user);
                                        $getaa = $aa['Email'];
                                        $getimg = $aa['ProfileImg'];

                                        //gET dest from booking
                                        $dest = mysqli_query($conn, "SELECT * FROM bookings WHERE BookingID = $booking");
                                        $dd = mysqli_fetch_array($dest);
                                        $getdd = $dd['DestinationID'];


                                        //gET dest NAME
                                        $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $getdd");
                                        $ddname = mysqli_fetch_array($destname);
                                        $getddname = $ddname['Name'];

                                        
                                     
                                        print "
                                              <td> ".$orderno."</td>
                                              <td> ". $Name."</td>
                                              <td>
                                                <img src='../uploads/".$getimg."' alt='".$getimg."' />
                                                <span class='pl-2'>".$getaa."</span>
                                              </td>
                                              
                                              <td> ".$getddname."</td>
                                              <td> ".$amount."</td>
                                              <td> ".$method."</td>
                                              <td> ".$date."</td>
                                              <td> ".$icon."</td>
                                              <td> ".$tsummary."</td>
                                              
                                              <td>
                                                <a href='viewpayment.php?payid=". urlencode($payid) ."''' type='button' class='btn btn-primary btn-rounded btn-fw'>View Pay Details</a>
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