        <?php
            include_once 'nav/homenav.php';
        ?>

            <div class="hero-section" style="position: relative;">
                <img src="../images/villas.jpg" alt="Barkada Room" style="width: 100%; height: 600px; object-fit: cover;">
            </div>

            <div style="max-width: 1500px; margin: -30px auto 50px; padding: 2rem 1rem; position: relative; background-color: #2c3e50; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div style="text-align: center; margin-bottom: 4rem; padding-bottom: 2rem; border-bottom: 2px solid #f0e6dd;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap;">
                        <h2 style="color: rgb(218, 191, 156); font-size: 2.8rem; font-family: 'impact'; margin-top:10px; text-transform: uppercase; letter-spacing: 1px;">
                            Sapphira villa 6 pax
                        </h2>
                        <div style="background: rgb(218, 191, 156); padding: 0.8rem 1.5rem; border-radius: 12px; margin-top: 10px;">
                            <p style="color: white; margin: 0;"><span style="font-size: 2rem; font-weight: bold;">₱8,999</span></p>
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 4rem; max-width: 1500px; margin-left: auto; margin-right: auto;">
                    <div style="text-align: center; padding: 3rem; background: #f9f6f2; border-radius: 15px; transition: transform 0.3s; cursor: pointer; border: 1px solid #e6d5c5;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                        <i class="fas fa-bed" style="font-size: 2.5rem; color: rgb(102, 67, 35); margin-bottom: 1.5rem;"></i>
                        <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; font-family: 'impact'; margin-bottom: 0.8rem;">Bed</h3>
                        <p style="color: #666; font-size: 1.2rem;">1 Queen-size & 4 Single-sized Beds</p>
                    </div>
                    <div style="text-align: center; padding: 2.5rem; background: #f9f6f2; border-radius: 15px; transition: transform 0.3s; cursor: pointer; border: 1px solid #e6d5c5;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                        <i class="fas fa-users" style="font-size: 2.5rem; color: rgb(102, 67, 35); margin-bottom: 1.5rem;"></i>
                        <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; font-family: 'impact'; margin-bottom: 0.8rem;">Capacity</h3>
                        <p style="color: #666; font-size: 1.2rem;">6 Person</p>
                    </div>
                </div>

                <div style="background: #f9f6f2; padding: 3rem; border-radius: 20px; border: 1px solid #e6d5c5;">
                    <h3 style="color: rgb(102, 67, 35); font-size: 2rem; font-family: 'impact'; margin-bottom: 2rem; text-align: center;">Room Features</h3>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                            <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                            <span style="color: #666;">Private Bathroom</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                            <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                            <span style="color: #666;">TV & Wifi in Rooms</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                            <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                            <span style="color: #666;">Large private living room</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                            <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                            <span style="color: #666;">Room Service</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                            <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                            <span style="color: #666;">Breakfast Included</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                            <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                            <span style="color: #666;">Air conditioning</span>
                        </div>
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