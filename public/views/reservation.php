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
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .room-picture {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .bg-card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .text-muted-foreground {
            color: #6c757d;
        }
        .room-price {
            font-size: 1.5rem;
            color: #ff4081;
        }
        .btn-primary {
            background-color: #ff4081;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e91e63;
        }
        .room-details {
            padding: 20px;
        }
        .section-title {
            margin-top: 2rem;
            font-weight: bold;
            font-size: 2rem;
            color: #333;
            border-bottom: 2px solid #ff4081;
            padding-bottom: 1rem;
        }
        label {
            font-weight: bold;
            color: #444;
        }
        .booking-summary {
            font-weight: 500;
        }
        .list-disc {
            list-style-type: disc;
            margin-left: 1.5rem;
        }
        .modal-content {
            border-radius: 12px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #ff4081;
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-4">
        <h2 class="section-title">5 Accommodations Found for 31 January 2025 - 1 February 2025</h2>

        <div class="row mt-4">
            <div class="container">
                <h1>Select a Room</h1>

                <!-- Room selection dropdown -->
                <div class="mb-4">
                    <label class="form-label" for="room-select">Select Room *</label>
                    <select id="room-select" class="form-select" required>
                        <?php foreach ($rooms as $index => $room): ?>
                            <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($room['name']); ?> – ₱<?php echo htmlspecialchars($room['price']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Room details display -->
                <div id="room-details" class="room-card">
                    <img id="room-image" src="" class="room-picture" alt="Room Image">
                    <h2 id="room-name" class="mt-2"></h2>
                    <p id="room-summary" class="mt-2 text-muted-foreground booking-summary"></p>
                </div>
            </div>

            <form id="bookingForm" class="mt-4">
                <div class="mb-4">
                    <label class="form-label" for="check-in">Check-in *</label>
                    <input type="date" id="check-in" class="form-control" required />
                </div>
                <div class="mb-4">
                    <label class="form-label" for="check-out">Check-out *</label>
                    <input type="date" id="check-out" class="form-control" required />
                </div>
                <div class="mb-4">
                    <label class="form-label" for="guests">Guests *</label>
                    <select id="guests" class="form-select" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="mt-4 d-flex align-items-center">
                    <input type="number" min="1" max="15" id="num-accommodations" value="1" class="form-control me-2 w-25" required/>
                    <span class="mx-2">of 15 accommodations available.</span>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Book</button>
                </div>
            </form>
        </div>

        <!-- Room Details Section -->
        <div class="row">
            <div class="col-12">
                <div class="bg-card mt-4">
                    <h2 class="text-xl font-bold text-foreground">Room Details</h2>
                    <p class="mt-2 text-muted-foreground booking-summary">
                        Superior Room from <span class="font-semibold room-price">₱ 2,988</span>. Choice of Twin or Queen Bed, Wifi in Rooms, Writing Desk, Turn Down Service, Room Service, Breakfast Included.
                    </p>
                    <div class="mt-4">
                        <ul class="list-disc">
                            <li>Guests: <span class="font-semibold">2</span></li>
                            <li>Amenities: <span class="font-semibold">Breakfast Included, Non-smoking, Smart LED TV, Streaming Movies, Wifi in Room, Work desk</span></li>
                            <li>Size: <span class="font-semibold">21m²</span></li>
                            <li>Bed Type: <span class="font-semibold">Twin Beds or Queen Sized Bed</span></li>
                            <li>Categories: <span class="font-semibold">Regular Rate Rooms</span></li>
                        </ul>
                    </div>
                    <div class="mt-6">
                        <p class="font-semibold">Prices start at: <span class="text-lg room-price">₱ 2,988</span> per night</p>
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
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-xl">Booking Details</h5>
                    <div class="mb-3">
                        <label class="form-label" for="customer-name">Name *</label>
                        <input type="text" id="customer-name" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="customer-email">Email *</label>
                        <input type="email" id="customer-email" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="customer-phone">Phone Number *</label>
                        <input type="tel" id="customer-phone" class="form-control" required />
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
                            <select id="payment-method" class="form-select" required>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-booking">Confirm Booking</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const rooms = <?php echo json_encode($rooms); ?>;

        document.getElementById('room-select').addEventListener('change', function () {
            const selectedIndex = this.value;
            const selectedRoom = rooms[selectedIndex];

            document.getElementById('room-image').src = selectedRoom.image || 'default_room_image.jpg';
            document.getElementById('room-name').innerText = selectedRoom.name;
            document.getElementById('room-summary').innerText = `Superior Room from ₱${selectedRoom.price}`;
        });

        document.getElementById('room-select').dispatchEvent(new Event('change'));

        const confirmBookingBtn = document.getElementById('confirm-booking');
        const paymentMethodSelect = document.getElementById('payment-method');
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));

        document.querySelector('[data-bs-toggle="modal"]').addEventListener('click', function () {
            const checkIn = document.getElementById('check-in').value;
            const checkOut = document.getElementById('check-out').value;
            const guests = document.getElementById('guests').value;
            const numRooms = document.getElementById('num-accommodations').value;

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

            modal.hide();
            alert(`Booking confirmed for ${name}!\nEmail: ${email}\nPhone: ${phone}\nPayment Method: ${paymentMethod}\nPayment Details: ${paymentDetails}`);
        });

        function calculateTotalPrice() {
            const pricePerNight = <?php echo $room_price; ?>;
            const checkIn = new Date(document.getElementById('check-in').value); 
            const checkOut = new Date(document.getElementById('check-out').value);
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            const numRooms = document.getElementById('num-accommodations').value;

            return pricePerNight * nights * numRooms;
        }

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