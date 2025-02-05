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

    <!-- Rooms Section -->
    <section class="rooms">
            <!-- Carousel Container -->
            <div class="carousel-container">
                <!-- Carousel Slides -->
                <div class="carousel-wrapper">
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details" style="background: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 10px; max-width: 400px; margin: 2rem;">
                            <div class="room-title" style="font-size: 1.8rem; color: #926d45; font-weight: bold; margin-bottom: 1rem; font-family: 'Impact';">Grand Living Room</div>
                            <div class="room-description" style="font-size: 1.1rem; color: #666; margin-bottom: 1rem; line-height: 1.6;">Relax in style with plush seating, warm textures, and carefully curated decor.</div>
                            <div class="room-price" style="font-size: 1.4rem; color: #926d45; font-weight: bold;">₱5,000 per night</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details" style="background: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 10px; max-width: 400px; margin: 2rem;">
                            <div class="room-title" style="font-size: 1.8rem; color: #926d45; font-weight: bold; margin-bottom: 1rem; font-family: 'Impact';">Opulent Bedroom</div>
                            <div class="room-description" style="font-size: 1.1rem; color: #666; margin-bottom: 1rem; line-height: 1.6;">An oasis of peace with soft hues, velvet throws, and the finest linens. Perfect for couples seeking luxury and comfort.</div>
                            <div class="room-price" style="font-size: 1.4rem; color: #926d45; font-weight: bold;">₱3,500 per night</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details" style="background: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 10px; max-width: 400px; margin: 2rem;">
                            <div class="room-title" style="font-size: 1.8rem; color: #926d45; font-weight: bold; margin-bottom: 1rem; font-family: 'Impact';">Elegant Dining Room</div>
                            <div class="room-description" style="font-size: 1.1rem; color: #666; margin-bottom: 1rem; line-height: 1.6;">A space designed for unforgettable dinners, featuring luxurious furniture and state-of-the-art amenities.</div>
                            <div class="room-price" style="font-size: 1.4rem; color: #926d45; font-weight: bold;">₱4,000 per night</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details" style="background: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 10px; max-width: 400px; margin: 2rem;">
                            <div class="room-title" style="font-size: 1.8rem; color: #926d45; font-weight: bold; margin-bottom: 1rem; font-family: 'Impact';">Chic Study</div>
                            <div class="room-description" style="font-size: 1.1rem; color: #666; margin-bottom: 1rem; line-height: 1.6;">Where productivity meets comfort. A sophisticated workspace perfect for focus, equipped with high-speed internet.</div>
                            <div class="room-price" style="font-size: 1.4rem; color: #926d45; font-weight: bold;">₱2,500 per night</div>
                        </div>
                    </div>
                    <div class="carousel-slide" style="background-image: url('../images/room.jpg');">
                        <div class="room-details" style="background: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 10px; max-width: 400px; margin: 2rem;">
                            <div class="room-title" style="font-size: 1.8rem; color: #926d45; font-weight: bold; margin-bottom: 1rem; font-family: 'Impact';">Luxurious Bathroom</div>
                            <div class="room-description" style="font-size: 1.1rem; color: #666; margin-bottom: 1rem; line-height: 1.6;">Pamper yourself with a spa-like experience, featuring modern elegance and premium toiletries.</div>
                            <div class="room-price" style="font-size: 1.4rem; color: #926d45; font-weight: bold;">₱3,000 per night</div>
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

            <div style="max-width: 1000px; margin: 7rem auto; background: rgba(255, 255, 255, 0); padding: 3rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); ">
                <form action="/reservation/submit" method="POST">
                    <!-- Check-in and Check-out Section -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px;">
                            <h3 style="color:  #926d45; margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK IN</h3>
                            <input type="date" name="check_in" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                            <input type="time" name="check_in_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                        </div>
                        <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px;">
                            <h3 style="color: #926d45; margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK OUT</h3>
                            <input type="date" name="check_out" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                            <input type="time" name="check_out_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div style="display: flex; justify-content: center;">
                        <button type="submit" style="width: 50%; padding: 1rem; margin-top: 2rem; background: linear-gradient(to right, rgb(218, 191, 156), rgb(218, 191, 156)); color: white; border: none; border-radius: 12px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
                            Search Booking
                        </button>
                    </div>
                </form>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    const header = document.querySelector('header');

    mobileMenuBtn.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        header.classList.toggle('menu-open');
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!navLinks.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
            navLinks.classList.remove('active');
            header.classList.remove('menu-open');
        }
    });
});
</script>
</body>

</html>