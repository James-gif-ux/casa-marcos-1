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
            <a href="#" class="room-image-link" onclick="openModal('<?php echo $room['image']; ?>', '<?php echo $room['name']; ?>', <?php echo $room['price']; ?>)">
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
        <p id="<?php echo $room['name']; ?>"></p>
        <form action="reservation.php" method="POST" id="bookingForm" class="compact-form">
            <input type="hidden" name="roomName" id="<?php echo $room['name']; ?>">
            <input type="hidden" name="roomPrice" id="<?php echo $room['price']; ?>">
            <div class="form-group">
                <input type="date" id="checkIn" name="checkIn" required placeholder="Check-in">
                <input type="date" id="checkOut" name="checkOut" required placeholder="Check-out">
            </div>
            <select id="guests" name="guests" required>
                <option value="1">1 Guest</option>
                <option value="2">2 Guests</option>
                <option value="3">3 Guests</option>
                <option value="4">4 Guests</option>
            </select>
            <button type="submit" class="book-button">Search Bookings</button>
        </form>
    </div>
</div>

</main>

<footer>
    <p>© 2025 Casa Marcos. All rights reserved.</p>
</footer>

<script>

    function openModal(image, name, price) {
        document.getElementById('modalImage').src = image;
        document.getElementById('<?php echo $room['name']; ?>').innerText = name;
        document.getElementById('<?php echo $room['name']; ?>').value = name;
        document.getElementById('<?php echo $room['price']; ?>').value = price;

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
<script src="../assets/js/modal.js"></script>

</body>
</html>