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
        }
        .room-picture {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .bg-card {
            background-color: #fff; /* Card background */
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .text-muted-foreground {
            color: #6c757d; /* Bootstrap muted text color */
        }
        .room-price {
            font-size: 1.5rem;
            color: #ff4081; /* Highlight price */
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
            font-size: 1.75rem; /* Increase font size */
            color: #333;
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
            margin-left: 1.5rem; /* Add margin for list */
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-4">
        <h2 class="section-title">5 Accommodations Found for 31 January 2025 - 1 February 2025</h2>
        
        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <img src="https://source.unsplash.com/600x400/?hotel-room" class="room-picture" alt="Room Picture">
            </div>
            <div class="col-md-6 mb-4">
                <h3 class="text-xl font-bold mb-3">Book Your Stay</h3>
                <p><strong>Required fields are followed by *:</strong></p>
                <form id="bookingForm">
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
        </div>

        <!-- Room Details Section -->
        <div class="row">
            <div class="col-12">
                <div class="bg-card p-4 mt-4">
                    <h2 class="text-xl font-bold text-foreground">Regular Superior Room</h2>
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
</body>
</html>