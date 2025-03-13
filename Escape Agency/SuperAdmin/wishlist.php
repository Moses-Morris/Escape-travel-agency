<?php
    include 'base.php';
?>



<!-- partial -->
<div class="main-panel">
          <div class="content-wrapper">
            
            
          <h4><i class="mdi mdi-stop-circle-outline  text-primary ml-auto"></i>  Wishlist and Likes</h4>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Likes</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $feature = mysqli_query($conn,"SELECT COUNT(*) FROM  Wishlist");
                              $r = mysqli_fetch_row($feature);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              ?>
                        </div>
                        <h6 class="text-muted font-weight-normal">Destination Likes</h6>
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
                    <h5>Active Likes</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $wishlist = mysqli_query($conn,"SELECT COUNT(*) FROM  Wishlist");
                              $r = mysqli_fetch_row($wishlist);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                              $result = mysqli_query($conn, "SELECT a.WishlistID , a.UserID,
                                                                                              COUNT(b.DestinationID) AS DestCount, 
                                                                                              ROUND((COUNT(b.DestinationID) / (SELECT COUNT(*) FROM Destinations)) * 100, 2) AS DestinationPercentage
                                                                                        FROM Wishlist a
                                                                                        LEFT JOIN Destinations b ON a.WishlistID = b.DestinationID
                                                                                        GROUP BY a.WishlistID
                                                                                        ORDER BY DestCount DESC
                                                                      ");

                              while($row = mysqli_fetch_array($result)){
                                if ($result->num_rows > 0) {
                                  while ($row = $result->fetch_assoc()) {
                                     
                                      $count = $row["DestCount"];
                                      $percent = $row["DestinationPercentage"];
                                      /*
                                      print "</div>
                                                  <h6 class='text-muted font-weight-normal'> ".$count." Destinations Liked</h6>";
                                     */
                                  }
                                }
                              }

                              ?>
                        </div>
                        <h6 class="text-muted font-weight-normal"> Destinations Liked</h6>
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
                    <h5>InActive Likes</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $wishlist = mysqli_query($conn,"SELECT COUNT(*) FROM  Wishlist WHERE Status = 'inactive'");
                              $r = mysqli_fetch_row($wishlist);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";

                            ?>
                          <p class="text-danger ml-2 mb-0 font-weight-medium"></p>
                        </div>
                        <h6 class="text-muted font-weight-normal"></h6>
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
                    <h4 class="card-title">All Liked Events and Destinations</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              Wishlist ID
                            </th>
                            <th> Destination Name </th>
                            <th> Likes </th>
                            
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                                      $result = mysqli_query($conn, "SELECT a.WishlistID
                                                                                                    COUNT(b.DestinationID) AS DestCount, 
                                                                                                    ROUND((COUNT(b.DestinationID) / (SELECT COUNT(*) FROM destinations)) * 100, 2) AS WishPercentage
                                                                                              FROM wishlist a
                                                                                              LEFT JOIN destinations b ON a.DestinationID = b.DestinationID
                                                                                              GROUP BY a.WishlistID
                                                                                              ORDER BY DestCount DESC
                                                                                              LIMIT 6");
                                                              while($row = mysqli_fetch_array($result)){
                                                              if ($result->num_rows > 0) {
                                                              while ($row = $result->fetch_assoc()) {
                                                              
                                                              $count = $row["DestCount"];
                                                              $percent = $row["WishPercentage"];


                                                              print "
                                                              <tr>
                                                              <td>
                                                                <i class='flag-icon flag-icon-us'></i>
                                                              </td>
                                                              
                                                              <td class='text-right'> ".$count." </td>
                                                              <td class='text-right font-weight-medium'> ".$percent."% </td>
                                                              </tr>
                                                              ";
                                                              }
                                                              } else {
                                                              echo "No results found.";
                                                              }

                                                              }
                                     
                        ?>
                          
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Liked Events and Destinations</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              Wishlist ID
                            </th>
                            <th> Destination Name </th>
                            <th> Likes </th>
                            <th> User </th>
                            <th> Time </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                                      $result = mysqli_query($conn,"SELECT * FROM Wishlist ORDER BY Created_at DESC");
                                      while($row = mysqli_fetch_array($result)){
                                        $id = $row["WishlistID"];
                                        $dest = $row["DestinationID"];
                                        $user = $row["UserID"];
                                        $date = $row["Created_at"];
                                        $status = $row["Status"];
                                        $count = $row["Count"];
                                        
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

                                        //gET user anme
                                        $users = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $user");
                                        $dd = mysqli_fetch_array($users);
                                        $getdd = $dd['Email'];

                                     
                                        print "
                                              <td> ".$id."</td>
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$getddname."</span>
                                              </td>
                                              <td> ".$count."</td>
                                              <td> ".$getdd ."</td>
                                              <td> ".$date."</td>
                                              
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