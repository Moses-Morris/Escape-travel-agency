<?php
    include 'base.php';
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        
            <div class="card">
                <div class="row">
                <div class="col-md-12 grid-margin">



<div class="row col-md-12">
<div class="col-md-6 grid-margin transparent">
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Total Activities</p>
            <?php
                    // Ensure database connection exists
                    if (!isset($conn)) {
                        die("Database connection error.");
                    }

                    // Prepare the query to prevent SQL injection
                    $query = "SELECT COUNT(*) AS ActCount FROM activities WHERE AgentID=?";

                    $stmt = $conn->prepare($query);
                    if ($stmt === false) {
                        die("Query preparation failed: " . $conn->error);
                    }

                    $stmt->bind_param("s", $agentID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $value = 0; 

                    if ($row = $result->fetch_assoc()) {
                        $value = $row['ActCount'];
                    }

                    
                    echo "<p class='fs-30 mb-2'>$value</p>";
                    ?>

            <p>All My Created Activities</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-4">Approved Activities</p>
            <?php
                    // Ensure database connection exists
                    if (!isset($conn)) {
                        die("Database connection error.");
                    }

                    // Prepare the query to prevent SQL injection
                    $query = "SELECT COUNT(*) AS ActCount FROM activities WHERE AgentID=? AND Status='active'";

                    $stmt = $conn->prepare($query);
                    if ($stmt === false) {
                        die("Query preparation failed: " . $conn->error);
                    }

                    $stmt->bind_param("s", $agentID);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $value = 0; 

                    if ($row = $result->fetch_assoc()) {
                        $value = $row['ActCount'];
                    }

                    
                    echo "<p class='fs-30 mb-2'>$value</p>";
                    ?>
            <p>Active and Running Activities</p>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
  

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">All Activities</h4>
        <a href="createactivity.php" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Activity</a>
        </p>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Activity Name </th>
                
                <th> Description </th>
                
                <th> Price </th>
                <th> Duration </th>
                <th> Rating </th>
                <th> Destination Reference </th>
                <th> Date Created </th>
                <th> Status </th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <?php
                    $result = mysqli_query($conn,"SELECT * FROM activities WHERE AgentID=$agentID ORDER BY Created_at ASC");
                    while($row = mysqli_fetch_array($result)){
                    $id = $row["ActivityID"];
                    $Name = $row["Name"];
                    $desc = $row["Description"];
                    $img = $row["ImageURL"];
                    $amount = $row["Price"];
                    $dest = $row["DestinationID"];
                    $agent = $row["AgentID"];
                    $duration = $row["Duration"];
                    $status = $row["Status"];
                    $rating = $row['RatingAVG'];
                    $date = $row['Created_at'];
                    
                    if ($status == "active"){
                        $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Running</i>";
                        
                    }else{
                        $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
                    }

                    

                    //gET agent anme
                    $agents = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
                    $dd = mysqli_fetch_array($agents);
                    $getdd = $dd['CompanyName'];


                    //gET dest NAME
                    $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
                    $ddname = mysqli_fetch_array($destname);
                    $getddname = $ddname['Name'];

                    
                    
                    print "
                            
                            <td>
                            <img src=".$img." alt='image' />
                            <span class='pl-2'>".$Name."</span>
                            </td>
                            
                            
                            <td>". $desc."</td>
                            
                            <td> ".$amount ."</td>
                            <td> ".$duration."</td>
                            <td> ".$rating."</td>
                            <td> ".$getddname."</td>

                            
                            <td> ".$date."</td>
                            <td> ".$icon."</td>
                            
                            
                            <td>
                            <a href='viewactivity.php?actid=". urlencode($id) ."'' class='badge badge-outline-success'>View Activity</a>
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