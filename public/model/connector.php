<?php
class Connector {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "casa_marcos";
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public function disconnect() {
        $this->conn = null;
    }
    
}
?>