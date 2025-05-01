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
                    <h4 class="card-title">Notifications To Users</h4>
                    <a href="createnotification.php" type="button" class="btn btn-primary btn-rounded btn-fw">Create new Notification</a>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> Image </th>
                            <th> User </th>
                            <th> Message </th>
                            <th> Type </th>
                          
                            <th> Active </th>
                            
                            <th> Date </th>
                            <th> Options </th>
                            <th> Delivered </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php


                                       $result = mysqli_query($conn,"SELECT * FROM Notifications
                                                                                                WHERE AgentID = $agentID  ");
                                        while($row = mysqli_fetch_array($result)){
                                            $notid = $row["NotificationID"];
                                            $user = $row["UserID"];
                                            $message = $row["Message"];
                                            $type = $row["Type"];
                                            $status = $row["Urgency"];
                                            $active = $row["Status"];
                                            $del = $row["active"];
                                            $Sdate = $row["Created_at"];
                                            if ($status == 0){
                                                $option = "Message";
                                            } else if($status == 1){
                                                $option = "Not Urgent";
                                            } else{
                                                $option = "Urgent";
                                            }

                                            //Check if message is being delivered to user
                                            if ($del == 0){
                                              $lost = "Deleted/deactivated";
                                          
                                          } else{
                                            $lost = "Already Delivered";
                                          }
                                        
                                    
                                    
                                            //Get User Details
                                            $user = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$user ");
                                            $r3 = mysqli_fetch_array($user);
                                            $nr3 = $r3["Email"];
                                            $nr4 = $r3["ProfileImg"];

                                     
                                            print "
                                                <td class='py-1'>
                                                    <img src=".$nr4." alt=".$nr4." />
                                                </td>
                                                
                                                <td> ". $nr3."</td>
                                                <td> ".$message."</td>
                                                <td> ".$type."</td>
                                                
                                                <td> ".$active."</td>
                                                <td> ".$Sdate."</td>
                                                <td> ".$option."</td>
                                                <td> ".$lost."</td>
                                               
                                                <td>
                                                      <a href='seennotification.php?i=".urlencode($notid)." type='button' class='btn btn-primary btn-rounded btn-fw'>Seen</a>
                                                </td>
                                                 <td>
                                                      <a href='deletenotification.php?i=".urlencode($notid)." type='button' class='btn btn-danger btn-rounded btn-fw'>Delete </a>
                                                </td>
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