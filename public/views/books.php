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
body {
    font-family: Arial, sans-serif;
    line-height: 1.5;
    margin: 0;
    background-color: #f8f9fa;
}

#services {
    padding: 2rem; /* Reduced padding for simplicity */
}

h2 {
    text-align: center;
    font-size: 2rem;
    color: #333;
    margin-bottom: 1.5rem;
}

.service-list {
    display: flex;
    flex-wrap: wrap; /* Allow items to wrap to the next row as necessary */
    justify-content: center; /* Center items */
    gap: 1.5rem; /* Space between services */
}

.service-item {
    background: #ffffff; /* White background for service item */
    border: 1px solid #ddd; /* Light border for separation */
    border-radius: 5px; /* Slightly rounded edges */
    padding: 1rem;
    text-align: center; /* Center text */
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    width: calc(45% - 1.5rem); /* Two columns, accounting for gaps */
    max-width: 400px; /* Max width to control size */
}

.service-image {
    width: 100%; /* Full width */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 0.5rem; /* Spacing below image */
}

.description {
    font-size: 0.9rem;
    color: #666;
    margin: 0.5rem 0; /* Margins for spacing */
}

.service-price {
    font-size: 1.1rem;
    color: #007bff; /* Bootstrap primary color for price */
    margin: 0.5rem 0; /* Margins for spacing */
}

.readmore {
    background-color: #28a745; /* Green button */
    color: #ffffff;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s; /* Smooth transition */
}

.readmore:hover {
    background-color: #218838; /* Darker green on hover */
}
</style>

<section id="services" class="services section">
    <div class="container">
        <h2>Our Services</h2>
        <div class="service-list">
            <?php foreach ($services as $srvc): ?>
                <div class="service-item">
                    <h3><?= $srvc['services_name'] ?></h3>
                    <img src="../images/<?= $srvc['services_image'] ?>" alt="<?= $srvc['services_name'] ?>" class="service-image">
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
        echo $result; // Display error message if any
    }
}
?>

<style>
    /* Section Styling */
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
        height: 600px; /* Increased fixed height */
        position: relative;
        overflow: hidden;
    }

    /* Wrapper for the left, right, and additional images */
    .image-wrapper {
        display: flex; /* Display images side by side */
        justify-content: space-between; /* Adds space between images */
        position: relative;

    /* Image styling */
    .image img {
        width: 100%;
        height: 600px; /* Increased fixed height */
        object-fit: cover;
        transition: transform 0.5s ease;
    }
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

    .room-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .room-content {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 2rem;
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
    }

    .image-wrapper {
        display: flex;
        flex-direction: row;
        width: 100%;
        animation: continuousSlide 30s linear infinite;
    }

    @keyframes continuousSlide {
        0% {
            transform: translateX(0);
        }
        100% {
            /* Move left by 50% of the width to show the duplicate set */
            transform: translateX(-263%);
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

<section class="image-slider-section" style="padding: 5rem 1rem; background-color: rgb(218, 191, 156);">
    <div class="relative flex items-center justify-center">
        <div class="image-container">
            <!-- Image Wrapper (Two columns for left and right images) -->
            <div class="image-wrapper">
                <div class="image left-image">
                    <img src="../images/3.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-left"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5);">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Sapphira Villas 6 Pax</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">A two story villa with 1 Queen-size bed & 4 single beds, 2 private bathrooms, large private living room, TV, Wi-Fi & air conditioning.</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱8,999/night</p>
                    </div>
                </div>

                <div class="image right-image">
                    <img src="../images/11.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-right"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5);">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Sapphira Villas 8 Pax</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">A two story villa with 1 Queen-size bed & 8 single-size beds, 2 private bathrooms, large private living room, TV, Wi-Fi & air conditioning.</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱11,999/night</p>
                    </div>
                </div>

                <div class="image right-image">
                    <img src="../images/room.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-right"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5); ">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Matrimonial</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">Queen-size bed, private bathroom, TV, Wi-Fi, air conditioning</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱4,999/night</p>
                    </div>
                </div>

                <div class="image right-image">
                    <img src="../images/mp.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-right"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5); ">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Matrimonial Plus</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">Queen-size bed, larger room, larger private bathroom, TV, Wi-Fi, air conditioning</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱5,399/night</p>
                    </div>
                </div>

                <div class="image right-image">
                    <img src="../images/barkada.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-right"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5); ">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Barkada</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">4 Twin-sized bed, private bathroom, TV, Wi-Fi, air conditioning</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱7,999/night</p>
                    </div>
                </div>

                <div class="image right-image">
                    <img src="../images/CV4.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-right"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5); ">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">CV Room 4 Pax</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">2 Queen-sized bed, Shared bathroom, TV, Wi-Fi, air conditioning</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱3,999/night</p>
                    </div>
                </div>

                <div class="image right-image">
                    <img src="../images/CVP.jpg"/>
                    <div class="overlay-dark"></div>
                    <div class="overlay-light-right"></div>
                    <div class="room-details" style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background-color: rgba(0, 0, 0, 0.5); ">
                        <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">CV Room 8 Pax</h3>
                        <p style="font-size: 1.2rem; color: #d4b696;">8 Single-sized bed, shared bathroom, TV, Wi-Fi, air conditioning</p>
                        <p style="font-size: 1.2rem; color: #d4b696;">₱5,999/night</p>
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