<?php
    include_once 'nav/homenav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/res.css">
    <link rel="stylesheet" href="../assets/css/rooms.css">
</head>
<body>
    <div class="container mx-auto p-4" >
      
        <div style="margin-top: 250px;">
        <div class="row mt-4" >
            <div class="col-md-6 mb-4">
            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="room-picture" alt="Room Picture">
            </div>
            <div class="col-md-6 mb-4">
                <h3 class="text-xl font-bold mb-3">Book Your Stay</h3>
                <p><strong>Required fields are followed by *:</strong></p>
                <form>
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
                    <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
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
                    <div class="mt-4 d-flex align-items-center">
                    <input type="number" min="1" max="15" value="1" class="form-control me-2 w-25" />
                    <span class="mx-2">of 15 accommodations available.</span>
                    <button class="btn btn-primary">Book</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>