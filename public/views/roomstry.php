<?php
include 'nav/homenav.php';
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
    // Get form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $date = $_POST['date'];
    $service_id = $_POST['service_id'];  // Get the selected service ID from the form

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
        /* Your CSS styles */
     

        #services {
            padding: 200px;
            background-color: #fff;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .service-item {
            background-color: #ffffff;
            padding: 20px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            flex: 1 1 calc(33.333% - 20px);
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .service-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .readmore {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .readmore:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }
        footer p {
            text-align: center;
            font-size: 1.0em;
            margin: 1px auto; 
            color: #fff;
            width: 100%;
            display: block; 
        }
    </style>
</head>
<body>

<section id="services" class="services section">
    <div class="container">
        <h2>Our Services</h2>
        <div class="row">
            <?php foreach ($services as $srvc): ?>
                <div class="service-item">
                    <div class="icon">
                        <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" style="width: 100%; height: 350px; object-fit: cover;">
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
    <footer>
        <p>© 2025 Casa Marcos. All rights reserved.</p>
    </footer>

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