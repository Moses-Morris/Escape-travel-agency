<?php
    include 'base.php';
?>

<?php
    //Create an Event
    //echo $agentID;
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])) {
      
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $desc = mysqli_real_escape_string($conn,$_POST['desc']);
        $destination = mysqli_real_escape_string($conn,$_POST['destination']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $duration = mysqli_real_escape_string($conn,$_POST['duration']);
        //$img = $_POST['img'];

        
        $target_file = null;
       
        if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            $filetype = mime_content_type($_FILES['img']['tmp_name']);

            if (!in_array($filetype, $allowed)) {
                die("<div class='alert alert-warning'>Invalid image format. Use jpg, png, or gif.</div>");
            }

            $filename = uniqid() . '_' . basename($_FILES['img']['name']);
            $target_file = "uploads/" . $filename;

            if (!move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                die("<div class='alert alert-warning'>Image upload failed.</div>");
            }
        }

        $msg = "";
        $state = "OK";
        $rating = 0;
        $status = "active";
        
        $date =  date('Y-m-d H:i');
        //echo $name.$desc.$destination.$location.$country.$price.$tag.$activities.$end.$start.$target_file.$rating.$status.$likes.$date;   
        if (empty($name) || empty($desc) || empty($duration) || empty($price)  || empty($destination)){
          $msg = "<div class='alert alert-danger'>Do not send empty fields: </div>";
          //$state= "NOTOK";
        } else{
          //$stmt = "INSERT INTO destinations ( Name, Description, Location, Country,   Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at, ImageURL)  VALUES
          //('$name', '$desc', '$location', '$country', '$price', '$rating', '$rating', '$rating', '$activities', '$travel', '$dist', '$agentID',  '$status', '$date', '$target_file')";
          //$stmt->bind_params();
          $stmt = $conn->prepare("INSERT INTO Events (Name, Description, Price,  ImageURL, RatingAVG, Duration, Status, Created_at, DestinationID, AgentID)  
          VALUES (?,?,?,?,?,?,?,?,?,?)" );
          $stmt->bind_param("ssssssssss", $name, $desc,  $price, $target_file, $rating, $duration,$status, $date, $destination, $agentID);
          if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Activity Created Successfully. Proceeding to All Events
                          </div>";
            echo "<script>
                          setTimeout(function() {
                              window.location.href = 'activities.php';
                          }, 3000);
                        </script>";
            //header("Refresh:2; url=destinations.php");
            exit;
          }else{
            $msg =   "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
          }

        }

        mysqli_close($conn);
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
                    <h4 class="card-title">Create A New Activity</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        </style>
                        <div class="form-group ">
                        <label for="">Activity Image</label>
                        <input type="file" class="form-control" name="img" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                       </div>
                      <div class="form-group">
                        <label for="Activity">Activity Name</label>
                        <input type="text" class="form-control" name="name" >
                      </div>
                      <div class="form-group">
                        <label for="">Description Of Activity</label>
                        <input type="text" class="form-control" name="desc" >
                      </div>
                      
                      

                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    <div class="form-group">
                        <label for="">Activity Price in USD </label>
                        <input type="number" class="form-control" name="price" >
                      </div>
                      <div class="form-group">
                        <label for="">Duration : The period or time the activity runs</label>
                        <input type="text" class="form-control" name="duration" >
                      </div>
                      <div class="form-group">
                        <label for="Booked Destination">Destination Name</label>
                        <input list='destinations' id='destination' name='destination' placeholder='Destination' class='form-control'>
                            <datalist id='destinations'>
                                <?php
                                    //Select some elements from  the database
                                    //echo $agentID;
                                    $result = mysqli_query($conn,"SELECT * FROM Destinations WHERE AgentID=$agentID");
                                    while($row = mysqli_fetch_array($result)){
                                        $ID = $row["DestinationID"];
                                        $destinationName = $row["Name"];
                                        $destImage =  $row["ImageURL"];
                                        $location =  $row["Location"];
                                        $country =  $row["Country"];
                                        $destdetails = "$destinationName -"." $location, "."$country. ";
                                        echo "<option value=".$ID.">  " .$destdetails." </option>
                                        ";
                                    }
                                
                                ?>
                            </datalist>
                    </div>
                      
                      
                        
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="submit" onclick="return confirm('Are the Details correct? Review. If Okay, Proceed');">Create</button>
                        <p>- Create a new destination. -</p>
                        <p>- You should not have empty fields. -</p>
                        <p>- Wait For it to be approved by The Escape Agency Admin. -</p>
                        
                     
                    </form>
                    
                  </div>
                </div>
              </div>

            





<?php
    include 'footer.php';
?>