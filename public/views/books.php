<?php
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
h2{
    text-align: center;
    color: #2a2a2a;
    font-size: 80px ;
    margin-bottom: 2rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1rem;
    margin-top: 2rem;
}
#services {
    padding: 200px; /* Reduced top/bottom padding, added side padding */
}

.service-list {
    display: grid;
    grid-template-columns: 1fr; /* Single column */
    gap: 2rem; /* Increased gap between items */
    max-width: 1200px; /* Maximum width of content */
    margin: 0 auto; /* Center the container */
}

.service-item {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 100%; /* Full width */
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two columns inside service item */
    gap: 2rem;
    align-items: center;
}

.service-item h3 {
    font-size: 1.8rem;
    color: #333;
    margin-bottom: 1rem;
    grid-column: 1 / -1; /* Span full width */
}

.service-image {
    width: 100%;
    height: 400px; /* Fixed height */
    object-fit: cover;
    border-radius: 8px;
}

.service-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.description {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.6;
}

.service-price {
    font-size: 1.5rem;
    color: #007bff;
    font-weight: bold;
    margin: 1rem 0;
}

.readmore {
    background-color: #28a745;
    color: #ffffff;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    width: fit-content;
    margin: 0 auto;
}

.readmore:hover {
    background-color: #218838;
    transform: translateY(-2px);
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
                    <div class="service-content">
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
