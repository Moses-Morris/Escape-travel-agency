

<?php
    include 'base.php';
    include_once 'config/connection.php';
    $apiKey = "dead49bebc88a9825ace67e93a79efe5"; // Replace this with your actual key
    



    function getUserIP() {
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          return $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          return $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
          return $_SERVER['REMOTE_ADDR'];
      }
  }
  
  $userIP = getUserIP();
  //echo "User IP Address: " . $userIP;
  
    //echo $getdd;
?>      

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome <b><?php echo $Company ?></b></h3>
            
          </div>
                  <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                      <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <i class="mdi mdi-calendar"></i> Today (10 Jan 2021) </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                          <a class="dropdown-item" href="#">January - March</a>
                          <a class="dropdown-item" href="#">March - June</a>
                          <a class="dropdown-item" href="#">June - August</a>
                          <a class="dropdown-item" href="#">August - November</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="assets/images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                      <div class="d-flex">
                        <?php
                          
                          /*
                          $ip = getUserIP();
                          $geoAPI = "http://ip-api.com/json/{$ip}";
                          $geoData = json_decode(file_get_contents($geoAPI), true);
                          
                          if ($geoData['status'] === 'success') {
                              $city = $geoData['city'];
                              $country = $geoData['country'];
                              $lat = $geoData['lat'];
                              $lon = $geoData['lon'];
                          
                              echo "Location: $city, $country<br>";
                              echo "Latitude: $lat, Longitude: $lon<br>";
                          
                              // Fetch Weather Data
                              // Replace with your OpenWeatherMap API key
                              $weatherAPI = "http://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$apiKey}&units=metric";
                              $weatherData = json_decode(file_get_contents($weatherAPI), true);
                          
                              if ($weatherData) {
                                  $temperature = $weatherData['main']['temp'];
                                  $weather = $weatherData['weather'][0]['description'];
                                  $humidity = $weatherData['main']['humidity'];
                          
                                  echo "Weather: $weather<br>";
                                  echo "Temperature: $temperature°C<br>";
                                  echo "Humidity: $humidity%";
                              } else {
                                  echo "Unable to fetch weather data.";
                              }
                          } else {
                              echo "Unable to fetch location.";
                          }
                          */
                        ?>
                        <div>
                          <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>31<sup>C</sup></h2>
                        </div>
                        <div class="ms-2">
                          <h4 class="location font-weight-normal">Chicago</h4>
                          <h6 class="font-weight-normal">Illinois</h6>
                        </div>
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

                        
                        <p class="fs-30 mb-2"></p>
                        <p>In 24 hours</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
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

                                $value = 0; // Default value

                                if ($row = $result->fetch_assoc()) {
                                    $value = $row['DestCount'];
                                }

                                // Print the count
                                echo "<p class='fs-30 mb-2'>$value</p>";
                                ?>

                        <p>My Created Destinations</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Paid Amount Bookings</p>
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
                        
                        <p>Paid Destinations Bookings</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Number of Destination Events</p>
                        <?php
                            $agents = mysqli_query($conn,"SELECT COUNT(*) FROM  Events WHERE AgentID=$agentID ");
                            $r = mysqli_fetch_row($agents);
                            $nr = $r[0];
                            //echo "$Company";
                            // Print the count
                            echo "<p class='fs-30 mb-2'>$nr</p>";
                        ?>
                        <p>Destinations with Events</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>





<?php
    include 'footer.php';
?>