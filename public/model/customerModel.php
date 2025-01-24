<?php
require_once 'connector.php';
class Database extends Connector {

    public function getConnection() {

        $host = "localhost";

        $dbname = "resort_db";

        $username = "root";

        $password = "";

        

        try {

            return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        } catch(PDOException $e) {

            error_log($e->getMessage());

            throw $e;

        }

    }
}

class CustomerModel {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getCustomers() {
        try {
            $query = "SELECT * FROM customer_tb WHERE cstm_approved = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function approveCustomer($customerId) {
        try {
            $query = "UPDATE customer_tb SET cstm_approved = 1 WHERE cstm_id = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$customerId]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>