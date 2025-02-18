<?php
    include_once 'nav/homenav.php';
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

        $params = [
            $_SESSION['booking_id'], // Assuming booking_id is stored in session
            $check_in,
            $check_out
        ];

        $result = $connector->executeQuery($sql, $params);

        if ($result) {
            $_SESSION['success'] = "Check-in/out dates saved successfully!";
            header("Location: confirmation.php");
            exit();
        }

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}
?>

<!-- Add this in the <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../assets/css/roomstry.css">


<section class="hera">
    <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 1rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="display: flex; flex-direction: column; align-items: center;">
            <!-- Check-in and Check-out Section -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; width: 100%; justify-content: center;">
                <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px; text-align: center;">
                    <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK IN</h3>
                    <input type="date" id="check_in" name="check_in" required 
                           min="<?php echo date('Y-m-d'); ?>"
                           style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                </div>
                <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px; text-align: center;">
                    <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK OUT</h3>
                    <input type="date" id="check_out" name="check_out" required
                           style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
            </div>

            <script>
                document.getElementById('check_in').addEventListener('change', function() {
                    const checkIn = new Date(this.value);
                    const minCheckOut = new Date(checkIn);
                    minCheckOut.setDate(minCheckOut.getDate() + 1);
                    
                    document.getElementById('check_out').min = minCheckOut.toISOString().split('T')[0];
                });
            </script>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">Submit</button>
        </form>
    </div>
</section>



<section class="image-slider-section" style="padding: 5rem 1rem; background-color: rgb(218, 191, 156);">
    <div class="relative flex items-center justify-center">
        <div class="image-container">
            <!-- Image Wrapper (Two columns for left and right images) -->
            <div class="image-wrapper">
                <?php foreach ($services as $srvc): ?>
                    <div class="image">
                        <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" class="room-image">
                        <div class="room-content">
                            <!-- Combined Title, Description, and Price -->
                            <div class="room-header">
                                <h3 class="room-title"><?= $srvc['services_name'] ?></h3>
                                <p class="room-details"><?= $string = substr($srvc['services_description'],0,200); ?></p> <!-- Description between title and price -->
                                <div class="price-tag">
                                    <p class="room-price">₱<?= number_format($srvc['services_price'], 2) ?>/night</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

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
        <script>
            let currentIndex = 0;
            const slider = document.querySelector('.image-wrapper');
            const images = document.querySelectorAll('.image');
            const totalImages = images.length;

            // Set initial styles
            slider.style.transition = "transform 1s ease-in-out";

            function changeSlide() {
                if (currentIndex === totalImages - 1) {
                    // Reset to first image
                    currentIndex = 0;
                    slider.style.transition = "none";
                    slider.style.transform = `translateX(0)`;
                    
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            slider.style.transition = "transform 1s ease-in-out";
                        });
                    });
                } else {
                    currentIndex++;
                    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                }
            }

            // Start automatic sliding
            const slideInterval = setInterval(changeSlide, 3000);

            // Add hover controls
            slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
            slider.addEventListener('mouseleave', () => setInterval(changeSlide, 3000));

            // Add touch support
            let touchStartX = 0;
            let touchEndX = 0;

            slider.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            });

            slider.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                if (touchStartX - touchEndX > 50) {
                    changeSlide();
                }
            });
        </script>
