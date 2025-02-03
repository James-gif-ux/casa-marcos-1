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
        <span class="close" style="cursor:pointer;">&times;</span>
        <img class="modal-image-content" id="modalImage" src="" alt="">
        <h2 id="modalRoomName"></h2>
        <div id="modalRoomPrice"></div>
        
        <form action="reservation.php" method="post" id="bookingForm" class="compact-form">
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
            <input type="hidden" id="roomId" name="roomId">
            <input type="hidden" id="roomPrice" name="roomPrice">
            <button type="submit" class="book-button">Search Bookings</button>
        </form>
    </div>
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

<script>
    // Get all room image links
    const roomLinks = document.querySelectorAll('.view-room');
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeButton = document.querySelector('.close');
    const modalRoomName = document.getElementById('modalRoomName');
    const modalRoomPrice = document.getElementById('modalRoomPrice');

    roomLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();

            const roomId = link.getAttribute('data-id');
            const roomName = link.getAttribute('data-name');
            const roomPrice = link.getAttribute('data-price');
            const roomImage = link.getAttribute('data-image');

            // Set modal image and room details
            modalImage.src = roomImage;
            modalRoomName.textContent = roomName;
            modalRoomPrice.textContent = `Price: $${roomPrice} per night`;

            // Set the room ID and price in the form
            document.getElementById('roomId').value = roomId;
            document.getElementById('roomPrice').value = roomPrice;

            // Display the modal
            modal.style.display = "block";
        });
    });

    // Close the modal when the close button is clicked
    closeButton.addEventListener('click', () => {
        modal.style.display = "none";
    });

    // Close the modal if the user clicks outside of the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>

<script src="../assets/js/modal.js"></script>

</body>

</html>