<?php
session_start();
require_once '../model/server.php';
include_once '../model/reservationModel.php';

$model = new Reservation_Model();
$reservationModel = new Reservation_Model();
$connector = new Connector(); // Initialize connector before using it

// Get specific service based on URL parameter
if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $sql = "SELECT * FROM services_tb WHERE services_id = :service_id";
    $stmt = $connector->getConnection()->prepare($sql);
    $stmt->execute([':service_id' => $service_id]);
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$service) {
        header("Location: books.php");
        exit();
    }
} else {
    // Redirect back to books.php if no service_id is provided
    header("Location: books.php");
    exit();
}

// Get all services
$services = $reservationModel->get_service();

// Include the Connector class
require_once '../model/server.php';
$connector = new Connector();

// Fetch all bookings that are pending approval
$sql = "SELECT reservation_id, name, email, phone, date, message FROM reservations WHERE status = 'pending'";
$reservations = $connector->executeQuery($sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $connector = new Connector();
        
        // Updated SQL to include res_services_id
        $sql = "INSERT INTO reservations (name, email, phone, date, message, status, res_services_id) 
                VALUES (:name, :email, :phone, :date, :message, 'pending', :service_id)";
        
        $stmt = $connector->getConnection()->prepare($sql);
        $result = $stmt->execute([
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':phone' => $_POST['phone'],
            ':date' => $_POST['date'],
            ':message' => $_POST['message'],
            ':service_id' => $_POST['service_id'] // This gets the hidden service_id field value
        ]);

        if ($result) {
            echo "<script>alert('Reservation submitted successfully!');</script>";
        }
        
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservred Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<style>
    /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and Background */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
}

/* Reservation Page (Flex layout) */
.reservation-page {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 100%;
    max-width: 1200px;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

/* Room Image Section */
.room-image-section {
    width: 45%;
    text-align: center;
    padding: 20px;
}

.room-image {
    width: 90%;
    height: 500px;
    margin-top: 50px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.room-image:hover {
    transform: scale(1.05);
}

h3 {
    margin-top: 15px;
    color: #3e3e3e;
    font-size: 28px;
    font-weight: 600;
}

p {
    margin-top: 10px;
    font-size: 18px;
    color: #777;
}

/* Reservation Form Section */
.reservation-container {
    width: 55%;
}

.right-section {
    padding-left: 30px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1a1a1a;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: 1px;
}

/* Alerts (Success/Error) */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    text-align: center;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Form Styling */
.reservation-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

input, textarea {
    width: 100%;
    padding: 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    color: #333;
    background-color:rgb(249, 249, 249);
    transition: border-color 0.3s ease;
}

input:focus, textarea:focus {
    outline: none;
    border-color:rgb(80, 59, 31);
    background-color: #fff;
}

textarea {
    resize: vertical;
}

/* Button Styling */
.submit-btn {
    background-color:rgb(218, 191, 156);
    color: #fff;
    padding: 15px;
    font-size: 18px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: rgb(80, 59, 31);
}

.submit-btn:active {
    background-color: #333;
}

/* Hover Effects for Form Inputs and Button */
input:hover, textarea:hover, .submit-btn:hover {
    transform: translateY(-2px);
}

/* Responsive Design */
@media screen and (max-width: 1024px) {
    .reservation-page {
        padding: 20px;
        max-width: 900px;
    }

    .room-image {
        height: 400px;
        margin-top: 80px;
    }
}

@media screen and (max-width: 768px) {
    body {
        height: auto;
        padding: 10px;
    }

    .reservation-page {
        flex-direction: column;
        padding: 20px;
    }

    .room-image-section,
    .reservation-container {
        width: 100%;
    }

    .room-image {
        height: 300px;
        margin-top: 40px;
    }

    .right-section {
        padding-left: 0;
        margin-top: 30px;
    }

    h2 {
        font-size: 28px;
    }

    h3 {
        font-size: 24px;
    }
}

@media screen and (max-width: 480px) {
    .reservation-page {
        padding: 15px;
    }

    .room-image {
        height: 200px;
        margin-top: 20px;
    }

    input, textarea, .submit-btn {
        padding: 12px;
        font-size: 16px;
    }

    label {
        font-size: 16px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    h2 {
        font-size: 24px;
    }

    h3 {
        font-size: 20px;
    }

    p {
        font-size: 16px;
    }
}

/* Touch Device Optimizations */
@media (hover: none) {
    input:hover, textarea:hover, .submit-btn:hover {
        transform: none;
    }

    .submit-btn {
        padding: 15px 20px;
    }
}

    /* Responsive Design */
    @media screen and (max-width: 1024px) {
        .reservation-page {
            padding: 20px;
            max-width: 900px;
        }
    
        .room-image {
            height: 400px;
            margin-top: 80px;
        }
    }
    
    @media screen and (max-width: 768px) {
        body {
            height: auto;
            padding: 10px;
        }
    
        .reservation-page {
            flex-direction: column;
            padding: 20px;
        }
    
        .room-image-section,
        .reservation-container {
            width: 100%;
        }
    
        .room-image {
            height: 300px;
            margin-top: 40px;
        }
    
        .right-section {
            padding-left: 0;
            margin-top: 30px;
        }
    
        h2 {
            font-size: 28px;
        }
    
        h3 {
            font-size: 24px;
        }
    }
    
    @media screen and (max-width: 480px) {
        .reservation-page {
            padding: 15px;
        }
    
        .room-image {
            height: 200px;
            margin-top: 20px;
        }
    
        input, textarea, .submit-btn {
            padding: 12px;
            font-size: 16px;
        }
    
        label {
            font-size: 16px;
        }
    
        .form-group {
            margin-bottom: 15px;
        }
    
        h2 {
            font-size: 24px;
        }
    
        h3 {
            font-size: 20px;
        }
    
        p {
            font-size: 16px;
        }
    }
    
    /* Touch Device Optimizations */
    @media (hover: none) {
        input:hover, textarea:hover, .submit-btn:hover {
            transform: none;
        }
    
        .submit-btn {
            padding: 15px 20px;
        }
    }
</style>
<body>
    <div class="reservation-page">
        <!-- Room Image Section -->
        <div class="room-image-section">
            <img src="../images/<?= $service['services_image'] ?>" alt="Room Image" class="room-image">
            <h3><?= $service['services_name'] ?></h3>
            <p><?= $service['services_description'] ?></p>
            <p class="service-price">₱<?= number_format($service['services_price'], 2) ?></p>
        </div>
        <?php
            ?>
        <!-- Reservation Form Section -->
        <div class="reservation-container">
            <div class="right-section">
                <h2>Make a Reservation</h2>
                <form method="POST" action="reservation.php?service_id=<?= $service['services_id'] ?>" class="reservation-form">
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Special Requests:</label>
                        <textarea id="message" name="message" rows="4"></textarea>
                    </div>

                    <input type="hidden" name="service_id" value="<?= $service['services_id'] ?>">

                    <div style="display: flex; gap: 10px; justify-content: space-between;">
                        <button type="submit" class="submit-btn" style="width: 48%;">Make Reservation</button>
                        <button type="button" onclick="window.location.href='books.php'" 
                            class="submit-btn" 
                            style="width: 48%; background-color: #8B7355;">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.reservation-form').addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to make this reservation?')) {
                this.submit();
            }
        });
    </script>
</body>
</html>
