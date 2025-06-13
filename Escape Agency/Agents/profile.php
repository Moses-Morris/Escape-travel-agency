<?php
    include 'base.php';
?>
<?php
    $msg =" ";
    $result = mysqli_query($conn,"SELECT * FROM Agents
                                WHERE AgentID = $agentID  ");
    while($row = mysqli_fetch_array($result)){
        $ID = $row["AgentID"];
        $Description = $row["Description"];
        $Name = $row["CompanyName"];
        $Keywords = $row["Keywords"];
        $location = $row["Location"];
        $country = $row["Country"];
        $img = $row["ProfileImg"];
        $phone = $row["Phone"];
        $Agenttype = $row["AgentType"];
        $email = $row["Email"];
        $services = $row["Services"];
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
                    <h4 class="card-title">Account Details</h4>
                    <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?eventid=' . $id; ?>" method="post" enctype="multipart/form-data">
                     

                      <?php
                        if( $msg){
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
                        <label for="">Company Image</label><br>
                        <img src="uploads/<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:30vh; width: 15vw; background-position: center; object-fit:cover; border-radius:50%;">
                        <input type="file" class="form-control" name="img" >
                      </div>
                      <div class="form-group">
                        <label >Agent Company Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $Name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Company Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="<?php echo $Description; ?>">
                      </div>
                 
                      <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
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
                        <input type="text" class="form-control"name="location" value="<?php echo $location; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">KeyWords</label>
                        <input type="text" class="form-control" name="keywords" value="<?php echo $Keywords; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Agent Type</label>
                        <input type="text" class="form-control" name="agenttype" value="<?php echo $Agenttype; ?> ">
                      </div>
                      
                      
                      <div class="form-group">
                        <label for="">Services  </label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $services; ?>">
                      </div>
                    
                      
                      
                      
                      
                     
                      
                      <div class="form-group">
                      <p>- You can update the Profile Account Details -</p>
                      
                        <button onclick="return confirm('Are you sure You want to Update?')" class="btn btn-info btn-rounded btn-fw me-2"  name="update">Update</a>
                        
                       
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>



<?php
    include 'footer.php';
?>