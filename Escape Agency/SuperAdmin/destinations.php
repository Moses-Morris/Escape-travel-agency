<?php
  include 'base.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">


          <h4><i class="mdi mdi-debug-step-into  text-primary ml-auto"></i>  Destinations</h4>
          <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Number Of Destinations</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Status='approved'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Created_at<'$date' AND Status='approved'");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Listed Destinations This month</h6>";
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
                    <h5>Active Destinations</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Created_at<'$date' ");
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
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Listed Destinations This month</h6>";
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
                    <h5>Inactive Destinations</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <?php
                              //check details of the destination
                              $destinations = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Status!='approved'");
                              $r = mysqli_fetch_row($destinations);
                              $nr = $r[0];

                              print "<h2 class='mb-0'>". $nr."</h2>";
                              $date = date('Y-m-d', strtotime('-30 days'));
                              //cho $date; 
                              //check details of the destination difference of 1 month

                              $dest2 = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE Created_at<'$date' AND Status!='approved'");
                              $r2 = mysqli_fetch_row($dest2);
                              $nr2 = $r2[0];
                              //echo  $nr2;

                              $diff = $nr - $nr2;
                              $perc = $diff * 100;
                              if ($perc == 0) {
                                $currperc = 1;
                              }else{
                                $currperc = $perc / $nr;
                              }
                              
                              if ($currperc > 0) {
                                $sign = "+";
                              }else {
                                $sign = "";
                              }

                              print "
                                  <p class='text-success ml-4 mb-0 font-weight-medium'>".$sign."".$currperc."%</p>
                              ";

                              print "</div>
                                  <h6 class='text-muted font-weight-normal'>".$diff." New Destinations This month</h6>";
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
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Search For A Destination</h4>
                    <form class="forms-sample mt-4" method="POST">
                          <div class="form-group">
                            <input type="text" class="form-control" placeholder="Destination or Client Email" name="search" required>
                          </div>
                          <button type="submit" class="btn btn-primary btn-lg">Search</button>
                        </form>
                        <br>
                    <?php
                        // Include DB connection here or above this block
                        // Example: $conn = new mysqli("localhost", "root", "", "your_database");

                        $searchResults = [];

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
                            $search = "%" . trim($_POST["search"]) . "%";

                            $stmt = $conn->prepare("
                                SELECT * FROM Bookings b
                                JOIN Destinations d ON b.DestinationID = d.DestinationID
                                JOIN Users a ON b.UserID = a.UserID
                                WHERE  d.Name LIKE ? OR d.Country LIKE ?");

                            if ($stmt) {
                                $stmt->bind_param("ss", $search, $search);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows === 0) {
                                    echo "<div class='alert alert-warning'>No matching bookings found.</div>";
                                } else {
                                    echo "<div class='alert alert-success'>Search Results:</div>";
                                    print "<div class='table-responsive'>
                                                  <table class='table'>
                                                    <thead>
                                                      <tr>
                                                    
                                                        <th> Destination Name </th>
                                                        <th> Country </th>
                                                        <th> Price </th>
                                                        <th> Agent Name </th>
                                                        <th> Travel </th>
                                                        <th> Destination Bookings </th>
                                                        <th> Actions </th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>";
                                                      while($row = mysqli_fetch_array($result)){
                                                        $ID = $row["DestinationID"];
                                                        $Name = $row["Name"];
                                                        $location = $row["Location"];
                                                        $country = $row["Country"];
                                                        $img = $row["ImageURL"];
                                                        $price = $row["Price"];
                                                        $Agent = $row["AgentID"];
                                                        $travel = $row["TravelID"];
                                                        
                
                                                         //get the user who has placed the booking
                                                         $agent_name = mysqli_query($conn,"SELECT * FROM agents WHERE AgentID=$Agent");
                                                         $row5 = mysqli_fetch_array($agent_name);
                                                         $AgentName = $row5["CompanyName"]; //use email as name
                
                                                        //Count bookings for destination
                                                        $dest_amt = mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE DestinationID=$ID ");
                                                        $r2 = mysqli_fetch_row($dest_amt);
                                                        $nr2 = $r2[0];
                
                                                     
                                                        print "
                                                              
                                                              
                                                              <td>
                                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                                <span class='pl-2'>".$Name."</span>
                                                              </td>
                                                              <td> ".$location.", ".$country."</td>
                                                              <td> ". $price."</td>
                                                              <td> ".$AgentName."</td>
                                                              <td> ".$travel."</td>
                                                              <td> ".$nr2."</td>
                                                              <td>
                                                                <div class='badge badge-outline-success'>Active</div>
                                                              </td>
                                                              <td>
                                                                <a href='viewDestination.php?destid=". urlencode($ID) ."' type='button' class='btn btn-primary  btn-rounded btn-fw'>View Destination </a>
                                                              </td>
                                                            </tr>";
                                              
                                    
                                                          };
                                                          echo "</ul>";
                                                      }
                      
                                                      $stmt->close();
                                                  } else {
                                                      echo "<div class='alert alert-danger'>Query failed: " . $conn->error . "</div>";
                                                  }
                                              }
                                              ?>
                                              </tbody>
                                            </table>
                                          
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Destinations Information</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                        
                            <th> Destination Name </th>
                            <th> Country </th>
                            <th> Price </th>
                            <th> Agent Name </th>
                            <th> Travel </th>
                            <th> Destination Bookings </th>
                            <th> Actions </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           
                          
                                    <?php
                                      $result = mysqli_query($conn,"SELECT * FROM destinations WHERE Status='approved'");
                                      while($row = mysqli_fetch_array($result)){
                                        $ID = $row["DestinationID"];
                                        $Name = $row["Name"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ImageURL"];
                                        $price = $row["Price"];
                                        $Agent = $row["AgentID"];
                                        $travel = $row["TravelID"];
                                        

                                         //get the user who has placed the booking
                                         $agent_name = mysqli_query($conn,"SELECT * FROM agents");
                                         $row5 = mysqli_fetch_array($agent_name);
                                         $AgentName = $row5["CompanyName"]; //use email as name

                                        //Count bookings for destination
                                        $dest_amt = mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE DestinationID=$ID ");
                                        $r2 = mysqli_fetch_row($dest_amt);
                                        $nr2 = $r2[0];

                                     
                                        print "
                                              
                                              
                                              <td>
                                                <img src='assets/images/faces/face1.jpg' alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                              <td> ".$location.", ".$country."</td>
                                              <td> ". $price."</td>
                                              <td> ".$AgentName."</td>
                                              <td> ".$travel."</td>
                                              <td> ".$nr2."</td>
                                              <td>
                                                <div class='badge badge-outline-success'>Active</div>
                                              </td>
                                              <td>
                                                <a href='viewDestination.php?destid=". urlencode($ID) ."' type='button' class='btn btn-primary  btn-rounded btn-fw'>View </a>
                                                
                                              </td>
                                            </tr>";



                                      };

                                    ?>
                                      
                         
                            
                        </tbody>
                      </table>
                    </div>




                    <div class="table-responsive">
                      <h6>Unapproved Bookings</h6>
                      <table class="table">
                        <thead>
                          <tr>
                        
                            <th> Destination Name </th>
                            <th> Country </th>
                            <th> Price </th>
                            <th> Agent Name </th>
                            <th> Travel </th>
                            <th> Destination Bookings </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           
                          
                                    <?php
                                      $result = mysqli_query($conn,"SELECT * FROM destinations WHERE Status!='approved'");
                                      while($row = mysqli_fetch_array($result)){
                                        $ID = $row["DestinationID"];
                                        $Name = $row["Name"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ImageURL"];
                                        $price = $row["Price"];
                                        $Agent = $row["AgentID"];
                                        $travel = $row["TravelID"];
                                        
                                         //get the user who has placed the booking
                                         $agent_name = mysqli_query($conn,"SELECT * FROM agents WHERE AgentID=$Agent");
                                         $row5 = mysqli_fetch_array($agent_name);
                                         $AgentName = $row5["CompanyName"]; //use email as name

                                        //Count bookings for destination
                                        $dest_amt = mysqli_query($conn,"SELECT COUNT(*) FROM bookings WHERE DestinationID=$ID ");
                                        $r2 = mysqli_fetch_row($dest_amt);
                                        $nr2 = $r2[0];

                                     
                                        print "
                                              
                                              
                                              <td>
                                                <img src='".$img."' alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                              <td> ".$location.", ".$country."</td>
                                              <td> ". $price."</td>
                                              <td> ".$AgentName."</td>
                                              <td> ".$travel."</td>
                                              <td> ".$nr2."</td>
                                              <td>
                                                <a href='./approveDestination.php' class='badge badge-outline-success'>Approve</a>
                                              </td>
                                            <td>
                                                <a href='viewDestination.php?destid=". urlencode($ID) ."' type='button' class='btn btn-primary  btn-rounded btn-fw'>View Destination </a>
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
              
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Most Visited Countries Yearly</h4>
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
                            ?>
                            
                            <h2>🌍 Most Visited Countries</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country</th>
                                        <th>Total Bookings</th>
                                        <th>Percentage of Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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
<?php
    include 'footer.php';
?>