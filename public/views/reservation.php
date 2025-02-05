<?php

include_once 'nav/homenav.php';
require_once '../model/connector.php';
require_once '../model/roomModel.php';
require_once '../model/Booking_Model.php';

$connector = new Connector();
$conn = $connector->getConnection();
$roomModel = new RoomModel($conn);
$rooms = $roomModel->get_Rooms();

if (empty($rooms)) {
    $rooms = [];
}

$bookingModel = new Booking_Model();

// Get all services
$rooms = $bookingModel->get_room();

// Include the Connector class
require_once '../model/connector.php';
$connector = new Connector();

// Fetch all bookings that are pending approval
$sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_date FROM booking_tb WHERE booking_status = 'pending'";
$bookings = $connector->executeQuery($sql);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data with validation and sanitization
    $fullname = !empty($_POST['fullname']) ? trim(strip_tags($_POST['fullname'])) : null;
    $email = !empty($_POST['email']) ? trim(strip_tags($_POST['email'])) : null;
    $number = !empty($_POST['number']) ? trim(strip_tags($_POST['number'])) : null;
    $room_id = !empty($_POST['room_id']) ? intval($_POST['room_id']) : null; // Ensure it is an integer
    $date = !empty($_POST['date']) ? trim(strip_tags($_POST['date'])) : null;


    // Attempt to insert the booking. Ensure that insert_booking handles the room ID validation.
    $result = $bookingModel->insert_booking($fullname, $email, $number, $date, $room_id);

    if ($result === true) {
        echo "Booking successfully added!";
    } else {
        echo $result;  // Display error message if any
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    
    <style>
      
        .container {
            max-width: 1200px;
            margin: 0;
        }
        
        .room-picture { 
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
       
        .bg-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(134, 6, 6, 0.05);
            border: 1px solid rgba(220, 220, 220, 0.3);
            padding: 2.5rem;
            margin: 1.5rem 0;
        }
        .text-muted-foreground {
            color: #4a4a4a;
            line-height: 1.8;
            font-family: 'Lato', sans-serif;
        }
        .room-price {
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.6rem;
        }
        .btn-primary {
            background: rgb(102, 67, 35);
            border: none;
            padding: 14px 28px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .btn-primary:hover {
            background: rgb(218, 191, 156);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(70, 168, 5, 0.2);
        }
        .form-control, .form-select {
            border-radius: 4px;
            padding: 12px;
            border: 1px solid #dee2e6;
            background: #ffffff;
            transition: all 0.3s ease;
            font-family: 'Lato', sans-serif;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 2px rgba(112, 30, 219, 0.1);
            border-color: #2c3e50;
        }
        label {
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 10px;
            font-family: 'Lato', sans-serif;
        }
        .booking-summary {
            font-size: 1.1rem;
            color: #2c3e50;
            line-height: 1.8;
        }
        .list-disc {
            padding-left: 1.5rem;
            color: #2c3e50;
        }
        .list-disc li {
            margin: 12px 0;
            padding-left: 10px;
            font-family: 'Lato', sans-serif;
        }
        .modal-content {
            border-radius: 8px;
            border: none;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        }
        .modal-header {
            background: rgb(102, 67, 35);
            color: white;
            border-radius: 8px 8px 0 0;
            padding: 1.5rem;
        }
        .modal-title {
            font-weight: 500;
            
        }
        .section-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 1.8rem;
            font-size: 2.2rem;
            font-family: 'Playfair Display', serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Lato:wght@300;400;500&display=swap');
    </style>
</head>
<body>
    <div class="container mx-auto p-4">
            <div class="row mt-4">
                <div class="container mx-auto p-4" style="margin-top: 120px;">
                    <div class="row mt-4">
                        <!-- Left Column: Room Image -->
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="room-select" style="font-family: Impact;">Select Room</label>
                                <select id="room-select" class="form-select " style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease; " required>
                                    <?php foreach ($rooms as $index => $room): ?>
                                        <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($room['room_name']); ?> - ₱<?php echo htmlspecialchars($room['price']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="mt-3">
                                    <img id="room-image" src="" class="room-picture w-100" alt="Room Image">
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Booking Form -->
                        <div class="col-lg-6">
                            <form id="bookingForm">
                                <div class="mb-4">
                                    <label class="form-label" for="check-out" style="font-family: Impact;">Check-in: </label>
                                    <input type="date" id="check-in"  style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease; "required placeholder="Check-in"/>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="check-out" style="font-family: Impact;">Check-out: </label>
                                    <input type="date" id="check-out"  style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required placeholder="Check-out" />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="guests" style="font-family: Impact;" >Guests </label>
                                    <select id="guests" class="form-select " style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mt-4 d-flex align-items-center">
                                    <input type="number" min="1" max="15" id="num-accommodations" value="1" class="form-control me-2 w-25" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                                    <span class="mx-2">of 15 accommodations available.</span>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Book</button>
                                </div>
                            </form>
                            <!-- The confirmation modal -->
                            <div class="modal fade" id="confirmationModal<?php echo htmlspecialchars($room['room_id']); ?>" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <form action="../pages/submit-booking.php" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel<?php echo htmlspecialchars($room['room_id']); ?>" style="font-family: Impact;">Confirm Your Booking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label"  style="font-family: Impact;">Name </label>
                                                <input type="text"  value="<?php echo htmlspecialchars($room['room_id']); ?>" name="Fullname" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"  style="font-family: Impact;">Email </label>
                                                <input type="email"  name="Email" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"  style="font-family: Impact;">Phone Number </label>
                                                <input type="tel"  name="PhoneNumber" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"  style="font-family: Impact;">Date</label>
                                                <input type="date"  name="Date" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                                            </div>
                                        
                                       
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" id="confirm-booking">Confirm Booking</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <!-- Room Details Section -->
        <div class="row">
           <!-- Room Details Section -->
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <div class="bg-card p-4 mt-4" style="border: 2px solid #d4b696; border-radius: 8px;">
                            <h2 class="text-xl font-bold text-foreground" style="font-family: Impact;">Description:</h2>
                            <p class="mt-2 text-muted-foreground booking-summary" style="padding: 0.8rem; margin: 0.5rem 0; font-size: 1rem;">
                                <span id="room-description" class="font-semibold"><?php echo htmlspecialchars($room['description']); ?></span> 
                            </p>
                            <div class="mt-6">
                                <p class="font-semibold text-center" style="font-family: Impact;">
                                    Prices start at: <br> 
                                    <span id="room-sales" class="text-lg room-price" style="transition: all 0.3s ease;">₱ <?php echo htmlspecialchars($room['price']); ?></span> 
                                    per night
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--footer srart here--->
    <footer>
        <p>© 2025 Casa Marcos. All rights reserved.</p>
    </footer>
    <!--footer end here--->

    <!--script for header srart here--->
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
    <!----script for header--->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--script for rooms start here-->
    <script>
        // Assuming 'rooms' array is accessible here as a JSON object
        const rooms = <?php echo json_encode($rooms); ?>;

        document.getElementById('room-select').addEventListener('change', function () {
            const selectedIndex = this.value;
            const selectedRoom = rooms[selectedIndex];

            // Update room details
            document.getElementById('room-image').src = selectedRoom.image || 'default_room_image.jpg'; //provide a default image
            document.getElementById('room-description').innerText = selectedRoom.description || 'This luxurious room offers a comfortable stay with modern amenities.';
            document.getElementById('room-name').innerText = selectedRoom.name;
            document.getElementById('room-summary').innerText = `Superior Room from ₱${selectedRoom.price}`;
        });
        document.getElementById('room-select').addEventListener('change', function () {
            const selectedIndex = this.value;
            const selectedRoom = rooms[selectedIndex];
            document.getElementById('room-price').innerText = `₱${selectedRoom.price}`;
            document.getElementById('room-na').innerText = selectedRoom.room_name; // Update room name here
        });
        document.getElementById('room-select').addEventListener('change', function () {
            const selectedIndex = this.value;
            const selectedRoom = rooms[selectedIndex];
            document.getElementById('room-sales').innerText = `₱${selectedRoom.price}`;
        });


        // Trigger the change event on page load to show the first room's details
        document.getElementById('room-select').dispatchEvent(new Event('change'));
       

        
    </script>
    <!--script for rooms end here-->

    <!--script for modal start here-->
    <script>
    function showModal() {
        const checkInDate = document.getElementById('check-in').value;
        const checkOutDate = document.getElementById('check-out').value;
        const guestsCount = document.getElementById('guests').value;
        const accommodationsCount = document.getElementById('num-accommodations').value;

        // Set values in the modal
        document.getElementById('confirm-check-in').innerText = checkInDate;
        document.getElementById('confirm-check-out').innerText = checkOutDate;
        document.getElementById('confirm-guests').innerText = guestsCount;
        document.getElementById('confirm-rooms').innerText = accommodationsCount;
    }

    // Event handler for the Book button
    document.getElementById('check-out').addEventListener('click', showModal);
    const bookButton = document.querySelector('.btn.btn-primary');
    bookButton.addEventListener('click', showModal);

    document.getElementById('confirm-booking').addEventListener('click', function() {
        // Perform booking confirmation logic here
        alert("Your booking has been confirmed!");

        // Optionally, hide the modal after confirmation
        $('#confirmationModal').modal('hide');
    });

    // Event handler for the booking form
    const bookingForm = document.getElementById('bookingForm');

    bookingForm.addEventListener('submit', function(event) {
        // Prevent actual form submission for debugging
        event.preventDefault();

        // Create a FormData object from the form
        const formData = new FormData(bookingForm);
        console.log('Form Data:', Object.fromEntries(formData));

        // Store input values
        const checkInDate = formData.get('check-in');
        const checkOutDate = formData.get('check-out');
        const guestsCount = formData.get('guests');
        const accommodationsCount = formData.get('num-accommodations');

        // Show the modal with the input values
        $('#confirmationModal').modal('show');

        // Set input values in the modal
        document.getElementById('confirm-check-in').innerText = checkInDate; // Update modal text
        document.getElementById('confirm-check-out').innerText = checkOutDate; // Update modal text
        document.getElementById('confirm-guests').innerText = guestsCount; // Update modal text
        document.getElementById('num-accommodations').innerText = accommodationsCount; // Update modal text
    });

</script>
    <!--script for modal end here-->

    <!--script for price calculation start here-->
    <script>
        // Add to the existing script section
        function calculateTotalPrice() {
            const pricePerNight = <?php echo $room_price; ?>;
            const checkIn = new Date(document.getElementById('check-in').value);
            const checkOut = new Date(document.getElementById('check-out').value);
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const numRooms = document.getElementById('num-accommodations').value;
            
            return pricePerNight * nights * numRooms;
        }

        // Update the price display when dates or rooms change
        document.getElementById('check-in').addEventListener('change', updatePrice);
        document.getElementById('check-out').addEventListener('change', updatePrice);
        document.getElementById('num-accommodations').addEventListener('change', updatePrice);

        function updatePrice() {
            const totalPrice = calculateTotalPrice();
            document.getElementById('confirm-price').innerText = `₱ ${totalPrice}`;
        }

    </script>
    <!--script for price calculation end here-->
</body>
</html>

