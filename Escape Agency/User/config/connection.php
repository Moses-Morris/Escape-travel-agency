
<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "escapeagency";

// Create connection
$mysqli = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
/*
class Database {
    private $host = 'localhost';
    private $db_name = 'escapeagency';
    private $username = 'root';
    private $password = '';

    public $conn;

    public function connection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection Error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
    */
?>
