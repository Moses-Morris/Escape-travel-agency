<?php
include_once '../config/connection.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connection();
    }
    
    public function register($name, $email, $passwordHash, $phone, $role, $created_at, $country, $location, $ProfileImg) {
        $hashedPassword = password_hash($passwordHash, PASSWORD_DEFAULT);

        $query = "INSERT INTO Users (Name, Email, PasswordHash, Phone, Role, Created_at, Country, Location, ProfileImg)
                  VALUES (:name, :email, :password, :phone, :role, :created_at, :country, :location, :ProfileImg)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':ProfileImg', $ProfileImg);

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


?>