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
    $date = $_POST['date'];
    $time = $_POST['time'];
    $room_id = $_POST['room_id'];  // Get the selected service ID from the form

    // Insert the booking into the database
    $result = $bookingModel->insert_booking($fullname, $email, $number, $date, $room_id);

    if ($result === true) {
        // Set session variables to display in confirmation page
        $_SESSION['booking_success'] = true;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['number'] = $number;
        $_SESSION['room_name'] = $bookingModel->get_room_name_by_id($room_id);  // Assuming this method exists to get the service name
        $_SESSION['date'] = $date;

        // Redirect to confirmation page
        header("Location: ../views/confirmation.php");
        exit();
    } else {
        // Handle errors (optional)
        echo "Error: " . $result;
    }
}
