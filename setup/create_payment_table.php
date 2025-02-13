<?php
require_once '../public/model/server.php';

try {
    $connector = new Connector();
    
    $sql = "CREATE TABLE IF NOT EXISTS payment_tb (
        payment_id INT PRIMARY KEY AUTO_INCREMENT,
        payment_amount DECIMAL(10,2) NOT NULL,
        payment_status VARCHAR(20) NOT NULL DEFAULT 'pending',
        payment_transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        payment_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        payment_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $connector->executeQuery($sql);
    echo "Payment table created successfully";
} catch (Exception $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>