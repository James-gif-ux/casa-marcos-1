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
h2 {
    text-align: center;
    color: #2a2a2a;
    font-size: clamp(40px, 5vw, 80px);
    margin-bottom: clamp(1rem, 3vw, 2rem);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1rem;
    margin-top: clamp(1rem, 3vw, 2rem);
}

#services {
    padding: clamp(40px, 5vw, 180px);
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
    width: 900px; /* Full width */
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

.booking-sidebar {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 400px;
    z-index: 1000;
    margin-right: 20px;
}

.booking-form {
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(8px);
}

.date-inputs {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.check-section {
    background: rgba(250, 240, 230, 0.5);
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.content-wrapper {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    max-width: 1800px;
    margin: 0 auto;
    padding: 20px;
    min-height: 100vh;
}

.rooms-container {
    height: 100%;
    overflow-y: auto;
    padding-right: 30px;
}

.booking-container {
    height: fit-content;
    position: sticky;
    top: 240px; /* Increased top position */
    margin-top: 150px; /* Added margin to lower position */
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(8px);
}

.check-section {
    background: rgba(250, 240, 230, 0.5);
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 1rem;
}

@media (max-width: 1200px) {
    .content-wrapper {
        grid-template-columns: 1fr;
    }

    .booking-container {
        position: relative;
        top: 0;
        margin-top: 2rem;
        width: 100%;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
}

@media (max-width: 768px) {
    .service-list {
        gap: 1rem;
    }

    .service-item {
        grid-template-columns: 1fr;
        width: 100%; /* Full width for mobile */
        padding: 1rem;
    }

    .service-image {
        height: 250px;
        width: 100%;
    }

    .check-section {
        padding: 0.8rem;
    }

    input[type="date"],
    input[type="time"] {
        font-size: 0.9rem;
        padding: 0.6rem;
        width: 100%;
    }

    .content-wrapper {
        padding: 10px;
    }

    .booking-container {
        padding: 1rem;
        margin-top: 1rem;
    }

    .service-content {
        padding: 0.5rem;
    }

    .description {
        font-size: 0.95rem;
    }

    .service-price {
        margin: 0.5rem 0;
    }
}

@media (max-width: 480px) {
    h2 {
        font-size: 32px;
    }

    #services {
        padding: 20px;
    }

    .service-image {
        height: 200px;
    }

    .description {
        font-size: 0.9rem;
    }

    .service-price {
        font-size: 1.2rem;
    }

    .readmore {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
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

<div class="content-wrapper">
    <div class="rooms-container">
        <!-- Existing rooms section -->
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
                                ₱<?= number_format($srvc['services_price'], 2) ?>
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
    </div>

    <div class="booking-container">
        <form action="../pages/books.php" method="POST">
            <div class="check-section">
                <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK IN</h3>
                <input type="date" name="check_in" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                <input type="time" name="check_in_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem;">
            </div>
            
            <div class="check-section">
                <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK OUT</h3>
                <input type="date" name="check_out" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                <input type="time" name="check_out_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem;">
            </div>

            <button type="submit" style="width: 100%; padding: 1rem; margin-top: 1rem; background: linear-gradient(to right, rgb(218, 191, 156), rgb(218, 191, 156)); color: white; border: none; border-radius: 12px; cursor: pointer; font-size: 1.1rem; font-weight: bold;">
                Search Booking
            </button>
        </form>
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

<footer>
        <p>© 2025 Casa Marcos. All rights reserved.</p>
    </footer>
</body>
</html>
