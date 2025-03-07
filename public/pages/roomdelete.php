<?php
require_once '../model/server.php';

if (isset($_GET['services_id']) && isset($_GET['action'])) {
    $services_id = $_GET['services_id'];
    $action = $_GET['action'];
    $connector = new Connector();

    if ($action === 'delete') {
        $sql = "DELETE FROM services_tb WHERE services_id = :services_id";
    } elseif ($action === 'complete') {
        $sql = "UPDATE booking_tb SET booking_status = 'completed' WHERE booking_id = :booking_id";
    }

    $params = [':booking_id' => $booking_id];

    if ($connector->executeUpdate($sql, $params)) {
        header("Location: ../pages/roomsUpload.php?deleted=true");
    } else {
        header("Location: ../pages/roomsUpload.php?deleted=false");
    }
    exit();
}
?>