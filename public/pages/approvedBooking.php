<?php
require_once '../model/server.php';

if (isset($_GET['reservation_id']) && isset($_GET['action'])) {
    $reservation_id = $_GET['reservation_id'];
    $action = $_GET['action'];
    $connector = new Connector();
    
    // Initialize $sql variable
    $sql = '';

    if ($action === 'pedning') {
        $sql = "UPDATE reservations SET status = 'pending' WHERE reservation_id = :reservation_id";
    } elseif ($action === 'cancelled') {
        $sql = "UPDATE reservations SET status = 'cancelled' WHERE reservation_id = :reservation_id";
    }

    // Only proceed if SQL query is set
    if (!empty($sql)) {
        $params = [':reservation_id' => $reservation_id];

        if ($connector->executeUpdate($sql, $params)) {
            header("Location: ../pages/booking.php?approved=true");
        } else {
            header("Location: ../pages/booking.php?approved=false");
        }
    } else {
        header("Location: ../pages/booking.php?error=invalid_action");
    }
    exit();
}

// Redirect if no parameters provided
header("Location: ../pages/booking.php?error=missing_params");
exit();
?>