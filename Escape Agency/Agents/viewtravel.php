<?php
    include 'base.php';
?>
<?php
 $msg="";
    //get the id from url and
    if (isset($_GET['travelid']) && filter_var($_GET['travelid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['travelid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }
?>
<?php
                                      
$result = mysqli_query($conn,"SELECT * FROM traveloptions WHERE AgentID=$agentID AND TravelID=$id");
while($row = mysqli_fetch_array($result)){
    $id = $row["TravelID"];
    $book = $row["BookingID"];
    $dest = $row["DestinationID"];
    $date = $row["Created_at"];
    $agent = $row["AgentID"];
    $status = $row["Status"];
    $mode = $row["TravelMode"];
    $details = $row["Details"];
    $price = $row["Prices"];



    if ($status == 'active'){
        $icon = "<i class='mdi mdi-check-circle  text-primary ml-auto'>Active</i>";
        $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Deactivate</a>";
    }else{
        $icon = "<i class='mdi mdi-window-close  text-primary ml-auto'>Inactive</i> ";
        $button = "<a href='./deactivy.php' class='badge badge-outline-success'>Activate</a>";
    }




    //gET dest NAME
    $destname = mysqli_query($conn, "SELECT * FROM destinations WHERE DestinationID = $dest");
    $ddname = mysqli_fetch_array($destname);
    $getddname = $ddname['Name'];
    $getddimage = $ddname['ImageURL'];


    //gET agent anme
    $agent = mysqli_query($conn, "SELECT * FROM agents WHERE AgentID = $agent");
    $dd = mysqli_fetch_array($agent);
    $getddn = $dd['CompanyName'];

    if (($getddn == "") || ($agent == "0")){
    $company = "Escape Agency";
    } else{
    $company = $getddn;
    }


    //Get booking details
    $bookings = mysqli_query($conn, "SELECT * FROM bookings WHERE BookingID = $book");
    $ff = mysqli_fetch_array($bookings);
    $getuser = $ff['UserID'];
    $getDate = $ff['Created_at'];
    // = $getuser." on ".$getDate;

    //get user
    $users = mysqli_query($conn, "SELECT * FROM users WHERE UserID = $getuser");
    $dd = mysqli_fetch_array($users);
    $getdd = $dd['Email'];
    $getbookingdetails = "Booked by ".$getdd." on ->".$getDate;
}
?>
<?php
//Actions on Travel Options
 // Handle Form Actions
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['update'])) {
    $travelid = mysqli_real_escape_string($conn,$_POST['travelid']);
    $mode = mysqli_real_escape_string($conn,$_POST['mode']);
    $details = mysqli_real_escape_string($conn,$_POST['details']);
    $destination = mysqli_real_escape_string($conn,$_POST['destination']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    //$booking = mysqli_real_escape_string($conn,$_POST['booking']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $Cdate =  mysqli_real_escape_string($conn,$_POST['date']);
    
    $stmt = $conn->prepare("UPDATE traveloptions SET TravelMode=?, Details=?,  Prices=?, Status=?, DestinationID=?, Created_at=? WHERE TravelID=? ");
    $stmt->bind_param("sssssss", $mode, $details,  $price, $status,  $destination,$Cdate, $travelid);

    if ($stmt->execute()) {
        $msg = "<div class='alert alert-success'>Travel Option updated successfully.</div>";
        
    } else {
        $msg = "<div class='alert alert-danger'>Update failed: {$stmt->error}</div>";
    }

    $stmt->close();
    }

    
           

       
    }elseif (isset($_POST['deactivate'])) {
      $stmt = $conn->prepare("UPDATE traveloptions SET Status = 'inactive' WHERE TravelID = ?  AND AgentID=$agentID");
      $stmt->bind_param("i", $travelid);
      if ($stmt->execute()) {
          $msg =  "<div class='alert alert-info'>Travel Option deactivated.</div>";
      } else {
         $msg =   "<div class='alert alert-danger'>Failed to deactivate: " . $stmt->error . "</div>";
      }
      $stmt->close();
  } elseif (isset($_POST['delete'])) {
      $stmt = $conn->prepare("DELETE FROM traveloptions WHERE TravelID = ? AND AgentID=$agentID" );
      $stmt->bind_param("i", $travelid);
      if ($stmt->execute()) {
          echo "<div class='col-md-6 d-flex '>
                      Travel Option Deleted Sucessfully
                          ";

                          echo "<script>
                          setTimeout(function() {
                              window.location.href = 'listings.php#travel';
                          }, 3000);
                        </script>";
          exit;
      } else {
        $msg =   "<div class='alert alert-danger'>Delete failed: " . $stmt->error . "</div>";
      }
      $stmt->close();
  }

?>

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="listings.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Listings</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Travel Option Details</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?travelid=' . $id; ?>" method="post" enctype="multipart/form-data">
                      <?php
                       
                          if($msg){
                            print $msg;
                          }
                          echo $icon ;
                      ?>
                        <hr>
                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                      </style>
                   
                      <input type="text" class="form-control" name="travelid" value="<?php echo $travelid; ?>" hidden>
                      
                      <div class="form-group">
                        <label for="">Travel Mode Name</label>
                        <input type="text" class="form-control" name="mode" value="<?php echo $mode; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Details</label>
                        <input type="text" class="form-control" name="details" value="<?php echo $details; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Destination : <?php echo  $getddname; ?>  </label>
                        <input type="text" class="form-control" name="destination" value="<?php echo  $dest; ?>"  >
                      </div>
                      <!--div class="form-group">
                        <label for="">Booking Details : </label>
                        <input type="text" class="form-control" name="booking" value="">
                      </div-->
                      
                      <div class="form-group">
                        <label for="">Is this Travel option Running?</label>
                        <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
                      </div>
                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control"name="price" value="<?php echo $price; ?> ">
                      </div>
                     
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
                      </div>
                      <div class="form-group">
                      <p>- You can update the destination details -</p>
                      <p>- Deactivate the Destination if you do not wish to proceed with the request -</p>
                      
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="update">Update</button>
                        <button type="submit" class="btn btn-danger btn-rounded btn-fw me-2" name="deactivate">Deactivate</button>
                        
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>




<?php
    include 'footer.php';
?>