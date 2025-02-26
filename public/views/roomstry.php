<?php
session_start();
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
    $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out FROM booking_tb WHERE booking_status = 'pending'";
    $bookings = $connector->executeQuery($sql);


require_once '../model/server.php';


?>
<!-- Add this in the <head> section -->
<link rel="stylesheet" href="../assets/css/roomstry.css">
<section class="hera">
    <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 2rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
        <form method="POST" action="" style="display: flex; flex-direction: column; align-items: center;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; width: 100%; justify-content: center;">
                <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px; text-align: center;">
                    <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK IN</h3>
                    <input type="date" id="checkin" name="checkin_date" required 
                           min="<?php echo date('Y-m-d'); ?>"
                           style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                </div>
                <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px; text-align: center;">
                    <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK OUT</h3>
                    <input type="date" id="checkout" name="checkout_date" required
                           min="<?php echo date('Y-m-d'); ?>"
                           style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                </div>
            </div>
            <button type="submit" name="submit_dates" style="width: 45%; margin: 2rem auto; padding: 1rem; background: rgb(218, 191, 156); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; display: block;">
                Search Booking
            </button>
        </form>
    </div>
</section>

<?php
if (isset($_POST['submit_dates'])) {
    try {
        $checkin_date = $_POST['checkin_date'];
        $checkout_date = $_POST['checkout_date'];
        
        // Validate dates
        $current_date = date('Y-m-d');
        if ($checkin_date < $current_date) {
            throw new Exception("Check-in date cannot be in the past.");
        }
        if ($checkout_date <= $checkin_date) {
            throw new Exception("Check-out date must be after check-in date.");
        }

        // Insert into database without status
        $sql = "INSERT INTO checkin_tb (check_in, check_out) VALUES (:check_in, :check_out)";
        $stmt = $connector->getConnection()->prepare($sql);
        $result = $stmt->execute([
            ':check_in' => $checkin_date,
            ':check_out' => $checkout_date
        ]);

        if ($result) {
            echo "<script>
                alert('Dates have been successfully saved!');
                window.location.href = 'books.php';
            </script>";
            $_SESSION['check_in'] = $checkin_date;
            $_SESSION['check_out'] = $checkout_date;
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    }
}
?>
<script>
document.getElementById('checkin').addEventListener('change', function() {
    const checkIn = new Date(this.value);
    const minCheckOut = new Date(checkIn);
    minCheckOut.setDate(minCheckOut.getDate() + 1);
    document.getElementById('checkout').min = minCheckOut.toISOString().split('T')[0];
});
</script>

<section class="image-slider-section" style="padding: 6rem 2rem; background-color: rgb(218, 191, 156);">
    <div class="relative flex items-center justify-center">
        <div class="image-container">
            <!-- Image Wrapper (Two columns for left and right images) -->
            <div class="image-wrapper">
                <?php foreach ($services as $srvc): ?>
                    <div class="image">
                        <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" class="room-image">
                        <div class="room-content">
                            <div class="room-header">
                                <h3 class="room-title"><?= $srvc['services_name'] ?></h3>
                                <p class="room-details"><?= $string = substr($srvc['services_description'],0,200); ?></p>
                                <div class="price-tag">
                                    <p class="room-price">₱<?= number_format($srvc['services_price'], 2) ?>/night</p>
                                </div>
                                <div>
                                    <?php
                                    // Define room page mapping
                                    $roomPages = [
                                        'Sapphira Villa 6 Pax' => '../pages/rooms.php?sub_page=sapphira',
                                        'Sapphira Villas 8 Pax' => '../pages/rooms.php?sub_page=sapphira8',
                                        'Matrimonial' => '../pages/rooms.php?sub_page=matrimonial',
                                        'Matrimonial Plus' => '../pages/rooms.php?sub_page=matrimonialPlus',
                                        'CV Room 4 Pax' => '../pages/rooms.php?sub_page=cvRoom4',
                                        'CV Room 8 Pax' => '../pages/rooms.php?sub_page=cvRoom8',
                                        'Barkada' => '../pages/rooms.php?sub_page=barkada',
                                    ];
                                    $roomName = trim($srvc['services_name']);
                                    $pageUrl = isset($roomPages[$roomName]) ? $roomPages[$roomName] : '#';
                                    ?>
                                    <button 
                                        onclick="window.location.href='<?= $pageUrl ?>'"
                                        class="btn"
                                        style="text-decoration: none; 
                                        position:absolute; top: 0; 
                                        left: 0; margin-left: 290px; 
                                        margin-top: 185px; 
                                        background-color:#d4b699; 
                                        padding: 12px; border-radius: 25px; 
                                        color: white; font-weight: bold; 
                                        font-size: 22px; 
                                        cursor: pointer;
                                        border: none;">
                                        View details
                                    </button>
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
