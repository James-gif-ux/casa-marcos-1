<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Marcos - Welcome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.4;
        font-size: 16px;
    }

    header {
        position: fixed;
        padding: 1.5rem;
        width: 100%;
        display: flex;
        justify-content: center;
        z-index: 1000;
        background-color: transparent;
        transition: background-color 0.5s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    header.scrolled {
        background-color: #2c3e50;
    }

    header.scrolled .logo h1,
    header.scrolled nav ul li a {
        color: rgb(218, 191, 156);
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo h1 {
        color: rgb(102, 67, 35);
        font-size: 3.8rem;
        font-family: impact;
        letter-spacing: 1px;
    }

    nav ul {
        display: flex;
        list-style: none;
        gap: 1.5rem;
    }

    nav ul li {
        position: relative;
    }

    nav ul li a {
        color: rgb(102, 67, 35);
        text-decoration: none;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
        font-family: impact;
        text-transform: uppercase;
        transition: background-color 0.3s, transform 0.3s;
        border-radius: 4px;
    }

    nav ul li a:hover {
        background-color: #34495e;
        color: #fff;
        transform: scale(1.05);
    }

    .hero {
        text-align: center;
        padding: 18rem;
        background-image: url('../images/11.jpg');
        background-size: cover;
        background-position: center;
    }

    footer {
        background-color: #2c3e50;
        color: #fff;
        text-align: center;
        padding: 1.5rem;
    }

    input,
    select {
        font-family: 'Arial', sans-serif;
        padding: 0.8rem;
        border-radius: 4px;
        width: 100%;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    input:focus,
    select:focus {
        border-color: rgb(163, 99, 15);
        outline: none;
    }

    /* Room Section */
    .rooms {
        background-color: #f9f6f2;
        padding: 8rem 0;
        position: relative;
    }

    .rooms-header {
        margin-bottom: 4rem;
        position: relative;
    }

    .room-cards {
        display: flex;
        justify-content: center;
        gap: 3rem;
        max-width: 1600px;
        margin: 0 auto;
        padding: 0 4rem;
    }

    .room-card {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        width: calc(25% - 2.25rem);
        text-align: center;
        padding: 0;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        position: relative;
    }

    .room-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 15px 40px rgba(102, 67, 35, 0.2);
    }

    .room-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .room-card:hover .room-img {
        transform: scale(1.1);
    }

    .room-title {
        margin: 2rem 1.5rem 1rem;
        font-size: 2rem;
        color: rgb(102, 67, 35);
        font-family: 'impact';
        letter-spacing: 1px;
    }

    .room-description {
        margin: 0 1.5rem 2rem;
        font-size: 1.1rem;
        color: #5d4037;
        line-height: 1.6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .btn-room {
        background: linear-gradient(135deg, rgb(102, 67, 35) 0%, rgb(163, 99, 15) 100%);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 1rem 2.5rem;
        cursor: pointer;
        margin: 0 1.5rem 2rem;
        transition: all 0.3s ease;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-room:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(102, 67, 35, 0.3);
    }

    /* Container for the Carousel */
    .carousel-container {
        width: 80%;
        margin: 50px auto;
        overflow: hidden;
        position: relative;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Carousel Slide Wrapper */
    .carousel-wrapper {
        display: flex;
        transition: transform 1s ease;
    }

    /* Individual Slide */
    .carousel-slide {
        min-width: 100%;
        height: 700px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    /* Title and Description */
    .room-details {
        position: absolute;
        bottom: 20px;
        left: 20px;
        color: white;
        font-family: 'Georgia', serif;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .room-title {
        font-size: 2em;
        font-weight: bold;
    }

    .room-description {
        font-size: 1.1em;
        margin-top: 10px;
    }

    /* Navigation Arrows */
    .prev,
    .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.4);
        color: white;
        border: none;
        font-size: 2em;
        padding: 10px;
        cursor: pointer;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }

    /* Dots Navigation */
    .dots-container {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
    }

    .dot {
        height: 10px;
        width: 10px;
        margin: 0 5px;
        background-color: white;
        border-radius: 50%;
        transition: background-color 0.3s ease;
        cursor: pointer;
    }

    .active-dot {
        background-color: gold;
    }

    @media (max-width: 1200px) {
        .room-card {
            width: calc(50% - 2.25rem);
        }

        nav ul {
            flex-direction: column;
            align-items: center;
        }

        nav ul li {
            margin-bottom: 1rem;
        }

        .hero {
            padding: 10rem;
        }

        .hero div {
            padding: 2rem;
        }

        .rooms-header {
            text-align: center;
        }

        .carousel-container {
            width: 90%;
        }

        .btn-room {
            width: 80%;
        }

        h2,
        h3 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .room-card {
            width: 100%;
        }

        .carousel-container {
            height: auto;
        }

        .hero {
            padding: 6rem 1.5rem;
        }

        .hero div {
            padding: 2rem 1rem;
        }

        .dots-container {
            bottom: 10px;
        }

        .btn-room {
            width: 100%;
            margin: 0 0 2rem 0;
        }

        nav {
            flex-direction: column;
        }

        nav ul {
            width: 100%;
        }

        nav ul li {
            text-align: center;
        }
    }
</style>

<body>
    <header>
        <nav>
            <ul style="width: 100%; align-items: center;">
                <li><a href="/">Our Rooms</a></li>
                <li><a href="/menu">Offer</a></li>
                <a href="/" class="logo" style="margin: 0 2rem; text-decoration: none;">
                    <h1 style="text-align: center; line-height: 1.2;">CASA MARCOS
                        <span style="display: block; font-size: 1rem;">RESORT AND VILLAS</span>
                    </h1>
                </a>
                <li><a href="/reservations">About Us</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 3rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
                <h2 style="text-align: center; color: rgb(218, 191, 156); margin-bottom: 2rem; font-size: 2.4rem; font-family: 'impact';">RESERVATION DETAILS</h2>
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


        <section style="padding: 5rem 2rem; background-color: rgba(172, 144, 117, 0.89)">
            <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h2 style="color: rgb(102, 67, 35); margin-bottom: 2rem; font-size: 2.5rem; font-family: 'impact';">Our History</h2>
                <div style="display: flex; gap: 3rem; align-items: center;">
                    <div style="flex: 1;">
                        <img src="../images/history.jpg" alt="Resort History" style="width: 100%; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    </div>
                    <div style="flex: 1; text-align: left;">
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #34495e; margin-bottom: 1.5rem;">
                            Founded in 1985, Casa Marcos began as a modest family retreat nestled in the heart of nature. Over the decades, it has evolved into a premier luxury resort while maintaining its authentic charm and warm hospitality.
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.8; color: #34495e;">
                            Today, Casa Marcos stands as a testament to excellence in hospitality, combining traditional values with modern luxury. Our commitment to exceptional service and guest satisfaction continues to be the cornerstone of our legacy.
                        </p>
                        <button class="btn-room">Learn More</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Rooms Section -->
        <section class="rooms">
            <h2 style="color: rgb(102, 67, 35); margin-bottom: 2rem; font-size: 2.5rem; font-family: 'impact'; text-align: center;">Our Rooms</h2>

            <!-- Carousel Container -->
            <div class="carousel-container">
                <!-- Carousel Slides -->
                <div class="carousel-wrapper">
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details">
                            <div class="room-title">Grand Living Room</div>
                            <div class="room-description">Relax in style with plush seating, warm textures, and carefully curated decor.</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details">
                            <div class="room-title">Opulent Bedroom</div>
                            <div class="room-description">An oasis of peace with soft hues, velvet throws, and the finest linens.</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details">
                            <div class="room-title">Elegant Dining Room</div>
                            <div class="room-description">A space designed for unforgettable dinners, featuring luxurious furniture.</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details">
                            <div class="room-title">Chic Study</div>
                            <div class="room-description">Where productivity meets comfort. A sophisticated workspace perfect for focus.</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details">
                            <div class="room-title">Luxurious Bathroom</div>
                            <div class="room-description">Pamper yourself with a spa-like experience, featuring modern elegance.</div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button class="prev" onclick="moveSlide(-1)">❮</button>
                <button class="next" onclick="moveSlide(1)">❯</button>

                <!-- Dots Navigation -->
                <div class="dots-container">
                    <span class="dot active-dot" onclick="currentSlide(0)"></span>
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
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

    <script>
        let currentIndex = 0;

        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');

        function moveSlide(step) {
            currentIndex += step;
            if (currentIndex >= slides.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = slides.length - 1;
            updateCarousel();
        }

        function currentSlide(index) {
            currentIndex = index;
            updateCarousel();
        }

        function updateCarousel() {
            // Move the carousel wrapper
            document.querySelector('.carousel-wrapper').style.transform = `translateX(-${currentIndex * 100}%)`;

            // Update dots
            dots.forEach((dot, i) => {
                dot.classList.remove('active-dot');
                if (i === currentIndex) {
                    dot.classList.add('active-dot');
                }
            });
        }
    </script>

</body>

</html>