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
    $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out FROM booking_tb WHERE booking_status = 'pending'";
    $bookings = $connector->executeQuery($sql);

    // Store POST data if available
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['check_in'] = $_POST['checkin_date'];
        $_SESSION['check_out'] = $_POST['checkout_date'];
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : 'Default Name';
        $email = isset($_POST['email']) ? $_POST['email'] : 'default@example.com';
        $number = isset($_POST['number']) ? $_POST['number'] : 'Default Number';
        $check_in = isset($_POST['check_in']) ? $_POST['check_in'] : null;
        $check_out = isset($_POST['check_out']) ? $_POST['check_out'] : null;
        $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : null;

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

            <form action="" method="post">
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
            </form>
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