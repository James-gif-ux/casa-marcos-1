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
    </style>

    <section class="off">
        <div class="slider-container" style="max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; background: rgba(255, 255, 255, 0); backdrop-filter: blur(3px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
            <div class="slider" style="display: flex; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color: rgba(218, 191, 156, 0.9); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">Welcome to Casa Marcos Restaurant</h2>
                    <p style="color: rgb(255, 255, 255); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">Experience exquisite dining in our elegant atmosphere, where traditional flavors meet modern cuisine.</p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(255, 255, 255); margin: 2rem auto;"></div>
                </div>
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color: rgba(218, 191, 156, 0.9); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">Our Culinary Excellence</h2>
                    <p style="color: rgb(255, 255, 255); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">Our expert chefs craft each dish with passion, using only the finest local ingredients.</p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(255, 255, 255); margin: 2rem auto;"></div>
                </div>
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color: rgba(218, 191, 156, 0.9); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">Perfect for Every Occasion</h2>
                    <p style="color: rgb(255, 255, 255); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">From intimate dinners to special celebrations, we create memorable dining experiences.</p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(255, 255, 255); margin: 2rem auto;"></div>
                </div>
            </div>
            <div style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%);">
                <button onclick="prevSlide()" style="background: rgb(102, 67, 35); border: none; padding: 15px 20px; cursor: pointer; border-radius: 50%; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">←</button>
            </div>
            <div style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                <button onclick="nextSlide()" style="background: rgb(102, 67, 35); border: none; padding: 15px 20px; cursor: pointer; border-radius: 50%; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">→</button>
            </div>
        </div>
    </section>  
    
    <section>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color:rgb(218, 191, 156);
    }
    h2 {
        color:  #2c3e50;
        text-align: center;
        margin: 20px 0;
        font-size: 1.75em;
        padding-bottom: 10px;
    }

    .menu-nav {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 20px 0;
    }

    .menu-nav button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #2c3e50;
        color: rgb(218, 191, 156);
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 1.1em;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .menu-section {
        display: none; /* Start hidden */
        margin-bottom: 40px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .grid-container > div {
        background-color: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s;
        text-align: center;
        position: relative; /* For the overlay */
        opacity: 0; /* Start hidden */
        transform: translateY(20px); /* Start off-position */
        transition: opacity 0.5s ease, transform 0.5s ease; /* Apply delay for opacity and transform */
    }

    .grid-container > div.visible {
        opacity: 1; /* Visible */
        transform: translateY(0); /* Move to original position */
    }

    .grid-container > div:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .menu-image {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .item-name {
        font-weight: bold;
        margin-top: 10px;
        font-size: 1.2em;
        color: #2c3e50;
    }

    .price {
        font-size: 1.1em;
        color: #e74c3c;
        font-weight: bold;
    }

    /* Add a Pseudo Element for Overlays */
    .grid-container > div:after {
        content: '';
        background: rgba(255, 255, 255, 0.6);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .grid-container > div:hover:after {
        opacity: 1;
    }
</style>
</head>
<body>



<div class="menu-nav">
    <button onclick="showSection('main')">Main Courses</button>
    <button onclick="showSection('meats')">Meats & Fish</button>
    <button onclick="showSection('desserts')">Desserts</button>
</div>

  <div id="main" class="menu-section">
      <h2>Main Courses</h2>
      <div class="grid-container">
          <div>
              <img src="https://placehold.co/300x200" alt="Pizza" class="menu-image">
              <span class="item-name">Pizza</span>
              <span class="price">₱649.00</span>
          </div>
          <div>
              <img src="https://placehold.co/300x200" alt="Burger" class="menu-image">
              <span class="item-name">Burger</span>
              <span class="price">₱449.00</span>
          </div>
          <div>
              <img src="https://placehold.co/300x200" alt="Pasta" class="menu-image">
              <span class="item-name">Pasta</span>
              <span class="price">₱549.00</span>
          </div>
          <div>
              <img src="https://placehold.co/300x200" alt="Pizza" class="menu-image">
              <span class="item-name">Pizza</span>
              <span class="price">₱649.00</span>
          </div>
          <div>
              <img src="https://placehold.co/300x200" alt="Burger" class="menu-image">
              <span class="item-name">Burger</span>
              <span class="price">₱449.00</span>
          </div>
          <div>
              <img src="https://placehold.co/300x200" alt="Pasta" class="menu-image">
              <span class="item-name">Pasta</span>
              <span class="price">₱549.00</span>
          </div>
      </div>
  </div>
<div id="meats" class="menu-section">
    <h2>Meats & Fish</h2>
    <div class="grid-container">
        <div>
            <img src="https://placehold.co/300x200" alt="Steak" class="menu-image">
            <span class="item-name">Steak</span>
            <span class="price">₱1,249.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Fish" class="menu-image">
            <span class="item-name">Fish</span>
            <span class="price">₱949.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Grilled Chicken" class="menu-image">
            <span class="item-name">Grilled Chicken</span>
            <span class="price">₱799.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Steak" class="menu-image">
            <span class="item-name">Steak</span>
            <span class="price">₱1,249.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Fish" class="menu-image">
            <span class="item-name">Fish</span>
            <span class="price">₱949.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Grilled Chicken" class="menu-image">
            <span class="item-name">Grilled Chicken</span>
            <span class="price">₱799.00</span>
        </div>
    </div>
</div>

<div id="desserts" class="menu-section">
    <h2>Desserts</h2>
    <div class="grid-container">
        <div>
            <img src="https://placehold.co/300x200" alt="Ice Cream" class="menu-image">
            <span class="item-name">Ice Cream</span>
            <span class="price">₱299.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Chocolate Cake" class="menu-image">
            <span class="item-name">Chocolate Cake</span>
            <span class="price">₱349.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Apple Pie" class="menu-image">
            <span class="item-name">Apple Pie</span>
            <span class="price">₱399.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Ice Cream" class="menu-image">
            <span class="item-name">Ice Cream</span>
            <span class="price">₱299.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Chocolate Cake" class="menu-image">
            <span class="item-name">Chocolate Cake</span>
            <span class="price">₱349.00</span>
        </div>
        <div>
            <img src="https://placehold.co/300x200" alt="Apple Pie" class="menu-image">
            <span class="item-name">Apple Pie</span>
            <span class="price">₱399.00</span>
        </div>
    </div>
</div>

<script>
    function showSection(section) {
        const sections = document.querySelectorAll('.menu-section');
        sections.forEach(sec => sec.style.display = 'none'); // Hide all sections
        const activeSection = document.getElementById(section);
        activeSection.style.display = 'block'; // Show selected section

        // Add visible class to items for animation
        const items = activeSection.querySelectorAll('.grid-container > div');
        items.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add('visible'); // Add class for animation
            }, index * 100); // Staggered effect (100ms delay)
        });

        // Remove visible class from items in other sections
        sections.forEach(sec => {
            if (sec.id !== section) {
                const otherItems = sec.querySelectorAll('.grid-container > div');
                otherItems.forEach(item => {
                    item.classList.remove('visible'); // Remove the visible class from other sections
                });
            }
        });
    }

    // Optionally, show the first section by default
    showSection('main');
</script>
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
