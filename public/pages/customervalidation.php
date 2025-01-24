<?php
require_once '../model/customerModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_POST['customer_id'];
    $customerModel = new CustomerModel();
    if ($customerModel->approveCustomer($customerId)) {
        header('Location: ../views/customer.php');
    } else {
        echo "Failed to approve customer.";
    }
}
?>