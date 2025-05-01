<?php
    include 'base.php';
?>
<?php
 $msg = " ";
$email = " ";
 //get the id from url and
   if (isset($_GET['user']) && filter_var($_GET['user'], FILTER_VALIDATE_INT)) {
       $user = $_GET['user'];
       //echo "Received ID: " . htmlspecialchars($user);
       $sqlquery11 = "SELECT Email FROM users WHERE UserID = '$user'";
        $result = mysqli_query($conn, $sqlquery11);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $email = $row['Email'];  // Extract the actual email
            //echo $email;  // ✅ Now it's safe to echo
        } else {
            echo "No user found with that ID.";
        }
   } /*else{
     echo "Invalid";
   }*/
?>
<?php
   //Create a Notification
   $msg = "";
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])) {
      
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $message = mysqli_real_escape_string($conn,$_POST['message']);
        $type = mysqli_real_escape_string($conn,$_POST['type']);
        $urgent = mysqli_real_escape_string($conn,$_POST['urgent']);
        $active = 1;
        $state = "unread";
       
        // $agentType - the variable with type of agent getting the property
        $date =  date('Y-m-d H:i');
        $sqlquery22 = "SELECT UserID FROM users WHERE Email = '$email'";
        $result = mysqli_query($conn, $sqlquery22);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id = $row['UserID'];  
        } else {
            echo "No user found with that Email.";
        }
         
          $stmt = $conn->prepare("INSERT INTO notifications (UserID, Message, Type, Status, Created_at, AgentID, Urgency, active)  
          VALUES (?,?,?,?,?,?,?,?)" );
          $stmt->bind_param("issssiss", $id, $message, $type, $state, $date, $agentID, $urgent, $active );
          if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Message/Notification Created Successfully. Proceeding to All Notifications
                          </div>";
            echo "<script>
                          setTimeout(function() {
                              window.location.href = 'notifications.php';
                          }, 3000);
                        </script>";
            //header("Refresh:2; url=destinations.php");
            exit;
          }else{
            $msg =   "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
          }
         
        $stmt->close();
        //mysqli_close($conn);
        }
   }

?>

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="row">

            
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create A New Notification To Your Users
                    </h4>
                    <p>Notify about their Bookings.</p>
                    <p>Respond To their Queries</p>
                    <hr>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        <?php
                               if($msg){
                                print $msg;
                               }
                        ?>
                        
                      </style>
                      
                      <div class="form-group">
                        <label for="">User Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email ; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Message</label>
                        <input type="text" class="form-control" name="message" >
                      </div>
                      
                      <div class="form-group">
                        <label for="">Type of Message</label>
                        <input list="type" type="text" class="form-control" name="type" >
                            <datalist id="type">
                                <option value="alert">Alert</option>
                                <option value="promo">Promotion</option>
                                <option value="feedback">Feedback</option>
                                <option value="question">Question</option>
                            </datalist list=type>
                      </div>
                      <div class="form-group">
                        <label for="">Is It Urgent?</label>
                        <input list="urgent" type="text" class="form-control" name="urgent" >
                            <datalist id="urgent">
                                <option value="0">Not Urgent</option>
                                <option value="1">Inbox</option>
                                <option value="2">Very Urgent</option>
                                <option value="3">Needs Attention</option>
                                <option value="4">Expired</option>
                            </datalist list=type>
                      </div>
                     
                      

                     
                      
                      <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="submit" onclick="return confirm('Are the Details correct? Review. If Okay, Proceed');">Create</button>
                        <p>- Create a new destination. -</p>
                        <p>- You should not have empty fields. -</p>
                        <p>- Wait For it to be approved by The Escape Agency Admin. -</p>
                        
                     
                    </form>
                    
                  </div>
                </div>
              </div>
             
                      
                        
                        
                    
                  </div>
                </div>
              </div>





<?php
    include 'footer.php';
?>