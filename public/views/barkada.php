<?php
    include_once 'nav/homenav.php';
?>

<div class="hero-section" style="position: relative;">
    <img src="../images/barkada.jpg" alt="Barkada Room" style="width: 100%; height: 600px; object-fit: cover;">
    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); padding: 4rem 2rem 2rem;">
        <h1 style="margin-bottom: 10px; color: white; font-size: 3.5rem; font-family: 'impact'; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            Holiday Treat Superior Room
        </h1>
    </div>
</div>

<div style="max-width: 1500px; margin: 0 auto; padding: 4rem 2rem;  margin-top: -50px; position: relative;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="color: rgb(102, 67, 35); font-size: 2.5rem; font-family: 'impact'; margin: 0;">
                Superior Room Experience
            </h2>
            <p style="font-size: 1.8rem; color: #666; margin: 0;">from <span style="color: rgb(102, 67, 35); font-size: 2.5rem; font-weight: bold;">₱3,988</span></p>
        </div>
        <p style="color: #666; font-size: 1.2rem; margin: 1rem 0 0; text-align: left;">
            Inclusive of Lunch OR Dinner Buffet for 2 at the Gusto Restaurant
        </p>
    </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 3rem;">
        <div style="text-align: center; padding: 2rem; background: #f9f6f2; border-radius: 15px;">
            <i class="fas fa-ruler-combined" style="font-size: 2rem; color: rgb(102, 67, 35); margin-bottom: 1rem;"></i>
            <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 0.5rem;">Size</h3>
            <p style="color: #666;">21 M²</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: #f9f6f2; border-radius: 15px;">
            <i class="fas fa-bed" style="font-size: 2rem; color: rgb(102, 67, 35); margin-bottom: 1rem;"></i>
            <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 0.5rem;">Bed</h3>
            <p style="color: #666;">Twin Beds</p>
        </div>
        <div style="text-align: center; padding: 2rem; background: #f9f6f2; border-radius: 15px;">
            <i class="fas fa-users" style="font-size: 2rem; color: rgb(102, 67, 35); margin-bottom: 1rem;"></i>
            <h3 style="color: rgb(102, 67, 35); font-size: 1.5rem; font-family: 'impact'; margin-bottom: 0.5rem;">Capacity</h3>
            <p style="color: #666;">2 Adults 1 Child</p>
        </div>
    </div>

   

    <div style="background: #f9f6f2; padding: 2rem; border-radius: 15px;">
        <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; font-family: 'impact'; margin-bottom: 1.5rem;">Room Features</h3>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fas fa-check-circle" style="color: rgb(102, 67, 35);"></i>
                <span style="color: #666;">Choice of Twin or King Bed</span>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fas fa-check-circle" style="color: rgb(102, 67, 35);"></i>
                <span style="color: #666;">Wifi in Rooms</span>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fas fa-check-circle" style="color: rgb(102, 67, 35);"></i>
                <span style="color: #666;">Writing Desk</span>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fas fa-check-circle" style="color: rgb(102, 67, 35);"></i>
                <span style="color: #666;">Room Service</span>
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <i class="fas fa-check-circle" style="color: rgb(102, 67, 35);"></i>
                <span style="color: #666;">Breakfast Included</span>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>© 2025 Casa Marcos. All rights reserved.</p>
</footer>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
        h1[style*="font-size: 3.5rem"] {
            font-size: 2.5rem !important;
        }
        div[style*="margin-top: -50px"] {
            margin-top: -30px;
            margin-left: 1rem;
            margin-right: 1rem;
        }
    }
</style>

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