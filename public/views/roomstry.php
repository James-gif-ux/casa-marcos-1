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

<!-- Add this in the <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
      position: relative;
      overflow: hidden; /* Ensures no overflow when sliding */
  }

  /* Wrapper for the left, right, and additional images */
  .image-wrapper {
      display: flex; /* Display images side by side */
      justify-content: space-between; /* Adds space between images */
      height: 600px; /* Set the height of the image container */
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
      height: 600px; /* Make images take up the full height of the container */
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

  /* Description Styling */
  .image-description {
      position: absolute;
      bottom: 30px;
      left: 20px;
      right: 20px;
      color: white;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
      padding: 20px;
      border-radius: 8px;
      max-width: 90%;
  }

  .room-card {
      position: relative;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
  }

  .room-card:hover {
      transform: translateY(-5px);
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
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.8)); /* Dark gradient */
    display: flex;
    flex-direction: column; /* Stack the content vertically */
    justify-content: space-between; /* Space between name, description, and price */
    padding: 20px;
    box-sizing: border-box;
}

.room-header {
    margin-top: 300px;
    background: rgba(212, 182, 150, 0.9);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.room-title {
    font-size: 2rem;
    color: #fff;
    font-family: 'Impact';
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 10px; /* Space between room name and description */
}

.room-details {
    height: 100px;
    font-size: 1.2rem;
    position: relative;
    color: #fff;
    padding: 10px 20px;
    background: transparent;
    border-radius: 8px;
    line-height: 1.6;
    text-align: center;
    margin: 10px 0; /* Space between description and price */
}

.price-tag {
    background: rgb(102, 67, 35);
    color: #fff;
    padding: 10px 20px;
    border-radius: 25px;
    text-align: center;
    width: fit-content;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    margin-top: 10px; /* Space above price */
}

.room-price {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0;
    letter-spacing: 1px;
}




.image-wrapper {
        display: flex;
        flex-direction: row;
        width: 100%;
        animation: continuousSlide 50s linear infinite;
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

/* Base styles */
:root {
    --primary-color: rgb(218, 191, 156);
    --dark-brown: rgb(102, 67, 35);
}

/* Responsive styles */
@media screen and (max-width: 1024px) {
    .image-container {
        width: 100%;
    }
    
    .image {
        width: 100%;
        height: 500px;
    }
    
    .room-header {
        margin-top: 200px;
    }
}

@media screen and (max-width: 768px) {
    .hera form {
        padding: 0.5rem;
        margin: 0 10px;
    }
    
    .hera div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 1rem !important;
    }
    
    button[type="submit"] {
        width: 100% !important;
    }
    
    .image-slider-section {
        padding: 2rem 0.5rem;
    }
    
    .image {
        height: 400px;
    }
    
    .room-title {
        font-size: 1.5rem;
    }
    
    .room-details {
        font-size: 1rem;
        height: auto;
    }
    
    .price-tag {
        padding: 8px 16px;
    }
    
    .room-price {
        font-size: 1.2rem;
    }

    .room-content {
        padding: 15px;
        height: 100%;
        justify-content: flex-end;
    }

    .room-header {
        margin-top: auto;
        background: rgba(212, 182, 150, 0.95);
        padding: 15px;
        margin-bottom: 10px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .room-details {
        height: auto;
        min-height: 60px;
        font-size: 0.9rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        margin: 8px 0;
    }

    .room-title {
        font-size: 1.3rem;
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .price-tag {
        position: relative;
        bottom: 0;
        margin: 10px auto;
    }

    .image-wrapper {
        animation: none;
        transform: none;
        flex-direction: column;
        gap: 1rem;
        height: auto;
        width: 100%;
    }

    .image {
        width: 100%;
        height: 300px;
        margin: 0;
    }
}

@media screen and (max-width: 480px) {
    .image {
        height: 300px;
    }
    
    .room-header {
        margin-top: 150px;
        padding: 15px;
    }
    
    .room-title {
        font-size: 1.2rem;
    }
    
    .room-details {
        font-size: 0.9rem;
    }
    
    .image-wrapper {
        animation: continuousSlide 30s linear infinite;
    }
    
    @keyframes continuousSlide {
        0% { transform: translateX(0); }
        100% { transform: translateX(-200%); }
    }
}

/* Touch device optimization */
@media (hover: none) {
    .room-card:hover {
        transform: none;
    }
    
    .image img {
        transition: none;
    }
}

/* Mobile-first responsive styles */
@media screen and (max-width: 1024px) {
    .image-container {
        width: 100%;
        margin: 0;
    }
    
    .image-wrapper {
        flex-direction: column;
        height: auto;
    }
    
    .image {
        width: 100%;
        height: 400px;
        margin: 10px 0;
    }
    
    .room-header {
        margin-top: 150px;
        padding: 15px;
    }
}

@media screen and (max-width: 768px) {
    .hera {
        padding: 1rem;
    }

    .hera form {
        width: 100%;
        max-width: none;
    }
    
    .hera div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 1rem !important;
    }
    
    input[type="date"],
    input[type="time"] {
        font-size: 14px;
        padding: 10px;
    }
    
    .room-title {
        font-size: 1.5rem;
    }
    
    .room-details {
        font-size: 0.9rem;
        height: auto;
        padding: 10px;
    }
    
    .price-tag {
        padding: 8px 15px;
        font-size: 0.9rem;
    }

    button[type="submit"] {
        width: 100% !important;
        padding: 12px !important;
        font-size: 1rem !important;
    }
}

@media screen and (max-width: 480px) {
    .image-slider-section {
        padding: 1rem 0;
    }
    
    .image {
        height: 250px;
    }
    
    .room-header {
        margin-top: 100px;
        padding: 10px;
    }
    
    .room-title {
        font-size: 1.2rem;
    }
    
    .room-content {
        padding: 10px;
    }
    
    .price-tag {
        padding: 5px 10px;
        font-size: 0.8rem;
    }
    
    .image-wrapper {
        animation: continuousSlide 20s linear infinite;
    }

    h3 {
        font-size: 1.2rem !important;
    }
}

/* Touch device optimization */
@media (hover: none) {
    .room-card:hover {
        transform: none;
    }
    
    .image img {
        transition: none;
    }
}
</style>


        <section class="hera">
            <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 1rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
            <form action="../pages/books.php" method="POST">
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



;l,kmjnhgf