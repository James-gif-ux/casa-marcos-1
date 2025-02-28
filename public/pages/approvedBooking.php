<?php
require_once '../model/server.php';

if (isset($_GET['reservation_id']) && isset($_GET['action'])) {
    $reservation_id = $_GET['reservation_id'];
    $action = $_GET['action'];
    $status = ($action === 'approve') ? 'confirmed' : 'cancelled';

    try {
        $connector = new Connector();
        
        // First get the reservation details
        $sql = "SELECT r.*, s.services_name 
                FROM reservations r 
                LEFT JOIN services_tb s ON r.res_services_id = s.services_id 
                WHERE r.reservation_id = ?";
        $stmt = $connector->executeQuery($sql, [$reservation_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        // Update reservation status
        $sql = "UPDATE reservations SET status = ? WHERE reservation_id = ?";
        $stmt = $connector->executeQuery($sql, [$status, $reservation_id]);

        // If approved and record is requested, insert into bookings
        if ($action === 'approve' && isset($_GET['record'])) {
            // Insert into bookings table
            $sql = "INSERT INTO bookings (
                        customer_name, 
                        email, 
                        phone, 
                        checkin_date, 
                        checkout_date, 
                        room_id, 
                        message,
                        status
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, 'confirmed')";
            
            $stmt = $connector->executeQuery($sql, [
                $booking['name'],
                $booking['email'],
                $booking['phone'],
                $booking['checkin'],
                $booking['checkout'],
                $booking['res_services_id'],
                $booking['message']
            ]);

            // Update booking count in services_tb
            $sql = "UPDATE services_tb SET booking_count = booking_count + 1 
                    WHERE services_id = ?";
            $connector->executeQuery($sql, [$booking['res_services_id']]);
        }

        // Redirect based on the parameter
        if (isset($_GET['redirect']) && $_GET['redirect'] === 'booking') {
            header("Location: ../views/booking.php");
            exit();
        } else {
            header("Location: ../views/reservedBooking.php");
            exit();
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>