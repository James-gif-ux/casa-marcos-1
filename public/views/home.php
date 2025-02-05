<?php
    include_once 'nav/homenav.php';
?>

    <main>
        <section class="hero">
            <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 3rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
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


        <section style="padding: 5rem 2rem; background-color: rgba(172, 144, 117, 0.89); position: relative; overflow: hidden;">
            <!-- Decorative Elements -->
            <div style="position: absolute; top: 0; left: 0; width: 150px; height: 150px; background: rgba(218, 191, 156, 0.2); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: -50px; right: -50px; width: 200px; height: 200px; background: rgba(218, 191, 156, 0.2); border-radius: 50%;"></div>
            
            <div style="max-width: 1200px; margin: 0 auto; text-align: center; position: relative; z-index: 1;">
            <h2 style="color: rgb(102, 67, 35); margin-bottom: 2rem; font-size: 2.5rem; font-family: 'impact'; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                About Us
                <span style="display: block; width: 80px; height: 3px; background: rgb(102, 67, 35); margin: 1rem auto;"></span>
            </h2>
            
            <div style="display: flex; gap: 4rem; align-items: center; background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(250, 245, 240, 0.95)); 
                        padding: 3rem; border-radius: 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.15); position: relative; overflow: hidden;">
                
                <!-- Decorative elements -->
                <div style="position: absolute; top: -20px; left: -20px; width: 100px; height: 100px; background: rgba(218, 191, 156, 0.2); 
                            border-radius: 50%; filter: blur(2px);"></div>
                <div style="position: absolute; bottom: -30px; right: -30px; width: 150px; height: 150px; background: rgba(102, 67, 35, 0.1); 
                            border-radius: 50%; filter: blur(3px);"></div>

                <div style="flex: 1; transition: all 0.5s ease; position: relative;">
                    <img src="../images/history.jpg" alt="Resort History" 
                         style="width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
                                transform: rotate(-2deg); transition: all 0.5s ease;"
                         onmouseover="this.style.transform='rotate(0deg) scale(1.03)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.3)';"
                         onmouseout="this.style.transform='rotate(-2deg) scale(1)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.2)';">
                    <div style="position: absolute; top: -15px; right: -15px; background: rgb(102, 67, 35); color: white; 
                                padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; transform: rotate(3deg);">
                        Since 1985
                    </div>
                </div>
                
                <div style="flex: 1; text-align: left;">
                    <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; margin-bottom: 1.5rem; font-family: 'impact';">
                        Our Story
                    </h3>
                    <p style="font-size: 1.1rem; line-height: 1.9; color: #4a4a4a; margin-bottom: 1.8rem; 
                             text-shadow: 0 1px 1px rgba(0,0,0,0.05); font-family: 'Georgia', serif;">
                        Founded in 1985, Casa Marcos began as a modest family retreat nestled in the heart of nature. 
                        Over the decades, it has evolved into a premier luxury resort while maintaining its authentic charm 
                        and warm hospitality.
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.9; color: #4a4a4a; margin-bottom: 2rem; 
                             text-shadow: 0 1px 1px rgba(0,0,0,0.05); font-family: 'Georgia', serif;">
                        Today, Casa Marcos stands as a testament to excellence in hospitality, combining traditional values 
                        with modern luxury. Our commitment to exceptional service and guest satisfaction continues to be 
                        the cornerstone of our legacy.
                    </p>
                    <div style="display: flex; gap: 1rem;">
                        <button class="btn-room" style="background: linear-gradient(135deg, rgb(102, 67, 35), rgb(163, 99, 15)); 
                                       color: white; padding: 1rem 2.5rem; border: none; border-radius: 50px; cursor: pointer;
                                       font-size: 1.1rem; transition: all 0.4s ease; text-transform: uppercase;
                                       letter-spacing: 2px; box-shadow: 0 5px 15px rgba(102, 67, 35, 0.3);"
                            onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(102, 67, 35, 0.4)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(102, 67, 35, 0.3)';">
                            Learn More
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <!-- Rooms Section -->
        <section class="rooms">
        <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center; position: relative;">
            Our Rooms
            <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
        </h2>
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

        <section style="padding: 8rem 2rem; background-color: #f9f6f2;">
            <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center; position: relative;">
            Our Spaces
            <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
            </h2>
            <div style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; padding: 0 2rem;">
            
            <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
                <img src="../images/area.jpg" alt="Fitness Room" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
                <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Fitness Room</h3>
                <p style="color: #666; line-height: 1.6;">Have a good sweat at the Fitness Center, with state-of-the-art equipment to serve our guests.</p>
                </div>
            </div>

            <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
                <img src="../images/area.jpg" alt="Restaurant and Cafe" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
                <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Restaurant & Cafe</h3>
                <p style="color: #666; line-height: 1.6;">Experience exquisite dining in an elegant atmosphere with our diverse culinary offerings.</p>
                </div>
            </div>

            <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
                <img src="../images/area.jpg" alt="Pool and Gardens" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
                <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Pool & Gardens</h3>
                <p style="color: #666; line-height: 1.6;">Unwind in our luxurious pool or explore our meticulously maintained garden paradise.</p>
                </div>
            </div>

            <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
                <img src="../images/area.jpg" alt="Conference Areas" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
                <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Conference Areas</h3>
                <p style="color: #666; line-height: 1.6;">Professional meeting spaces equipped with modern technology for successful events.</p>
                </div>
            </div>
            </div>

            <style>
            .amenity-card:hover {
                transform: translateY(-15px);
                box-shadow: 0 15px 40px rgba(102, 67, 35, 0.2);
            }
            .amenity-card:hover img {
                transform: scale(1.1);
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