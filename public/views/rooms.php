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

    <link rel="stylesheet" href="../assets/css/rooms.css">
   <!-- Rooms Section -->

   <div class="grid-container">
    <?php foreach ($rooms as $room): ?>
        <div class="grid-item">
            <a href="#" class="room-image-link view-room" data-id="<?php echo $room['id']; ?>" data-name="<?php echo $room['name']; ?>" data-price="<?php echo $room['price']; ?>" data-image="<?php echo $room['image']; ?>">
                <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['name']; ?>" class="room-image">
            </a>
            <p><?php echo $room['name']; ?></p>
            <div class="room-price">$<?php echo $room['price']; ?>/night</div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modal -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <a href="#" class="btn btn-secondary" onclick="closeModal()" style="position: absolute; top: 20px; right: 20px; padding: 8px 15px; border-radius: 8px; background: rgb(102, 67, 35); color: white; text-decoration: none; font-weight: 600;">&times;</a>
        <img class="modal-image-content" id="modalImage" src="" alt="Room Image">
        <p id="modalRoomName"></p>
        <form action="reservation.php" method="POST" id="bookingForm" class="compact-form">
            <input type="hidden" name="roomName" id="selectedRoomName">
            <input type="hidden" name="roomPrice" id="selectedRoomPrice">
            <div class="form-group">
                <input type="date" id="checkIn" name="checkIn" required placeholder="Check-in">
                <input type="date" id="checkOut" name="checkOut" required placeholder="Check-out">
            </div>
        </div>
        <div class="dots">
            <div class="dot active" onclick="goToSlide(0)"></div>
            <div class="dot" onclick="goToSlide(1)"></div>
            <div class="dot" onclick="goToSlide(2)"></div>
            <div class="dot" onclick="goToSlide(3)"></div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>

<script>
    function openModal(image, name, price) {
        document.getElementById('modalImage').src = image;
        document.getElementById('modalRoomName').innerText = name;
        document.getElementById('selectedRoomName').value = name;
        document.getElementById('selectedRoomPrice').value = price;

        const modal = document.getElementById('imageModal');
        modal.style.display = 'block';
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
    }

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
    });

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
    });
    </script>
</body>
</html>