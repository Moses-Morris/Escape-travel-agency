<?php
    include 'base.php';
?>
<?php
    $msg = " ";
    //get the id from url and payment
    if (isset($_GET['payid']) && filter_var($_GET['payid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['payid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>

<?php
    //get payment details
    $result = mysqli_query($conn,"SELECT * FROM Payments 
        WHERE  PaymentID=$id");
    while($row = mysqli_fetch_array($result)){
        $payid=$row['PaymentID'];
        $ID = $row["OrderNo"];
        $Names = $row["Name"];
        $user = $row["UserID"];
        $booking = $row["BookingID"];
        $amount = $row["Amount"];
        $method = $row["PayMethod"];
        $status = $row["Status"];
        $active = $row["Active"];
        $date = $row["TransactionDate"];
        $summary = $row["TransactionSummary"];
        $receipt = $row["Receipt"];
        //echo $status;
        if ($status == "active"){
            $tano = "Paid";
        } else{
            $tano = "Not Paid";
        }
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
    }
?>


<?php
    //Update or Deactivate Payments
    // Handle Form Actions
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['confirm'])) {
            $ppayid = $_POST['payid'];
            $porder = $_POST['order'];
            $tname = $_POST['name'];
            $puser = $_POST['user'];
            $pdestination = $_POST['destination'];
            $pamount = $_POST['amount'];
            $pmethod = $_POST['method'];
            $pstatus = $_POST['status'];
            $pactive = $_POST['active'];
            $pdate = $_POST['date'];
            $psummary = $_POST['summary'];
            $preceipt = $_POST['receipt'];
            
            if(empty($status) || empty($psummary) ){
                $msg = "Please Change this Values : Transaction Summary, Receipt and Status(Paid)";
            }
            //new status now
            $statusnew = "paid";
            $activenew = "active";
            $stmt1 = $conn->prepare("UPDATE payments SET OrderNo=?, Name=?,  Amount=?, PayMethod=?, Status=?, Active=? ,  TransactionSummary=?, Receipt=? WHERE PaymentID=? ");
           // $stmt1->bind_param("isisssssii", $porder, $tname, $pamount, $pmethod, $statusnew, $activenew, $psummary, $preceipt, $ppayid, $agentID);
            // 3. Bind parameters to the placeholders, in order
            $stmt1->bind_param("issssssss", 
                $porder,     // i: integer
                $tname,      // s: string
                $pamount,    // s: string (use "d" if numeric)
                $pmethod,    // s: string
                $statusnew,  // s: string
                $activenew,  // s: string
                $psummary,   // s: string
                $preceipt,   // s: string
                $ppayid,     // s: string (should be int?)
               // $agentID     // i: integer
            );
            if ($stmt1->execute()) {
                $msg = "<div class='alert alert-success'>Payment updated successfully. Payment Has been Confirmed. The destination should be Booked Successfully :: ".$nr3."  by ->  ".$UserName."</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
            }
            $stmt1->close();

            //Aso update booking details now
            $check = 1;
            $stmt2 = $conn->prepare("UPDATE bookings SET Paid=? WHERE BookingID=? ");
            $stmt2->bind_param("ss", $check, $booking);

            if ($stmt2->execute()) {
                $msg = "<div class='alert alert-success'>Booking Updated  successfully. Payment Has been Confirmed. The destination should be Booked Successfully :: ".$nr3."  by ->  ".$UserName."</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
            }

            $stmt2->close();

        }elseif (isset($_POST['deactivate'])) {
            //new status now
            $ppayid = $_POST['payid'];
            $statusnew = "unpaid";
            $activenew = "inactive";
            $receiptnew = "None";
            $summ="Pending confirmation";
            $stmt1 = $conn->prepare("UPDATE payments SET Status=?, Active=?, Receipt=?, TransactionSummary=? WHERE PaymentID=? ");
            /* 2. Check if the prepare() worked
            if (!$stmt1) {
                die("Prepare failed: " . $conn->error);
            }*/
            $stmt1->bind_param("ssssi",$statusnew, $activenew,  $receiptnew, $summ, $ppayid);
            /* 3. Bind parameters to the placeholders, in order
                $stmt1->bind_param("issssssss", 
                $porder,     // i: integer
                $tname,      // s: string
                $pamount,    // s: string (use "d" if numeric)
                $pmethod,    // s: string
                $statusnew,  // s: string
                $activenew,  // s: string
                $psummary,   // s: string
                $preceipt,   // s: string
                $ppayid,     // s: string (should be int?)
                //$agentID     // i: integer
                );
                */
            if ($stmt1->execute()) {
                $msg =  "<div class='alert alert-info'>Payment Rejected or Not Processed. Booking Not Approved Yet</div>";
            } else {
               $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt1->error . "</div>";
            }
            $stmt1->close();
            

            //Also Update Booking to Notpaid
            $check = 0;
            $stmt2 = $conn->prepare("UPDATE bookings SET Paid=? WHERE BookingID=? ");
            $stmt2->bind_param("ss", $check, $booking);

            if ($stmt2->execute()) {
                $msg = "<div class='alert alert-success'>Booking Suspended  successfully. Payment Has been Rejected or Cancelled. The Booking Confirmation Should be Checked :: ".$nr3."  by ->  ".$UserName."</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Update failed: {$stmt2->error}</div>";
            }

            $stmt2->close();
        
        } else {
            $msg =   "<div class='alert alert-danger'>Failed: " . $stmt1->error . "</div>";
        }
        //$stmt1->close();
        //$stmt2->close();
}
    
      
  
?>
<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="row">

            <style>
                .form-control{
                    font-weight: bold;
                    font-size: 600;
                }
            </style>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Payment Details</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?payid=' . $payid; ?>" method="post" >
                    <?php
                        if($msg){
                            echo $msg;
                        }
                    ?>
                    
                    <input type="number" class="form-control" name="payid" value="<?php echo $payid; ?>" hidden>     
                      <div class="form-group">
                        <label for="">Order Number</label>
                        <input type="text" class="form-control" name="order" value="<?php echo $ID; ?>" >
                      </div>
                      <div class="form-group">
                        <label for="">Transaction Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $Names; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">User</label>
                        <input type="email" class="form-control" name="user" value="<?php echo $UserName; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Booked Destination</label>
                        <input type="text" class="form-control"name="destination" value="<?php echo $nr3; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount" value="<?php echo $amount; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Payment Method</label>
                        <input type="text" class="form-control" name="method" value="<?php echo $method; ?>">
                      </div>
                      
                    
                    
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">.</h4>
                            
                            <div class="form-group">
                                <label for="">Status : Paid or Unpaid</label>
                                <input type="text" class="form-control" name="status" value="<?php echo $tano; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Transaction Status (Is transaction Valid)</label>
                                <input type="text" class="form-control" name="active" value="<?php echo $active; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Transaction Date</label>
                                <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Transaction Summary</label>
                                <input  list="summarys" id="summary" type="text" class="form-control" name="summary" placeholder="<?php echo $summary; ?>">
                                <datalist id="summarys">
                                    <option value="Payment successful">Payment successful</option>
                                    <option value="Pending confirmation">Pending confirmation</option>
                                    <option value="Transaction completed">Transaction completed</option>
                                    <option value="Payment processed">Payment processed</option>
                                    <option value="Awaiting clearance">Awaiting clearance</option>
                                    <option value="Confirmed on blockchain">Confirmed on blockchain</option>
                                    <option value="Success">Success</option>
                                    <option value="Pending approval">Pending approval</option>
                                    <option value="Transaction cleared">Transaction cleared</option>
                                    <option value="Processed successfully">Processed successfully</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="">Receipt Number or Details</label>
                                <input type="text" class="form-control" name="receipt" value="<?php echo $receipt; ?>">
                                <small>Input receipt or transaction number for easier future reference and verification.</small>
                            </div>

                            
                            
                            <div class="form-group">
                            <p>- You can update the Payment details : Transaction Summary, Status to Paid and Active or Not; -</p>
                            <p>- Deactivate the Payment if you do not wish to proceed with the request or refund the payment or not recieved-</p>
                                <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="confirm">Confirm Paid</button>
                                <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="deactivate">Deactivate/Cancel</button>
                                
                                </div>
                            
                    </form>
                    
                  </div>
                </div>
              </div>
                    </div>
<?php
    include 'footer.php';
?>