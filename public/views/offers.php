    <?php
    include_once 'nav/homenav.php';
    ?>
    <style>
        .flip-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 400px;
            padding: 50px;
        }

        .flip-card {
            width: 1100px;
            height: 400px;
            perspective: 1000px;
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateX(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .flip-card-front img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        .flip-card-back {
            background: #2c3e50;
            color: white;
            transform: rotateX(180deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }

        .flip-card-back h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .flip-card-back p {
            font-size: 18px;
        }

        .offers-section {
        text-align: center;
        padding: 23rem;
        background-image: url('../images/offers.jpg');
        background-size: cover;
        background-position: center;
    }

    .slider-container {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        background: rgba(255, 255, 255, 0);
        backdrop-filter: blur(3px);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .slider {
        display: flex;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .slide {
        min-width: 100%;
        padding: 2rem;
        text-align: center;
        background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));
    }

    .slide h2 {
        color: rgba(218, 191, 156, 0.9);
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-family: 'impact';
        margin-bottom: 1.5rem;
    }

    .slide p {
        color: rgb(255, 255, 255);
        font-size: clamp(1rem, 2vw, 1.5rem);
        line-height: 1.6;
        margin: 0 auto;
        max-width: 600px;
        font-family: 'Georgia', serif;
    }

    .decorative-line {
        width: 150px;
        height: 3px;
        background: rgb(255, 255, 255);
        margin: 2rem auto;
    }

    .slider-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgb(102, 67, 35);
        border: none;
        padding: 15px 20px;
        cursor: pointer;
        border-radius: 50%;
        color: white;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .slider-button:hover {
        background: rgb(82, 47, 15);
    }

    .slider-button.prev {
        left: 20px;
    }

    .slider-button.next {
        right: 20px;
    }

    @media (max-width: 768px) {
        .offers-section {
            padding: 5rem 1rem;
        }

        .slide {
            padding: 1.5rem;
        }

        .slider-button {
            padding: 10px 15px;
            font-size: 1rem;
        }
    }
    </style>

<section class="offers-section">
    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <h2>Welcome to Casa Marcos Restaurant</h2>
                <p>Experience exquisite dining in our elegant atmosphere, where traditional flavors meet modern cuisine.</p>
                <div class="decorative-line"></div>
            </div>
            <div class="slide">
                <h2>Our Culinary Excellence</h2>
                <p>Our expert chefs craft each dish with passion, using only the finest local ingredients.</p>
                <div class="decorative-line"></div>
            </div>
            <div class="slide">
                <h2>Perfect for Every Occasion</h2>
                <p>From intimate dinners to special celebrations, we create memorable dining experiences.</p>
                <div class="decorative-line"></div>
            </div>
        </div>
        <button class="slider-button prev" onclick="prevSlide()">←</button>
        <button class="slider-button next" onclick="nextSlide()">→</button>
    </div>
</section>

   <section>

    </section>
       
    </section>
        <div class="flip-container" style="background-color:rgb(218, 191, 156);">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="../images/dining.jpg" alt="Special Offer">
                    </div>
                    <div class="flip-card-back">
                        <h3 style="color: #DAC0A3; font-family: 'Georgia', serif; margin-bottom: 30px; text-transform: uppercase; letter-spacing: 2px;">
                            Enjoy Fabulous Buffets with your Family <br> 
                            <span style="font-size: 0.8em; color: #F8F0E5;">Call to Reserve your table</span>
                        </h3>
                        <div style="padding: 20px; border-radius: 10px; margin: 15px;">
                            <p style="color: #F8F0E5; font-size: 20px; margin: 10px 0; font-family: 'Arial', sans-serif;">
                                <i class="fas fa-sun"></i> Lunch Buffet 
                                <b style="color: #DAC0A3;">11am to 2pm</b>
                            </p>
                            <p style="color: #F8F0E5; font-size: 20px; margin: 10px 0; font-family: 'Arial', sans-serif;">
                                <i class="fas fa-moon"></i> Dinner Buffet 
                                <b style="color: #DAC0A3;">6pm to 9pm</b>
                            </p>
                        </div>    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 Casa Marcos. All rights reserved.</p>
    </footer>

    <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('.slide');
            const slider = document.querySelector('.slider');

            function showSlide(index) {
                slider.style.transform = `translateX(-${index * 100}%)`;
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(currentSlide);
            }

            // Auto-advance slides every 5 seconds
            setInterval(nextSlide, 5000);
    </script>


    <script>
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
