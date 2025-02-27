<?php
include '../config/connection.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connection();
    }
    
    public function register($name, $email, $passwordHash, $phone, $role, $created_at, $country, $location) {
        $hashedPassword = password_hash($passwordHash, PASSWORD_DEFAULT);

        $query = "INSERT INTO Users (Name, Email, PasswordHash, Phone, Role, Created_at, Country, Location)
                  VALUES (:name, :email, :password, :phone, :role, :created_at, :country, :location)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':location', $location);

        return $stmt->execute();
    }

    public function login($email, $passwordHash) {
        $query = "SELECT * FROM Users WHERE Email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($passwordHash, $user['PasswordHash'])) {
            session_start();
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['user_name'] = $user['Name'];
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $name, $value) {
        $query = "UPDATE Users SET $name = :value WHERE UserID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM Users WHERE UserID = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}

// Handling Registration Form Submission
if (isset($_POST['register'])) {
    $database = new Database();
    $db = $database->connection();
    $user = new User($db);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $targetDir = "uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $role = "customer";
    $created_at = date('Y-m-d H:i:s');
    $country = 'US';

    // Check file type
    $allowedTypes = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Only JPG, PNG, JPEG, and GIF files are allowed.");
    }

    // Upload file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        if ($user->register($name, $email, $password, $phone, $role, $created_at, $country, $location)) {
            echo "User added successfully!";
        } else {
            echo "Failed to add User.";
        }
    } else {
        echo "Image upload failed.";
    }
} else {
    echo "No file uploaded.";
}
?>
