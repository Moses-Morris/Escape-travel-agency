
<?php
    include 'base.php';
    include_once 'config/connection.php';
   
    //echo $getdd;
?>      





<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
            <div class="col-md-12 grid-margin">



            <div class="row col-md-12">
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Destinations</p>
                        <?php
                                // Ensure database connection exists
                                if (!isset($conn)) {
                                    die("Database connection error.");
                                }

                                // Prepare the query to prevent SQL injection
                                $query = "SELECT a.AgentID, COALESCE(COUNT(d.DestinationID), 0) AS DestCount 
                                          FROM Agents a
                                          LEFT JOIN Destinations d ON a.AgentID = d.AgentID
                                          WHERE a.CompanyName = ?
                                          GROUP BY a.AgentID";

                                $stmt = $conn->prepare($query);
                                if ($stmt === false) {
                                    die("Query preparation failed: " . $conn->error);
                                }

                                $stmt->bind_param("s", $Company);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $value = 0; 

                                if ($row = $result->fetch_assoc()) {
                                    $value = $row['DestCount'];
                                }

                                
                                echo "<p class='fs-30 mb-2'>$value</p>";
                                ?>

                        <p>All My Created Destinations</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Approved Destinations</p>
                        <?php
                                // Ensure database connection exists
                                if (!isset($conn)) {
                                    die("Database connection error.");
                                }

                                // Prepare the query to prevent SQL injection
                                $query = "SELECT a.AgentID, COALESCE(COUNT(d.DestinationID), 0) AS DestCount 
                                          FROM Agents a
                                          LEFT JOIN Destinations d ON a.AgentID = d.AgentID
                                          WHERE a.CompanyName = ? AND d.Status='approved'
                                          GROUP BY a.AgentID";

                                $stmt = $conn->prepare($query);
                                if ($stmt === false) {
                                    die("Query preparation failed: " . $conn->error);
                                }

                                $stmt->bind_param("s", $Company);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                $value = 0; // Default value

                                if ($row = $result->fetch_assoc()) {
                                    $value = $row['DestCount'];
                                }

                                // Print the count
                                echo "<p class='fs-30 mb-2'>$value</p>";
                                ?>
                        <p>Approved by the Admin</p>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
              <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Ongoing Destination Visits</p>
                        <?php
                              // Ensure database connection exists
                              if (!isset($conn)) {
                                  die("Database connection error.");
                              }

                              $query = "SELECT COUNT(b.BookingID) AS TotalBookingsRunning
                                        FROM Bookings b
                                        JOIN Destinations d ON b.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ? AND DATE(b.EndDate) < CURDATE()";

                              $stmt = $conn->prepare($query);
                              if (!$stmt) {
                                  die("Query preparation failed: " . $conn->error);
                              }

                              // Bind the agent ID to the query
                              $stmt->bind_param("i", $agentID);
                              $stmt->execute();
                              $result = $stmt->get_result();

                              $totalBookings = 0; // Default value

                              if ($row = $result->fetch_assoc()) {
                                  $totalBookings = $row['TotalBookingsRunning'];
                              }

                             

                              

                              // Display the count of bookings for the logged-in agent
                              echo "<p class='fs-30 mb-2'>$totalBookings </p>";
                              ?>
                        <p>Ongoing tours and Visits</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Expected Amount</p>
                        <?php
                              // Ensure database connection exists
                              if (!isset($conn)) {
                                  die("Database connection error.");
                              }

                              /* Start session to get logged-in agent's ID
                              session_start();
                              if (!isset($_SESSION['AgentID'])) {
                                  die("Agent is not logged in.");
                              }

                              $agentID = $_SESSION['AgentID']; // Logged-in agent ID
                              */
                              // Prepare the SQL query to get today's bookings
                              $query = "SELECT SUM(b.Amount) AS TotalPayments
                                        FROM Payments b
                                        JOIN Bookings c ON b.BookingID = c.BookingID
                                        JOIN Destinations d ON c.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ?";

                              /*$query = "SELECT COUNT(b.BookingID) AS TotalBookings
                                        FROM Bookings b
                                        JOIN Destinations d ON b.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ? AND DATE(b.StartDate) = CURDATE()";*/

                              $stmt = $conn->prepare($query);
                              if (!$stmt) {
                                  die("Query preparation failed: " . $conn->error);
                              }

                              // Bind the agent ID to the query
                              $stmt->bind_param("i", $agentID);
                              $stmt->execute();
                              $result = $stmt->get_result();

                              $value1 = 0; // Default value

                                if ($row = $result->fetch_assoc()) {
                                    $value1 = $row['TotalPayments'];
                                }

                                // Print the count
                                echo "<p class='fs-30 mb-2'>$value1</p>";
                            ?>
                        <p>Amount from Bookings</p>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Destinations</h4>
                    <a href="createdestination.php" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Destination</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Destination Name </th>
                            <th> Description </th>
                            <th> Country </th>
                            <th> Price </th>
                           
                            <th> Travel </th>
                            <th> Destination Bookings </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                      $result = mysqli_query($conn,"SELECT * FROM Destinations d 
                                                                            JOIN Agents a ON d.AgentID = a.AgentID
                                                                            WHERE a.AgentID = $agentID  ");
                                      while($row = mysqli_fetch_array($result)){
                                        $ID = $row["DestinationID"];
                                        $Name = $row["Name"];
                                        $location = $row["Location"];
                                        $country = $row["Country"];
                                        $img = $row["ImageURL"];
                                        $price = $row["Price"];
                                        $Agent = $row["AgentID"];
                                        $travel = $row["TravelID"];
                                        $approv = $row["Status"];
                                        $desc = $row["Description"];
                                        //echo "$approv";
                                        //approved or not
                                        if ($approv === "active"){
                                          $icon = "<button class='badge badge-outline-success'>Approved</button>";
                                        }else if($approv == " " ) {
                                          $icon = "<button class='badge badge-outline-danger'>Not Approved</button>";
                                        } else{
                                          $icon = "<button class='badge badge-outline-danger'>Not Approved</button>";
                                        }

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
                                                <img src=".$img." alt='image' />
                                                <span class='pl-2'>".$Name."</span>
                                              </td>
                                               <td> ".$desc."</td>
                                              <td> ".$location.", ".$country."</td>
                                              <td> ". $price." USD</td>
                                            
                                              <td> ".$travel."</td>
                                              <td> ".$nr2."</td>
                                              <td>
                                                ".$icon."
                                              </td>
                                              <td>
                                                <a <a href='viewdestination.php?destid=". urlencode($ID) ."' type='button' class='btn btn-primary  btn-rounded btn-fw'>View </a>
                                                
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
            


<?php
    include 'footer.php';
?>