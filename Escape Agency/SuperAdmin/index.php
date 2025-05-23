<?php
    include 'base.php';

    include 'config/connection.php';
?>


    <!-- partial -->
    <div class="main-panel">
          <div class="content-wrapper">
            
            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <?php
                              $today = date('Y-m-d');
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM users WHERE Created_at='$today'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>  

                          
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <?php
                            $today = date('Y-m-d');
                            $check=mysqli_query($conn,"SELECT COUNT(*) FROM users WHERE Created_at='$today'");
                            $r = mysqli_fetch_row($check);
                            $nr = $r[0];
                            if ($nr >= 1){
                              print "<span class='mdi mdi-arrow-top-right icon-item'></span>";
                            }else{
                              print "<span class='mdi mdi-arrow-bottom-left icon-item danger'></span>";
                            }
                          ?>
                          
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">New Clients Signup</h6>
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
                           
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM destinations WHERE status='APPROVED'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";
                            ?>      
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                        <?php
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM destinations WHERE status='approved'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              if ($nr >= 1){
                                print "<span class='mdi mdi-arrow-top-right icon-item success'></span>";
                              }else{
                                print "<span class='mdi mdi-arrow-bottom-left icon-item danger'></span>";
                              }
                            ?>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Active Destinations</h6>
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
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE paid='TRUE'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                            ?>
                          
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <?php
                                $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE paid='TRUE'");
                                $r = mysqli_fetch_row($check);
                                $nr = $r[0];
                                if ($nr >= 1){
                                  print "<span class='mdi mdi-arrow-top-right icon-item success'></span>";
                                }else{
                                  print "<span class='mdi mdi-arrow-bottom-left icon-item danger'></span>";
                                }
                          ?>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Active Bookings</h6>
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
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE paid=1 AND status='confirmed' AND active='active'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                            ?>
                          
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                        <?php
                                $check=mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE paid=1 AND status='confirmed' AND active='active'");
                                $r = mysqli_fetch_row($check);
                                $nr = $r[0];
                                if ($nr >= 1){
                                  print "<span class='mdi mdi-arrow-top-right icon-item success'></span>";
                                }else{
                                  print "<span class='mdi mdi-arrow-bottom-left icon-item danger'></span>";
                                }
                          ?>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Ongoing Tours </h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Daily Transaction History</h4>
                    <?php
                              $check=mysqli_query($conn,"SELECT SUM(amount) FROM payments WHERE status='paid'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h6 class='mb-0'>Total Amount   :   ".$nr."</h6>";

                            ?>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Transfer to Paypal</h6>
                        <p class="text-muted mb-0">Paid and Active Bookings</p>
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                      <?php
                              $check=mysqli_query($conn,"SELECT SUM(amount) FROM payments WHERE paymethod='PayPal'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                            ?>
                      </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Tranfer to Credit Card</h6>
                        <p class="text-muted mb-0">Paid and Active Bookings</p>
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                      <?php
                              $check=mysqli_query($conn,"SELECT SUM(amount) FROM payments WHERE paymethod='Credit Card'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h3 class='mb-0'>".$nr."</h3>";

                            ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Open Destination Bookings</h4>
                      <p class="text-muted mb-1">Your data status</p>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          
                            
                              <?php
                                  $result = mysqli_query($conn,"SELECT * FROM bookings LIMIT 5");
                                  while($row = mysqli_fetch_array($result)){
                                    echo "<div class='preview-item border-bottom'>
                                                <div class='preview-thumbnail'>
                                                  <div class='preview-icon bg-success'>
                                                    <i class='mdi mdi-cloud-download'></i>
                                                  </div>
                                                </div>
                                                <div class='preview-item-content d-sm-flex flex-grow'>
                                                  <div class='flex-grow'>";
                                    //Get the destination name
                                    $destID = $row['DestinationID'];
                                    $dest_desc = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID='$destID'");
                                    $row2 = mysqli_fetch_array($dest_desc);
                                    echo "<h6 class='preview-subject'>".$row2['Description']."</h6>";

                                    //Get other details of the Destination Bookings
                                    $bookType = $row['BookingType'];
                                    $date = $row['StartDate'];
                                    $hosting = $row['HostingID'];


                                    //get the hosting place
                                    $dest_hosting = mysqli_query($conn,"SELECT * FROM accomodation WHERE HostingID='$hosting'");
                                    $row3 = mysqli_fetch_array($dest_hosting);
                                    echo "
                                          <p class='text-muted mb-0'>Travel Type : (".$bookType.")</p>
                                        </div>
                                        <div class='mr-auto text-sm-right pt-2 pt-sm-0'>
                                          <p class='text-muted'>".$date."</p>
                                          <p class='text-muted mb-0'>".$row3['Name']." </p>
                                        </div>
                                      </div>
                                    </div>
                                    ";
                                  }
                                  
                                ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Successful Bookings</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //Count the number of Bookings
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE status='confirmed' AND paid=1 ");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h2 class='mb-0'>".$nr."</h2>";


                             

                              //Total Amount from bookings
                              $check=mysqli_query($conn,"SELECT SUM(amount) FROM payments WHERE status='paid'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              //print "<br><p class='text-success ml-2 mb-0 '>Total Amount   :   ".$nr."</p>";

                              print "</div>
                                    <h6 class='text-success  mb-0 font-weight-normal'>Total Amount   :   $".$nr."</h6>
                                  </div>
                              ";
                    
                              

                            ?>
                          
                          
                       
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Ongoing Bookings Processes </h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //Count the number of Ongoing Bookings
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE status='pending' ");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h2 class='mb-0'>".$nr."</h2>";


                             

                              //Total Amount from Ongoing bookings
                              $check=mysqli_query($conn,"SELECT SUM(TotalPrice) FROM bookings WHERE status='pending'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              //print "<br><p class='text-success ml-2 mb-0 '>Total Amount   :   ".$nr."</p>";

                              print "</div>
                                    <h6 class='text-success  mb-0 font-weight-normal'>Expected Amount   :   $".$nr."</h6>
                                  </div>
                              ";
                    
                              

                            ?>
                          
                          
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
                    <h5>New Requests</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //Count the number of Ongoing Bookings  for new requests but not paid
                              $check=mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE status='pending' AND active='active'");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              print "<h2 class='mb-0'>".$nr."</h2>";


                             

                              //Total Amount from Ongoing bookings for new requests but not paid
                              $check=mysqli_query($conn,"SELECT SUM(TotalPrice) FROM bookings WHERE status='pending' AND active='active' AND paid=0");
                              $r = mysqli_fetch_row($check);
                              $nr = $r[0];
                              //print "<br><p class='text-success ml-2 mb-0 '>Total Amount   :   ".$nr."</p>";

                              print "</div>
                                    <h6 class='text-success  mb-0 font-weight-normal'>Expected Amount   :   $".$nr."</h6>
                                  </div>
                              ";
                    
                              

                            ?>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
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
                    <h4 class="card-title">Destinations Order Status : TOP 10 Destinations</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> Destination Name </th>
                            <th> Location </th>
                            <th> No.Of Bookings </th>
                            <th> BookingsAmount </th>
                            <th> Destination Price </th>
                            <th> Featured </th>
                            <th> Created On </th>
                            <th> Status</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          
                            <?php
                                $check=mysqli_query($conn,"SELECT * FROM  destinations WHERE status='approved' LIMIT 5");
                                while($row = mysqli_fetch_array($check)){
                                  $destId = $row['DestinationID'];
                                  $destName = $row['Name'];
                                  $destLocation = $row['Location'];
                                  $destCountry = $row['Country'];
                                  $destImg = $row['ImageURL'];
                                  $destAgent = $row['AgentID'];
                                  $destPrice = $row['Price'];
                                  $destFeature = $row['Featured'];
                                  $destDate1 = $row['Created_at'];
                                  $destDate = date("d-m-Y", strtotime($destDate1));

                                  //check details of the destination
                                  $destDetails = mysqli_query($conn,"SELECT COUNT(*) FROM  bookings WHERE DestinationID=$destId ORDER BY StartDate");
                                  $r = mysqli_fetch_row($destDetails);
                                  $nr = $r[0];

                                  $destDetails2 = mysqli_query($conn,"SELECT SUM(TotalPrice) FROM  bookings WHERE DestinationID=$destId AND Paid=1 ORDER BY StartDate");
                                  $r2 = mysqli_fetch_row($destDetails2);
                                  $nr2 = $r2[0];

                                 



                                  if ($destFeature == 1){
                                    $feature = "Featured";
                                  }else{
                                    $feature = "Not Featured";
                                  }


                                  print "<tr>";
                                  print "
                                      <td>
                                        <img src='assets/images/faces/face1.jpg' alt='image' />
                                        <span class='pl-2'>".$destName."</span>
                                      </td>
                                      <td>".$destLocation.",".$destCountry."</td>
                                      <td>".$nr."</td>
                                      <td>$ ".$nr2."</td>
                                      
                                      <td>".$destPrice."</td>
                                      <td> ".$feature." </td>
                                      <td> ".$destDate." </td>
                                      <td>
                                        <div class='badge badge-outline-success'>Active</div>
                                      </td>
                                  ";



                                  print "</tr>";

                                }



                            ?>
                            
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              
            <div class="row">
              <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title">Messages</h4>
                      <p class="text-muted mb-1 small">View all</p>
                    </div>
                    <div class="preview-list">
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <img src="assets/images/faces/face6.jpg" alt="image" class="rounded-circle" />
                        </div>
                        <div class="preview-item-content d-flex flex-grow">
                          <div class="flex-grow">
                            <div class="d-flex d-md-block d-xl-flex justify-content-between">
                              <h6 class="preview-subject">Leonard</h6>
                              <p class="text-muted text-small">5 minutes ago</p>
                            </div>
                            <p class="text-muted">Well, it seems to be working now.</p>
                          </div>
                        </div>
                      </div>
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <img src="assets/images/faces/face8.jpg" alt="image" class="rounded-circle" />
                        </div>
                        <div class="preview-item-content d-flex flex-grow">
                          <div class="flex-grow">
                            <div class="d-flex d-md-block d-xl-flex justify-content-between">
                              <h6 class="preview-subject">Luella Mills</h6>
                              <p class="text-muted text-small">10 Minutes Ago</p>
                            </div>
                            <p class="text-muted">Well, it seems to be working now.</p>
                          </div>
                        </div>
                      </div>
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <img src="assets/images/faces/face9.jpg" alt="image" class="rounded-circle" />
                        </div>
                        <div class="preview-item-content d-flex flex-grow">
                          <div class="flex-grow">
                            <div class="d-flex d-md-block d-xl-flex justify-content-between">
                              <h6 class="preview-subject">Ethel Kelly</h6>
                              <p class="text-muted text-small">2 Hours Ago</p>
                            </div>
                            <p class="text-muted">Please review the tickets</p>
                          </div>
                        </div>
                      </div>
                      <div class="preview-item border-bottom">
                        <div class="preview-thumbnail">
                          <img src="assets/images/faces/face11.jpg" alt="image" class="rounded-circle" />
                        </div>
                        <div class="preview-item-content d-flex flex-grow">
                          <div class="flex-grow">
                            <div class="d-flex d-md-block d-xl-flex justify-content-between">
                              <h6 class="preview-subject">Herman May</h6>
                              <p class="text-muted text-small">4 Hours Ago</p>
                            </div>
                            <p class="text-muted">Thanks a lot. It was easy to fix it .</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Requested Gallery Slides</h4>
                    <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
                      <div class="item">
                        <img src="assets/images/dashboard/Rectangle.jpg" alt="">
                      </div>
                      <div class="item">
                        <img src="assets/images/dashboard/Img_5.jpg" alt="">
                      </div>
                      <div class="item">
                        <img src="assets/images/dashboard/img_6.jpg" alt="">
                      </div>
                    </div>
                    <div class="d-flex py-4">
                      <div class="preview-list w-100">
                        <div class="preview-item p-0">
                          <div class="preview-thumbnail">
                            <img src="assets/images/faces/face12.jpg" class="rounded-circle" alt="">
                          </div>
                          <div class="preview-item-content d-flex flex-grow">
                            <div class="flex-grow">
                              <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                <h6 class="preview-subject">Agent Name</h6>
                                <p class="text-muted text-small">4 Hours Ago</p>
                              </div>
                              <p class="text-muted">Destination Description.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="text-muted">Well, it seems to be working now. </p>
                    <div class="progress progress-md portfolio-progress">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-xl-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">To do list</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="enter task..">
                      <button class="add btn btn-primary todo-list-add-btn">Add</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse text-white todo-list todo-list-custom">
                        <li>
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Create invoice </label>
                          </div>
                          <i class="remove mdi mdi-close-box"></i>
                        </li>
                        <li>
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Meeting with Alita </label>
                          </div>
                          <i class="remove mdi mdi-close-box"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                          </div>
                          <i class="remove mdi mdi-close-box"></i>
                        </li>
                        <li>
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Plan weekend outing </label>
                          </div>
                          <i class="remove mdi mdi-close-box"></i>
                        </li>
                        <li>
                          <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                          </div>
                          <i class="remove mdi mdi-close-box"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Visitors and Requests by Countries</h4>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
                            <?php
                              

                                  $sql = "
                                      SELECT 
                                          d.Country,
                                          COUNT(b.BookingID) AS total_bookings,
                                          ROUND(COUNT(b.BookingID) * 100.0 / (SELECT COUNT(*) FROM bookings), 2) AS booking_percentage
                                      FROM 
                                          bookings b
                                      JOIN 
                                          destinations d ON b.DestinationID = d.DestinationID
                                      GROUP BY 
                                          d.Country
                                      ORDER BY 
                                          total_bookings DESC;
                                  ";

                                  $result = $conn->query($sql);
                                  $count = 1;
                                  while ($row = $result->fetch_assoc()) {
                                      echo "<tr>";
                                      echo "<td>{$count}</td>";
                                      echo "<td>{$row['Country']}</td>";
                                      echo "<td>{$row['total_bookings']}</td>";
                                      echo "<td>{$row['booking_percentage']}%</td>";
                                      echo "</tr>";
                                      $count++;
                                  }
                                  ?>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div id="audience-map" class="vector-map"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->


<?php
    include 'footer.php';
?>