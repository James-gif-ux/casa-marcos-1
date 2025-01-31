<?php
    include_once 'nav/homenav.php';
?>
 <style>
     
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        border-radius: 12px;
        animation: slideUp 0.8s ease-out;
        margin: 0 auto; /* Add this */
        
    }

    h1, p {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    main {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    }

    
    h1 {
        font-size: 2.5em;
        margin-bottom: 10px;
        color: #007BFF;
        animation: fadeInDown 0.8s ease-out;
    }

    @keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

    p {
        font-size: 1.2em;
        text-align: center;
        max-width: 600px;
        margin-bottom: 40px;
        animation: fadeIn 1s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        border-radius: 12px;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

    .grid-item {
        background-color: #fff;
        text-align: center;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.4s ease;
        border: 1px solid #eee;
        position: relative;
        margin-top: 150px;
        margin-bottom: 20px;
        padding: none;
    }

    .grid-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        border-color: #007BFF;
    }

    .grid-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
        transition: transform 0.6s ease;
    }

    .grid-item:hover img {
        transform: scale(1.1);
    }

    .grid-item p {
        margin: 15px 0;
        font-size: 1.3em;
        color: #444;
    }

    .room-price {
        font-size: 1.6em;
        color: #28a745;
        margin: 15px 0;
        transition: color 0.3s ease;
    }

    .grid-item:hover .room-price {
        color: #1e7e34;
    }

    .book-button {
        display: inline-block;
        padding: 12px 25px;
        margin: 15px 0;
        background-color: #007BFF;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .book-button:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
    }

    footer p {
        text-align: center;
        font-size: 1.0em;
        margin: 1px auto; 
        color: #fff;
        width: 100%;
        display: block; 
    }
    </style>
   <!-- Rooms Section -->

    <div class="grid-container">
        <div class="grid-item">
            <img src="../images/room.jpg" alt="Room 1">
            <p>Deluxe Room</p>
            <div class="room-price">$200/night</div>
            <a href="#" class="book-button">Book Now</a>
        </div>
        <div class="grid-item">
            <img src="../images/room.jpg" alt="Room 2">
            <p>Standard Room</p>
            <div class="room-price">$150/night</div>
            <a href="#" class="book-button">Book Now</a>
        </div>
        <div class="grid-item">
            <img src="../images/room.jpg" alt="Room 3">
            <p>Executive Suite</p>
            <div class="room-price">$350/night</div>
            <a href="#" class="book-button">Book Now</a>
        </div>
        <div class="grid-item">
            <img src="../images/room.jpg" alt="Room 4">
            <p>Family Suite</p>
            <div class="room-price">$300/night</div>
            <a href="#" class="book-button">Book Now</a>
        </div>
        <div class="grid-item">
            <img src="../images/room.jpg" alt="Room 5">
            <p>Honeymoon Suite</p>
            <div class="room-price">$400/night</div>
            <a href="#" class="book-button">Book Now</a>
        </div>
        <div class="grid-item">
            <img src="../images/room.jpg" alt="Room 6">
            <p>Single Room</p>
            <div class="room-price">$100/night</div>
            <a href="#" class="book-button">Book Now</a>
        </div>
    </div>

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