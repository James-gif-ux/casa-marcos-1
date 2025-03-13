<?php
    include_once 'nav/homenav.php';
?>


<style>
.about-section {
    text-align: center;
    padding: 23rem;
    background-image: url('../images/abouts.jpg');
    background-size: cover;
    background-position: center;
    width: 100%;
}

.slider-container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    background: rgba(255, 255, 255, 0);
    backdrop-filter: blur(2px);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.slider {
    display: flex;
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide {
    min-width: 100%;
    padding: 2rem;
    text-align: center;
    background: linear-gradient(45deg, rgba(218, 191, 156, 0.1), rgba(163, 99, 15, 0.1));
}

.slide h2 {
    color: rgb(102, 67, 35);
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    font-family: 'impact';
    margin-bottom: 1.5rem;
}

.slide p {
    color: rgb(240, 240, 240);
    font-size: clamp(1rem, 2vw, 1.5rem);
    line-height: 1.6;
    margin: 0 auto;
    max-width: 600px;
    font-family: 'Georgia', serif;
    padding: 0 1rem;
}

.decorative-line {
    width: 150px;
    height: 3px;
    background: rgb(255, 255, 255);
    margin: 2rem auto;
}

.slider-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgb(102, 67, 35);
    border: none;
    padding: clamp(10px, 2vw, 15px);
    cursor: pointer;
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.prev-button {
    left: 20px;
}

.next-button {
    right: 20px;
}

@media (max-width: 768px) {
    .about-section {
        padding: 5rem 1rem;
    }
    
    .slider-container {
        margin: 0 1rem;
    }
    
    .slide {
        padding: 1rem;
    }
    
    .slider-button {
        padding: 8px 12px;
        font-size: 1rem;
    }
}

.experience-section {
                max-width: 1400px;
                margin: 8rem auto;
                padding: 0 2rem;
            }

            .experience-title {
                color: #2c3e50;
                font-size: clamp(2rem, 5vw, 3.2rem);
                margin-bottom: 4rem;
                text-align: center;
                font-family: 'Playfair Display', serif;
            }

            .experience-title-line {
                display: block;
                width: 120px;
                height: 4px;
                background: linear-gradient(to right, #c8a97e, #e2c9a6);
                margin: 1.5rem auto;
                border-radius: 2px;
            }

            .experience-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 5rem;
                align-items: center;
            }

            .experience-text {
                background: #fff;
                padding: 3rem;
                border-radius: 20px;
                box-shadow: 0 15px 30px rgba(0,0,0,0.05);
            }

            .experience-paragraph {
                color: #34495e;
                font-size: clamp(1rem, 2vw, 1.3rem);
                line-height: 1.8;
                margin-bottom: 2.5rem;
                text-align: justify;
                font-family: 'Roboto', sans-serif;
            }

            .experience-image {
                width: 100%;
                height: 500px;
                object-fit: cover;
                border-radius: 25px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.15);
                transition: transform 0.3s ease;
            }

            @media (max-width: 1024px) {
                .experience-content {
                    gap: 3rem;
                }
                
                .experience-text {
                    padding: 2rem;
                }
            }

            @media (max-width: 768px) {
                .experience-section {
                    margin: 4rem auto;
                }

                .experience-content {
                    grid-template-columns: 1fr;
                }

                .experience-image {
                    height: 400px;
                    order: -1;
                }
            }

            @media (max-width: 480px) {
                .experience-section {
                    padding: 0 1rem;
                }

                .experience-text {
                    padding: 1.5rem;
                }

                .experience-image {
                    height: 300px;
                }
            }

            .team-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 8rem 0;
        position: relative;
        overflow: hidden;
    }

    .decorative-element {
        position: absolute;
        background: radial-gradient(circle, #c8a97e 0%, transparent 70%);
        opacity: 0.1;
    }

    .team-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 4rem;
    }

    .team-member {
        background: white;
        padding: 3.5rem 2rem;
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        transition: all 0.4s ease-in-out;
    }

    .member-image-container {
        position: relative;
        width: 240px;
        height: 240px;
        margin: 0 auto 2.5rem;
    }

    .image-background {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(45deg, #c8a97e, #e2c9a6);
        opacity: 0.2;
        transform: scale(1.1);
    }

    .member-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 8px solid white;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .member-name {
        color: #2c3e50;
        margin-bottom: 1rem;
        text-align: center;
        font-size: 1.8rem;
        font-family: 'Playfair Display', serif;
    }

    .member-role {
        color: #c8a97e;
        margin-bottom: 2rem;
        text-align: center;
        font-size: 1.3rem;
        font-weight: 500;
    }

    .member-bio {
        color: #666;
        text-align: center;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 2rem;
        border-top: 1px solid #eee;
        padding-top: 2rem;
    }

    .social-link {
        color: inherit;
        font-size: 1.8rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
        padding: 12px;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    @media (max-width: 768px) {
        .team-section {
            padding: 4rem 0;
        }

        .team-container {
            padding: 1rem;
        }

        .member-image-container {
            width: 200px;
            height: 200px;
        }

        .member-name {
            font-size: 1.5rem;
        }

        .member-role {
            font-size: 1.1rem;
        }

        .member-bio {
            font-size: 1rem;
        }

        .social-link {
            font-size: 1.5rem;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .team-grid {
            gap: 2rem;
        }

        .member-image-container {
            width: 180px;
            height: 180px;
        }
    }

    .gallery-section {
    max-width: 1400px;
    margin: 8rem auto;
    padding: 2rem;
}

.gallery-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    grid-auto-flow: dense;
}

.gallery-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    aspect-ratio: 1;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.gallery-item.large {
    grid-column: span 2;
    grid-row: span 2;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.gallery-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    padding: 2rem;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}

.gallery-overlay h3 {
    color: white;
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    font-family: 'Playfair Display', serif;
}

.gallery-overlay p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-item:hover .gallery-overlay {
    transform: translateY(0);
}

@media (max-width: 768px) {
    .gallery-item.large {
        grid-column: span 1;
        grid-row: span 1;
    }
    
    .gallery-masonry {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}
</style>
<link rel="stylesheet" href="../assets/css/about.css">
<section class="about-section">
    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <h2>Casa Marcos Resort and villas</h2>
                <p>Discover luxury and comfort at Casa Marcos, where every stay becomes an unforgettable experience.</p>
                <div class="decorative-line"></div>
            </div>
            <div class="slide">
                <h2>Our Commitment</h2>
                <p>We provide exceptional service and amenities, ensuring your stay is comfortable and relaxing.</p>
                <div class="decorative-line"></div>
            </div>
            <div class="slide">
                <h2>Your Home Away From Home</h2>
                <p>Experience the perfect blend of modern luxury and Filipino hospitality at Casa Marcos.</p>
                <div class="decorative-line"></div>
            </div>
        </div>
        <button onclick="prevSlide()" class="slider-button prev-button">←</button>
        <button onclick="nextSlide()" class="slider-button next-button">→</button>
    </div>
</section>   

        <!-- Experience Section -->
        <div class="experience-section">
            <h2 class="experience-title">
                Experience and Care
                <span class="experience-title-line"></span>
            </h2>
            <div class="experience-content">
                <div class="experience-text">
                    <p class="experience-paragraph">
                        At Casa Marcos, we believe in creating extraordinary experiences through exceptional care and attention to detail. 
                        Our dedicated team works tirelessly to ensure every guest feels welcomed and valued, combining professional 
                        service with genuine Filipino warmth.
                    </p>
                    <p class="experience-paragraph" style="margin-bottom: 0;">
                        We pride ourselves on understanding and anticipating our guests' needs, offering personalized services that 
                        make every stay memorable. Our commitment to excellence extends beyond luxury amenities to create meaningful 
                        connections and experiences that will last a lifetime.
                    </p>
                </div>
                <img src="../images/villas.jpg" 
                     alt="Experience" 
                     class="experience-image"
                     onmouseover="this.style.transform='scale(1.02)'" 
                     onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>

        <!-- Team Section -->
        <div class="team-section">
    <div class="decorative-element" style="width: 300px; height: 300px; top: -150px; left: -150px;"></div>
    <div class="decorative-element" style="width: 200px; height: 200px; bottom: -100px; right: -100px;"></div>
    
    <div class="team-container">
        <div class="team-grid">
            <!-- Team Member 1 -->
            <div class="team-member" onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)'">
                <div class="member-image-container">
                    <div class="image-background"></div>
                    <img src="../images/owner.jpg" alt="Staff Member" class="member-image">
                </div>
                <h3 class="member-name">Maritess Cayaco Marcos</h3>
                <p class="member-role">Owner</p>
                <p class="member-bio">Leading the vision and strategic direction of Casa Marcos, ensuring excellence in hospitality and guest experiences.</p>
                <div class="social-links">
                    <a href="#" class="social-link" style="color: #1DA1F2" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" style="color: #4267B2" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link" style="color: #E1306C" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="team-member" onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)'">
                <div class="member-image-container">
                    <div class="image-background"></div>
                    <img src="../images/manager.jpg" alt="Staff Member" class="member-image">
                </div>
                <h3 class="member-name">Nicole Marie Marcos</h3>
                <p class="member-role">Manager</p>
                <p class="member-bio">Overseeing daily operations and ensuring exceptional service standards across all departments.</p>
                <div class="social-links">
                    <a href="#" class="social-link" style="color: #1DA1F2" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" style="color: #4267B2" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link" style="color: #E1306C" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="team-member" onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 30px 60px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.1)'">
                <div class="member-image-container">
                    <div class="image-background"></div>
                    <img src="../images/cashier.jpg" alt="Staff Member" class="member-image">
                </div>
                <h3 class="member-name">Myca Jacinto</h3>
                <p class="member-role">Front Office</p>
                <p class="member-bio">Providing warm welcomes and professional assistance to guests while managing front desk operations.</p>
                <div class="social-links">
                    <a href="#" class="social-link" style="color: #1DA1F2" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" style="color: #4267B2" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-link" style="color: #E1306C" onmouseover="this.style.transform='scale(1.2) rotate(10deg)'" onmouseout="this.style.transform='scale(1) rotate(0)'"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Gallery Section -->
        <div class="gallery-section">
    <div class="gallery-masonry">
        <div class="gallery-item large">
            <img src="../images/villas.jpg" 
                 alt="Resort Villa View" 
                 class="gallery-image"
                 loading="lazy">
            <div class="gallery-overlay">
                <h3>Luxury Villas</h3>
                <p>Experience ultimate comfort in our premium villas</p>
            </div>
        </div>
        <div class="gallery-item">
            <img src="../images/roomtab.jpg" 
                 alt="Room Interior" 
                 class="gallery-image"
                 loading="lazy">
            <div class="gallery-overlay">
                <h3>Elegant Rooms</h3>
                <p>Modern amenities meet classic design</p>
            </div>
        </div>
        <div class="gallery-item">
            <img src="../images/history.jpg" 
                 alt="Resort History" 
                 class="gallery-image"
                 loading="lazy">
            <div class="gallery-overlay">
                <h3>Our Heritage</h3>
                <p>A legacy of excellence since establishment</p>
            </div>
        </div>
        <div class="gallery-item">
            <img src="../images/abouts.jpg" 
                 alt="Resort Amenities" 
                 class="gallery-image"
                 loading="lazy">
            <div class="gallery-overlay">
                <h3>Premium Amenities</h3>
                <p>World-class facilities for your comfort</p>
            </div>
        </div>
        <div class="gallery-item">
            <img src="../images/abouts.jpg" 
                 alt="Resort Amenities" 
                 class="gallery-image"
                 loading="lazy">
            <div class="gallery-overlay">
                <h3>Premium Amenities</h3>
                <p>World-class facilities for your comfort</p>
            </div>
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