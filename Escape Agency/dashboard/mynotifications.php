<?php
    include 'base.php';
    $userid = $_SESSION['user_id'];
?>
            <aside class="dashboard-content profile">
                <div>
                    <h5>My Notifications <i class="fa chevron-right"></i></h5>
                </div>

                <section>
                    <div class="notifications-card">
                        <!--div class="notifying-users-cards">
                            <div class="notifying-user">
                                <div class="notifying-user-img">
                                    <img src="../media/pexels-chanwalrus-958545.jpg" alt="">
                                </div>
                                <div class="notifying-user-data">
                                    <p>Travel Agent</p>
                                </div>
                            </div>
                            <div class="notifying-user">
                                <div class="notifying-user-img">
                                    <img src="../media/pexels-chanwalrus-958545.jpg" alt="">
                                </div>
                                <div class="notifying-user-data">
                                    <p>Travel Agent</p>
                                </div>
                            </div>
                            <div class="notifying-user">
                                <div class="notifying-user-img">
                                    <img src="../media/pexels-chanwalrus-958545.jpg" alt="">
                                </div>
                                <div class="notifying-user-data">
                                    <p>Travel Agent</p>
                                </div>
                            </div>
                        </div-->
                        <div class="notification-message">
                            <table class="table table-striped">
                        <thead>
                          <tr>
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
                                                                                                WHERE UserID = $userid  ");
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
                                               
                                                
                                                
                                                <td> ".$message."</td>
                                                <br>
                                                <td> ".$type."</td>
                                                
                                                <td> ".$active."</td>
                                                <td> ".$Sdate."</td>
                                                <td> ".$option."</td> 
                                                <td> ".$lost."</td>
                                               
                                                
                                                </tr>
                                                
                                                ";
                                                



                                      };

                                    ?><hr>
                        </tbody>
                                    </table>
                            
                        </div>
                    </div>
                </section>

            </aside>
        </article>
    </main>


<?php
    include 'footer.php';
?>



