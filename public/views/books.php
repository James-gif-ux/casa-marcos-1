<?php
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = isset($data['fullname']) ? $data['fullname'] : 'Default Name';
    $email = isset($data['email']) ? $data['email'] : 'default@example.com';
    $number = isset($data['number']) ? $data['number'] : 'Default Number';
    $date = isset($data['date']) ? $data['date'] : 'Default Date';
    $service_id = isset($data['service_id']) ? $data['service_id'] : 'Default Service ID';

    // Attempt to insert the booking
    $result = $bookingModel->insert_booking($fullname, $email, $number, $date, $service_id);

    if ($result === true) {
        echo "Booking successfully added!";
    } else {
        echo $result;  // Display error message if any
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
    <title>Grid Style Example</title>
    <style>
/* Global Styles */
body {
    font-family: Arial, sans-serif;
    line-height: 1.5;
    margin: 0;
    background-color: #f8f9fa;
}

#services {
    padding: 2rem; /* Reduced padding for simplicity */
}

h2 {
    text-align: center;
    font-size: 2rem;
    color: #333;
    margin-bottom: 1.5rem;
}

.service-list {
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next row as necessary */
    justify-content: center; /* Center items */
    gap: 1.5rem; /* Space between services */
}

.service-item {
    background: #ffffff; /* White background for service item */
    border: 1px solid #ddd; /* Light border for separation */
    border-radius: 5px; /* Slightly rounded edges */
    padding: 1rem;
    text-align: center; /* Center text */
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    width: calc(45% - 1.5rem); /* Two columns, accounting for gaps */
    max-width: 400px; /* Max width to control size */
}

.service-image {
    width: 100%; /* Full width */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 0.5rem; /* Spacing below image */
}

.description {
    font-size: 0.9rem;
    color: #666;
    margin: 0.5rem 0; /* Margins for spacing */
}

.service-price {
    font-size: 1.1rem;
    color: #007bff; /* Bootstrap primary color for price */
    margin: 0.5rem 0; /* Margins for spacing */
}

.readmore {
    background-color: #28a745; /* Green button */
    color: #ffffff;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s; /* Smooth transition */
}

.readmore:hover {
    background-color: #218838; /* Darker green on hover */
}
</style>

<section id="services" class="services section">
    <div class="container">
        <h2>Our Rooms</h2>
        <div class="service-list">
            <?php foreach ($services as $srvc): ?>
                <div class="service-item">
                    <h3><?= $srvc['services_name'] ?></h3>
                    <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" class="service-image">
                    <p class="description"><?= $srvc['services_description'] ?></p>
                    <div class="service-price">
                        $<?= number_format($srvc['services_price'], 2) ?>
                    </div>
                    <button type="button" class="readmore" data-bs-toggle="modal" data-bs-target="#bookingModal" 
                        data-id="<?= $srvc['services_id'] ?>" 
                        data-name="<?= $srvc['services_name'] ?>">
                        Book Now!
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</section>
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
                        <label for="date" class="form-label">Booking Date:</label>
                        <input type="date" name="date" class="form-control" required>
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


</body>
</html>
