<?php
// Include necessary files
include_once '../model/Booking_Model.php';  // Assuming this contains logic for booking insertion
session_start();  // Start session to store confirmation data

$bookingModel = new Booking_Model();       // Create an instance of the booking model

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $service_id = $_POST['service_id'];

    // Insert the booking into the database
    $result = $bookingModel->insert_booking($fullname, $email, $number, $check_in, $check_out, $service_id);

    if ($result === true) {
        // Set session variables to display in confirmation page
        $_SESSION['booking_success'] = true;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['number'] = $number;
        $_SESSION['check_in'] = $check_in;
        $_SESSION['check_out'] = $check_out;
        $_SESSION['service_name'] = $bookingModel->get_service_name_by_id($service_id);
        
        // Remove unused variables
        // $_SESSION['date'] = $date;  // Remove this line
        // $_SESSION['time'] = $time;  // Remove this line

        // Redirect to confirmation page
        header("Location: ../views/confirmation.php");
        exit();
    } else {
        // Handle errors (optional)
        echo "Error: " . $result;
    }
}
