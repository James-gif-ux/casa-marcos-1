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

    // Fetch all available services from the database
    public function get_service() {
        $sql = "SELECT * FROM services_tb";
        $result = $this->conn->query($sql);
        $services = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }

        return $services;
    }
    public function get_images() {
        $sql = "SELECT * FROM services_tb";
        $result = $this->conn->query($sql);
        $services = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }

        return $services;
    }

    // Check if a service exists by its ID
    public function get_service_name_by_id($services_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM services_tb WHERE services_id = ?");
        $stmt->bind_param("i", $services_id);  // "i" for integer
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;  // Return true if the service exists, false otherwise
    }

    // Insert a new booking into the database
    public function insert_booking($fullname, $email, $number, $check_in, $check_out, $services_id, $status = 'pending') {
        // Validate if the service exists
        if (!$this->get_service_name_by_id($services_id)) {
            return "";
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $this->conn->prepare("INSERT INTO booking_tb (booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out, booking_services_id, booking_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        // Bind the parameters
        $stmt->bind_param("sssssss", $fullname, $email, $number, $check_in, $check_out, $services_id, $status);
        
        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            // If successful, return true
            $stmt->close();
            return true;
        } else {
            // If there was an error, return an error message
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

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; // No booking found
        }

        $stmt->close();
    }

    // Get all bookings that are pending approval
    public function get_pending_bookings() {
        $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out FROM booking_tb WHERE booking_status = 'pending'";
        $result = $this->conn->query($sql);
        $bookings = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row;
            }
        }

        return $bookings;
    }

    public function update_room($id, $name, $description, $price, $image) {
        try {
            $sql = "UPDATE services_tb SET 
                    services_name = ?, 
                    services_description = ?, 
                    services_price = ?, 
                    services_image = ? 
                    WHERE services_id = ?";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$name, $description, $price, $image, $id]);
            
            return true;
        } catch (PDOException $e) {
            return "Database Error: " . $e->getMessage();
        }
    }
}
?>
