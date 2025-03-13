<?php
            include_once 'nav/homenav.php';
            include_once '../model/BookingModel.php';
            include_once '../model/Booking_Model.php';

            $model = new BookingModel();
            $bookingModel = new Booking_Model();

            // Get all services
            $services = $bookingModel->get_service();
            $images = $bookingModel->get_images();

            // Include the Connector class
            require_once '../model/server.php';
            $connector = new Connector();

            // Fetch all bookings that are pending approval
            $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out FROM booking_tb WHERE booking_status = 'pending'";
            $bookings = $connector->executeQuery($sql);
            
            $sql = "SELECT image_id,image_name, image_img, image_description FROM image_tb WHERE 1";
            $images = $connector->executeQuery($sql);

            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_dates'])) {
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
                    // Store dates in session and redirect
                    $_SESSION['check_in'] = $checkin_date;
                    $_SESSION['check_out'] = $checkout_date;
                    
                    echo "<script>
                        window.location.href = 'books.php';
                    </script>";
                } catch (Exception $e) {
                    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
                }
            }

            
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $connector = new Connector();
            
            // Validate required fields
            $required_fields = ['name', 'email', 'phone', 'checkin_date', 'checkout_date', 'message', 'service_id'];
            foreach ($required_fields as $field) {
                if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                    throw new Exception("Please fill in all required fields. Missing: " . $field);
                }
            }
            
            // Validate dates
            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
            
            if (!strtotime($checkin) || !strtotime($checkout)) {
                throw new Exception("Invalid date format");
            }
            
            $sql = "INSERT INTO reservations (name, email, phone, checkin, checkout, message, status, res_services_id) 
                    VALUES (:name, :email, :phone, :checkin, :checkout, :message, 'pending', :service_id)";
            
            $stmt = $connector->getConnection()->prepare($sql);
            $result = $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'],
                ':phone' => $_POST['phone'],
                ':checkin' => $checkin,
                ':checkout' => $checkout,
                ':message' => $_POST['message'],
                ':service_id' => $_POST['service_id']
            ]);

            if ($result) {
                echo "<script>alert('Reservation submitted successfully!');</script>";
            }
            
        } catch (Exception $e) {
            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    ini_set('memory_limit', '256M');
?>

        <link rel="stylesheet" href="../assets/css/roomstry.css">
            <main>
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
                                        style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                                </div>
                            </div>
                            <input type="hidden" name="search_dates" value="true">
                            <button type="submit" style="width: 45%; margin: 2rem auto; padding: 1rem; background: rgb(218, 191, 156); color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px; display: block;">
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
                            $sql = "INSERT INTO booking_tb (booking_check_in, booking_check_out) VALUES (:check_in, :check_out)";
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

       
    </style>
    
    
        
        <!-- Experience Section -->
        <div style="max-width: 1400px; margin: 8rem auto; padding: 0 2rem;">
        <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center;">
                            About Us
                            <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
                        </h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;">
                <div style="background: #fff; padding: 3rem; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.05);">
                    <p style="color: #34495e; font-size: 1.3rem; line-height: 1.8; margin-bottom: 2.5rem; text-align: justify; font-family: 'Roboto', sans-serif;">
                        At Casa Marcos, we believe in creating extraordinary experiences through exceptional care and attention to detail. 
                        Our dedicated team works tirelessly to ensure every guest feels welcomed and valued, combining professional 
                        service with genuine Filipino warmth.
                    </p>
                    <p style="color: #34495e; font-size: 1.3rem; line-height: 1.8; text-align: justify; font-family: 'Roboto', sans-serif;">
                        We pride ourselves on understanding and anticipating our guests' needs, offering personalized services that 
                        make every stay memorable. Our commitment to excellence extends beyond luxury amenities to create meaningful 
                        connections and experiences that will last a lifetime.
                    </p>
                </div>
                <img src="../images/villas.jpg" alt="Experience" style="width: 100%; height: 500px; object-fit: cover; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>
</section>
        <!-- Rooms Section -->
        <section class="image-slider-section" style="padding: 8rem 1rem; background-color:rgb(255, 255, 255);">
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





        <section style="padding: 8rem 2rem; background-color:rgb(255, 255, 255);">
                <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center; position: relative;">
                    Our Amenities
                    <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
                </h2>
                <div style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; padding: 0 2rem;">
                    
                    <!-- Amenity Cards -->
                <?php foreach ($images as $img): ?>
                    <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
                        <img src="../images/<?= $img['image_img'] ?>" alt="<?= $img['image_img'] ?>" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
                        <div style="padding: 2rem;">
                            <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;"><?= $img['image_name'] ?></h3>
                            <p style="color: #666; line-height: 1.6;"><?= $img['image_description'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            <style>
                .amenity-card:hover {
                    transform: translateY(-15px);
                    box-shadow: 0 15px 40px rgba(102, 67, 35, 0.2);
                }
                .amenity-card:hover img {
                    transform: scale(1.1);
                }
                .dot.active-dot {
                    background-color: rgb(163, 99, 15);
                }
                .dot {
                    background-color: #ccc;
                    transition: background-color 0.3s;
                }
                .dot:hover {
                    background-color: rgb(163, 99, 15);
                }
                @media (max-width: 1200px) {
                    div[style*="grid-template-columns"] {
                        grid-template-columns: repeat(2, 1fr) !important;
                    }
                }
                @media (max-width: 768px) {
                    div[style*="grid-template-columns"] {
                        grid-template-columns: 1fr !important;
                    }
                }
            </style>
        </section>

        <!-- Ensure that the accompanying script remains as previously provided -->
        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let currentSlideIndex = 0;
            const slides = document.querySelectorAll('.carousel-slide');
            const totalSlides = slides.length;
            const carouselWrapper = document.querySelector('.carousel-wrapper');

            slides.forEach(slides => {
                slides.style.display = 'none';
            });

            function showSlides(index) {
                slides.forEach(slides => {
                    slides.style.display = 'none';
                });
                const offset = -index * 100;
                carouselWrapper.style.transform = `translateX(${offset}%)`;
                slides[index].style.display = 'block';
                updateDots(index);
            }

            function moveSlide(direction) {
                let newIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
                showSlides(newIndex);
                currentSlideIndex = newIndex;
            }

            function updateDots(index) {
                const dots = document.querySelectorAll('.dot');
                dots.forEach((dot, i) => {
                    dot.classList.remove('active-dot');
                    dot.style.backgroundColor = '#ccc';
                });
                dots[index].classList.add('active-dot');
                dots[index].style.backgroundColor = 'rgb(163, 99, 15)';
            }

            carouselWrapper.style.display = 'block';
            showSlides(currentSlideIndex);

            document.querySelector('.prev').addEventListener('click',() => moveSlide(-1));
            document.querySelector('.next').addEventListener('click',() => moveSlide(1));
        });
        </script>

            
                    <section style="padding: 5rem 2rem; background-color:rgb(255, 255, 255);">
                        <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center;">
                            Contact Us
                            <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
                        </h2>
                        <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 2fr; gap: 3rem;">
                            <!-- Contact Info Side -->
                                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                    <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; margin-bottom: 2rem; font-family: 'impact';">Find Us</h3>
                                    
                                    <!-- Location -->
                                    <div style="margin-bottom: 2rem;">
                                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <i class="fas fa-map-marker-alt" style="color: rgb(102, 67, 35); font-size: 1.5rem; margin-right: 1rem;"></i>
                                            <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Address</h4>
                                        </div>
                                        <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;">Brgy SapSap, Pastrana Leyte</p>
                                    </div>

                                    <!-- Phone -->
                                    <div style="margin-bottom: 2rem;">
                                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <i class="fas fa-phone" style="color: rgb(102, 67, 35); font-size: 1.5rem; margin-right: 1rem;"></i>
                                            <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Phone</h4>
                                        </div>
                                        <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;">+1 234 567 8900</p>
                                    </div>

                                    <!-- Email -->
                                    <div style="margin-bottom: 2rem;">
                                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                            <i class="fas fa-envelope" style="color: rgb(102, 67, 35); font-size: 1.5rem; margin-right: 1rem;"></i>
                                            <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Email</h4>
                                        </div>
                                        <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;">casamarcosresort@gmail.com</p>
                                    </div>
                                </div>

                            <!-- Contact Form Side -->
                                <div style="background: white; padding: 3rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                    <form action="contact.php" method="POST" style="display: grid; gap: 1.5rem;">
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                            <div style="position: relative;">
                                                <i class="fas fa-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                                <input type="text" name="name" placeholder="Your Name" required 
                                                    style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                            </div>
                                            <div style="position: relative;">
                                                <i class="fas fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                                <input type="email" name="email" placeholder="Your Email" required 
                                                    style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                            </div>
                                        </div>
                                        <div style="position: relative;">
                                            <i class="fas fa-heading" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                            <input type="text" name="subject" placeholder="Subject" required 
                                                style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                        </div>
                                        <div style="position: relative;">
                                            <i class="fas fa-comment" style="position: absolute; left: 1rem; top: 1.2rem; color: #d4b696;"></i>
                                            <textarea name="message" placeholder="Your Message" required 
                                                style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; min-height: 150px; resize: vertical; width: 100%;"></textarea>
                                        </div>
                                        <button type="submit" 
                                            style="padding: 1rem 2rem; background: linear-gradient(to right, rgb(102, 67, 35), rgb(163, 99, 15)); 
                                                color: white; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; 
                                                transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 5px 15px rgba(102, 67, 35, 0.3)';"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                            <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                                            Send Message
                                        </button>
                                    </form>
                                </div>
                        </div>
                    </section>
                
            </main>

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

        

        </body>

    </html>