

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
                              //echo  $Company;
                              $agents = mysqli_query($conn, "SELECT * FROM Agents WHERE CompanyName='$Company'" );
                              $dd = mysqli_fetch_array($agents);
                              $getdd = $dd['AgentID'];
                              //echo $getdd;
                                /*
                              $result = mysqli_query($conn,"SELECT * FROM destinations WHERE AgentID=$getdd ORDER BY Created_at DESC");
                              while($row = mysqli_fetch_array($result)){
                                 $id = $row["DestinationID"];
                                  
                                 echo "bally".$id;
                                 $sql ="SELECT COUNT(*) FROM bookings WHERE  DestinationID=$id";
                                 $result = mysqli_query($conn,$sql);
                                 $num = $result[0];
                                 
                                 $count += $num;
                                 print "<p class='fs-30 mb-2'>$count</p>";
                              }
                              
*/
                              
                            ?>
                        <p class="fs-30 mb-2"></p>
                        <p>10.00% (30 days)</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Total Destinations</p>
                        <?php
                                  $agent = mysqli_query($conn, "SELECT * FROM Agents WHERE CompanyName='$Company'" );
                                  $dd = mysqli_fetch_array($agent);
                                  $getdd = $dd['AgentID'];

                                  $dest = mysqli_query($conn,"SELECT COUNT(*) FROM  destinations WHERE AgentID=$getdd");
                                  $r = mysqli_fetch_row($dest);
                                  $num = $r[0];
                                 
                               
                                 print "<p class='fs-30 mb-2'>$num</p>";
                              
                              

                              
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
                        <p class="mb-4">Number of Meetings</p>
                        <p class="fs-30 mb-2">34040</p>
                        <p>2.00% (30 days)</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Number of Clients</p>
                        <p class="fs-30 mb-2">47033</p>
                        <p>0.22% (30 days)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>





<?php
    include 'footer.php';
?>