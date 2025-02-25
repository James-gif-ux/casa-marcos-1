<?php
require_once '../model/server.php';

if (isset($_GET['reservation_id']) && isset($_GET['action'])) {
    $reservation_id = $_GET['reservation_id']; // Fixed: changed from booking_id to reservation_id
    $action = $_GET['action'];
    $connector = new Connector();

    try {
        if ($action === 'approve') {
            $sql = "UPDATE reservations SET status = 'confirmed' WHERE reservation_id = :reservation_id";
        } elseif ($action === 'delete') {
            $sql = "DELETE FROM reservations WHERE reservation_id = :reservation_id";
        }

        $params = [':reservation_id' => $reservation_id];

        if ($connector->executeUpdate($sql, $params)) {
            header("Location: ../views/reservedBooking.php?status=success&action=" . $action);
        } else {
            header("Location: ../views/reservedBooking.php?status=error&action=" . $action);
        }
    } catch (Exception $e) {
        header("Location: ../views/reservedBooking.php?status=error&message=" . urlencode($e->getMessage()));
    }
    exit();
}
?>