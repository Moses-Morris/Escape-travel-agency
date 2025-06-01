<?php
    include 'base.php';
?>
<?php
$msg = " ";
    //get the id from url and
    if (isset($_GET['blogid']) && filter_var($_GET['blogid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['blogid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } else {
        echo "Invalid ID!";
    }

?>
<?php
//Form Action
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST['update'])) {
    // Collect POST data
    $blogname = $_POST["blogname"];
    $tagline = $_POST["tagline"];
    $destination = $_POST["destination"];
    $subtitle = $_POST["subtitle"];
    $publish = $_POST["publish"];
    $content = $_POST["content"];
    $keywords = $_POST["keywords"];
    $icon = $_POST["icon"];
    $created = $_POST["date"];
    //$agentID = $_SESSION['agent_id']; // Make sure this is set

    // Handle image upload
    $uploadOk = true;
    $target_file = ""; 
    $imageUpdated = false;

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['img']['tmp_name'];
      $originalName = $_FILES['img']['name'];
      $fileSize = $_FILES['img']['size'];
      $fileMimeType = mime_content_type($fileTmpPath);
      $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
      $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
      $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

      if (!in_array($fileMimeType, $allowedMimeTypes) || !in_array($fileExt, $allowedExtensions)) {
        $msg = "<div class='alert alert-warning'>Invalid file type. Only JPG, PNG, or GIF allowed.</div>";
        $uploadOk = false;
      }

      if ($fileSize > 5 * 1024 * 1024) {
        $msg = "<div class='alert alert-warning'>File is too large. Max 5MB allowed.</div>";
        $uploadOk = false;
      }

      if ($uploadOk) {
        $uniqueName = uniqid('img_', true) . '.' . $fileExt;
        $uploadDir = "uploads/";
        $target_file = $uploadDir . $uniqueName;

        if (move_uploaded_file($fileTmpPath, $target_file)) {
          $imageUpdated = true;
        } else {
          $msg = "<div class='alert alert-danger'>Failed to move uploaded file.</div>";
          $uploadOk = false;
        }
      }
    }

    if ($uploadOk) {
      // Use existing image if no new one uploaded
      if (!$imageUpdated) {
        $existing = mysqli_query($conn, "SELECT BlogImage FROM blogs WHERE AuthorID = $agentID");
        $row = mysqli_fetch_assoc($existing);
        $target_file = $row['BlogImage'];
      }

      $stmt = $conn->prepare("UPDATE blogs 
        SET Status = ?, BlogTitle = ?, BlogImage = ?, Tagline = ?, 
            Subtitle = ?, PublishedDate = ?, BlogContent = ?, 
            Keywords = ?, Created_at = ?
        WHERE Role = 'agent' AND AuthorID = ?");

      if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
      }

      $stmt->bind_param("sssssssssi", $icon, $blogname, $target_file, $tagline, $subtitle, $publish, $content, $keywords, $created, $agentID);

      if ($stmt->execute()) {
        $msg = "<div class='alert alert-success'>Blog updated successfully.</div>";
      } else {
        $msg = "<div class='alert alert-danger'>Update failed: " . $stmt->error . "</div>";
      }

      $stmt->close();
    }
  } elseif (isset($_POST['deactivate'])) {
    //$agentID = $_SESSION['agent_id']; // Ensure this is defined
    $stmt = $conn->prepare("UPDATE blogs SET Status = 'inactive' , Published=0 WHERE Role = 'agent' AND AuthorID = ?");
    $stmt->bind_param("i", $agentID);
    $stmt->execute();
    $stmt->close();
    $msg = "<div class='alert alert-warning'>Blog deactivated.</div>";
  }elseif (isset($_POST['activate'])) {
    $today =  date('Y-m-d H:i');
    $stmt = $conn->prepare("UPDATE blogs SET Status = 'active', PublishedDate='$today' WHERE Role = 'agent' AND AuthorID = ?");
    $stmt->bind_param("i", $agentID);
    if ($stmt->execute()) {
        $msg =  "<div class='alert alert-info'>Blog Activated. It is running Succesfully.</div>";
    } else {
       $msg =   "<div class='alert alert-danger'>Failed to Activate: " . $stmt->error . "</div>";
    }
    $stmt->close();

}
}

