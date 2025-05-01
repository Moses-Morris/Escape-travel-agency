<?php
    include 'base.php';
?>

<?php
    //Create an Event
    //echo $agentID;
    $msg = " ";
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])) {
      
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $desc = mysqli_real_escape_string($conn,$_POST['desc']);
        $destination = mysqli_real_escape_string($conn,$_POST['destination']);
        $location = mysqli_real_escape_string($conn,$_POST['location']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $tag = mysqli_real_escape_string($conn,$_POST['tag']);
        $activities = mysqli_real_escape_string($conn,$_POST['activities']);
        $end = mysqli_real_escape_string($conn,$_POST['end']);
        $start = mysqli_real_escape_string($conn,$_POST['start']);
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
        $likes = 0;
     
        $date =  date('Y-m-d H:i');
        //echo $name.$desc.$destination.$location.$country.$price.$tag.$activities.$end.$start.$target_file.$rating.$status.$likes.$date;   
        if (empty($name) || empty($desc) || empty($location) || empty($country) || empty($price) || empty($tag) || empty($activities) || empty($start) || empty($end) || empty($destination)){
          $msg = "<div class='alert alert-danger'>Do not send empty fields: </div>";
          //$state= "NOTOK";
        } else{
          //$stmt = "INSERT INTO destinations ( Name, Description, Location, Country,   Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at, ImageURL)  VALUES
          //('$name', '$desc', '$location', '$country', '$price', '$rating', '$rating', '$rating', '$activities', '$travel', '$dist', '$agentID',  '$status', '$date', '$target_file')";
          //$stmt->bind_params();
          $stmt = $conn->prepare("INSERT INTO Events (Name, Activities, Location, Country, DestinationID, StartDate, EndDate, Price,  ImageURL, LikesAVG, Description,TagLine ,  RatingAVG, Status, Created_at, AgentID)  
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)" );
          $stmt->bind_param("ssssssssssssssss", $name,$activities,  $location, $country, $destination, $start, $end,  $price,  $target_file, $likes, $desc,$tag, $rating,$status,$date,$agentID);
          if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Event Created Successfully. Proceeding to All Events
                          </div>";
            echo "<script>
                          setTimeout(function() {
                              window.location.href = 'events.php';
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
                    <h4 class="card-title">Create A New Event</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                      <?php
                        if($msg){
                          echo $msg;
                        }
                      ?>
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        </style>
                        <div class="form-group ">
                        <label for="">Event Image</label>
                        <input type="file" class="form-control" name="img" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                       </div>
                      <div class="form-group">
                        <label for="Booked Destination">Event Name</label>
                        <input type="text" class="form-control" name="name" >
                      </div>
                      <div class="form-group">
                        <label for="">Description Of Event</label>
                        <input type="text" class="form-control" name="desc" >
                      </div>
                      <div class="form-group">
                        <label for="">Details of Event </label>
                        <input type="text" class="form-control" name="tag" >
                      </div>
                      <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" class="form-control" name="location" >
                      </div>
                      <div class="form-group">
                        <label for="">Country</label>
                        <input type="text"  class="form-control" name="country" >
                      </div>

                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                      
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
                      <div class="form-group">
                        <label for="">Price  </label>
                        <input type="number" class="form-control"  name="price" >
                      </div>
                      <div class="form-group">
                        <label for="">Starting Date</label>
                        <input type="date" class="form-control" name="start" >
                      </div>
                      <div class="form-group">
                        <label for="">Ending Date</label>
                        <input type="date" class="form-control" name="end" >
                      </div>
                      <div class="form-group">
                        <label for="">Activities</label>
                        <input type="number" class="form-control" name="activities" >
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