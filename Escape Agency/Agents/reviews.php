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


            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">My Reviews</h4>
                    
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> User </th>
                            <th> Destination </th>
                            <th> Rating </th>
                            <th> Comment </th>
                            <th> Date </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php
                                       

                                $result = mysqli_query($conn,"SELECT * FROM Reviews b
                                                                                        JOIN Destinations d ON b.DestinationID = d.DestinationID 
                                                                                        JOIN Agents a ON d.AgentID = a.AgentID
                                                                                        WHERE a.AgentID = $agentID  ");
                                while($row = mysqli_fetch_array($result)){
                                    $user = $row["UserID"];
                                    $dest = $row["DestinationID"];
                                    $rating = $row["RatingAVG"];
                                    $cmt = $row["ReviewComment"];
                                    $date = $row["Created_at"];
                                            
                                    //Get destination through destinations
                                    $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                                    $r3 = mysqli_fetch_array($dest);
                                    $nr3 = $r3["Name"];

                                    //Get destination through destinations
                                    $user = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$user ");
                                    $r4 = mysqli_fetch_array($user);
                                    $nr4 = $r4["Email"];

                                     
                                            print "
                                                
                                                <td> ". $nr4."</td>
                                                <td> ". $nr3."</td>
                                                
                                                <td> ".$rating."</td>
                                                <td> ". $cmt."</td>
                                                
                                                 <td> ".$date."</td>
                                                
                                               
                                                </tr>
                                                ";



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