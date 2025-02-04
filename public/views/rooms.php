<?php
    include_once 'nav/homenav.php';
    require_once '../model/connector.php';
    require_once '../model/roomModel.php';
    
    $connector = new Connector();
    $roomModel = new RoomModel($connector->getConnection());
    $rooms = $roomModel->getAllRooms();
if (empty($rooms)) {
    $rooms = [];
}
 
?>


<style>
 

    .slider {
        position: relative;
        width: 900px; /* Increased width */
        height: 500px; /* Increased height */
        overflow: hidden;
        margin: auto;
        border: 2px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .slides {
        display: flex;
        transition: transform 0.8s ease-in-out; /* Smooth transition */
        width: 400%;
        height: 100%;
    }

    .slide {
        min-width: 25%;
        position: relative; /* Required for absolute positioning of the info box */
        transition: all 0.8s ease;
    }

    .slide img {
        width: 100%;
        height: 100%;
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .prev, .next {
        position: absolute;
        bottom: 30px; /* Position below the slider */
        background-color: rgba(255, 255, 255, 0.9);
        border: 2px solid #4CAF50; 
        padding: 10px;
        cursor: pointer;
        font-size: 28px;
        color: #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
        border-radius: 5px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .prev {
        left: 35%;
        bottom: 20px; /* Closer to the bottom */
    }

    .next {
        right: 35%;
        bottom: 20px; /* Closer to the bottom */
    }

    .prev:hover, .next:hover {
        background-color: rgba(255, 255, 255, 1);
        transform: scale(1.05);
    }

    .dots {
        position: absolute;
        bottom: 40px; /* Position above buttons */
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 5px;
    }

    .dot {
        height: 15px;
        width: 15px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .dot.active {
        background-color: #4CAF50; /* Active dot color */
    }

    .slide-info {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        background: linear-gradient(to right, #4CAF50, #45a049);
        color: white;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        text-align: left;
        opacity: 0; /* Hide by default */
        transition: all 0.4s ease;
        pointer-events: none; /* Prevents flickering when moving mouse */
    }

    .slide-info h3 {
        margin: 0 0 10px 0;
        font-size: 24px;
        color: #fff;
        border-bottom: 2px solid rgba(255,255,255,0.3);
        padding-bottom: 8px;
    }

    .slide-info p {
        margin: 5px 0;
        font-size: 16px;
        line-height: 1.4;
    }

    .slide-info .price {
        font-size: 20px;
        font-weight: bold;
        color: #ffeb3b;
        margin-top: 10px;
    }

    .slide:hover .slide-info {
        opacity: 1; /* Show on hover */
        transform: translateX(-50%) translateY(-10px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
</style>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section >
    <div class="slider" >
        <div id="roomSlider" class="carousel slide" data-ride="carousel" >
            <div class="carousel-inner">
                <?php foreach ($rooms as $index => $room): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo $room['image']; ?>" >
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $room['name']; ?></h5>
                            <p><?php echo $room['description']; ?></p>
                            <p class="price">$/night</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#roomSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#roomSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        function showSlide(index) {
            const slidesContainer = document.querySelector('.slides');
            slidesContainer.style.transform = `translateX(-${index * 25}%)`;
            dots.forEach((dot, i) => {
                dot.classList.remove('active');
            });
            dots[index].classList.add('active');
        }
            
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            currentSlide = index;
            showSlide(currentSlide);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);
    </script>
<!-- footer -->
    <footer>
        <p>© 2025 Casa Marcos. All rights reserved.</p>
    </footer>
<!-- script for header start -->
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
    <!-- script for header end -->
