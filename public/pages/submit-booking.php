<?php
// Include necessary files
include_once '../model/Booking_Model.php';
session_start();

$bookingModel = new Booking_Model();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Get and validate form data
        $fullname = trim($_POST['fullname']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $number = trim($_POST['number']);
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        $service_id = (int)$_POST['service_id'];

        // Debug information
        error_log("Attempting to insert booking with data:");
        error_log("Name: $fullname");
        error_log("Email: $email");
        error_log("Number: $number");
        error_log("Check-in: $check_in");
        error_log("Check-out: $check_out");
        error_log("Service ID: $service_id");

        // Insert the booking into the database
        $result = $bookingModel->insert_booking($fullname, $email, $number, $check_in, $check_out, $service_id);

        if ($result === true) {
            // Set session variables
            $_SESSION['booking_success'] = true;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;
            $_SESSION['number'] = $number;
            $_SESSION['check_in'] = $check_in;
            $_SESSION['check_out'] = $check_out;
            $_SESSION['service_name'] = $bookingModel->get_service_name_by_id($service_id);

            header("Location: ../views/confirmation.php");
            exit();
        } else {
            error_log("Booking insertion failed: " . print_r($result, true));
            throw new Exception("Unable to complete booking. Please try again.");
        }
    } catch (Exception $e) {
        error_log("Booking error: " . $e->getMessage());
        $_SESSION['error'] = "Booking failed: " . $e->getMessage();
        header("Location: ../views/books.php");
        exit();
    }
}
