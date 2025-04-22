<?php
    include 'base.php';
?>
<?php
   //Create a destination
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['submit'])) {
      
        $hosting = mysqli_real_escape_string($conn,$_POST['property']);
        $desc = mysqli_real_escape_string($conn,$_POST['desc']);
        $destination = mysqli_real_escape_string($conn,$_POST['destination']);
        $type = mysqli_real_escape_string($conn,$_POST['type']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $location = mysqli_real_escape_string($conn,$_POST['location']);
        $features = mysqli_real_escape_string($conn,$_POST['features']);
        //$option = mysqli_real_escape_string($conn,$_POST['optiontype']);
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
        $active = "active";
        $rating = 0.0;
        // $agentType - the variable with type of agent getting the property
        $date =  date('Y-m-d H:i');
       
          //$stmt = "INSERT INTO destinations ( Name, Description, Location, Country,   Price, RatingAVG, Featured, PopularityRanking, Activities, TravelID, DistFromOrigin, AgentID, Status, Created_at, ImageURL)  VALUES
          //('$name', '$desc', '$location', '$country', '$price', '$rating', '$rating', '$rating', '$activities', '$travel', '$dist', '$agentID',  '$status', '$date', '$target_file')";
          //$stmt->bind_params();
          $stmt = $conn->prepare("INSERT INTO accomodation ( Name, DestinationID, Type, PricePerNight, RatingAVG, ImageURL, Location, DistFromOrigin, Features,active, Description, Created_at, AgentID)  
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)" );
          $stmt->bind_param("sssssssssssss", $property, $agentID, $status, $date, $rating, $services, $features,$desc,$price, $location, $option, $agentType,$target_file);
          if ($stmt->execute()) {
            echo "<div class='col-md-6 d-flex '>
                            <div class='card alert alert-success'> Property Created Successfully. Proceeding to All Properties
                          </div>";
            echo "<script>
                          setTimeout(function() {
                              window.location.href = 'listings.php';
                          }, 3000);
                        </script>";
            //header("Refresh:2; url=destinations.php");
            exit;
          }else{
            $msg =   "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
          }
          /*$stmt->bind_params();
          if (!mysqli_query($conn,$stmt)){
            die('Error: ' . mysqli_error($conn));
            $state= "NOTOK";
            $msg =   "<div class='alert alert-danger'>Failed to Create destination: " . "</div>";
          }else{
            $msg =  "<div class='alert alert-info'>A New Destination is created.</div>";
            //echo "<div class='alert alert-success'>Destination Created.</div>";
          }*

        /
        
        /*
        if ($stmt->execute()) {
          $msg =  "<div class='alert alert-info'>A New Destination is created.</div>";
        } else {
            $msg =   "<div class='alert alert-danger'>Failed to Create destination: " . $stmt->error . "</div>";
        }
            */
        //$stmt->close();
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
                    <h4 class="card-title">Create A New Property</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        <?php
                               if($_SERVER['REQUEST_METHOD'] == 'POST' && ($state=="NOTOK")){
                                  print $msg;
                               } else{
                                print $msg;
                               }
                               if($msg){
                                print $msg;
                               }
                        ?>
                      </style>
                      <div class="form-group ">
                        <label for="">Property Image</label>
                        <input type="file" class="form-control" name="img" style="height:auto; width: 30vw; background-position: center; object-fit:center;">
                       </div>
                      <div class="form-group">
                        <label for="">Hosting Name</label>
                        <input type="text" class="form-control" name="hosting" >
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="desc" >
                      </div>
                      
                      <div class="form-group">
                        <label for="">Destination Name</label>
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
                        <label for="">Type</label>
                        <input list="type" type="text" class="form-control" name="type" >
                            <datalist id="type">
                                <option value="resort">Resort</option>
                                <option value="airbnb">AirBnB</option>
                                <option value="hotel">Hotel</option>
                            </datalist list=type>
                      </div>
                      <div class="form-group">
                        <label for="">Price : Total Amount Per Night</label>
                        <input type="number" class="form-control"  name="price" >
                      </div>
                      

                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text"  class="form-control" name="location" >
                      </div>
                      <div class="form-group">
                        <label for="">Dist From Origin: in Km</label>
                        <input type="number" class="form-control"  name="price" >
                      </div>
                    <div class="form-group">
                        <label for="">Features</label>
                        <input type="text" class="form-control"  name="features" >
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