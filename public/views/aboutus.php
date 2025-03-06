<?php
    include_once 'nav/homenav.php';
?>


        <!-- Hero Section with Enhanced Design -->
        <section class="about">
        <div class="slider-container" style="max-width: 1200px; margin: 0 auto; position: relative; overflow: hidden; background: rgba(255, 255, 255, 0); backdrop-filter: blur(2px); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
            <div class="slider" style="display: flex; transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);">
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color:  rgb(102, 67, 35); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">Casa Marcos Resort and villas</h2>
                    <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">Discover luxury and comfort at Casa Marcos, where every stay becomes an unforgettable experience.</p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(255, 255, 255); margin: 2rem auto;"></div>
                </div>
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color: rgb(102, 67, 35); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">Our Commitment</h2>
                    <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">We provide exceptional service and amenities, ensuring your stay is comfortable and relaxing.</p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background: rgb(255, 255, 255); margin: 2rem auto;"></div>
                </div>
                <div class="slide" style="min-width: 100%; padding: 4rem; text-align: center; background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));">
                    <h2 style="color:  rgb(102, 67, 35); font-size: 2.5rem; font-family: 'impact'; margin-bottom: 1.5rem;">Your Home Away From Home</h2>
                    <p style="color: rgb(240, 240, 240); font-size: 1.5rem; line-height: 1.6; margin: 0 auto; max-width: 600px; font-family: 'Georgia', serif;">Experience the perfect blend of modern luxury and Filipino hospitality at Casa Marcos.</p>
                    <div class="decorative-line" style="width: 150px; height: 3px; background:  rgb(255, 255, 255); margin: 2rem auto;"></div>
                </div>
            </div>
            <div style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%);">
                <button onclick="prevSlide()" style="background:  rgb(102, 67, 35); border: none; padding: 15px 20px; cursor: pointer; border-radius: 50%; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">←</button>
            </div>
            <div style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                <button onclick="nextSlide()" style="background:  rgb(102, 67, 35); border: none; padding: 15px 20px; cursor: pointer; border-radius: 50%; color: white; font-size: 1.2rem; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">→</button>
            </div>
        </div>
    </section>    

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
        <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 8rem 0; position: relative; overflow: hidden;">
            <!-- Decorative Elements -->
            <div style="position: absolute; width: 300px; height: 300px; background: radial-gradient(circle, #c8a97e 0%, transparent 70%); top: -150px; left: -150px; opacity: 0.1;"></div>
            <div style="position: absolute; width: 200px; height: 200px; background: radial-gradient(circle, #e2c9a6 0%, transparent 70%); bottom: -100px; right: -100px; opacity: 0.1;"></div>
            
            <div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
            <h2 style="color: #2c3e50; font-size: 3.5rem; margin-bottom: 1rem; text-align: center; font-family: 'Playfair Display', serif;">
                Our Team
            </h2>
            <span style="display: block; width: 150px; height: 4px; background: linear-gradient(to right, #c8a97e, #e2c9a6); margin: 0 auto 5rem; border-radius: 2px;"></span>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 4rem;">
                <!-- Team Member 1 -->
                <div style="background: white; padding: 1.2rem 2rem; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); transition: all 0.4s ease-in-out;" 
                 onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.15)'" 
                 onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)'">
                <div style="position: relative; width: 240px; height: 240px; margin: 0 auto 2.5rem;">
                    <div style="position: absolute; width: 100%; height: 100%; border-radius: 50%; background: linear-gradient(45deg, #c8a97e, #e2c9a6); opacity: 0.2; transform: scale(1.1);"></div>
                    <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 8px solid white; box-shadow: 0 15px 30px rgba(0,0,0,0.15);">
                </div>
                <h3 style="color: #2c3e50; margin-bottom: 1rem; text-align: center; font-size: 2rem; font-family: 'Playfair Display', serif;">John Doe</h3>
                <p style="color: #c8a97e; margin-bottom: 2rem; text-align: center; font-size: 1.3rem; font-weight: 500;">General Manager</p>
                <p style="color: #666; text-align: center; font-size: 1.1rem; margin-bottom: 2rem; line-height: 1.6;">Leading our team with passion and dedication to create exceptional experiences.</p>
                <div style="display: flex; justify-content: center; gap: 2rem; border-top: 1px solid #eee; padding-top: 2rem;">
                    <a href="#" style="color: #1DA1F2; font-size: 1.8rem; transition: all 0.3s ease; background:rgb(250, 250, 248); padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #4267B2; font-size: 1.8rem; transition: all 0.3s ease; background: #f8f9fa; padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #E1306C; font-size: 1.8rem; transition: all 0.3s ease; background: #f8f9fa; padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-instagram"></i></a>
                </div>
                </div>

                <!-- Team Member 2 (copy same enhanced structure as Member 1, change name/title/description) -->
                <div style="background: white; padding: 3.5rem 2rem; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); transition: all 0.4s ease-in-out;" 
                 onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.15)'" 
                 onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)'">
                <div style="position: relative; width: 240px; height: 240px; margin: 0 auto 2.5rem;">
                    <div style="position: absolute; width: 100%; height: 100%; border-radius: 50%; background: linear-gradient(45deg, #c8a97e, #e2c9a6); opacity: 0.2; transform: scale(1.1);"></div>
                    <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 8px solid white; box-shadow: 0 15px 30px rgba(0,0,0,0.15);">
                </div>
                <h3 style="color: #2c3e50; margin-bottom: 1rem; text-align: center; font-size: 2rem; font-family: 'Playfair Display', serif;">Jane Smith</h3>
                <p style="color: #c8a97e; margin-bottom: 2rem; text-align: center; font-size: 1.3rem; font-weight: 500;">Operations Director</p>
                <p style="color: #666; text-align: center; font-size: 1.1rem; margin-bottom: 2rem; line-height: 1.6;">Ensuring seamless operations and guest satisfaction at every touchpoint.</p>
                <div style="display: flex; justify-content: center; gap: 2rem; border-top: 1px solid #eee; padding-top: 2rem;">
                    <a href="#" style="color: #1DA1F2; font-size: 1.8rem; transition: all 0.3s ease; background:rgb(250, 250, 248); padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #4267B2; font-size: 1.8rem; transition: all 0.3s ease; background: #f8f9fa; padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #E1306C; font-size: 1.8rem; transition: all 0.3s ease; background: #f8f9fa; padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-instagram"></i></a>
                </div>
                </div>

                <!-- Team Member 3 (copy same enhanced structure as Member 1, change name/title/description) -->
                <div style="background: white; padding: 3.5rem 2rem; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); transition: all 0.4s ease-in-out;" 
                 onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.15)'" 
                 onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)'">
                <div style="position: relative; width: 240px; height: 240px; margin: 0 auto 2.5rem;">
                    <div style="position: absolute; width: 100%; height: 100%; border-radius: 50%; background: linear-gradient(45deg, #c8a97e, #e2c9a6); opacity: 0.2; transform: scale(1.1);"></div>
                    <img src="../images/roomtab.jpg" alt="Staff Member" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 8px solid white; box-shadow: 0 15px 30px rgba(0,0,0,0.15);">
                </div>
                <h3 style="color: #2c3e50; margin-bottom: 1rem; text-align: center; font-size: 2rem; font-family: 'Playfair Display', serif;">Mike Johnson</h3>
                <p style="color: #c8a97e; margin-bottom: 2rem; text-align: center; font-size: 1.3rem; font-weight: 500;">Guest Relations Manager</p>
                <p style="color: #666; text-align: center; font-size: 1.1rem; margin-bottom: 2rem; line-height: 1.6;">Creating memorable experiences and lasting connections with our guests.</p>
                <div style="display: flex; justify-content: center; gap: 2rem; border-top: 1px solid #eee; padding-top: 2rem;">
                    <a href="#" style="color: #1DA1F2; font-size: 1.8rem; transition: all 0.3s ease; background:rgb(250, 250, 248); padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: #4267B2; font-size: 1.8rem; transition: all 0.3s ease; background: #f8f9fa; padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #E1306C; font-size: 1.8rem; transition: all 0.3s ease; background: #f8f9fa; padding: 12px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'; this.style.boxShadow='0 6px 12px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1) rotate(0)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.1)'"><i class="fab fa-instagram"></i></a>
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
    window.addEventListener('scroll', function () {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>