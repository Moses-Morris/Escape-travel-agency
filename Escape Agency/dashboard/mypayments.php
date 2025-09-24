<?php
    include 'base.php';
    $userid = $_SESSION['user_id'];
?>
            <aside class="dashboard-content">
                <div>
                    <h5>My Payments and Destinations Paid <i class="fa chevron-right"></i></h5>
                </div>

                <section>
                  <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th> OrderNo </th>
                            
                            <th> PayName </th>
                            <th> Destination </th>
                            <th> Amount </th>
                            <th> Payment Method </th>
                            <th> Date </th>
                            <th> Status </th>
                            <th> Option </th>
                            <th> Transaction Summary </th>
                            <th> Paid </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                  <?php
                  $result = mysqli_query($conn,"SELECT * FROM Payments WHERE  UserID=$userid ");
                                        while($row = mysqli_fetch_array($result)){
                                            $payid=$row['PaymentID'];
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
                                            //echo $status;
                                            if ($status=="active"){
                                                $tano = "Paid";
                                                $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>". $tano."</i> ";
                                            } else{
                                                $tano = "Not Paid";
                                                $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>". $tano."</i> ";
                                            }
                                                //get the user who has placed the booking
                                

                                            //Get booking
                                            $book = mysqli_query($conn,"SELECT * FROM bookings WHERE BookingID=$booking ");
                                            $r2 = mysqli_fetch_array($book);
                                            $nr2 = $r2["DestinationID"];
                                    
                                            //Get destination through booking
                                            $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$nr2 ");
                                            $r3 = mysqli_fetch_array($dest);
                                            $nr3 = $r3["Name"];
                                          }

                                          print "
                                                 <td> ".$ID ."</td>
                                                
                                                <td> ".$Name."</td>
                                                <td> ".$nr3."</td>
                                                <td> ".$amount."</td>
                                                <td> ".$method."</td>
                                                <td> ".$date."</td>
                                                <td> ". $status."</td>
                                                <td> ".$active."</td>
                                                
                                                <td> ".$summary."</td>
                                                <td> Cleared</td>
                                                ";

                  ?>
                    
                            
                          </tr>
                          
                          
                        </tbody>
                      </table>
                    </div>
                </section>

            </aside>
        </article>
    </main>










<?php
    include 'footer.php';
?>
      