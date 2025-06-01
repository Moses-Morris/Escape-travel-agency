<?php
    include 'base.php';
?>



        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-forward  text-primary ml-auto"></i> Travel Options Details  </h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>All Travel Options</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $tra = mysqli_query($conn,"SELECT COUNT(*) FROM  traveloptions");
                              $r = mysqli_fetch_row($tra);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Travel Options</h6>";
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
                    <h5>Active Travel Options</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $tra = mysqli_query($conn,"SELECT COUNT(*) FROM  traveloptions WHERE Status = 'active'");
                              $r = mysqli_fetch_row($tra);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+8.5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Actvive Travel Options</h6>";
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
                    <h5>Inactive Travel Options</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $tra = mysqli_query($conn,"SELECT COUNT(*) FROM  traveloptions WHERE Status = 'inactive'");
                              $r = mysqli_fetch_row($tra);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              print "
                              <p class='text-success ml-4 mb-0 font-weight-medium'>+8.5%</p>
                                ";

                                print "</div>
                                    <h6 class='text-muted font-weight-normal'> Total Inactive Travel Options</h6>";
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
                    <h4 class="card-title">All TravelOptions</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> Option ID </th>
                            <th> Destination </th>
                            <th> Booking ID </th>
                            <th> Booking Date </th>
                            <th> User </th>
                            <th> Travel Mode </th>
                            <th> Details of Travel </th>
                            <th> Price </th>
                            <th> Created By : Agent </th>
                            <th> Option Created On  </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM traveloptions    ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["TravelID"];
                                        $book = $row["BookingID"];
                                        $dest = $row["DestinationID"];
                                        $date = $row["Created_at"];
                                        $agent = $row["AgentID"];
                                        $status = $row["Status"];
                                        $mode = $row["TravelMode"];
                                        $details = $row["Details"];
                                        $price = $row["Prices"];
                                      
                                        
                                        
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


                                         //Get booking details
                                         $bookings = mysqli_query($conn, "SELECT * FROM bookings WHERE BookingID = $book");
                                         $ff = mysqli_fetch_array($bookings);
                                         $getuser = $ff['UserID'];
                                         $getDate = $ff['Created_at'];
                                         

                                         //get user
                                          
                                        $users = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $getuser");
                                        $dd = mysqli_fetch_array($users);
                                        $getdd = $dd['Email'];


                                     
                                        print "
                                              <td> ".$id."</td>
                                              <td> ".$dest."</td>
                                              
                                              <td> ".$book."</td>
                                              <td>".$getDate."</td>
                                              <td> ".$getdd."</td>
                                              <td> ".$mode."</td>
                                              <td> ".$details."</td>
                                              <td> ".$price."</td>
                                              <td> ".$company."</td>
                                              <td> ".$date."</td>
                                              <td> ".$icon."</td>
                                              
                                            </tr>";



                                      };

                                    ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            

<?php
    include 'footer.php';
?>