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

<?php
require_once '../model/server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $connector = new Connector();
        
        // Validate dates
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
        
        
        if (strtotime($check_out) <= strtotime($check_in)) {
            throw new Exception("Check-out date must be after check-in date");
        }

        // Insert into checkin_tb
        $sql = "INSERT INTO checkin_tb (check_booking_id, `check-in`, `check-out`) 
                VALUES (?, ?, ?)";

        

      

        if ($result) {
            $_SESSION['success'] = "Booking dates saved successfully!";
            header("Location: confirmation.php");
            exit();
        }

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
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
    <style>
        /* Global Styles */
        :root {
            --primary-color: #a0784d; /* Warm, sophisticated primary color */
            --secondary-color: #f8f0e3; /* Soft, elegant secondary color */
            --text-color: #333333; /* Darker text for readability */
            --accent-color: #d4aa7d; /* Accent for highlights */
            --font-family-heading: 'Playfair Display', serif;
            --font-family-body: 'Poppins', sans-serif;
        }


        #services {
            padding: clamp(4rem, 7vw, 8rem);
        }

        .service-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive columns */
            gap: 3rem; /* Increased gap */
            max-width: 1400px; /* Wider content area */
            margin: 0 auto;
            justify-items: center; /* Center items horizontally */
        }

        .service-item {
            background: #ffffff; /* Pure white background */
            border: 1px solid rgba(0, 0, 0, 0.08); /* Very subtle border */
            border-radius: 15px; /* More rounded corners */
            padding: 2.5rem; /* More padding */
            text-align: left; /* Keep text left-aligned */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Stronger shadow */
            width: 100%; /* Full width within its grid cell */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-item:hover {
            transform: translateY(-8px); /* More pronounced lift on hover */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); /* Even stronger shadow on hover */
        }

        .service-item h3 {
            font-family: var(--font-family-heading);
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1.2rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .service-image {
            width: 100%;
            height: 350px; /* Increased height */
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .service-content {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .description {
            font-size: 1.05rem;
            color: #555;
            line-height: 1.8;
        }

        .service-price {
            font-size: 1.7rem;
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1rem;
            font-family: var(--font-family-heading);
        }

        .readmore {
            background-color: var(--primary-color);
            color: #ffffff;
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.05rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            align-self: start; /* Align button to the start of the flex container */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            font-family: var(--font-family-body);
            font-weight: 500;
        }

        .readmore:hover {
            background-color: var(--accent-color);
            transform: translateY(-3px);
        }

        .reserve-now { /* Style for the Reserve Now button */
            background-color: var(--accent-color);
            color: #ffffff;
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.05rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
            align-self: start;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            font-family: var(--font-family-body);
            font-weight: 500;
        }

        .reserve-now:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Booking Section Styling */
        .booking-container {
            background: rgba(255, 255, 255, 0.98); /* Nearly opaque white */
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px); /* Subtle blur */
            position: sticky;
            top: 120px; /* Adjust top position */
            z-index: 10;
            margin-top: 130px;
            transition: box-shadow 0.3s ease, height 0.3s ease; /* Smooth shadow and height transition */
            height: 750px;
        }

        .booking-container:hover {
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25); /* Stronger shadow on hover */
        }

        .check-section {
            background: var(--secondary-color); /* Light background */
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05); /* Subtle inset shadow */
        }

        .check-section h3 {
            font-family: var(--font-family-heading);
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        input[type="date"],
        input[type="time"],
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 1rem 1.2rem;
            margin-bottom: 1.2rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1.05rem;
            font-family: var(--font-family-body);
            transition: border-color 0.3s ease;
        }

        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: var(--primary-color); /* Highlight on focus */
            outline: none; /* Remove default focus outline */
        }

        /* Submit Button */
        .booking-container button[type="submit"] {
            width: 100%;
            padding: 1.1rem;
            margin-top: 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); /* Gradient background */
            color: #ffffff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 600;
            font-family: var(--font-family-body);
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .booking-container button[type="submit"]:hover {
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color)); /* Reverse gradient on hover */
            transform: translateY(-3px);
        }

        /* Content Wrapper and Responsiveness */
        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 0.6fr; /* Adjusted for a more luxurious feel */
            gap: 3rem;
            max-width: 1600px;
            margin: 0 auto;
            padding: 6rem 4rem; /* Increased padding */
            min-height: 100vh;
        }

        .rooms-container {
            overflow-y: auto;
            padding-right: 2rem;
        }


        @media (max-width: 1400px) {
            .content-wrapper {
                padding: 4rem 2rem;
            }
            .service-list {
                gap: 2rem;
            }
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

            .rooms-container {
                padding-right: 0;
            }
        }

        @media (max-width: 992px) {
            .service-item {
                padding: 2rem;
            }
            .service-image {
                height: 300px;
                margin-bottom: 1rem;
            }
            .description {
                font-size: 1rem;
            }
            .service-price {
                font-size: 1.5rem;
            }
            .readmore {
                padding: 12px 20px;
                font-size: 1rem;
            }

            .check-section {
                padding: 1.5rem;
            }
        }


        @media (max-width: 768px) {
            .service-list {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .service-item {
                padding: 1.5rem;
            }

            .service-image {
                height: 250px;
            }

            .content-wrapper {
                padding: 2rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .check-section {
                padding: 1rem;
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
                                    <button type="button" class="reserve-now" data-bs-toggle="modal" data-bs-target="#bookingModal"
                                            data-id="<?= $srvc['services_id'] ?>"
                                            data-name="<?= $srvc['services_name'] ?>">
                                        Reserve Now
                                    </button>
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
                    <input type="date" name="check_in" required min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="check-section">
                    <h3>Check-out</h3>
                    <input type="date" name="check_out" required>
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

        document.querySelector('input[name="check_in"]').addEventListener('change', function() {
            const checkIn = new Date(this.value);
            const minCheckOut = new Date(checkIn);
            minCheckOut.setDate(minCheckOut.getDate() + 1);
            
            document.querySelector('input[name="check_out"]').min = minCheckOut.toISOString().split('T')[0];
        });
    </script>

    <footer>
        <p>© 2025 Casa Marcos. All rights reserved</p>
    </footer>
</body>
</html>