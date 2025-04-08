<?php
    include 'base.php';
?>

<?php
    //get the id from url and
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
    //update the blog
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
                    <form class="forms-sample"  enctype="multipart/form-data" method="POST">
                      

                        <?php
                                    $result = mysqli_query($conn,"SELECT * FROM blogs WHERE Role='agent' AND AuthorID=$agentID ");
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
                                    }
                                    ?>




<style> 
                            .form-group input{
                            font-weight:900;
                            font-size: medium;
                            }
                      </style>
                      
                      <div class="form-group">
                        <label for="Booked Destination">Blog Name</label>
                        <input type="text" class="form-control" name="blogname" value="<?php echo $title; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Blog Image</label>
                        <img src="<?php echo $img; ?>" alt="<?php echo $img; ?>">
                        <input type="file" class="form-control" name="img" >
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
                        <input type="email" class="form-control" name="icon" value="<?php echo $stat; ?>">
                      </div>
     
                      
                      <div class="form-group">
                        <label for="">Created ON</label>
                        <input type="text" class="form-control" name="date" value="<?php echo $created; ?>">
                      </div>
                     
                      
                      <div class="form-group">
                      <p>- You can update the Event details -</p>
                      <p>- Deactivate the Event if you do not wish to proceed with the request -</p>
                      <a href="?update=<?php echo $id; ?>" onclick="return confirm('Are you sure You want to Update?')" class="btn btn-warning btn-rounded btn-fw me-2"  name="update">Update</a>
                        <a href="?delete=<?php echo $id; ?>" onclick="return confirm('Are you sure You want to delete?')" class="btn btn-danger btn-rounded btn-fw me-2"  name="delete">Delete</a>
                        
                        </div>
                     
                    </form>
                    
                  </div>
                </div>
              </div>




<?php
    include 'footer.php';
?>



