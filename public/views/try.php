<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Suite Description</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }

        .room__description {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 50%, transparent 100%);
            padding: 30px 20px;  /* Padding for the description box */
            position: relative;  /* Adjusted positioning */
            width: 350px; /* Set width for consistency */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5); /* Shadow effect */
        }

        .room__title {
            font-family: 'Impact', sans-serif;
            font-size: 2rem;  /* Title size */
            color: #fff;
            margin-bottom: 5px;  /* Reduced margin */
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
        }

        .room__description img {
            width: 100%;
            height: auto;
            border-radius: 10px; /* Match description box */
            margin-bottom: 10px;  /* Margin below image */
            max-height: 300px;  /* Maximum height */
            object-fit: cover;  /* Maintain aspect ratio */
            gap: 15px;  /* Reduced gap */
        }

        .room__description p {
            font-size: 1rem;  /* Description size */
            color: #eee;
            margin-bottom: 10px;  /* Reduced bottom margin */
            line-height: 1.4;  /* Line height for readability */
        }

        .room__price {
            font-size: 1.8rem;  /* Price size */
            color: rgb(163, 99, 15);
            font-weight: bold;
            margin: 10px 0;  /* Reduced margin */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .freebies {
            display: flex;
            justify-content: center;
            gap: 15px;  /* Reduced gap */
            margin: 10px 0;  /* Reduced margin */
        }

        .freebie-item {
            display: flex;
            align-items: center;
            color: #fff;
            transition: transform 0.3s ease;
            font-size: 0.9rem;  /* Font size adjustment */
        }

        .freebie-item img {
            width: 20px;  /* Icon size */
            height: 20px;  /* Icon size */
            margin-right: 5px;  /* Reduced margin */
        }

        .freebie-item:hover {
            transform: scale(1.1);
        }

        .book-now-btn {
            background: rgb(163, 99, 15);
            color: white;
            padding: 10px 25px;  /* Padding for button */
            border: none;
            border-radius: 25px; /* Rounded corners */
            font-size: 1rem;  /* Button size */
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;  /* Margin above button */
            width: 100%;  /* Full width button */
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); /* Shadow effect */
        }

        .book-now-btn:hover {
            background: rgb(102, 67, 35);
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.5); /* Shadow on hover */
        }

        @media (max-width: 768px) {
            .room__description {
                width: 90%; /* Responsive width for smaller screens */
                padding: 20px 15px; /* Padding adjustments for mobile */
            }
            .room__title {
                font-size: 1.8rem;  /* Smaller title for mobile */
            }
            .room__price {
                font-size: 1.5rem;  /* Smaller price for mobile */
            }
            .book-now-btn {
                font-size: 0.9rem;  /* Smaller button for mobile */
            }
            .room__description p {
                font-size: 0.9rem;  /* Smaller description for mobile */
            }
        }
    </style>
</head>
<body>

<div class="room__description">
    <img src="../images/room.jpg" alt="Luxury Suite">
    <div class="room__title">Luxury Suite</div>
    <p>This is a luxurious room with a king-size bed and a stunning view of the city.</p>
    <div class="room__price">₱2,500 per night</div>
    <div class="freebies">
        <div class="freebie-item">
            <img src="../images/wifi-icon.png" alt="WiFi">
            <span>Free WiFi</span>
        </div>
        <div class="freebie-item">
            <img src="../images/breakfast-icon.png" alt="Breakfast">
            <span>Breakfast</span>
        </div>
        <div class="freebie-item">
            <img src="../images/parking-icon.png" alt="Parking">
            <span>Parking</span>
        </div>
    </div>
    <button class="book-now-btn">Book Now</button>
</div>

<div class="room__description">
    <img src="../images/room.jpg" alt="Luxury Suite">
    <div class="room__title">Luxury Suite</div>
    <p>This is a luxurious room with a king-size bed and a stunning view of the city.</p>
    <div class="room__price">₱2,500 per night</div>
    <div class="freebies">
        <div class="freebie-item">
            <img src="../images/wifi-icon.png" alt="WiFi">
            <span>Free WiFi</span>
        </div>
        <div class="freebie-item">
            <img src="../images/breakfast-icon.png" alt="Breakfast">
            <span>Breakfast</span>
        </div>
        <div class="freebie-item">
            <img src="../images/parking-icon.png" alt="Parking">
            <span>Parking</span>
        </div>
    </div>
    <button class="book-now-btn">Book Now</button>
</div>

<div class="room__description">
    <img src="../images/room.jpg" alt="Luxury Suite">
    <div class="room__title">Luxury Suite</div>
    <p>This is a luxurious room with a king-size bed and a stunning view of the city.</p>
    <div class="room__price">₱2,500 per night</div>
    <div class="freebies">
        <div class="freebie-item">
            <img src="../images/wifi-icon.png" alt="WiFi">
            <span>Free WiFi</span>
        </div>
        <div class="freebie-item">
            <img src="../images/breakfast-icon.png" alt="Breakfast">
            <span>Breakfast</span>
        </div>
        <div class="freebie-item">
            <img src="../images/parking-icon.png" alt="Parking">
            <span>Parking</span>
        </div>
    </div>
    <button class="book-now-btn">Book Now</button>
</div>

<div class="room__description">
    <img src="../images/room.jpg" alt="Luxury Suite">
    <div class="room__title">Luxury Suite</div>
    <p>This is a luxurious room with a king-size bed and a stunning view of the city.</p>
    <div class="room__price">₱2,500 per night</div>
    <div class="freebies">
        <div class="freebie-item">
            <img src="../images/wifi-icon.png" alt="WiFi">
            <span>Free WiFi</span>
        </div>
        <div class="freebie-item">
            <img src="../images/breakfast-icon.png" alt="Breakfast">
            <span>Breakfast</span>
        </div>
        <div class="freebie-item">
            <img src="../images/parking-icon.png" alt="Parking">
            <span>Parking</span>
        </div>
    </div>
    <button class="book-now-btn">Book Now</button>
</div>

</body>
</html>