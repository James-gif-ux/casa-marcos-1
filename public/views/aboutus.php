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

        <div class="hero-section" style="position: relative;">
            <img src="../images/hotel.jpg" alt="Barkada Room" style="width: 100%; height: 600px; object-fit: cover;">
        </div>

        <div style="max-width: 1200px; margin: 5rem auto; padding: 2rem;">
            <h2 style="color: #333; font-size: 2.5rem; margin-bottom: 2rem; text-align: left; font-weight: bold;">Our Story</h2>
            <p style="color: #666; font-size: 1.2rem; line-height: 1.8; margin-bottom: 1.5rem; text-align: justify; font-family: 'Roboto', sans-serif;">
            Casa Marcos, nestled in the heart of natural beauty, has been a cherished destination since its establishment. 
            What began as a modest retreat has evolved into a premier resort destination, offering a perfect blend of 
            comfort, luxury, and authentic Filipino hospitality. Our resort stands as a testament to years of dedication 
            in providing memorable experiences for our guests, surrounded by lush landscapes and modern amenities.
            </p>
            <p style="color: #666; font-size: 1.2rem; line-height: 1.8; text-align: justify; font-family: 'Roboto', sans-serif;">
            Today, Casa Marcos continues to grow while maintaining its commitment to excellent service and sustainable 
            practices. We take pride in creating an environment where guests can unwind, reconnect with nature, and 
            create lasting memories with their loved ones.
            </p>
        </div>


        <div style="max-width: 1200px; margin: 5rem auto; padding: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; text-align: center;">
            <!-- Staff Member 1 -->
            <div style="padding: 1.5rem;">
                <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem;">
                <h3 style="color: #333; margin-bottom: 0.5rem;">John Doe</h3>
                <p style="color: #666; margin-bottom: 1rem;">General Manager</p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                <a href="#" style="color: #1DA1F2;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #4267B2;"><i class="fab fa-facebook"></i></a>
                <a href="#" style="color: #0077B5;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Staff Member 2 -->
            <div style="padding: 1.5rem;">
                <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem;">
                <h3 style="color: #333; margin-bottom: 0.5rem;">Jane Smith</h3>
                <p style="color: #666; margin-bottom: 1rem;">Customer Relations</p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                <a href="#" style="color: #1DA1F2;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #4267B2;"><i class="fab fa-facebook"></i></a>
                <a href="#" style="color: #0077B5;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Staff Member 3 -->
            <div style="padding: 1.5rem;">
                <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem;">
                <h3 style="color: #333; margin-bottom: 0.5rem;">Mark Wilson</h3>
                <p style="color: #666; margin-bottom: 1rem;">Head Chef</p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                <a href="#" style="color: #1DA1F2;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: #4267B2;"><i class="fab fa-facebook"></i></a>
                <a href="#" style="color: #0077B5;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            </div>
        </div>


        <div style="max-width: 1400px; margin: 4rem auto; padding: 3rem;">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
                <img src="../images/villas.jpg" alt="Resort Image 1" 
                    style="width: 100%; height: 500px; object-fit: cover; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.02)'" 
                    onmouseout="this.style.transform='scale(1)'">

                <img src="../images/roomtab.jpg" alt="Resort Image 2" 
                    style="width: 80%; height: 300px; display: inline-block; margin-right: 2%; object-fit: cover; border-radius: 10px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; margin-top: 30%;"
                    onmouseover="this.style.transform='scale(1.02)'" 
                    onmouseout="this.style.transform='scale(1)'">

                <img src="../images/roomtab.jpg" alt="Resort Image 3" 
                    style="width: 80%; height: 300px; display: inline-block; margin-left: 18%; object-fit: cover; border-radius: 10px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.02)'" 
                    onmouseout="this.style.transform='scale(1)'">

                <img src="../images/history.jpg" alt="Resort Image 4" 
                    style="width: 100%; height: 500px; object-fit: cover; border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.02)'" 
                    onmouseout="this.style.transform='scale(1)'">
            </div>
</div>         

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