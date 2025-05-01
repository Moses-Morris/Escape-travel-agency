<?php
    include 'base.php';
?>
<?php


  $msg = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

        // Sanitize and escape input
        $title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
        $dest = (int) ($_POST['dest'] ?? 0); // Ensure it's an integer
        $tagline = mysqli_real_escape_string($conn, $_POST['tagline'] ?? '');
        $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle'] ?? '');
        $content = mysqli_real_escape_string($conn, $_POST['content'] ?? '');
        $keywords = mysqli_real_escape_string($conn, $_POST['keywords'] ?? '');
        $date = date("Y-m-d H:i:s");

        $image_url = null;

        // Validate image upload
        if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            $filetype = mime_content_type($_FILES['img']['tmp_name']);

            if (!in_array($filetype, $allowed)) {
                $msg = "<div class='alert alert-danger'>Invalid image format. Use JPEG, PNG, or GIF.</div>";
            } else {
                $filename = uniqid() . '_' . basename($_FILES['img']['name']);
                $target_path = "uploads/" . $filename;

                if (move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {
                    $image_url = $target_path;
                } else {
                    $msg = "<div class='alert alert-danger'>Failed to upload image.</div>";
                }
            }
        }

        $role = "agent";
        $published = 1;
        $status = "active";

        if (empty($title) || empty($tagline) || empty($subtitle) || empty($content) || empty($keywords)) {
            $msg = "<div class='alert alert-danger'>Please fill in all fields.</div>";
        } else {
            // Insert into DB
            $stmt = $conn->prepare("INSERT INTO blogs (AuthorID, Role, DestinationID, BlogTitle, Tagline, Subtitle, BlogContent, Keywords, BlogImage, Created_at, Published, Status) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt) {
                $stmt->bind_param("isisssssssss", $agentID, $role, $dest, $title, $tagline, $subtitle, $content, $keywords, $image_url, $date, $published, $status);

                if ($stmt->execute()) {
                    $msg = "<div class='alert alert-success'>Blog created successfully.</div>";
                    echo "<script>
                            setTimeout(() => {
                                window.location.href = 'blogs.php';
                            }, 3000);
                          </script>";
                } else {
                    $msg = "<div class='alert alert-danger'>Error saving blog: " . $stmt->error . "</div>";
                }
                $stmt->close();
            } else {
                $msg = "<div class='alert alert-danger'>Database error: " . $conn->error . "</div>";
            }
        }

        mysqli_close($conn);
    }
  ?>
  

<!-- partial -->

<!-- HTML Form -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create A New Blog</h4>
                            <small>Write a blog to Attract clients to your destination.</small>

                            <?= $msg ?>

                            <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Blog Cover Image</label>
                                    <input type="file" class="form-control" name="img" style="height:auto; width: 30vw;">
                                </div>
                                <div class="form-group">
                                    <label>Blog Title</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label>Blog Tagline</label>
                                    <input type="text" class="form-control" name="tagline" required>
                                </div>
                                <div class="form-group">
                                    <label>Blog Subtitle</label>
                                    <input type="text" class="form-control" name="subtitle" required>
                                </div>
                                <div class="form-group">
                                    <label>Blog Content</label>
                                    <textarea class="form-control" name="content" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Keyword : Format (#key #Key )</label>
                                    <input type="text" class="form-control" name="keywords" required>
                                </div>
                                <div class="form-group">
                                    <label>Destination : Optional</label>
                                    <input list='destinations' id='destination' name='dest' placeholder='Destination' class='form-control'>
                                    <datalist id='destinations'>
                                        <?php
                                            $result = mysqli_query($conn, "SELECT * FROM Destinations WHERE AgentID=$agentID");
                                            while($row = mysqli_fetch_array($result)) {
                                                $ID = $row["DestinationID"];
                                                $destinationName = $row["Name"];
                                                $location = $row["Location"];
                                                $country = $row["Country"];
                                                $destdetails = "$destinationName - $location, $country.";
                                                echo "<option value='$ID'>$destdetails</option>";
                                            }
                                        ?>
                                    </datalist>
                                </div>
                                <button type="submit" class="btn btn-primary btn-rounded btn-fw me-2" name="submit" onclick="return confirm('Are the Details correct? Review. If Okay, Proceed');">Create</button>
                                <p>- Create a new Blog. -</p>
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