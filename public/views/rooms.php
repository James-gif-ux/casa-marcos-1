<?php
    include_once 'nav/homenav.php';
    require_once '../model/connector.php';
    require_once '../model/roomModel.php';
    
    $connector = new Connector();
    $roomModel = new RoomModel($connector->getConnection());
    $rooms = $roomModel->getAllRooms();
if (empty($rooms)) {
    $rooms = [];
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Image Slider</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .slider {
        position: relative;
        width: 900px; /* Increased width */
        height: 500px; /* Increased height */
        overflow: hidden;
        margin: auto;
        border: 2px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .slides {
        display: flex;
        transition: transform 0.8s ease-in-out; /* Smooth transition */
        width: 400%;
        height: 100%;
    }

    .slide {
        min-width: 25%;
        position: relative; /* Required for absolute positioning of the info box */
        transition: all 0.8s ease;
    }

    .slide img {
        width: 100%;
        height: 100%;
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .prev, .next {
        position: absolute;
        bottom: 30px; /* Position below the slider */
        background-color: rgba(255, 255, 255, 0.9);
        border: 2px solid #4CAF50; 
        padding: 10px;
        cursor: pointer;
        font-size: 28px;
        color: #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .prev {
        left: 35%;
        bottom: 20px; /* Closer to the bottom */
    }

    .next {
        right: 35%;
        bottom: 20px; /* Closer to the bottom */
    }

    .prev:hover, .next:hover {
        background-color: rgba(255, 255, 255, 1);
        transform: scale(1.05);
    }

    .dots {
        position: absolute;
        bottom: 40px; /* Position above buttons */
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 5px;
    }

    .dot {
        height: 15px;
        width: 15px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .dot.active {
        background-color: #4CAF50; /* Active dot color */
    }

    .slide-info {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        background: linear-gradient(to right, #4CAF50, #45a049);
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        text-align: left;
        opacity: 0; /* Hide by default */
        transition: all 0.4s ease;
        pointer-events: none; /* Prevents flickering when moving mouse */
    }

    .slide-info h3 {
        margin: 0 0 10px 0;
        font-size: 24px;
        color: #fff;
        border-bottom: 2px solid rgba(255,255,255,0.3);
        padding-bottom: 8px;
    }

    .slide-info p {
        margin: 5px 0;
        font-size: 16px;
        line-height: 1.4;
    }

    .slide-info .price {
        font-size: 20px;
        font-weight: bold;
        color: #ffeb3b;
        margin-top: 10px;
    }

    .slide:hover .slide-info {
        opacity: 1; /* Show on hover */
        transform: translateX(-50%) translateY(-10px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
</style>
<body>
    <div class="slider">
        <div class="slides">
            <div class="slide active">
            <img src="../images/room.jpg" alt="Image 1">
            <div class="slide-info">
                <h3>Deluxe Room</h3>
                <p>Spacious room with ocean view</p>
                <p>Features king-size bed, premium linens, and a private bathroom with rainfall shower</p>
                <p>Includes complimentary breakfast and WiFi</p>
                <p class="price">$199/night</p>
            </div>
            </div>
            <div class="slide">
            <img src="../images/room.jpg" alt="Image 2">
            <div class="slide-info">
                <h3>Suite Room</h3>
                <p>Luxury suite with private balcony</p>
                <p>Separate living area, kitchenette, and master bedroom with en-suite bathroom</p>
                <p>Stunning ocean views and access to exclusive lounge</p>
                <p class="price">$299/night</p>
            </div>
            </div>
            <div class="slide">
            <img src="../images/room.jpg" alt="Image 3">
            <div class="slide-info">
                <h3>Family Room</h3>
                <p>Perfect for family gatherings</p>
                <p>Two bedrooms with connecting door, children's play area</p>
                <p>Includes family meal package and access to kids' club</p>
                <p class="price">$399/night</p>
            </div>
            </div>
            <div class="slide">
            <img src="../images/room.jpg" alt="Image 4">
            <div class="slide-info">
                <h3>Presidential Suite</h3>
                <p>Ultimate luxury experience</p>
                <p>Three bedrooms, private dining room, and butler service</p>
                <p>Includes airport transfer, spa access, and personalized concierge</p>
                <p class="price">$599/night</p>
            </div>
            </div>
        </div>
        <div class="dots">
            <div class="dot active" onclick="goToSlide(0)"></div>
            <div class="dot" onclick="goToSlide(1)"></div>
            <div class="dot" onclick="goToSlide(2)"></div>
            <div class="dot" onclick="goToSlide(3)"></div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        function showSlide(index) {
            const slidesContainer = document.querySelector('.slides');
            slidesContainer.style.transform = `translateX(-${index * 25}%)`;
            dots.forEach((dot, i) => {
                dot.classList.remove('active');
            });
            dots[index].classList.add('active');
        }
            
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            currentSlide = index;
            showSlide(currentSlide);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);
    </script>
</body>
</html>