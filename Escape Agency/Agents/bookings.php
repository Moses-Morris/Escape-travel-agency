<?php
    include 'base.php';
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
                        <p class="mb-4">Today’s Bookings</p>
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
                              $query = "SELECT COUNT(b.BookingID) AS TotalBookings
                                        FROM Bookings b
                                        JOIN Destinations d ON b.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ? AND DATE(b.StartDate) = CURDATE()";

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
                                  $totalBookings = $row['TotalBookings'];
                              }

                              // Display the count of bookings for the logged-in agent
                              echo "<p class='fs-30 mb-2'>$totalBookings</p>";
                            ?>

                        <p>Bookings in 24hrs</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                      <p class="mb-4">Total  Bookings</p>
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
                              $query = "SELECT COUNT(b.BookingID) AS TotalBookings
                                        FROM Bookings b
                                        JOIN Destinations d ON b.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ? ";

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
                                  $totalBookings = $row['TotalBookings'];
                              }

                              // Display the count of bookings for the logged-in agent
                              echo "<p class='fs-30 mb-2'>$totalBookings</p>";
                              ?>
                        
                        <p>Since Signup</p>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
              <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Active Paid Bookings</p>
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
                              $query = "SELECT COUNT(b.BookingID) AS TotalBookings
                                        FROM Bookings b
                                        JOIN Destinations d ON b.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ? AND b.Paid = 1";

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
                                  $totalBookings = $row['TotalBookings'];
                              }

                              // Display the count of bookings for the logged-in agent
                              echo "<p class='fs-30 mb-2'>$totalBookings</p>";
                              ?>

                        <p>Confirmed Payments</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Confirmed Bookings</p>
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
                              $query = "SELECT COUNT(b.BookingID) AS TotalBookings
                                        FROM Bookings b
                                        JOIN Destinations d ON b.DestinationID = d.DestinationID
                                        JOIN Agents a ON d.AgentID = a.AgentID
                                        WHERE a.AgentID = ? AND b.Status = 'cancelled'";

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
                                  $totalBookings = $row['TotalBookings'];
                              }

                              // Display the count of bookings for the logged-in agent
                              echo "<p class='fs-30 mb-2'>$totalBookings</p>";
                              ?>

                        <p>Successfully Validated Bookings</p>
                      </div>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">All Bookings</h4>
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Client Name </th>
                            <th> Destination </th>
                            <th> Hosting</th>
                            <th> Type </th>
                            <th> Start Date </th>
                            <th> End Date </th>
                            <th> Total Price </th>
                            <th> Paid </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                         
                            $result = mysqli_query($conn,"SELECT * FROM Bookings b
                                                                            JOIN Destinations d ON b.DestinationID = d.DestinationID
                                                                            JOIN Agents a ON d.AgentID = a.AgentID
                                                                            WHERE a.AgentID = $agentID ");
                            while($row = mysqli_fetch_array($result)){
                              $ID = $row["BookingID"];
                              $Client = $row["UserID"];
                              $destination = $row["DestinationID"];
                              $Hosting = $row["HostingID"];
                              $Type = $row["BookingType"];
                              $People = $row["NumOfPeople"];
                              $start = $row["StartDate"];
                              $end = $row["EndDate"];
                              $price = $row["TotalPrice"];
                              $paid = $row["Paid"];
                              $sttus = $row['Active'];
                              // echo "$sttus ";
                              if ($sttus == "active"){
                                $approved = "Active";
                             
                              }else{
                                $approved = "Cancelled";
                              }
                              
                              
                              //GEt the destination name
                              $dest_name = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$destination");
                              $row2 = mysqli_fetch_array($dest_name);
                              $destinationName = $row2["Name"];
                              $destImage =  $row2["ImageURL"];

                              //get the Hosting name
                              $host_name = mysqli_query($conn,"SELECT * FROM accomodation WHERE HostingID=$Hosting");
                              $row3 = mysqli_fetch_array($host_name);
                              $HostingName = $row3["Name"];

          

                              //get the user who has placed the booking
                              $user_name = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$Client");
                              $row4 = mysqli_fetch_array($user_name);
                              $UserName = $row4["Email"]; //use email as name


                              if($paid == 1){
                                $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'></i>";
                              }else{
                                $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'></i> ";
                              }
                              print "
                                    <td> ".$UserName ." </td>
                                    <td>
                                      <img src='assets/images/faces/face1.jpg' alt='image' />
                                      <span class='pl-2'>".$destinationName."</span>
                                    </td>
                                    <td> ".$HostingName." </td>
                                    <td>". $Type." (".$People." people) </td>
                                    <td> ".$start." </td>
                                    <td> ".$end." </td>
                                    <td> ". $price."</td>
                                    <td> ".$icon."</td>
                                    <td>
                                      <div class='badge badge-outline-success'>".$approved."</div>
                                    </td>
                                    <td>
                                      <a href='viewbooking.php?bookid=". urlencode($ID) ."' type='button' class='btn btn-info btn-rounded btn-fw'>View</a>
                                    </td>
                                    <td>
                                      <a href='createnotification.php?user=". urlencode($Client) ."' type='button' class='btn btn-info btn-rounded btn-fw'>Message Client</a>
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