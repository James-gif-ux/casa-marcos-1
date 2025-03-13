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
    $sql = "SELECT reservation_id, name, email, phone, checkin, checkout, message FROM reservations WHERE status = 'pending'";
    $reservations = $connector->executeQuery($sql);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $connector = new Connector();
            
            // Updated SQL to include res_services_id
            $sql = "INSERT INTO reservations (name, email, phone, checkin, checkout, message, status, res_services_id) 
                    VALUES (:name, :email, :phone, :checkin, :checkout, :message, 'pending', :service_id)";
            
            $stmt = $connector->getConnection()->prepare($sql);
            $result = $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':phone' => $_POST['phone'],
                ':checkin' => $_POST['checkin'],
                ':checkout' => $_POST['checkout'],
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
                <link rel="stylesheet" href="../assets/css/styles.css">
                <link rel="stylesheet" href="../assets/css/res.css">
            </head>
        <style>
         
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

                                <div class="mb-3">
                                <label for="check_in" class="form-label">Check-in Date:</label>
                                <input type="date" name="check_in" class="form-control" id="modal_check_in" required 
                                    min="<?php echo date('Y-m-d') ?>"
                                    value="<?php echo isset($_SESSION['check_in']) ? $_SESSION['check_in'] : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="check_out" class="form-label">Check-out Date:</label>
                                <input type="date" name="check_out" class="form-control" id="modal_check_out" required 
                                    min="<?php echo date('Y-m-d'); ?>"
                                    value="<?php echo isset($_SESSION['check_out']) ? $_SESSION['check_out'] : ''; ?>">
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
