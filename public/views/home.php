<?php
    include_once 'nav/homenav.php';
    include_once '../model/BookingModel.php';
    include_once '../model/Booking_Model.php';
?>

    <main>
        <section class="hero">
            <div style="max-width: 1000px; margin: 0 auto; background: rgba(255, 255, 255, 0); padding: 3rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); backdrop-filter: blur(1px);">
                <form action="books.php" method="POST">
                    <!-- Check-in and Check-out Section -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px;">
                            <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK IN</h3>
                            <input type="date" name="check_in" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                            <input type="time" name="check_in_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                        </div>
                        <div style="background:rgba(250, 240, 230, 0); padding: 1.5rem; border-radius: 12px;">
                            <h3 style="color: rgb(218, 191, 156); margin-bottom: 1rem; font-size: 1.4rem; font-family: 'impact';">CHECK OUT</h3>
                            <input type="date" name="check_out" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                            <input type="time" name="check_out_time" required style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" style="width: 50%; padding: 1rem; margin-top: 2rem; background: linear-gradient(to right, rgb(218, 191, 156), rgb(218, 191, 156)); color: white; border: none; border-radius: 12px; cursor: pointer; font-size: 1.1rem; font-weight: bold; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 1px;">
                        Search Booking
                    </button>
                </form>
            </div>
        </section>


        <section style="padding: 5rem 2rem; background-color: rgba(172, 144, 117, 0.89); position: relative; overflow: hidden;">
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
<!-- Rooms Section -->
<section class="rooms" style="position: relative; overflow: hidden; padding: 5rem 0; background: #f0ece4;">
    <div style="position: absolute; top: 0; left: 0; right: 0; height: 100%; background: rgba(255, 255, 255, 0.6); z-index: 1;"></div>
    <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center; position: relative; z-index: 2;">
        Our Rooms
        <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
    </h2>
    <!-- Carousel Container -->
    <div class="carousel-container" style="position: relative; z-index: 2;">
        <!-- Carousel Slides -->
        <div class="carousel-wrapper active" style="display: flex; overflow: hidden; transition: transform 0.5s ease;">
            <div class="carousel-slide" style="background-image: url('../images/room.jpg'); flex: 0 0 100%; background-size: cover; background-position: center;">
                <div class="room-details" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 2rem; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.2);">
                    <div class="room-title" style="font-weight: bold; color: rgb(102, 67, 35); font-size: 2rem;">Grand Living Room</div>
                    <div class="room-description" style="color: #666; margin: 1rem 0;">Relax in style with plush seating, warm textures, and carefully curated decor.</div>
                    <div class="room-price" style="color: rgb(163, 99, 15); font-size: 1.5rem; font-weight: bold;">$250 per night</div>
                    <div class="freebies" style="margin-top: 1rem; display: flex; justify-content: center;">
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/wifi-icon.png" alt="Free Wi-Fi" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Wi-Fi</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/breakfast-icon.png" alt="Free Breakfast" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Breakfast</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/parking-icon.png" alt="Free Parking" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Parking</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('../images/history.jpg'); flex: 0 0 100%; background-size: cover; background-position: center;">
                <div class="room-details" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 2rem; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.2);">
                    <div class="room-title" style="font-weight: bold; color: rgb(102, 67, 35); font-size: 2rem;">Opulent Bedroom</div>
                    <div class="room-description" style="color: #666; margin: 1rem 0;">An oasis of peace with soft hues, velvet throws, and the finest linens.</div>
                    <div class="room-price" style="color: rgb(163, 99, 15); font-size: 1.5rem; font-weight: bold;">$300 per night</div>
                    <div class="freebies" style="margin-top: 1rem; display: flex; justify-content: center;">
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/wifi-icon.png" alt="Free Wi-Fi" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Wi-Fi</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/breakfast-icon.png" alt="Free Breakfast" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Breakfast</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/parking-icon.png" alt="Free Parking" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Parking</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('../images/room.jpg'); flex: 0 0 100%; background-size: cover; background-position: center;">
                <div class="room-details" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 2rem; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.2);">
                    <div class="room-title" style="font-weight: bold; color: rgb(102, 67, 35); font-size: 2rem;">Elegant Dining Room</div>
                    <div class="room-description" style="color: #666; margin: 1rem 0;">A space designed for unforgettable dinners, featuring luxurious furniture.</div>
                    <div class="room-price" style="color: rgb(163, 99, 15); font-size: 1.5rem; font-weight: bold;">$200 per night</div>
                    <div class="freebies" style="margin-top: 1rem; display: flex; justify-content: center;">
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/wifi-icon.png" alt="Free Wi-Fi" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Wi-Fi</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/breakfast-icon.png" alt="Free Breakfast" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Breakfast</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/parking-icon.png" alt="Free Parking" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Parking</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('../images/room.jpg'); flex: 0 0 100%; background-size: cover; background-position: center;">
                <div class="room-details" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 2rem; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.2);">
                    <div class="room-title" style="font-weight: bold; color: rgb(102, 67, 35); font-size: 2rem;">Chic Study</div>
                    <div class="room-description" style="color: #666; margin: 1rem 0;">Where productivity meets comfort. A sophisticated workspace perfect for focus.</div>
                    <div class="room-price" style="color: rgb(163, 99, 15); font-size: 1.5rem; font-weight: bold;">$180 per night</div>
                    <div class="freebies" style="margin-top: 1rem; display: flex; justify-content: center;">
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/wifi-icon.png" alt="Free Wi-Fi" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Wi-Fi</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/breakfast-icon.png" alt="Free Breakfast" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Breakfast</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/parking-icon.png" alt="Free Parking" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Parking</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-slide" style="background-image: url('../images/room.jpg'); flex: 0 0 100%; background-size: cover; background-position: center;">
                <div class="room-details" style="background: rgba(255, 255, 255, 0.9); border-radius: 15px; padding: 2rem; text-align: center; box-shadow: 0 2px 15px rgba(0,0,0,0.2);">
                    <div class="room-title" style="font-weight: bold; color: rgb(102, 67, 35); font-size: 2rem;">Luxurious Bathroom</div>
                    <div class="room-description" style="color: #666; margin: 1rem 0;">Pamper yourself with a spa-like experience, featuring modern elegance.</div>
                    <div class="room-price" style="color: rgb(163, 99, 15); font-size: 1.5rem; font-weight: bold;">$150 per night</div>
                    <div class="freebies" style="margin-top: 1rem; display: flex; justify-content: center;">
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/wifi-icon.png" alt="Free Wi-Fi" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Wi-Fi</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/breakfast-icon.png" alt="Free Breakfast" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Breakfast</small>
                        </div>
                        <div style="margin: 0 15px; text-align: center;">
                            <img src="../images/parking-icon.png" alt="Free Parking" style="width: 40px; height: 40px;">
                            <small style="display: block; color: #666;">Free Parking</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button class="prev" onclick="moveSlide(-1)" style="position: absolute; top: 50%; left: 20px; background: rgba(255, 255, 255, 0.8); border: none; border-radius: 50%; padding: 10px; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2); z-index: 3;">❮</button>
        <button class="next" onclick="moveSlide(1)" style="position: absolute; top: 50%; right: 20px; background: rgba(255, 255, 255, 0.8); border: none; border-radius: 50%; padding: 10px; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.2); z-index: 3;">❯</button>

        <!-- Dots Navigation -->
        <div class="dots-container" style="text-align: center; z-index: 2; margin-top: 1rem;">
            <span class="dot active-dot" onclick="currentSlide(0)" style="height: 12px; width: 12px; margin: 0 4px; background-color: rgb(163, 99, 15); border-radius: 50%; display: inline-block; cursor: pointer;"></span>
            <span class="dot" onclick="currentSlide(1)" style="height: 12px; width: 12px; margin: 0 4px; background-color: #ccc; border-radius: 50%; display: inline-block; cursor: pointer;"></span>
            <span class="dot" onclick="currentSlide(2)" style="height: 12px; width: 12px; margin: 0 4px; background-color: #ccc; border-radius: 50%; display: inline-block; cursor: pointer;"></span>
            <span class="dot" onclick="currentSlide(3)" style="height: 12px; width: 12px; margin: 0 4px; background-color: #ccc; border-radius: 50%; display: inline-block; cursor: pointer;"></span>
            <span class="dot" onclick="currentSlide(4)" style="height: 12px; width: 12px; margin: 0 4px; background-color: #ccc; border-radius: 50%; display: inline-block; cursor: pointer;"></span>
        </div>
    </div>
