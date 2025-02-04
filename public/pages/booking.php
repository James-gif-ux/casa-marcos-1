<?php
require_once '../model/connector.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = isset($_POST['fullname']) ? $_POST['fullname'] : null; // Fixed variable name
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $number = isset($_POST['number']) ? $_POST['number'] : null;
    $check_in = isset($_POST['check_in']) ? $_POST['check_in'] : null;
    $check_out = isset($_POST['check_out']) ? $_POST['check_out'] : null;
    $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : null;
    $guests = isset($_POST['guests']) ? $_POST['guests'] : null; // Ensure this is retrieved
    $status = 'confirmed'; // Set a default status or retrieve from form

    // Check if required fields are filled
    if ($name && $email && $number && $check_in && $check_out && $room_id && $guests) {
        try {
            // Insert into customer_tb
            $customer_sql = "INSERT INTO customer_tb (cstm_name, cstm_email, cstm_number) VALUES (?, ?, ?)";
            $customer_params = [$name, $email, $number];
            $connector->executeUpdate($customer_sql, $customer_params);

            // Insert into booking_tb
            $booking_sql = "INSERT INTO booking_tb (booking_fullname, booking_email, booking_number, 
                           booking_checkin, booking_checkout, booking_guests, room_id, booking_status) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $booking_params = [$name, $email, $number, $check_in, $check_out, $guests, $room_id, $status];
            $connector->executeUpdate($booking_sql, $booking_params);

            header("Location: ../views/rooms.php?success=1");
            exit();

        } catch (PDOException $e) {
            error_log($e->getMessage()); // Log the error message
            header("Location: ../views/reservation.php?error=1");
            exit();
        }
    } else {
        // Handle the case where required
        // fields are not filled
        header("Location: ../views/reservation.php?error=2");
        exit();
    }
}

?>
