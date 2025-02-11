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

<style>
//* Section Styling */
.image-slider-section {
    padding: 5rem 2rem;
    background-color: #f4f4f4;
}

/* Flexbox for positioning and layout */
.relative {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Container for the images and text */
.image-container {
    width: 200%;
    max-width: 1500px;
    position: relative;
    overflow: hidden; /* Ensures no overflow when sliding */
}

/* Wrapper for the left, right, and additional images */
.image-wrapper {
    display: flex; /* Display images side by side */
    justify-content: space-between; /* Adds space between images */
    position: relative;
    transition: transform 1s ease-in-out; /* Smooth sliding transition */
}

/* Styling for each image */
.image {
    width: 48%; /* Make each image take up 48% of the width, leaving space between */
    flex-shrink: 0; /* Prevent images from shrinking */
    position: relative;
    overflow: hidden;
    border-radius: 12px; /* Round the corners of the images */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Soft shadow around images */
    margin: 0 1%; /* Add margin on the left and right of each image */
}

/* Image styling */
.image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease; /* Smooth transition */
}

/* Dark Overlay */
.overlay-dark {
    background-color: rgba(51, 51, 51, 0.6);
    position: absolute;
    inset: 0;
    border-radius: 12px; /* Round the overlay to match the image */
}

/* Light Overlay on the left image */
.overlay-light-left {
    background-color: rgba(243, 244, 246, 0.8);
    position: absolute;
    inset-y: 0;
    width: 50%;
    left: 0;
    border-radius: 12px 0 0 12px; /* Rounded corners on the left */
}

/* Light Overlay on the right image */
.overlay-light-right {
    background-color: rgba(243, 244, 246, 0.8);
    position: absolute;
    inset-y: 0;
    width: 50%;
    right: 0;
    border-radius: 0 12px 12px 0; /* Rounded corners on the right */
}