</section>





<section style="padding: 8rem 2rem; background-color: #f9f6f2;">
    <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center; position: relative;">
        Our Amenities
        <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
    </h2>
    <div style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; padding: 0 2rem;">
        
        <!-- Amenity Cards -->
        <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
            <img src="../images/area.jpg" alt="Fitness Room" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
            <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Fitness Room</h3>
                <p style="color: #666; line-height: 1.6;">Have a good sweat at the Fitness Center, with state-of-the-art equipment to serve our guests.</p>
            </div>
        </div>

        <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
            <img src="../images/area.jpg" alt="Restaurant and Cafe" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
            <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Restaurant & Cafe</h3>
                <p style="color: #666; line-height: 1.6;">Experience exquisite dining in an elegant atmosphere with our diverse culinary offerings.</p>
            </div>
        </div>

        <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
            <img src="../images/area.jpg" alt="Pool and Gardens" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
            <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Pool & Gardens</h3>
                <p style="color: #666; line-height: 1.6;">Unwind in our luxurious pool or explore our meticulously maintained garden paradise.</p>
            </div>
        </div>

        <div class="amenity-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.4s ease;">
            <img src="../images/area.jpg" alt="Conference Areas" style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.6s ease;">
            <div style="padding: 2rem;">
                <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 1rem;">Conference Areas</h3>
                <p style="color: #666; line-height: 1.6;">Professional meeting spaces equipped with modern technology for successful events.</p>
            </div>
        </div>
    </div>

    <style>
        .amenity-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 15px 40px rgba(102, 67, 35, 0.2);
        }
        .amenity-card:hover img {
            transform: scale(1.1);
        }
        .dot.active-dot {
            background-color: rgb(163, 99, 15);
        }
        .dot {
            background-color: #ccc;
            transition: background-color 0.3s;
        }
        .dot:hover {
            background-color: rgb(163, 99, 15);
        }
        @media (max-width: 1200px) {
            div[style*="grid-template-columns"] {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }
        @media (max-width: 768px) {
            div[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</section>

<!-- Ensure that the accompanying script remains as previously provided -->
<script>
   document.addEventListener('DOMContentLoaded', (event) => {
    let currentSlideIndex = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;
    const carouselWrapper = document.querySelector('.carousel-wrapper');

    slides.forEach(slides => {
        slides.style.display = 'none';
    });

    function showSlides(index) {
        slides.forEach(slides => {
            slides.style.display = 'none';
        });
        const offset = -index * 100;
        carouselWrapper.style.transform = `translateX(${offset}%)`;
        slides[index].style.display = 'block';
        updateDots(index);
    }

    function moveSlide(direction) {
        let newIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
        showSlides(newIndex);
        currentSlideIndex = newIndex;
    }

    function updateDots(index) {
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, i) => {
            dot.classList.remove('active-dot');
            dot.style.backgroundColor = '#ccc';
        });
        dots[index].classList.add('active-dot');
        dots[index].style.backgroundColor = 'rgb(163, 99, 15)';
    }

    carouselWrapper.style.display = 'block';
    showSlides(currentSlideIndex);

    document.querySelector('.prev').addEventListener('click',() => moveSlide(-1));
    document.querySelector('.next').addEventListener('click',() => moveSlide(1));
});
</script>

    
            <section style="padding: 5rem 2rem; background-color: #f9f6f2;">
                <h2 style="color: rgb(102, 67, 35); margin-bottom: 4rem; font-size: 2.5rem; font-family: 'impact'; text-align: center;">
                    Contact Us
                    <span style="display: block; width: 80px; height: 3px; background: rgb(163, 99, 15); margin: 1rem auto;"></span>
                </h2>
                <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 2fr; gap: 3rem;">
                    <!-- Contact Info Side -->
                    <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; margin-bottom: 2rem; font-family: 'impact';">Find Us</h3>
                        
                        <!-- Location -->
                        <div style="margin-bottom: 2rem;">
                            <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                <i class="fas fa-map-marker-alt" style="color: rgb(102, 67, 35); font-size: 1.5rem; margin-right: 1rem;"></i>
                                <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Address</h4>
                            </div>
                            <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;">Brgy SapSap, Pastrana Leyte</p>
                        </div>

                        <!-- Phone -->
                        <div style="margin-bottom: 2rem;">
                            <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                <i class="fas fa-phone" style="color: rgb(102, 67, 35); font-size: 1.5rem; margin-right: 1rem;"></i>
                                <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Phone</h4>
                            </div>
                            <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;">+1 234 567 8900</p>
                        </div>

                        <!-- Email -->
                        <div style="margin-bottom: 2rem;">
                            <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                <i class="fas fa-envelope" style="color: rgb(102, 67, 35); font-size: 1.5rem; margin-right: 1rem;"></i>
                                <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Email</h4>
                            </div>
                            <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;">casamarcosresort@gmail.com</p>
                        </div>
                    </div>

                    <!-- Contact Form Side -->
                    <div style="background: white; padding: 3rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <form action="/contact/submit" method="POST" style="display: grid; gap: 1.5rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                <div style="position: relative;">
                                    <i class="fas fa-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                    <input type="text" name="name" placeholder="Your Name" required 
                                        style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                </div>
                                <div style="position: relative;">
                                    <i class="fas fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                    <input type="email" name="email" placeholder="Your Email" required 
                                        style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                </div>
                            </div>
                            <div style="position: relative;">
                                <i class="fas fa-heading" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                <input type="text" name="subject" placeholder="Subject" required 
                                    style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                            </div>
                            <div style="position: relative;">
                                <i class="fas fa-comment" style="position: absolute; left: 1rem; top: 1.2rem; color: #d4b696;"></i>
                                <textarea name="message" placeholder="Your Message" required 
                                    style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; min-height: 150px; resize: vertical; width: 100%;"></textarea>
                            </div>
                            <button type="submit" 
                                style="padding: 1rem 2rem; background: linear-gradient(to right, rgb(102, 67, 35), rgb(163, 99, 15)); 
                                    color: white; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; 
                                    transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 5px 15px rgba(102, 67, 35, 0.3)';"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                                Send Message
                            </button>
                        </form>
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

   

</body>

</html>