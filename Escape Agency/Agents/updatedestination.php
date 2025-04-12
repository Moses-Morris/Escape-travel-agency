<?php






?>




<?php
      //Check and fetch ID from URL
      
      /* Fetch destination details
      $stmt = $conn->prepare("SELECT * FROM destinations WHERE DestinationID = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows !== 1) {
        die("Destination not found.");
      }
      $destination = $result->fetch_assoc();
      $stmt->close();
*/
      /* Handle form submission
      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit']) ){
        $id = intval($_POST['id']);
 *
      // Update
      if (isset($_POST['update'])) {
          $id = intval($_POST['id']);
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
            header("Refresh:2; url=viewdestination.php?destid=". urlencode($id) ."");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error updating: " . $stmt->error . "</div>";
        }
        $stmt->close();
    
     }

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
          
    }*/
?>
