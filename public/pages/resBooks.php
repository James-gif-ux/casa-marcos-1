<?php
// Include necessary files
include_once '../model/Booking_Model.php'; 
include '../model/reservationModel.php';
include_once '../model/server.php';
session_start();

$bookingModel = new Booking_Model();
$connector = new Connector();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get all form data
    $reservation_id = $_POST['service_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    
    try {
        // Start transaction
$connector->getConnection()->beginTransaction();
        
        // First, update the reservation status
        $sql = "UPDATE reservations SET status = 'approved' WHERE reservation_id = :reservation_id";
        $params = [':reservation_id' => $reservation_id];
        $connector->executeUpdate($sql, $params);
        
        // Then, insert into booking_tb
        $sql = "INSERT INTO booking_tb (booking_fullname, booking_email, booking_number, 
                booking_check_in, booking_check_out, booking_services_id, booking_status) 
                VALUES (:fullname, :email, :number, :check_in, :check_out, 
                (SELECT res_services_id FROM reservations WHERE reservation_id = :reservation_id),
                'approved')";
        
        $params = [
            ':fullname' => $fullname,
            ':email' => $email,
            ':number' => $number,
            ':check_in' => $check_in,
            ':check_out' => $check_out,
            ':reservation_id' => $reservation_id
        ];
        
        $connector->executeUpdate($sql, $params);
        
        // Commit transaction
    $connector->getConnection()->commit();
        
        header("Location: ../views/reservedBooking.php?approved=true");
        exit();
        
    } catch (Exception $e) {
        // Rollback on error
    $connector->getConnection()->rollBack();
        header("Location: ../views/reservedBooking.php?approved=false&error=" . urlencode($e->getMessage()));
        exit();
    }
}

if (isset($_GET['reservation_id']) && isset($_GET['action'])) {
    $reservation_id = $_GET['reservation_id'];
    $action = $_GET['action'];
    $connector = new Connector();

    if ($action === 'approve') {
        $sql = "UPDATE reservations SET status = 'approved' WHERE reservation_id = :reservation_id";
    } elseif ($action === 'complete') {
        $sql = "UPDATE reservations SET status = 'completed' WHERE reservation_id = :reservation_id";
    }

    $params = [':reservation_id' => $reservation_id];

    if ($connector->executeUpdate($sql, $params)) {
        header("Location: ../pages/booking.php?approved=true");
    } else {
        header("Location: ../pages/booking.php?approved=false");
    }
    exit();
}
?>