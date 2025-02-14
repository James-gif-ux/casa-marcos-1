<?php
session_start();
header('Content-Type: application/json');
require_once 'server.php'; // Assuming this file contains your database connection parameters

class PaymentProcessor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function processPayment($paymentData) {
        try {
            // Start transaction
            $this->conn->beginTransaction();

            // Create payment record with all required fields
            $paymentQuery = "INSERT INTO payment_tb (
                payment_amount, 
                payment_status, 
                payment_method,
                reference_number,
                payment_proof,
                payment_transaction_date
            ) VALUES (
                :amount, 
                'pending',
                :payment_method,
                :reference_number,
                :payment_proof,
                NOW()
            )";
            
            $stmt = $this->conn->prepare($paymentQuery);
            $result = $stmt->execute([
                'amount' => $paymentData['payment_amount'],
                'payment_method' => $paymentData['payment_method'],
                'reference_number' => $paymentData['reference_number'],
                'payment_proof' => $paymentData['payment_proof']
            ]);

            if ($result) {
                $this->conn->commit();
                return json_encode(['success' => true, 'message' => 'Payment processed successfully']);
            } else {
                throw new Exception("Failed to process payment");
            }

        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Payment Error: " . $e->getMessage());
            return json_encode([
                'success' => false, 
                'error' => "Payment processing failed. Please try again."
            ]);
        }
    }

    public function getPaymentDetails($paymentId) {
        $query = "SELECT * FROM payment_tb WHERE payment_id = :payment_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['payment_id' => $paymentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>