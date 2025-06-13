<?php
    include 'base.php';
?>
<?php
    $msg = "";
    //get the id from url and payment
    if (isset($_GET['adid']) && filter_var($_GET['adid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['adid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>

<?php
//The details of Discounted Ads
  $today = date('Y-m-d');

  $result = mysqli_query($conn,"SELECT * FROM Discounts
                                                          WHERE AgentID = $agentID  ");
  
  while($row = mysqli_fetch_array($result)){
      $ID = $row["DiscountID"];
      $name = $row["DiscountName"];
      $dest = $row["DestinationID"];
      $code = $row["Code"];
      $desc = $row["Description"];
      $discount = $row["Discount"];
      $active = $row["Status"];
      $Sdate = $row['StartDate'];
      $Edate = $row['EndDate'];
      $num = $row['NumOfCodes'];
      $date = $row["Created_at"];
      
      if ($Edate > $today){
        $it = "Running";
      }else{
        $it = "Over/Ended";
      }

      if ($active == "active"){
          $icon = "Approved and Running";
          $todobutton = "<button type='submit' class='btn btn-primary btn-rounded btn-fw me-2' name='deactivate'>Deactivate</button>";
      }else{
          $icon = "Not approved";
          $todobutton = "<button type='submit' class='btn btn-primary btn-rounded btn-fw me-2' name='activate'>Activate</button>";
      }   


      
        //Get destination through destinations
        $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
        $r3 = mysqli_fetch_array($dest);
        $nr3 = $r3["Name"];
  }
?>
<?php
//Actions on the Discounts
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['update'])) {
      $name = $_POST['discount'];
      $desc = $_POST['description'];
      $disamnt = $_POST['discountamt'];
      $code = $_POST['code'];
      $start = $_POST['start'];
      $end = $_POST['end'];
      $destination = $_POST['destination'];
      $status= $_POST['icon'];
      $numv = $_POST['numv'];
      $date = $_POST['date'];
     
      
      $stmt = $conn->prepare("UPDATE discounts SET Code=?,  Description=?,  Discount=?, DiscountName=?, StartDate=?, EndDate=? , NumOfCodes=?
               WHERE DiscountID=? AND AgentID=$agentID");
      $stmt->bind_param("ssssssii", $code, $desc, $disamnt,  $name, $start, $end, $numv, $id);
        
      
      if ($stmt->execute()) {
          $msg = "<div class='alert alert-success'>Discount updated successfully.</div>";
          
      } else {
          $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
      }
      $stmt->close();
        /*}*/

      } elseif (isset($_POST['deactivate'])) {
          $stmt = $conn->prepare("UPDATE discounts SET Status = 'inactive' WHERE DiscountID = ?  AND AgentID=$agentID");
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              $msg =  "<div class='alert alert-info'>Discount deactivated. It can no longer be used and is not active.</div>";
          } else {
             $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
          }
          $stmt->close();
      } elseif (isset($_POST['activate'])) {

        $stmt = $conn->prepare("UPDATE discounts SET Status = 'active' WHERE DiscountID = ?  AND AgentID=$agentID");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $msg =  "<div class='alert alert-info'>Discount Activated. It is running Succesfully.</div>";
        } else {
           $msg =   "<div class='alert alert-danger'>Failed to Activate: " . $stmt->error . "</div>";
        }
        $stmt->close();
      
      
      
      }elseif (isset($_POST['delete'])) {
        $deleted_on =   date('Y-m-d H:i');
        $stmt = $conn->prepare("UPDATE discounts SET Deleted='$deleted_on' WHERE DiscountID = ?  AND AgentID=$agentID");
          $stmt->bind_param("i", $id);
          if ($stmt->execute()) {
              $msg =  "<div class='alert alert-info'>Discount deleted. It can no longer be used and is not visible to the client.</div>";
          } else {
             $msg =   "<div class='alert alert-danger'>Failed to delete: " . $stmt->error . "</div>";
          }
          $stmt->close();
      }
    }



?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="discounts.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Discounts</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Discount Details</h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?adid=' . $id; ?>" method="post" enctype="multipart/form-data">
                      <?php
                          //get the id from url and
                          if (isset($_GET['adid']) && filter_var($_GET['adid'], FILTER_VALIDATE_INT)) {
                              $id = $_GET['adid'];
                              //echo "Received ID: " . htmlspecialchars($id);
                          } else {
                              echo "Invalid ID!";
                          }

                      ?>

                      <?php
                          if($msg){
                            print $msg;
                          }
                      ?>
                        <style> 
                            .form-group input{
                            font-weight:900;
                            font-size: medium;
                            }
                      </style>
                      <div class="form-group">
                        <label for="Booked Destination">Discount Name</label>
                        <input type="text" class="form-control" name="discount" value="<?php echo $name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $desc; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Destination</label>
                        <input type="text" class="form-control"name="destination" value="<?php echo $nr3; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Discount Amount : Format -> e.g 20%</label>
                        <input type="text" class="form-control" name="discountamt" value="<?php echo $discount; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Discount Voucher Code</label>
                        <input type="text" class="form-control" name="code" value="<?php echo $code; ?>">
                      </div>
                      
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Starting On Date</label>
                        <input type="text" class="form-control" name="start" value="<?php echo $Sdate; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Ending On Date</label>
                        <input type="text" class="form-control" name="end" value="<?php echo $Edate; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Approved  By Admin </label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Number of Voucher Codes</label>
                        <input type="text" class="form-control"  name="numv" value="<?php echo $num; ?> ">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
                      </div>
                     
                      
                      <div class="form-group">
                      <p>- You can update the Discount details -</p>
                      <p>- Deactivate the Discount if you do not wish to proceed with the discount -</p>
                      <p>- Delete the Discount if you do not wish to proceed with the discount. Remember this allows to make discounts on specific destinations. -</p>
                        <button type="submit" class="btn btn-success btn-rounded btn-fw me-2"  name="update">Update</button>
                        <?php
                            echo $todobutton;
                        ?>
                        <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="delete">Delete</button>
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>




<?php
    include 'footer.php';
?>