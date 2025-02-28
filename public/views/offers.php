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

    <section>
    <div style="padding: 50px; background-color: #2c3e50; color: white;">
            <h2 style="font-size: 2.5rem; font-family: 'Cormorant Garamond', 'Times New Roman', serif; text-align: center; color: rgb(218, 191, 156); margin-bottom: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); letter-spacing: 2px; text-transform: uppercase;">
                Enjoy your meal
            </h2>
        
        <div style="display: flex; justify-content: center; gap: 20px; margin-bottom: 40px;">
            <button class="offer-btn">Popular Breakfast</button>
            <button class="offer-btn">Special Lunch</button>
            <button class="offer-btn">Lovely Dinner</button>
        </div>

        <div id="menu-container" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 40px; max-width: 1400px; margin: 0 auto;">
                    <?php
                    $menuItems = [
                        'breakfast' => [
                            ['name' => 'Classic Pancakes', 'price' => '$12.99', 'image' => 'https://placehold.co/400x300/brown/white?text=Pancakes'],
                            ['name' => 'Eggs Benedict', 'price' => '$14.99', 'image' => 'https://placehold.co/400x300/yellow/black?text=Eggs'],
                            ['name' => 'Breakfast Burrito', 'price' => '$11.99', 'image' => 'https://placehold.co/400x300/orange/white?text=Burrito'],
                            ['name' => 'French Toast', 'price' => '$10.99', 'image' => 'https://placehold.co/400x300/tan/black?text=Toast']
                        ],
                        'lunch' => [
                            ['name' => 'Classic Burger', 'price' => '$15.99', 'image' => 'https://placehold.co/400x300/red/white?text=Burger'],
                            ['name' => 'Caesar Salad', 'price' => '$12.99', 'image' => 'https://placehold.co/400x300/green/white?text=Salad'],
                            ['name' => 'Fish & Chips', 'price' => '$16.99', 'image' => 'https://placehold.co/400x300/blue/white?text=Fish'],
                            ['name' => 'Pasta Carbonara', 'price' => '$18.99', 'image' => 'https://placehold.co/400x300/wheat/black?text=Pasta']
                        ],
                        'dinner' => [
                            ['name' => 'Grilled Salmon', 'price' => '$24.99', 'image' => 'https://placehold.co/400x300/pink/black?text=Salmon'],
                            ['name' => 'Filet Mignon', 'price' => '$29.99', 'image' => 'https://placehold.co/400x300/maroon/white?text=Steak'],
                            ['name' => 'Lobster Thermidor', 'price' => '$34.99', 'image' => 'https://placehold.co/400x300/red/white?text=Lobster'],
                            ['name' => 'Duck Confit', 'price' => '$28.99', 'image' => 'https://placehold.co/400x300/gray/white?text=Duck']
                        ]    ];

                    foreach ($menuItems['lunch'] as $item): ?>
                        <div class="menu-item" style="background: rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 20px; transition: transform 0.3s ease; cursor: pointer; display: flex; gap: 20px; opacity: 0; transform: translateY(20px);" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                            <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" style="width: 180px; height: 120px; object-fit: cover; border-radius: 10px;">
                            <div style="display: flex; flex-direction: column; justify-content: center;">
                                <h4 style="font-size: 1.3rem; color: rgb(218, 191, 156); margin-bottom: 10px;"><?= $item['name'] ?></h4>
                                <p style="color: #ecf0f1; margin-bottom: 10px;">Fresh ingredients prepared with care</p>
                                <span style="font-size: 1.1rem; color: rgb(218, 191, 156); font-weight: bold;"><?= $item['price'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <style>
                    .offer-btn.active {
                        background-color: #DAB89C;
                        color: white;
                        transform: scale(1.05);
                    }
                </style>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const menuContainer = document.getElementById('menu-container');
                    const buttons = document.querySelectorAll('.offer-btn');
                    
                    function showMenu(menuType, clickedButton) {
                        // Remove active class from all buttons
                        buttons.forEach(btn => btn.classList.remove('active'));
                        // Add active class to clicked button
                        clickedButton.classList.add('active');

                        menuContainer.innerHTML = '';
                        const menu = <?php echo json_encode($menuItems); ?>[menuType];
                        
                        menu.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'menu-item';
                            div.style.cssText = "background: rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 20px; transition: all 0.3s ease; cursor: pointer; display: flex; gap: 20px; opacity: 0; transform: translateY(20px);";
                            
                            div.innerHTML = `
                                <img src="${item.image}" alt="${item.name}" style="width: 180px; height: 120px; object-fit: cover; border-radius: 10px;">
                                <div style="display: flex; flex-direction: column; justify-content: center;">
                                    <h4 style="font-size: 1.3rem; color: rgb(218, 191, 156); margin-bottom: 10px;">${item.name}</h4>
                                    <p style="color: #ecf0f1; margin-bottom: 10px;">Fresh ingredients prepared with care</p>
                                    <span style="font-size: 1.1rem; color: rgb(218, 191, 156); font-weight: bold;">${item.price}</span>
                                </div>
                            `;
                            
                            menuContainer.appendChild(div);
                            setTimeout(() => {
                                div.style.opacity = '1';
                                div.style.transform = 'translateY(0)';
                            }, 100);
                        });
                    }

                    buttons[0].addEventListener('click', function() { showMenu('breakfast', this); });
                    buttons[1].addEventListener('click', function() { showMenu('lunch', this); });
                    buttons[2].addEventListener('click', function() { showMenu('dinner', this); });

                    // Show initial menu with animation and set initial active button
                    buttons[1].classList.add('active'); // Set lunch button as initially active
                    showMenu('lunch', buttons[1]);
                });
                </script>
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