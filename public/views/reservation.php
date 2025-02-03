<?php
require_once '../model/connector.php';
require_once '../model/roomModel.php';
$connector = new Connector();
$roomModel = new RoomModel($connector->getConnection());
$rooms = $roomModel->get_Rooms();

if (empty($rooms)) {
    $rooms = [];
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
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Playfair Display', serif;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
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
       
                <div class="container mx-auto p-4">
                    
                    <div class="row mt-4">
                        <!-- Left Column: Room Image -->
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label" for="room-select">Select Room *</label>
                                <select id="room-select" class="form-select " style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease; " required>
                                    <?php foreach ($rooms as $index => $room): ?>
                                        <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($room['name']); ?> - ₱<?php echo htmlspecialchars($room['price']); ?></option>
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
                                    <label class="form-label" for="check-in" style="font-family: Impact;" >Check-in </label>
                                    <input type="date" id="check-in" class="form-control " style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease; " required />
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="check-out" style="font-family: Impact;">Check-out </label>
                                    <input type="date" id="check-out" class="form-control " style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
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
                        </div>
                    </div>
                </div>
            </div>

        <!-- Room Details Section -->
        <div class="row">
            <div class="col-12 ">
                <div class="bg-card p-4 mt-4">
                    <h2 class="text-xl font-bold text-foreground">Description:</h2>
                    <p class="mt-2 text-muted-foreground booking-summary">
                        <span class="font-semibold"></span> <?php echo htmlspecialchars($room['description']); ?>
                    </p>
                    <div class="mt-6">
                    <p class="font-semibold">Prices start at: <span class="text-lg room-price">₱ <?php echo htmlspecialchars($room['price']); ?></span> per night</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel" style="font-family: Impact;" >Confirm Your Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="customer-name" style="font-family: Impact;">Name </label>
                        <input type="text" id="customer-name" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="customer-email" style="font-family: Impact;">Email </label>
                        <input type="email" id="customer-email" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="customer-phone" style="font-family: Impact;">Phone Number </label>
                        <input type="tel" id="customer-phone" class="form-control" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required />
                    </div>
                    <ul class="list-unstyled mt-3">
                        <li><strong>Check-in:</strong> <span id="confirm-check-in"></span></li>
                        <li><strong>Check-out:</strong> <span id="confirm-check-out"></span></li>
                        <li><strong>Guests:</strong> <span id="confirm-guests"></span></li>
                        <li><strong>Rooms:</strong> <span id="confirm-rooms"></span></li>
                    </ul>
                    <p class="font-semibold room-price">Total Price: <span id="confirm-price">₱ 2,988</span> per night</p>
                    <div class="mt-4">
                        <h5 class="text-xl">Payment Method</h5>
                        <div class="mb-3">
                            <label class="form-label" for="payment-method">Select Payment Method *</label>
                            <select id="payment-method" class="form-select" style="width: 100%; padding: 0.8rem; margin: 0.5rem 0; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;" required>
                                <option value="">Select an option</option>
                                <option value="credit-card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bank-transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <div id="credit-card-details" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label" for="credit-card-number">Credit Card Number *</label>
                                <input type="number" id="credit-card-number" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="credit-card-expiry">Expiry Date (MM/YY) *</label>
                                <input type="text" id="credit-card-expiry" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="credit-card-cvv">CVV *</label>
                                <input type="number" id="credit-card-cvv" class="form-control" />
                            </div>
                        </div>
                        <div id="paypal-details" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label" for="paypal-email">PayPal Email *</label>
                                <input type="email" id="paypal-email" class="form-control" />
                            </div>
                        </div>
                        <div id="bank-transfer-details" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label" for="bank-transfer-account">Account Number *</label>
                                <input type="number" id="bank-transfer-account" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bank-transfer-bank">Bank Name *</label>
                                <input type="text" id="bank-transfer-bank" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-booking">Confirm Booking</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Assuming 'rooms' array is accessible here as a JSON object
        const rooms = <?php echo json_encode($rooms); ?>;

        document.getElementById('room-select').addEventListener('change', function () {
            const selectedIndex = this.value;
            const selectedRoom = rooms[selectedIndex];

            // Update room details
            document.getElementById('room-image').src = selectedRoom.image || 'default_room_image.jpg'; //provide a default image
            document.getElementById('room-name').innerText = selectedRoom.name;
            document.getElementById('room-summary').innerText = `Superior Room from ₱${selectedRoom.price}`;
        });

        // Trigger the change event on page load to show the first room's details
        document.getElementById('room-select').dispatchEvent(new Event('change'));
    </script>
    <script>
        // Script to fill in the modal with booking details
        const confirmBookingBtn = document.getElementById('confirm-booking');
        const paymentMethodSelect = document.getElementById('payment-method');
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));

        document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', function () {
            // Fetch booking details
            const checkIn = document.getElementById('check-in').value;
            const checkOut = document.getElementById('check-out').value;
            const guests = document.getElementById('guests').value;
            const numRooms = document.getElementById('num-accommodations').value;

            // Set booking details in modal
            document.getElementById('confirm-check-in').innerText = checkIn;
            document.getElementById('confirm-check-out').innerText = checkOut;
            document.getElementById('confirm-guests').innerText = guests;
            document.getElementById('confirm-rooms').innerText = numRooms + ' rooms';
        });

        paymentMethodSelect.addEventListener('change', function () {
            const selectedMethod = paymentMethodSelect.value;
            const creditCardDetails = document.getElementById('credit-card-details');
            const paypalDetails = document.getElementById('paypal-details');
            const bankTransferDetails = document.getElementById('bank-transfer-details');

            creditCardDetails.style.display = 'none';
            paypalDetails.style.display = 'none';
            bankTransferDetails.style.display = 'none';

            if (selectedMethod === 'credit-card') {
                creditCardDetails.style.display = 'block';
            } else if (selectedMethod === 'paypal') {
                paypalDetails.style.display = 'block';
            } else if (selectedMethod === 'bank-transfer') {
                bankTransferDetails.style.display = 'block';
            }
        });

        confirmBookingBtn.addEventListener('click', function () {
            const name = document.getElementById('customer-name').value;
            const email = document.getElementById('customer-email').value;
            const phone = document.getElementById('customer-phone').value;
            const paymentMethod = paymentMethodSelect.value;

            let paymentDetails = '';

            if (paymentMethod === 'credit-card') {
                const creditCardNumber = document.getElementById('credit-card-number').value;
                const creditCardExpiry = document.getElementById('credit-card-expiry').value;
                const creditCardCvv = document.getElementById('credit-card-cvv').value;
                paymentDetails = `Credit Card: ${creditCardNumber}, Expiry: ${creditCardExpiry}, CVV: ${creditCardCvv}`;
            } else if (paymentMethod === 'paypal') {
                const paypalEmail = document.getElementById('paypal-email').value;
                paymentDetails = `PayPal Email: ${paypalEmail}`;
            } else if (paymentMethod === 'bank-transfer') {
                const bankTransferAccount = document.getElementById('bank-transfer-account').value;
                const bankTransferBank = document.getElementById('bank-transfer-bank').value;
                paymentDetails = `Bank Transfer: Account ${bankTransferAccount}, Bank ${bankTransferBank}`;
            }

            // Logic for confirming booking can be added here
            // For example, sending the data to a server or displaying a success message
            modal.hide(); // Hide the modal
            alert(`Booking confirmed for ${name}!\nEmail: ${email}\nPhone: ${phone}\nPayment Method: ${paymentMethod}\nPayment Details: ${paymentDetails}`); // Placeholder for actual confirmation Logic
        });

        
    </script>
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
</body>
</html>