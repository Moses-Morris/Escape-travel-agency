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
                    <h4 class="card-title">Payments</h4>
                  
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> OrderNo </th>
                            
                            <th> ClientName </th>
                            <th> Destination </th>
                            <th> Amount </th>
                            <th> Payment Method </th>
                            <th> Date </th>
                            <th> Status </th>
                            <th> Option </th>
                            <th> Transaction Summary </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          <?php


                                       $result = mysqli_query($conn,"SELECT * FROM Payments b
                                                                                                JOIN Bookings c ON b.BookingID = c.BookingID
                                                                                                JOIN Destinations d ON c.DestinationID = d.DestinationID 
                                                                                                JOIN Agents a ON d.AgentID = a.AgentID
                                                                                                WHERE a.AgentID = $agentID  ");
                                        while($row = mysqli_fetch_array($result)){
                                            $ID = $row["OrderNo"];
                                            $Name = $row["Name"];
                                            $user = $row["UserID"];
                                            $booking = $row["BookingID"];
                                            $amount = $row["Amount"];
                                            $method = $row["PayMethod"];
                                            $status = $row["Status"];
                                            $active = $row["Active"];
                                            $date = $row["TransactionDate"];
                                            $summary = $row["TransactionSummary"];
                                            
                                        
                                                //get the user who has placed the booking
                                            $username = mysqli_query($conn,"SELECT * FROM users WHERE UserID=$user");
                                            $row5 = mysqli_fetch_array($username);
                                            $UserName = $row5["Email"]; //use email as name

                                            //Get booking
                                            $book = mysqli_query($conn,"SELECT * FROM bookings WHERE BookingID=$booking ");
                                            $r2 = mysqli_fetch_array($book);
                                            $nr2 = $r2["DestinationID"];
                                    
                                            //Get destination through booking
                                            $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$nr2 ");
                                            $r3 = mysqli_fetch_array($dest);
                                            $nr3 = $r3["Name"];

                                     
                                            print "
                                                 <td> ".$ID ."</td>
                                                
                                                <td> ".$UserName."</td>
                                                <td> ".$nr3."</td>
                                                <td> ".$amount."</td>
                                                <td> ".$method."</td>
                                                <td> ".$date."</td>
                                                <td> ". $status."</td>
                                                <td> ".$active."</td>
                                                <td> ".$summary."</td>
                                                <td>
                                                      <a href='' type='button' class='btn btn-primary btn-rounded btn-fw'>Confirm</a>
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