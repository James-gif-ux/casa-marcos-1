<?php
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
    // Get all rooms from the database
    public function get_Rooms() {
        $sql = "SELECT * FROM rooms";
        $result = $this->conn->query($sql);
        $rooms = array();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rooms[] = $row;
            }
        }
        return $rooms;
    }
    // Insert a new booking into the database
    public function insert_booking($fullname, $email, $number, $date, $room_id, $status = 'pending') {
        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare("INSERT INTO booking_tb (booking_fullname, booking_email, booking_number, booking_date, booking_room_id, booking_status) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Bind the parameters
        $stmt->bind_param("ssssss", $fullname, $email, $number, $date, $room_id, $status);
        
        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $error = $stmt->error;
            $stmt->close();
            return "Error: " . $error;
        }
    }

    // Fetch room name by ID
    public function get_room_name_by_id($room_id) {
        $stmt = $this->conn->prepare("SELECT room_name FROM rooms WHERE room_id = ?");
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $stmt->bind_result($room_name);
        $stmt->fetch();
        $stmt->close();
        return $room_name;
    }
}
?>