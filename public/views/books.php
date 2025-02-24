<?php
session_start();
require_once 'nav/homenav.php';
include_once '../model/BookingModel.php';
include_once '../model/Booking_Model.php';

$model = new BookingModel();
$bookingModel = new Booking_Model();

// Get all services
$services = $bookingModel->get_service();

// Include the Connector class
require_once '../model/server.php';
$connector = new Connector();

// Fetch all bookings that are pending approval
$sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_date FROM booking_tb WHERE booking_status = 'pending'";
$bookings = $connector->executeQuery($sql);

// Store POST data if available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['check_in'] = $_POST['checkin_date'];
    $_SESSION['check_out'] = $_POST['checkout_date'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = isset($data['fullname']) ? $data['fullname'] : 'Default Name';
    $email = isset($data['email']) ? $data['email'] : 'default@example.com';
    $number = isset($data['number']) ? $data['number'] : 'Default Number';
    $check_in = isset($data['check_in']) ? $data['check_in'] : date('Y-m-d');
    $check_out = isset($data['check_out']) ? $data['check_out'] : date('Y-m-d', strtotime('+1 day'));
    $service_id = isset($data['service_id']) ? $data['service_id'] : 'Default Service ID';

    // Attempt to insert the booking with check-in and check-out dates
    $result = $bookingModel->insert_booking($fullname, $email, $number, $check_in, $check_out, $service_id);

    if ($result === true) {
        $_SESSION['booking_success'] = true;
        header("Location: confirmation.php");
        exit();
    } else {
        $_SESSION['error'] = $result;
        header("Location: books.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Grid Style Example</title>
    <link rel="stylesheet" href="../assets/css/books.css">

</head>
<body>
    <?php require_once 'nav/homenav.php'; ?>

    <div class="content-wrapper">
        <div class="rooms-container">
            <section id="services" class="services section">
                <div class="service-list">
                    <?php foreach ($services as $srvc): ?>
                        <div class="service-item">
                            <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" class="service-image">
                            <div class="service-content">
                                <h3><?= $srvc['services_name'] ?></h3>
                                <p class="description"><?= $srvc['services_description'] ?></p>
                                <div class="service-price">
                                    ₱<?= number_format($srvc['services_price'], 2) ?>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <button type="button" class="readmore" data-bs-toggle="modal" data-bs-target="#bookingModal"
                                            data-id="<?= $srvc['services_id'] ?>"
                                            data-name="<?= $srvc['services_name'] ?>">
                                        Book Now
                                    </button>
                                    <a href="reservation.php?service_id=<?= $srvc['services_id'] ?>" 
                                       class="readmore" 
                                       style="display: flex; align-items: center; justify-content: center; text-decoration: none; color: white;">
                                        Reserve Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

        <div class="booking-container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
                <div class="check-section">
                    <h3>Check-in</h3>
                    <input type="date" name="check_in" 
                           value="<?php echo isset($_SESSION['check_in']) ? $_SESSION['check_in'] : '2025-02-18'; ?>"
                           required min="<?= date('Y-m-d') ?>">
                </div>

                <div class="check-section">
                    <h3>Check-out</h3>
                    <input type="date" name="check_out" 
                           value="<?php echo isset($_SESSION['check_out']) ? $_SESSION['check_out'] : '2025-02-19'; ?>"
                           required>
                </div>
                <button type="submit">Search Booking</button>
        </div>
    </div>

    <!-- Single Modal for all bookings -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Your Service:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../pages/submit-booking.php" method="POST">
                        <input type="hidden" name="service_id" id="service_id" />
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name:</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="number" class="form-label">Phone Number:</label>
                            <input type="text" name="number" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="service" class="form-label">Select Service:</label>
                            <input type="text" id="service_name" name="service" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="check_in" class="form-label">Check-in Date:</label>
                            <input type="date" name="check_in" class="form-control" 
                                   value="<?php echo isset($_SESSION['check_in']) ? $_SESSION['check_in'] : date('Y-m-d'); ?>"
                                   required min="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label">Check-out Date:</label>
                            <input type="date" name="check_out" class="form-control"
                                   value="<?php echo isset($_SESSION['check_out']) ? $_SESSION['check_out'] : date('Y-m-d', strtotime('+1 day')); ?>"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event delegation to handle dynamic content
            document.querySelectorAll('.readmore').forEach(button => {
                button.addEventListener('click', function () {
                    // Get service details from data attributes
                    const serviceId = this.getAttribute('data-id');
                    const serviceName = this.getAttribute('data-name');

                    // Populate the modal with service data
                    document.getElementById('service_id').value = serviceId;
                    document.getElementById('service_name').value = serviceName;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event delegation to handle dynamic content
            document.querySelectorAll('.readmore').forEach(button => {
                button.addEventListener('click', function () {
                    // Get service details from data attributes
                    const serviceId = this.getAttribute('data-id');
                    const serviceName = this.getAttribute('data-name');
    
                    // Populate the modal with service data
                    document.getElementById('service_id').value = serviceId;
                    document.getElementById('service_name').value = serviceName;
                });
            });
        });
    </script>
    <script>
        // Handle check-in and check-out date validation
        const checkInInput = document.querySelector('input[name="check_in"]');
        const checkOutInput = document.querySelector('input[name="check_out"]');
    
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const minCheckOutDate = new Date(checkInDate);
            minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
            
            checkOutInput.min = minCheckOutDate.toISOString().split('T')[0];
            
            // If current check-out date is before new minimum, update it
            if (new Date(checkOutInput.value) <= checkInDate) {
                checkOutInput.value = minCheckOutDate.toISOString().split('T')[0];
            }
        });
    </script>

    <footer>
        <p>© 2025 Casa Marcos. All rights reserved</p>
    </footer>
</body>
</html>