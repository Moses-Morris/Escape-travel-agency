<?php
      /*Check and fetch ID from URL
      if (!isset($_GET['destid']) || !filter_var($_GET['destid'], FILTER_VALIDATE_INT)) {
        die("Invalid or missing destination ID.");
      }
      $destid = intval($_GET['destid']);

      // Fetch destination details
      $stmt = $conn->prepare("SELECT * FROM destinations WHERE DestinationID = ?");
      $stmt->bind_param("i", $destid);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows !== 1) {
        die("Destination not found.");
      }
      $destination = $result->fetch_assoc();
      $stmt->close();

      // Handle form submission
      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit']) ){
        $id = intval($_POST['id']);

      // Update
      //if (isset($_POST['update'])) {
          $name = $_POST['destination'];
          $desc = $_POST['description'];
          $location = $_POST['location'];
          $country = $_POST['country'];
          $travel = $_POST['travel'];
          $image = $_FILES['img'];
          $price = $_POST['price'];
          $dist = $_POST['dist'];

          //$image = $_FILES['image'];
          //validate image
           // Optional image upload
          $imgPath = $destination['ImageURL'];
          if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
              $image = $_FILES['img'];
              $allowed = ['image/jpeg', 'image/png', 'image/gif'];
              if (!in_array($image['type'], $allowed)) {
                  die("Invalid image type.");
              }

              $uploadDir = "uploads/";
              $uniqueName = time() . '_' . basename($image['name']);
              $uploadPath = $uploadDir . $uniqueName;

              if (!move_uploaded_file($image['tmp_name'], $uploadPath)) {
                  die("Image upload failed.");
              }
              $imgPath = $uploadPath;
          }

          $stmt = $conn->prepare("UPDATE destinations SET  name= ?, Description = ?, Location = ?, Country = ?, TravelID = ?,
                                                    ImageURL = ?, Price = ?, DistFromOrigin = ?
                                                    WHERE DestinationID = ?"
                                                    );
          $stmt->bind_param("ssisssssd",$name, $desc, $location, $country, $travel, $imgPath, $price, $dist, $id );

          if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Destination updated successfully.</div>";
            header("Refresh:2; url=viewdestination.php?destid=destid=". urlencode($ID) ."");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error updating: " . $stmt->error . "</div>";
        }
        $stmt->close();
    
     // }

      /*DELETE
      elseif (isset($_POST['delete'])) {
          $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
          $stmt->bind_param("i", $id);

          if ($stmt->execute()) {
              echo "<div class='alert alert-success'>Record deleted successfully.</div>";
          } else {
              echo "<div class='alert alert-danger'>Delete failed: " . $stmt->error . "</div>";
          }
          $stmt->close();
      }

      // ARCHIVE (or any other custom action)
      elseif (isset($_POST['archive'])) {
          $stmt = $conn->prepare("UPDATE users SET status = 'archived' WHERE id = ?");
          $stmt->bind_param("i", $id);

          if ($stmt->execute()) {
              echo "<div class='alert alert-info'>Record archived.</div>";
          } else {
              echo "<div class='alert alert-danger'>Archiving failed: " . $stmt->error . "</div>";
          }
          $stmt->close();
      }
          *
    }*/
?>
<?php
                           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['destination']) && isset($_POST['destination']))
                           {
                              // Collect the data from post method of form submission // 
                              $kcb=mysqli_real_escape_string($conn,$_POST['destination']);
                              $sqlUpdateDest="UPDATE destinations SET  name= ? WHERE DestinationID = $id";
                              $stmt = $conn->prepare($sqlUpdateDest);
                              if ($stmt->execute()){
                                  echo "<div class='alert alert-success'>Destination updated successfully.</div>";
                                  header("Location; url=viewdestination.php?destid=". urlencode($id) ."");
                                  exit;
                              } else {
                                  echo "<div class='alert alert-danger'>Error updating: " . $stmt->error . "</div>";
                              }
                           }
                      ?>
                      <form class="row g-3"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                        <div class="form-group">
                          <div>
                          <label for="Booked Destination">Destination Name</label>
                          <input type="text" class="form-control" name="submit" value="<?php echo $Name; ?>">
                          </div>
                          <button class='btn btn-primary btn-rounded  me-2 ' type='submit' name="destination">Edit</button>
                        </div>
                        
                        
                        
                      </form>
                      <form   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
                          <div>
                              <input type='text' id='disabledTextInput' class='form-control' placeholder='<?php echo $kcb; ?>' name='kcb' >
                            </div>
                      
                            <div class='col-md-3'>
                              <button class='btn btn-info  btn-rounded btn-fw me-2 ' type='submit' name="submit">Edit</button>
                              
                            </div>

                        </form>