/* Description Styling - Initially Hidden */
.image-description {
    position: absolute;
    bottom: 30px;
    left: 20px;
    right: 20px;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    padding: 20px;
    background: rgba(0, 0, 0, 0.8);
    border-radius: 8px;
    max-width: 90%;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.room-title {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif;
    letter-spacing: 1px;
}

.room-details {
    font-size: 1rem;
    line-height: 1.5;
}

/* Show description and price on hover */
.image:hover .image-description,
.image:hover {
    opacity: 1;
    transform: translateY(0) translateX(0);
}

/* Darken overlay only on hover */
.overlay-dark {
    background-color: rgba(51, 51, 51, 0);
    transition: background-color 0.3s ease;
}



/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
    /* Stack the images vertically */
    .image-wrapper {
        flex-direction: column; /* Stack images vertically */
        gap: 2rem; /* Add space between images */
    }

    .image {
        width: 100%; /* Make images full-width on small screens */
    }

    .image-description {
        bottom: 20px;
        left: 20px;
        right: 20px;
        padding: 15px;
        max-width: 95%;
    }

    .room-title {
        font-size: 1.5rem; /* Adjust title font size */
    }

    .room-details {
        font-size: 0.9rem; /* Adjust details font size */
    }

    .price-section {
        font-size: 1.5rem; /* Adjust price text size */
    }
}
</style>



        <section class="hera">
            <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 1rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
            <form action="/reservation/submit" method="POST">
                    <!-- Check-in and Check-out Section -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px;">
                            <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK IN</h3>
                            <input type="date" name="check_in" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                            <input type="time" name="check_in_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                        </div>
                        <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px;">
                            <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK OUT</h3>
                            <input type="date" name="check_out" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                            <input type="time" name="check_out_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" style="width: 50%; padding: 1rem; margin-top: 2rem; background: linear-gradient(to right, rgb(218, 191, 156), rgb(218, 191, 156)); color: white; border: none; border-radius: 12px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
                        Search Booking
                    </button>
                </form>
            </div>
        </section>



        <section class="image-slider-section" style = "padding: 10rem 1rem; background-color:rgb(255, 255, 255);">
            <div class="relative flex items-center justify-center">
                <div class="image-container">
                    <!-- Image Wrapper (Two columns for left and right images) -->
                    <div class="image-wrapper">
                        <!-- Left Column Image -->
                        <div class="image left-image">
                            <img src="../images/room.jpg" alt="Holiday Tier Deluxe Room" />
                            <div class="overlay-dark"></div>
                            <div class="overlay-light-left"></div>
                            <div class="image-description">
                                <h2 class="room-title">Holiday Tier Deluxe Room</h2>
                                <p class="room-details">A luxurious and spacious room designed for ultimate comfort. Experience a blend of elegance and modern amenities, ideal for those seeking a premium getaway.</p>
                            </div>
                        </div>

                        <!-- Right Column Image -->
                        <div class="image right-image">
                            <img src="../images/room.jpg" alt="Holiday Tier Superior Room" />
                            <div class="overlay-dark"></div>
                            <div class="overlay-light-right"></div>
                            <div class="image-description">
                                <h2 class="room-title">Holiday Tier Superior Room</h2>
                                <p class="room-details">Enjoy a perfect stay with exceptional amenities in our superior room, featuring modern furnishings and a serene atmosphere for a relaxing experience.</p>
                            </div>
                        </div>

                        <div class="image right-image">
                            <img src="../images/room.jpg" alt="Holiday Tier Superior Room" />
                            <div class="overlay-dark"></div>
                            <div class="overlay-light-right"></div>
                            <div class="image-description">
                                <h2 class="room-title">Holiday Tier Superior Room</h2>
                                <p class="room-details">Enjoy a perfect stay with exceptional amenities in our superior room, featuring modern furnishings and a serene atmosphere for a relaxing experience.</p>
                            </div>
                        </div>

                        <div class="image right-image">
                            <img src="../images/room.jpg" alt="Holiday Tier Superior Room" />
                            <div class="overlay-dark"></div>
                            <div class="overlay-light-right"></div>
                            <div class="image-description">
                                <h2 class="room-title">Holiday Tier Superior Room</h2>
                                <p class="room-details">Enjoy a perfect stay with exceptional amenities in our superior room, featuring modern furnishings and a serene atmosphere for a relaxing experience.</p>
                            </div>
                        </div>


                        <div class="image right-image">
                            <img src="../images/room.jpg" alt="Holiday Tier Superior Room" />
                            <div class="overlay-dark"></div>
                            <div class="overlay-light-right"></div>
                            <div class="image-description">
                                <h2 class="room-title">Holiday Tier Superior Room</h2>
                                <p class="room-details">Enjoy a perfect stay with exceptional amenities in our superior room, featuring modern furnishings and a serene atmosphere for a relaxing experience.</p>
                            </div>
                        </div>

                        <div class="image right-image">
                            <img src="../images/room.jpg" alt="Holiday Tier Superior Room" />
                            <div class="overlay-dark"></div>
                            <div class="overlay-light-right"></div>
                            <div class="image-description">
                                <h2 class="room-title">Holiday Tier Superior Room</h2>
                                <p class="room-details">Enjoy a perfect stay with exceptional amenities in our superior room, featuring modern furnishings and a serene atmosphere for a relaxing experience.</p>
                            </div>
                        </div>

                        
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
    let currentIndex = 0; // Initialize the current index
    const images = document.querySelectorAll('.image'); // Get all image elements
    const totalImages = images.length; // Get the total number of images

    // Function to change slide
    function changeSlide() {
        currentIndex = (currentIndex + 1) % totalImages;  // Increment index and loop back to 0 after last image
        const slider = document.querySelector('.image-wrapper');
        slider.style.transition = "transform 1s ease-in-out"; // Add smooth transition for slide movement
        slider.style.transform = `translateX(-${currentIndex * 100}%)`; // Move the slider to the correct position
    }

    // Automatically change slide every 4 seconds
    setInterval(changeSlide, 4000);

    // Optional: Reset the transition after 3 slides to make it smooth when looping back
    slider.addEventListener("transitionend", function() {
        if (currentIndex === totalImages - 1) {
            setTimeout(() => {
                const slider = document.querySelector('.image-wrapper');
                slider.style.transition = "none"; // Disable transition briefly
                slider.style.transform = `translateX(0%)`; // Jump back to the first image instantly
                currentIndex = 0; // Reset to first image
            }, 500  ); // Wait for a brief moment before jumping back to the start
        }
    });

   </script>
