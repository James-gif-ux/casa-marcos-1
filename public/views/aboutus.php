<?php
    include_once 'nav/homenav.php';
?>


        <!-- Hero Section with Enhanced Design -->
        <div class="hero-section" style="position: relative; overflow: hidden;">
            <img src="../images/about.jpg" alt="Barkada Room" 
            style="width: 100%; height: 100vh; object-fit: cover;">
            
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
            </div>
            
        </div>

        <!-- Experience Section -->
        <div style="max-width: 1400px; margin: 8rem auto; padding: 0 2rem;">
            <h2 style="color: #2c3e50; font-size: 3.2rem; margin-bottom: 4rem; text-align: center; font-family: 'Playfair Display', serif;">
                Experience and Care
                <span style="display: block; width: 120px; height: 4px; background: linear-gradient(to right, #c8a97e, #e2c9a6); margin: 1.5rem auto; border-radius: 2px;"></span>
            </h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;">
                <div style="background: #fff; padding: 3rem; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.05);">
                    <p style="color: #34495e; font-size: 1.3rem; line-height: 1.8; margin-bottom: 2.5rem; text-align: justify; font-family: 'Roboto', sans-serif;">
                        At Casa Marcos, we believe in creating extraordinary experiences through exceptional care and attention to detail. 
                        Our dedicated team works tirelessly to ensure every guest feels welcomed and valued, combining professional 
                        service with genuine Filipino warmth.
                    </p>
                    <p style="color: #34495e; font-size: 1.3rem; line-height: 1.8; text-align: justify; font-family: 'Roboto', sans-serif;">
                        We pride ourselves on understanding and anticipating our guests' needs, offering personalized services that 
                        make every stay memorable. Our commitment to excellence extends beyond luxury amenities to create meaningful 
                        connections and experiences that will last a lifetime.
                    </p>
                </div>
                <img src="../images/villas.jpg" alt="Experience" style="width: 100%; height: 500px; object-fit: cover; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>

        <!-- Team Section -->
        <div style="background: linear-gradient(to right, #f8f9fa, #f1f2f6); padding: 6rem 0;">
            <div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
            <h2 style="color: #2c3e50; font-size: 3.2rem; margin-bottom: 4rem; text-align: center; font-family: 'Playfair Display', serif;">
                Our Team
                <span style="display: block; width: 120px; height: 4px; background: linear-gradient(to right, #c8a97e, #e2c9a6); margin: 1.5rem auto; border-radius: 2px;"></span>
            </h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4rem;">
                <!-- Team Member 1 -->
                <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 220px; height: 220px; border-radius: 50%; object-fit: cover; margin: 0 auto 2rem; display: block; border: 6px solid #c8a97e; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <h3 style="color: #2c3e50; margin-bottom: 1rem; text-align: center; font-size: 1.8rem; font-family: 'Playfair Display', serif;">John Doe</h3>
                <p style="color: #666; margin-bottom: 2rem; text-align: center; font-size: 1.2rem;">General Manager</p>
                <div style="display: flex; justify-content: center; gap: 2rem;">
                    <a href="#" style="color: #1DA1F2; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #4267B2; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #E1306C; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-instagram"></i></a>
                </div>
                </div>

                <!-- Team Member 2 -->
                <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 220px; height: 220px; border-radius: 50%; object-fit: cover; margin: 0 auto 2rem; display: block; border: 6px solid #c8a97e; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <h3 style="color: #2c3e50; margin-bottom: 1rem; text-align: center; font-size: 1.8rem; font-family: 'Playfair Display', serif;">Jane Smith</h3>
                <p style="color: #666; margin-bottom: 2rem; text-align: center; font-size: 1.2rem;">Operations Director</p>
                <div style="display: flex; justify-content: center; gap: 2rem;">
                    <a href="#" style="color: #1DA1F2; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #4267B2; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #E1306C; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-instagram"></i></a>
                </div>
                </div>

                <!-- Team Member 3 -->
                <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 220px; height: 220px; border-radius: 50%; object-fit: cover; margin: 0 auto 2rem; display: block; border: 6px solid #c8a97e; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                <h3 style="color: #2c3e50; margin-bottom: 1rem; text-align: center; font-size: 1.8rem; font-family: 'Playfair Display', serif;">Mike Johnson</h3>
                <p style="color: #666; margin-bottom: 2rem; text-align: center; font-size: 1.2rem;">Guest Relations Manager</p>
                <div style="display: flex; justify-content: center; gap: 2rem;">
                    <a href="#" style="color: #1DA1F2; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #4267B2; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #E1306C; font-size: 1.8rem; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'"><i class="fab fa-instagram"></i></a>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <div style="max-width: 1400px; margin: 8rem auto; padding: 3rem;">
            <h2 style="color: #2c3e50; font-size: 3.2rem; margin-bottom: 4rem; text-align: center; font-family: 'Playfair Display', serif;">
                Our Gallery
                <span style="display: block; width: 120px; height: 4px; background: linear-gradient(to right, #c8a97e, #e2c9a6); margin: 1.5rem auto; border-radius: 2px;"></span>
            </h2>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 4rem;">
                <img src="../images/villas.jpg" alt="Resort Image 1" 
                    style="width: 100%; height: 700px; object-fit: cover; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); transition: all 0.5s ease;"
                    onmouseover="this.style.transform='scale(1.03)'" 
                    onmouseout="this.style.transform='scale(1)'">

                <div style="display: grid; grid-template-rows: repeat(2, 1fr); gap: 4rem;">
                    <img src="../images/roomtab.jpg" alt="Resort Image 2" 
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); transition: all 0.5s ease;"
                        onmouseover="this.style.transform='scale(1.03)'" 
                        onmouseout="this.style.transform='scale(1)'">
                    
                    <img src="../images/history.jpg" alt="Resort Image 3" 
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 25px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); transition: all 0.5s ease;"
                        onmouseover="this.style.transform='scale(1.03)'" 
                        onmouseout="this.style.transform='scale(1)'">
                </div>
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