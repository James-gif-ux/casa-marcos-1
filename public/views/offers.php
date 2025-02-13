<?php
    include_once 'nav/homenav.php';
?>

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




  <section class="food-menu" style="padding: 10rem 1rem; background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9));">
      <div class="menu-container" style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
          <div class="menu-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
              <!-- Menu Item 1 -->
              <div class="menu-item" style="background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                  <img src="../images/food1.jpg" alt="Special Dish 1" style="width: 100%; height: 180px; object-fit: cover; border-radius: 10px;">
                  <h3 style="color: rgb(163, 99, 15); margin: 0.8rem 0; font-size: clamp(1.2rem, 2vw, 1.5rem);">Signature Pasta</h3>
                  <p style="color: #666; margin-bottom: 0.8rem; font-size: clamp(0.9rem, 1.5vw, 1rem);">Homemade pasta with rich tomato sauce and fresh herbs</p>
                  <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: clamp(1rem, 1.8vw, 1.2rem);">₱250</span>
              </div>
            <!-- Menu Item 2 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food2.jpg" alt="Special Dish 2" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Grilled Salmon</h3>
                <p style="color: #666; margin-bottom: 1rem;">Fresh salmon with lemon butter sauce and seasonal vegetables</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱450</span>
            </div>

            <!-- Menu Item 3 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food3.jpg" alt="Special Dish 3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Classic Steak</h3>
                <p style="color: #666; margin-bottom: 1rem;">Premium cut beef with garlic mashed potatoes</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱550</span>
            </div>
        </div>
    </div>

    <div class="menu-container" style="max-width: 1175px; margin: 0 auto; padding: 2rem 1rem;">
        
        <div class="menu-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Menu Item 1 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food1.jpg" alt="Special Dish 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Signature Pasta</h3>
                <p style="color: #666; margin-bottom: 1rem;">Homemade pasta with rich tomato sauce and fresh herbs</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱250</span>
            </div>

            <!-- Menu Item 2 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food2.jpg" alt="Special Dish 2" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Grilled Salmon</h3>
                <p style="color: #666; margin-bottom: 1rem;">Fresh salmon with lemon butter sauce and seasonal vegetables</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱450</span>
            </div>

            <!-- Menu Item 3 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food3.jpg" alt="Special Dish 3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Classic Steak</h3>
                <p style="color: #666; margin-bottom: 1rem;">Premium cut beef with garlic mashed potatoes</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱550</span>
            </div>

             <!-- Menu Item 1 -->
             <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food1.jpg" alt="Special Dish 1" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Signature Pasta</h3>
                <p style="color: #666; margin-bottom: 1rem;">Homemade pasta with rich tomato sauce and fresh herbs</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱250</span>
            </div>

            <!-- Menu Item 2 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food2.jpg" alt="Special Dish 2" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Grilled Salmon</h3>
                <p style="color: #666; margin-bottom: 1rem;">Fresh salmon with lemon butter sauce and seasonal vegetables</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱450</span>
            </div>

            <!-- Menu Item 3 -->
            <div class="menu-item" style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
                <img src="../images/food3.jpg" alt="Special Dish 3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                <h3 style="color: rgb(163, 99, 15); margin: 1rem 0; font-size: 1.5rem;">Classic Steak</h3>
                <p style="color: #666; margin-bottom: 1rem;">Premium cut beef with garlic mashed potatoes</p>
                <span style="color: rgb(102, 67, 35); font-weight: bold; font-size: 1.2rem;">₱550</span>
            </div>
        </div>
    </div>
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