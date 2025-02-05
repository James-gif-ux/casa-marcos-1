<?php
// Include necessary files
include_once '../model/Booking_Model.php';  // Assuming this contains logic for booking insertion
session_start();  // Start session to store confirmation data

$bookingModel = new Booking_Model();  // Create an instance of the booking model

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $date = $_POST['date'];
    $room_id = $_POST['room_id'];  // Get the selected room ID from the form

    // Validate required fields
    if (empty($fullname) || empty($email) || empty($number) || empty($date) || empty($room_id)) {
        die("Error: All fields are required");
    }

    // Insert the booking into the database
    $result = $bookingModel->insert_booking($fullname, $email, $number, $date, $room_id);

    // Clear any existing session messages
    unset($_SESSION['booking_success']);
    unset($_SESSION['booking_error']);

    if ($result === true) {
        // Set session variables to display in confirmation page
        $_SESSION['booking_success'] = true;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['number'] = $number;
        $_SESSION['date'] = $date;
        $_SESSION['room_name'] = $bookingModel->get_room_name_by_id($room_id);
        

        // Redirect to confirmation page
        header("Location: ../views/confirmation.php");
        exit();
    } else {
        // Store error in session and redirect
        $_SESSION['booking_error'] = "Failed to create booking. Please try again.";
        header("Location: ../views/booking.php");
        exit();
    }
}
?>