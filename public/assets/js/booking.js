
document.addEventListener('DOMContentLoaded', function() {
    // Function to clear URL parameters
    function clearUrlParams() {
        const url = window.location.href.split('?')[0];
        window.history.replaceState({}, document.title, url);
    }

    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const tbody = document.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    // Modal functionality
    const modal = document.getElementById('messageModal');
    const span = document.getElementsByClassName('close')[0];
    const bookingIdInput = document.getElementById('booking_id');
    const recipientEmailInput = document.getElementById('recipient_email');
    function openModal(messageId, email) {
        modal.style.display = 'block';
        bookingIdInput.value = messageId;
        recipientEmailInput.value = email;
    }
    // Close modal when clicking (X)
    span.onclick = function() {
        modal.style.display = 'none';
    }
    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    // Modal functionality inquiries
    window.openModal = function(messageId, email) {
        modal.style.display = 'block';
        bookingIdInput.value = messageId;
        recipientEmailInput.value = email;
    }
    if (span) {
        span.onclick = function() {
            modal.style.display = 'none';
        }
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    // Form submission
    const emailForm = document.getElementById('emailForm');
    if (emailForm) {
        emailForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                
                const response = await fetch('../../send_mail.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                
                if (data.success) {
                    alert(data.message);
                    modal.style.display = 'none';
                    this.reset(); // Clear form
                } else {
                    throw new Error(data.message);
                }

            } catch (error) {
                alert(error.message);
                console.error('Error:', error);
            }
        });
    }
});