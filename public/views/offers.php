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
            transform: rotateX(180deg); /* Changed from rotateY to rotateX for backflip */
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
            background:  #2c3e50;
            color: white;
            transform: rotateX(180deg); /* Changed from rotateY to rotateX for backflip */
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

        .offer-btn {
            padding: 10px 20px;
            background-color: white;
            color: #A3630F;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .offer-btn:hover {
            background-color: #DAB89C;
            color: white;
            transform: scale(1.05);
        }
        </style>

    <section class="off">
        <div class="slider-container" style="max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; background: rgba(255, 255, 255, 0); backdrop-filter: blur(2px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
            <div class="slider" style="display: flex; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color: rgb(218, 191, 156); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">
                        Welcome to Casa Marcos Restaurant
                    </h2>
                    <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">
                        Experience exquisite dining in our elegant atmosphere, where traditional flavors meet modern cuisine.
                    </p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(218, 191, 156); margin: 2rem auto;"></div>
                </div>
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color:  rgb(218, 191, 156); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">
                        Our Culinary Excellence
                    </h2>
                    <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">
                        Our expert chefs craft each dish with passion, using only the finest local ingredients.
                    </p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(218, 191, 156); margin: 2rem auto;"></div>
                </div>
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color:  rgb(218, 191, 156); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">
                        Perfect for Every Occasion
                    </h2>
                    <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">
                        From intimate dinners to special celebrations, we create memorable dining experiences.
                    </p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(218, 191, 156); margin: 2rem auto;"></div>
                </div>
            </div>
            <div style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%);">
                <button onclick="prevSlide()" style="background: rgba(218, 191, 156, 0.9); border: none; padding: 15px 20px; cursor: pointer; border-radius: 50%; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">←</button>
            </div>
            <div style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                <button onclick="nextSlide()" style="background: rgba(218, 191, 156, 0.9); border: none; padding: 15px 20px; cursor: pointer; border-radius: 50%; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">→</button>
            </div>
        </div>
        <script>
            const orderBtn = document.getElementById('orderBtn');
            const orderModal = document.getElementById('orderModal');
            const orderForm = document.getElementById('orderForm');

            orderBtn.addEventListener('click', () => {
                orderModal.style.display = 'block';
            });

            function closeOrderModal() {
                orderModal.style.display = 'none';
            }

            orderForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Your order has been placed!');
                closeOrderModal();
            });
        </script>
    </section>

    <section class="menu-section" style="padding: 60px 20px; background: #2c3e50;">
        <div class="menu-container" style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; color: #DAB89C; font-family: 'Georgia', serif; font-size: 3.5rem; margin-bottom: 50px; text-transform: uppercase; letter-spacing: 2px; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Our Menu</h2>
            
            <div class="menu-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <!-- Appetizers -->
                <div class="menu-category" style="background: rgba(255, 255, 255, 0.1); padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
                    <h3 style="color: #DAB89C; font-family: 'Georgia'; border-bottom: 2px solid #DAB89C; padding-bottom: 15px; margin-bottom: 25px; font-size: 1.8rem; text-transform: uppercase;">Appetizers</h3>
                    
                    <div class="menu-item" style="margin-bottom: 25px; transition: transform 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <h4 style="color: #fff; margin: 0;">Garlic Shrimp</h4>
                            <span style="color: #DAB89C;">₱720</span>
                        </div>
                        <p style="color: #bbb; font-style: italic; margin: 0; font-size: 0.95em;">Sautéed shrimp in garlic butter sauce</p>
                    </div>

                    <div class="menu-item" style="margin-bottom: 25px; transition: transform 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <h4 style="color: #fff; margin: 0;">Crispy Calamari</h4>
                            <span style="color: #DAB89C;">₱610</span>
                        </div>
                        <p style="color: #bbb; font-style: italic; margin: 0; font-size: 0.95em;">Served with marinara sauce</p>
                    </div>
                </div>

                <!-- Main Courses -->
                <div class="menu-category" style="background: rgba(255, 255, 255, 0.1); padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
                    <h3 style="color: #DAB89C; font-family: 'Georgia'; border-bottom: 2px solid #DAB89C; padding-bottom: 15px; margin-bottom: 25px; font-size: 1.8rem; text-transform: uppercase;">Main Courses</h3>
                    
                    <div class="menu-item" style="margin-bottom: 25px; transition: transform 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <h4 style="color: #fff; margin: 0;">Ribeye Steak</h4>
                            <span style="color: #DAB89C;">₱1,825</span>
                        </div>
                        <p style="color: #bbb; font-style: italic; margin: 0; font-size: 0.95em;">12oz grilled ribeye with roasted vegetables</p>
                    </div>

                    <div class="menu-item" style="margin-bottom: 25px; transition: transform 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <h4 style="color: #fff; margin: 0;">Grilled Salmon</h4>
                            <span style="color: #DAB89C;">₱1,495</span>
                        </div>
                        <p style="color: #bbb; font-style: italic; margin: 0; font-size: 0.95em;">Fresh Atlantic salmon with lemon herb sauce</p>
                    </div>
                </div>

                <!-- Desserts -->
                <div class="menu-category" style="background: rgba(255, 255, 255, 0.1); padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
                    <h3 style="color: #DAB89C; font-family: 'Georgia'; border-bottom: 2px solid #DAB89C; padding-bottom: 15px; margin-bottom: 25px; font-size: 1.8rem; text-transform: uppercase;">Desserts</h3>
                    
                    <div class="menu-item" style="margin-bottom: 25px; transition: transform 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <h4 style="color: #fff; margin: 0;">Classic Tiramisu</h4>
                            <span style="color: #DAB89C;">₱495</span>
                        </div>
                        <p style="color: #bbb; font-style: italic; margin: 0; font-size: 0.95em;">Italian coffee-flavored dessert</p>
                    </div>

                    <div class="menu-item" style="margin-bottom: 25px; transition: transform 0.2s;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <h4 style="color: #fff; margin: 0;">Chocolate Lava Cake</h4>
                            <span style="color: #DAB89C;">₱550</span>
                        </div>
                        <p style="color: #bbb; font-style: italic; margin: 0; font-size: 0.95em;">Warm chocolate cake with molten center</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const reserveBtn = document.getElementById('reserveBtn');
        const reservationModal = document.getElementById('reservationModal');
        const reservationForm = document.getElementById('reservationForm');

        // Event listener to open the modal
        reserveBtn.addEventListener('click', () => {
            reservationModal.style.display = 'flex';
        });

        // Function to close modal
        function closeModal() {
            reservationModal.style.display = 'none';
        }

        // Prevent default form submission and close modal
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Your reservation has been confirmed!');
            closeModal();
        });
    </script>

    <style>
        /* Additional Styles */
        input {
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 1rem;
        }
    </style>
    </section>

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



        <div class="flip-container" style="background-color: #2c3e50;">
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="../images/dining.jpg" alt="Special Offer">
                    </div>
                    <div class="flip-card-back">
                        <h3>Special Offer</h3>
                        <p>Get 20% off on your first visit!</p>
                        <button class="offer-btn">Claim Offer</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
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