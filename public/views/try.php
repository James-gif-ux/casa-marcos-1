<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8.0.7/swiper-bundle.min.css" />
    <style>
      body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        margin: 0;
        padding: 20px;
        min-height: 100vh;
      }

      .swiper-container {
        width: 100%;
        height: 650px;
        padding: 60px 0;
      }

      .swiper-slide {
        width: 320px;
        height: 420px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        border: 1px solid rgba(255, 255, 255, 0.18);
      }

      .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
      }

      .swiper-slide-active {
        transform: scale(1.2);
        width: 480px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      }

      .swiper-slide-active img {
        transform: scale(1.1);
      }

      .description {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        color: black;
        padding: 35px 25px 25px;
        opacity: 0;
        text-align: center;
        font-family: impact;
        font-size: 15px;
        line-height: 1.7;
        letter-spacing: 0.4px;
        backdrop-filter: blur(8px);
      }

      .swiper-slide:hover .description {
        opacity: 1;
        transform: translateY(0);
      }

      .swiper-button-next,
      .swiper-button-prev {
        color: #ffffff;
        background: rgba(0, 0, 0, 0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: all 0.3s ease;
      }

      .swiper-button-next:hover,
      .swiper-button-prev:hover {
        background: rgba(0, 0, 0, 0.8);
        transform: scale(1.1);
      }

      .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid transparent;
        transition: all 0.3s ease;
      }

      .swiper-pagination-bullet-active {
        background:rgb(0, 0, 0);
        transform: scale(1.2);
        border: 2px solid #fff;
      }
    </style>
</head>
<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="Nature" />
            <span class="description">Image 1: Beautiful Nature Scene - A stunning landscape showcasing Earth's natural beauty with rolling hills and vibrant colors.</span>
        </div>
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="City" />
            <span class="description">Image 2: Urban City Life - A modern cityscape featuring towering skyscrapers, bustling streets, and architectural marvels.</span>
        </div>
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="Beach" />
            <span class="description">Image 3: Tropical Beach Paradise - Crystal clear waters meeting white sandy shores, with palm trees swaying in the ocean breeze.</span>
        </div>
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="Mountain" />
            <span class="description">Image 4: Majestic Mountains - Snow-capped peaks reaching into the clouds, offering breathtaking views of rugged terrain.</span>
        </div>
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="Forest" />
            <span class="description">Image 5: Dense Forest - Ancient woodland filled with towering trees, rich biodiversity, and mysterious shadows.</span>
        </div>
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="Forest" />
            <span class="description">Image 5: Dense Forest - Ancient woodland filled with towering trees, rich biodiversity, and mysterious shadows.</span>
        </div>
        <div class="swiper-slide">
            <img src="../images/room.jpg" alt="Forest" />
            <span class="description">Image 5: Dense Forest - Ancient woodland filled with towering trees, rich biodiversity, and mysterious shadows.</span>
        </div>
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<script src="https://unpkg.com/swiper@8.0.7/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        loop: true,
    });
</script>
</body>
</html>