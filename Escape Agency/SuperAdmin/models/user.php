<?php
    include 'config.php';

    class User {
        private $conn;

        public function __construct() {
            $database = new Database();
            $this->conn = $database->connection();
        }
        
        public function register($name, $email, $passwordHash, $phone, $role, $created_at, $country, $location, $profileImg) {
            $hashedPassword = password_hash($passwordHash, PASSWORD_DEFAULT);
            $query =  "INSERT INTO Users(Name, Email, PasswordHash, Phone, Role, Created_at, Country, Location, profileImg) VALUES ('$name', '$email', '$hashedPassword', '$phone', '$role', '$created_at', '$country', '$location', $profileImg);";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':passwordHash', $passwordHash);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':created_at', $created_at);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':Profile Image', $profileImg);


            if (($stmt->execute()) == TRUE){
                echo "User Registered Succesfully";
            } else{
                echo "Error : User Not Registered Succesfully";
            }
        }


        public function login($email, $passwordHash){
            $query = "SELECT * FROM Users WHERE email = :email LIMIT 1";  //Check this query confirm it
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($passwordHash, user['passwordHash'])){
                session_start();
                $_SESSION['user_id'] = $user['UserID '];
                $_SESSION['user_name'] = $user['Name'];
                return true;
            } else{
                return false;
            }

        }


        /*UPDATE User

        public function update() {
            $query = "UPDATE " . $this->table_name . " SET Name = :name, Email = :email WHERE UserID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id", $this->id);
            return $stmt->execute();
        }*/

        //uPDATE uSER
        public function update($id,$name, $value) {
            $query = "UPDATE Users SET $name = :value WHERE UserID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id", $this->id);
            return $stmt->execute();
        }

        // Delete User
        public function delete($id) {
            $query = "DELETE FROM Users WHERE UserID = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id);
            return $stmt->execute();
        }



    }

    
    
    
    /*
    header("Content-Type: application/json");
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $method = $_SERVER['REQUEST_METHOD'];
    if ($method === 'POST') {
        $data = json_decode(file_get_contents("php://input"));
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = $data->password;
        echo json_encode(["success" => $user->create()]);
    } elseif ($method === 'GET') {
        $stmt = $user->read();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents("php://input"));
        $user->id = $data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        echo json_encode(["success" => $user->update()]);
    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents("php://input"));
        $user->id = $data->id;
        echo json_encode(["success" => $user->delete()]);
    }
    */



?>