?>
<?php
    /*get the id from url and
    if (isset($_GET['blogid']) && filter_var($_GET['blogid'], FILTER_VALIDATE_INT)) {
        $id = $_GET['blogid'];
        //echo "Received ID: " . htmlspecialchars($id);
    } 
    //delete the blog
    else if(isset($_GET['delete']) && filter_var($_GET['delete'], FILTER_VALIDATE_INT)){
        $id = $_GET['delete'];
        // Delete Image
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $stmt = $conn->prepare("UPDATE  blogs SET  Status ='inactive' WHERE Role='agent' AND AuthorID=$agentID");
            
            $stmt->execute();

        }
    }
    /*update the blog
    else if(isset($_GET['update']) && filter_var($_GET['update'], FILTER_VALIDATE_INT)){
        $id = $_GET['update'];
        // Delete Image
        if ( $_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_GET['update'];
            $blogname = mysqli_real_escape_string($_POST["blogname"]);
            $img = $_POST["img"];
            $tagline = $_POST["tagline"];
            $destination = $_POST["destination"];
            $subtitle = $_POST["subtitle"];
            $publish = $_POST["publish"];
            $content = $_POST["content"];
            $keywords = $_POST["keywords"];
            $icon = $_POST["icon"];
            $created = $_POST["date"];
            $stmt = $conn->prepare("UPDATE  blogs SET  Status =$icon,  
                                                        BlogTitle=$blogname, BlogImage=$img, Tagline=$tagline,
                                                        Subtitle=$subtitle, PublishedDate=$publish, BlogContent=$content,
                                                        Keywords=$keywords, Created_at=$created
                                                        WHERE Role='agent' AND AuthorID=$agentID");
            if($stmt->execute()){
                echo "Worked";
            }
            else{
                echo "shiet";
            }

        }
        
    }
    else {
        echo "Invalid ID!";
    }
        */
?>
<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
        <a href="blogs.php" type="button" class="btn btn-outline-primary btn-rounded btn-fw">Go Back to Blogs</a>
        <div class="card">
            <div class="row">
                 
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Blog Details</h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?blogid=' . $id; ?>" method="post" enctype="multipart/form-data">
                      <?php
                        if($msg){
                          print $msg;
                        }
                      ?>

                        <?php
                                    $result = mysqli_query($conn,"SELECT * FROM blogs WHERE BlogID=$id ");
                                    while($row = mysqli_fetch_array($result)){
                                            $ID = $row["BlogID"];
                                            $dest = $row["DestinationID"];
                                            $img = $row["BlogImage"];
                                            $tag = $row["Tagline"];
                                            $title = $row["BlogTitle"];
                                            $subtitle = $row["Subtitle"];
                                            $PublishDate = $row["PublishedDate"];
                                            $content = $row["BlogContent"];
                                            $keywords = $row["Keywords"];
                                            $created = $row["Created_at"];
                                            $stat = $row["Status"];
                                            echo "<p class='text-danger'>This Blog is ".$stat."</p>";
                                             //Get destination through destinations
                                            $dest = mysqli_query($conn,"SELECT * FROM destinations WHERE DestinationID=$dest ");
                                            $r3 = mysqli_fetch_array($dest);
                                            $nr3 = $r3["Name"];

                                             
                                            if ($stat == "active"){
                                              $icon = "Active and Published";
                                              $todobutton = "<button type='submit' class='btn btn-primary btn-rounded btn-fw me-2' name='deactivate'>Deactivate</button>";
                                          }else{
                                              $icon = "Inactive and Not Published";
                                              $todobutton = "<button type='submit' class='btn btn-primary btn-rounded btn-fw me-2' name='activate'>Activate</button>";
                                          }   
                                    }
                                    ?>




                      <style> 
                            .form-group input{
                            font-weight:900;
                            font-size: medium;
                            }
                      </style>
                      <div class="form-group">
                        <label for="blog">Blog Image</label><br>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>" style="height:30vh; width: 30vw; background-position: center; object-fit:center;">
                        <input type="file" class="form-control" name="img" >
                      </div>
                      <div class="form-group">
                        <label for="Booked Destination">Blog Name</label>
                        <input type="text" class="form-control" name="blogname" value="<?php echo $title; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Blog Tagline</label>
                        <input type="text" class="form-control" name="tagline" value="<?php echo $tag; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Destination</label>
                        <input type="text" class="form-control"name="destination" value="<?php echo $nr3; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">SubTitle</label>
                        <input type="text" class="form-control" name="subtitle" value="<?php echo $subtitle; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label for="">Published On</label>
                        <input type="text" class="form-control" name="publish" value="<?php echo $PublishDate; ?>">
                      </div>
                      
                      
                    
                    
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">.</h4>
                    
                      <div class="form-group">
                        <label for="">Content</label>
                        <input type="textarea" class="form-control" name="content" value="<?php echo $content; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Keywords used for the blog</label>
                        <input type="text" class="form-control" name="keywords" value="<?php echo $keywords; ?> ">
                      </div>
                      <div class="form-group">
                        <label for="">Status of The Blog </label>
                        <input type="text" class="form-control" name="icon" value="<?php echo $icon; ?>">
                      </div>
     
                      
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $created; ?>">
                      </div>
                     
                      
                      <div class="form-group">
                      <p>- You can update the Event details -</p>
                      <p>- Deactivate the Event if you do not wish to proceed with the request -</p>
                        <button onclick="return confirm('Are you sure You want to Update?')" class="btn btn-warning btn-rounded btn-fw me-2"  name="update">Update</a>
                        
                        <?php
                            echo $todobutton;
                        ?>
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>

                        </div>


<?php
    include 'footer.php';
?>



