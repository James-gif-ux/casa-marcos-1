

// Get modal elements
const imageModal = document.getElementById('imageModal');
const modalImg = document.getElementById('modalImage');
/**
 * Selects the close button element for the image modal.
 */
const closeBtn = document.querySelector('.image-modal-close');

// Set minimum date to today for check-in and check-out
const today = new Date().toISOString().split('T')[0];
document.getElementById('checkIn').min = today;
document.getElementById('checkOut').min = today;

// Add click event to all room images
document.querySelectorAll('.room-image-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const roomCard = this.closest('.grid-item');
        modalImg.src = this.querySelector('img').src;
        imageModal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });
});

// Close modal when clicking X button
closeBtn.onclick = function() {
    imageModal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.onclick = function(e) {
    if (e.target == imageModal) {
        imageModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

// Handle booking form submission
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const checkIn = document.getElementById('checkIn').value;
    const checkOut = document.getElementById('checkOut').value;
    const guests = document.getElementById('guests').value;
    
    // Add your booking logic here
    console.log('Booking details:', { checkIn, checkOut, guests });
    alert('Booking successful!');
    imageModal.style.display = 'none';
    document.body.style.overflow = 'auto';
});
