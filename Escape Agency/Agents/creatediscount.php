<?php
    include 'base.php';
?>

<?php
    $msg = " ";
      //Create a Discount
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST['submit'])) {
            $discount = mysqli_real_escape_string($conn,$_POST['discount']);
            $dest = mysqli_real_escape_string($conn,$_POST['destination']);
            $desc = mysqli_real_escape_string($conn,$_POST['desc']);
            $code = mysqli_real_escape_string($conn,$_POST['code']);
            $discperc = mysqli_real_escape_string($conn,$_POST['discperc']);
            $start = mysqli_real_escape_string($conn,$_POST['start']);
            $end = mysqli_real_escape_string($conn,$_POST['end']);
            $numv = mysqli_real_escape_string($conn,$_POST['numv']);
            //$dist = mysqli_real_escape_string($conn,$_POST['dist']);
            $status = "active";
            $created =   date('Y-m-d H:i');
            $agentID = $agentID;
            $del = 0;
            
            if (empty($discount) || empty($desc) || empty($start) || empty($end) || empty($code) || empty($numv) || empty($dest) || empty($discperc)){
                $msg = "<div class='alert alert-danger'>Do not send empty fields: </div>";
                $state= "NOTOK";
              } else{
                
                $stmt = $conn->prepare("INSERT INTO discounts ( DiscountName, DestinationID, Code, Description, Discount, StartDate, EndDate, NumOfCodes, Status,  Created_at,  AgentID, Deleted)  
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?)" );
                $stmt->bind_param("sissssssssis", $discount, $dest, $code, $desc,  $discperc, $start, $end, $numv, $status, $date, $agentID, $del );
                if ($stmt->execute()) {
                  echo "<div class='col-md-6 d-flex '>
                                  <div class='card alert alert-success'> Discount Created Successfully. Proceeding to All Discounts
                                </div>";
                  echo "<script>
                                setTimeout(function() {
                                    window.location.href = 'discounts.php';
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
                    <h4 class="card-title">Create A New Discount</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data">
                      
                      <style> 
                        .form-group input{
                          font-weight:900;
                          font-size: medium;
                        }
                        <?php
                              
                               if($msg){
                                print "$msg";
                               }
                        ?>
                      </style>
                      
                      <div class="form-group">
                        <label for="">Discount Name</label>
                        <input type="text" class="form-control" name="discount" >
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
                      
                      <div class="form-group">
                        <label for="">Code: </label>
                        <br>
                        <small>8-10 Characters (Format : Text+Name+Percentage e.g VISITDUBAI20 / You can also use Random Characters e.g XDRFGBYU20 )</small>
                        <input type="text" class="form-control" name="code" >
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text"  class="form-control" name="desc" >
                      </div>

                     
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Discount : E.g 20% (From 1% - 99%)</label>
                        <input type="text" class="form-control"  name="discperc" >
                      </div>
                      <div class="form-group">
                        <label for="">Starting From</label>
                        <input type="date" class="form-control" name="start" >
                      </div>
                      <div class="form-group">
                        <label for="">Ends on</label>
                        <input type="date" class="form-control" name="end" >
                      </div>
                      <div class="form-group">
                        <label for="">Number Of Vouchers.</label>
                        <input type="number" class="form-control" name="numv" >
                      </div>
                      
                        
                        <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2"  name="submit" onclick="return confirm('Are the Details correct? Review. If Okay, Proceed');">Create Discount</button>
                        <p>- Create a new Discount. -</p>
                        <p>- You should not have empty fields. -</p>
                        <p>- Wait For it to be approved by The Escape Agency Admin. -</p>
                        
                     
                    </form>
                    
                  </div>
                </div>
              </div>



<?php
    include 'footer.php';
?>