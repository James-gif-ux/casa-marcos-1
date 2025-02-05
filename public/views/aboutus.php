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

      <section style="padding: 5rem 2rem; margin-top: 5rem; background-color: rgba(172, 144, 117, 0.89); position: relative; overflow: hidden;">
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