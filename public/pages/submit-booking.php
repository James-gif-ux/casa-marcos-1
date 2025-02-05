<?php
// Include necessary files
include_once '../model/Booking_Model.php';  // Adjust based on your directory structure
session_start();  // Start session to store confirmation data

$bookingModel = new Booking_Model();       // Create an instance of the booking model

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data with validation and sanitization
    $fullname = !empty($_POST['fullname']) ? trim(strip_tags($_POST['fullname'])) : null;
    $email = !empty($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
    $number = !empty($_POST['number']) ? trim(strip_tags($_POST['number'])) : null;
    $room_id = !empty($_POST['room_id']) ? intval($_POST['room_id']) : null; // Ensure it is an integer
    $date = !empty($_POST['date']) ? trim(strip_tags($_POST['date'])) : null;

    // Basic validation
    if (!$fullname || !$email || !$number || !$date || !$room_id) {
        // Redirect back with an error message
        $_SESSION['booking_error'] = "All fields are required.";
        header("Location: ../views/reservation.php");
        exit();
    }

    // Attempt to insert the booking. Ensure that insert_booking handles the room ID validation.
    $result = $bookingModel->insert_booking($fullname, $email, $number, $date, $room_id);

    if ($result === true) {
        // Set session variables for confirmation
        $_SESSION['booking_success'] = true;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['number'] = $number;
        $_SESSION['room_name'] = $bookingModel->get_room_name_by_id($room_id);  // Load room name
        $_SESSION['date'] = $date;

        // Redirect to confirmation page
        header("Location: ../views/confirmation.php");
        exit();
    } else {
        // Handle errors
        $_SESSION['booking_error'] = "Error: " . $result; // Store error message in session
        header("Location: ../views/reservation .php"); // Redirect to reservation page
        exit();
    }
}
?>