<?php
require_once '../model/server.php';

if (isset($_GET['booking_id']) && isset($_GET['action'])) {
    $booking_id = $_GET['booking_id'];
    $action = $_GET['action'];
    $connector = new Connector();

    if ($action === 'approve') {
        $sql = "UPDATE booking_tb SET booking_status = 'approved' WHERE booking_id = :booking_id";
    } elseif ($action === 'complete') {
        $sql = "UPDATE booking_tb SET booking_status = 'completed' WHERE booking_id = :booking_id";
    }

    $params = [':booking_id' => $booking_id];

    if ($connector->executeUpdate($sql, $params)) {
        header("Location: ../views/booking.php?approved=true");
    } else {
        header("Location: ../views/booking.php?approved=false");
    }
    exit();
}
?>