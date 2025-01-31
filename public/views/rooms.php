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
?>
    <link rel="stylesheet" href="../assets/css/rooms.css">
   <!-- Rooms Section -->

    <div class="grid-container">
       <?php foreach ($rooms as $room): ?>
            <div class="grid-item">
                <a href="#" class="room-image-link">
                    <img src="<?php echo $room['image']; ?>" alt="<?php echo $room['name']; ?>" class="room-image">
                </a>
                <p><?php echo $room['name']; ?></p>
                <div class="room-price">$<?php echo $room['price']; ?>/night</div>
            </div>
            <div id="imageModal" class="modal">
                <div class="modal-content">
                    <a href="rooms.php" class="btn btn-secondary" style="position: absolute; top: 20px; right: 20px; padding: 8px 15px; border-radius: 8px; background: rgb(102, 67, 35); color: white; text-decoration: none; font-weight: 600;">&times;</a>
                    <img class="modal-image-content" id="modalImage">
                    <form action="reservation.php" method="$_POST" id="bookingForm" class="compact-form">
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
        <?php endforeach; ?>
    </div>

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
<script src="../assets/js/modal.js"></script>

</body>

</html>