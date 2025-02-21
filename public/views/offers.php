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
    <div class="slider-container" style="max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; background: rgba(255, 255, 255, 0); backdrop-filter: blur(3px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
        <div class="slider" style="display: flex; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
            <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                <h2 style="color: rgb(82, 54, 15); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">
                    Welcome to Casa Marcos Restaurant
                </h2>
                <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">
                    Experience exquisite dining in our elegant atmosphere, where traditional flavors meet modern cuisine.
                </p>
                <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(218, 191, 156); margin: 2rem auto;"></div>
            </div>
            <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                <h2 style="color: rgb(82, 54, 15); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">
                    Our Culinary Excellence
                </h2>
                <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">
                    Our expert chefs craft each dish with passion, using only the finest local ingredients.
                </p>
                <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(218, 191, 156); margin: 2rem auto;"></div>
            </div>
            <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                <h2 style="color: rgb(82, 54, 15); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">
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

    <div style="text-align: center; margin-bottom: 5rem; padding: 1rem;">
        <button id="reserveBtn" style="background: rgba(218, 191, 156, 0.9); border: none; padding: 15px 30px; cursor: pointer; border-radius: 25px; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
            Reserve Your Table
        </button>
    </div>

   <!-- Modal for Reservation -->
<div id="reservationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); justify-content: center; align-items: center; z-index: 1000;">
    <div style="background: white; padding: 2rem; border-radius: 15px; width: 450px; position: relative; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);">
        <h2 style="color: rgb(82, 54, 15); margin-bottom: 1rem; font-family: 'Georgia', serif; font-size: 2rem; text-align: center; border-bottom: 2px solid rgb(218, 191, 156);">
            Reserve Your Table
        </h2>
        <form id="reservationForm">
            <label style="color: rgb(82, 54, 15); margin-bottom: 0.5rem; font-family: 'Helvetica Neue', sans-serif; font-weight: bold;">Name:</label>
            <input type="text" required style="width: 100%; padding: 12px; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
            
            <label style="color: rgb(82, 54, 15); margin-bottom: 0.5rem; font-family: 'Helvetica Neue', sans-serif; font-weight: bold;">Date:</label>
            <input type="date" required style="width: 100%; padding: 12px; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
            
            <label style="color: rgb(82, 54, 15); margin-bottom: 0.5rem; font-family: 'Helvetica Neue', sans-serif; font-weight: bold;">Time:</label>
            <input type="time" required style="width: 100%; padding: 12px; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
            
            <label style="color: rgb(82, 54, 15); margin-bottom: 0.5rem; font-family: 'Helvetica Neue', sans-serif; font-weight: bold;">Number of Guests:</label>
            <input type="number" required min="1" style="width: 100%; padding: 12px; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 5px; box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);">
            
            <button type="submit" style="background: rgb(82, 54, 15); border: none; padding: 12px 20px; cursor: pointer; color: white; font-size: 1.1rem; font-weight: bold; transition: all 0.3s ease; border-radius: 5px; width: 100%; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">Confirm Reservation</button>
        </form>
        <button onclick="closeModal()" style="position: absolute; top: 10px; right: 10px; background: transparent; border: none; font-size: 1.8rem; cursor: pointer; color: rgb(82, 54, 15);">&times;</button>
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