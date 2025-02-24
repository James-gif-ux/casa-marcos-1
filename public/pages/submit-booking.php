<?php
// Include necessary files
include_once '../model/Booking_Model.php';
session_start();

$bookingModel = new Booking_Model();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['number']) || 
        empty($_POST['check_in']) || empty($_POST['check_out']) || empty($_POST['service_id'])) {
        die("Error: All fields are required");
    }

    // Get form data with validation
    $fullname = trim($_POST['fullname']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $number = trim($_POST['number']);
    $check_in = date('Y-m-d', strtotime($_POST['check_in']));
    $check_out = date('Y-m-d', strtotime($_POST['check_out']));
    $service_id = (int)$_POST['service_id'];

    // Validate email
    if (!$email) {
        die("Error: Invalid email format");
    }

    // Validate dates
    if (strtotime($check_in) >= strtotime($check_out)) {
        die("Error: Check-out date must be after check-in date");
    }

    try {
        // Insert the booking into the database
        $result = $bookingModel->insert_booking($fullname, $email, $number, $check_in, $check_out, $service_id);

        if ($result === true) {
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
            die("Error: Booking insertion failed - " . $result);
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
