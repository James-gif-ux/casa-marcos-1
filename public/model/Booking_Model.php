<?php
require_once 'connector.php';

class Booking_Model {
    private $conn;

    public function __construct() {
        // Database credentials
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'resort_db';

        // Create the MySQL connection
        $this->conn = new mysqli($server, $username, $password, $database);

        // Check for a connection error and handle it
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Fetch all available rooms from the database
    public function get_rooms() {
        $sql = "SELECT * FROM rooms"; 
        $result = $this->conn->query($sql);
        $rooms = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rooms[] = $row;
            }
        }

        return $rooms;
    }

    // Check if a room exists by its ID
    public function get_room_name_by_id($room_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM rooms WHERE room_id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;  // Return true if the room exists, false otherwise
    }

    // Insert a new booking into the database
    public function insert_booking($fullname, $email, $number, $date, $time, $room_id, $status = 'pending') {
        // Validate if the room exists
        if (!$this->get_room_name_by_id($room_id)) {
            return "Error: The selected room does not exist.";
        }

        $stmt = $this->conn->prepare("INSERT INTO booking_tb (booking_fullname, booking_email, booking_number, booking_date, booking_time, booking_room_id, booking_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssss", $fullname, $email, $number, $date, $time, $room_id, $status);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Error: " . $error;
        }
    }

    // Fetch booking details by booking ID
    public function get_booking_by_id($booking_id) {
        $stmt = $this->conn->prepare("SELECT * FROM booking_tb WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $booking = null;
        if ($result->num_rows > 0) {
            $booking = $result->fetch_assoc();
        }

        $stmt->close();
        return $booking; // Return the booking or null if not found
    }

    // Get all bookings that are pending approval
    public function get_pending_bookings() {
        $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_date, booking_time FROM booking_tb WHERE booking_status = 'pending'";
        $result = $this->conn->query($sql);
        $bookings = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
        }

        return $bookings;
    }

    // Update booking status (approve or reject)
    public function update_booking_status($booking_id, $status) {
        if (!in_array($status, ['approved', 'rejected'])) {
            return "Invalid status provided.";
        }

        $stmt = $this->conn->prepare("UPDATE booking_tb SET booking_status = ? WHERE booking_id = ?");
        $stmt->bind_param("si", $status, $booking_id);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Error: " . $error;
        }
    }

    // Close the database connection
    public function close_connection() {
        $this->conn->close();
    }
}
?>