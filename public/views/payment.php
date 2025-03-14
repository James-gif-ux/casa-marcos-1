<?php
include_once 'nav/header.php';
require_once '../model/server.php';

// Initialize database connection
$connector = new Connector();

// Query to get payment records with customer details
$sql = "SELECT 
    p.payment_id,
    p.reference_number,
    payment_booking_id,
    b.booking_fullname,
    p.amount,
    p.payment_date,
    p.payment_status,
    p.payment_method,
    p.payment_proof
FROM payment_tb p
JOIN booking_tb b ON payment_booking_id = b.booking_id
ORDER BY p.payment_date DESC";

$result = $connector->executeQuery($sql);
$payments = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.payment-container {
  padding: 40px 20px;
  background-color: #f8f9fa;
}

.payment-card {
  border-radius: 10px;
  overflow: hidden;
}

.card-header {
  background: linear-gradient(135deg, #2193b0, #6dd5ed) !important;
  padding: 20px;
}

.card-header h2 {
  color: white !important;
  font-size: 24px;
  margin: 0;
  font-weight: 600;
}

.card-body {
  padding: 25px;
}

.payment-table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.payment-table thead th {
  background-color: #343a40;
  color: white;
  padding: 15px;
  font-weight: 500;
  text-align: left;
  border: none;
}

.payment-table tbody td {
  padding: 12px 15px;
  border-bottom: 1px solid #dee2e6;
}

.payment-table tbody tr:hover {
  background-color: #f5f5f5;
  transition: background-color 0.3s ease;
}
</style>

<div class="payment-container">
  <div class="card payment-card shadow">
    <div class="card-header">
      <h2 class="mb-0">Payment Records</h2>
    </div>
    <div class="card-body">
      <table class="payment-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Order ID</th>
            <th>Reference No.</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $counter = 1;
          foreach ($payments as $payment): 
          ?>
          <tr>
            <td><?php echo $counter++; ?></td>
            <td><?php echo htmlspecialchars($payment['reference_number']); ?></td>
            <td><?php echo htmlspecialchars($payment['booking_fullname']); ?></td>
            <td>₱<?php echo number_format($payment['amount'], 2); ?></td>
            <td><?php echo date('M d, Y', strtotime($payment['payment_date'])); ?></td>
            <td><?php echo ucfirst(htmlspecialchars($payment['payment_status'])); ?></td>
            <td>
              <?php if($payment['payment_proof']): ?>
                <a href="../images/payments/<?php echo htmlspecialchars($payment['payment_proof']); ?>" 
                   target="_blank" class="btn btn-info btn-sm">View Proof</a>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>