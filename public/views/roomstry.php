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
        $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out FROM booking_tb WHERE booking_status = 'pending'";
        $bookings = $connector->executeQuery($sql);


    require_once '../model/server.php';


    ?>
    <!-- Add this in the <head> section -->
    <link rel="stylesheet" href="../assets/css/roomstry.css">
        <section class="hero">
        </section>
       
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; margin-top: 980px;">
                <div style="max-width: 1200px; margin: 0 auto; background: rgba(255, 255, 255, 0.95); padding: 2rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); ">
                            <form method="POST" action="" style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-end; justify-content: space-between;">
                                <div class="flex-col" style="flex: 1; min-width: 200px;">
                                    <label for="checkin" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Check In</label>
                                    <input type="date" id="checkin" name="checkin_date" required 
                                        min="<?php echo date('Y-m-d'); ?>"
                                        style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                </div>
                                
                                <div class="flex-col" style="flex: 1; min-width: 200px;">
                                    <label for="checkout" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Check Out</label>
                                    <input type="date" id="checkout" name="checkout_date" required
                                        style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                </div>

                                <div class="flex-col" style="flex: 1; min-width: 150px;">
                                    <label for="adults" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Adults</label>
                                    <select id="adults" name="adults" style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>

                                <div class="flex-col" style="flex: 1; min-width: 150px;">
                                    <label for="children" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Children</label>
                                    <select id="children" name="children" style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>

                                <input type="hidden" name="search_dates" value="true">
                                <button type="submit" style="flex: 1; min-width: 200px; padding: 1rem; background: rgb(218, 191, 156); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; transition: all 0.3s ease;">
                                    Check Availability
                                </button>
                            </form>
                        </div>
                </div>

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

<section class="image-slider-section" style="padding: 8rem 1rem; background-color:rgb(255, 255, 255)">
                    <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center; position: relative;">
                    Our Rooms
                    <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
                    </h2>
                        <div class="relative flex items-center justify-center">
                            <div class="image-container">
                                <div class="image-wrapper">
                                    <?php foreach ($services as $srvc): ?>
                                        <?php
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
                                        <a href="<?= $pageUrl ?>" class="image" style="text-decoration: none; cursor: pointer;">
                                            <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" class="room-image">
                                            <div class="room-content">
                                                <div class="room-header">
                                                    <h3 class="room-title"><?= $srvc['services_name'] ?></h3>
                                                    <p class="room-details"><?= substr($srvc['services_description'], 0, 200) ?></p>
                                                    <div class="price-tag">
                                                        <p class="room-price">₱<?= number_format($srvc['services_price'], 2) ?>/night</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Enhanced Navigation Dots -->
                        <div style="text-align: center; margin-top: 3rem;">
                            <?php foreach ($services as $index => $srvc): ?>
                                <span class="room-dot" 
                                      data-index="<?= $index ?>" 
                                      style="display: inline-block; 
                                             width: 15px; 
                                             height: 15px; 
                                             border-radius: 50%; 
                                             background-color: #e0e0e0; 
                                             margin: 0 12px; 
                                             cursor: pointer;
                                             transition: all 0.4s ease;
                                             border: 2px solid rgb(163, 99, 15);
                                             box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                             position: relative;
                                             transform: scale(1);">
                                    <span style="position: absolute;
                                               top: -25px;
                                               left: 50%;
                                               transform: translateX(-50%) scale(0);
                                               background: rgb(163, 99, 15);
                                               color: white;
                                               padding: 4px 8px;
                                               border-radius: 4px;
                                               font-size: 12px;
                                               opacity: 0;
                                               transition: all 0.3s ease;
                                               white-space: nowrap;"><?= $srvc['services_name'] ?></span>
                                </span>
                            <?php endforeach; ?>
                        </div>    
                    </section>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const dots = document.querySelectorAll('.room-dot');
                        const images = document.querySelectorAll('.image');
                        
                        // Set first dot as active
                        dots[0].style.backgroundColor = 'rgb(163, 99, 15)';
                        
                        dots.forEach((dot, index) => {
                            dot.addEventListener('click', () => {
                                // Reset all dots
                                dots.forEach(d => d.style.backgroundColor = '#ccc');
                                // Activate clicked dot
                                dot.style.backgroundColor = 'rgb(163, 99, 15)';
                                
                                // Scroll to corresponding room
                                images[index].scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'nearest',
                                    inline: 'start'
                                });
                            });
                        });
                    });
                </script>

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
                // let currentIndex = 0;
                // const slider = document.querySelector('.image-wrapper');
                // const images = document.querySelectorAll('.image');
                // const totalImages = images.length;

                // // Set initial styles
                // slider.style.transition = "transform 1s ease-in-out";

                // function changeSlide() {
                //     if (currentIndex === totalImages - 1) {
                //         // Reset to first image
                //         currentIndex = 0;
                //         slider.style.transition = "none";
                //         slider.style.transform = `translateX(0)`;
                        
                //         requestAnimationFrame(() => {
                //             requestAnimationFrame(() => {
                //                 slider.style.transition = "transform 1s ease-in-out";
                //             });
                //         });
                //     } else {
                //         currentIndex++;
                //         slider.style.transform = `translateX(-${currentIndex * 100}%)`;
                //     }
                // }

                // // Start automatic sliding
                // const slideInterval = setInterval(changeSlide, 3000);

                // // Add hover controls
                // slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
                // slider.addEventListener('mouseleave', () => setInterval(changeSlide, 3000));

                // // Add touch support
                // let touchStartX = 0;
                // let touchEndX = 0;

                // slider.addEventListener('touchstart', e => {
                //     touchStartX = e.changedTouches[0].screenX;
                // });

                // slider.addEventListener('touchend', e => {
                //     touchEndX = e.changedTouches[0].screenX;
                //     if (touchStartX - touchEndX > 50) {
                //         changeSlide();
                //     }
                // });
            </script>
