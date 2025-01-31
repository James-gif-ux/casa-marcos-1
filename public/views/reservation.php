<?php
require_once '../model/connector.php';
require_once '../model/roomModel.php';

$connector = new Connector();
$roomModel = new RoomModel($connector->getConnection());
$rooms = $roomModel->getAllRooms();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa Marcos - Room Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .reservation-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin: 2rem auto;
            max-width: 800px;
        }
        .form-control:focus {
            border-color: rgb(102, 67, 35);
            box-shadow: 0 0 0 0.2rem rgba(102, 67, 35, 0.25);
        }
        .btn-primary {
            background-color: rgb(102, 67, 35);
            border-color: rgb(102, 67, 35);
        }
        .btn-primary:hover {
            background-color: rgb(163, 99, 15);
            border-color: rgb(163, 99, 15);
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="text-center mb-4" style="color: rgb(102, 67, 35); font-family: 'impact';">
        Room Reservation
        <span class="d-block mx-auto" style="width: 80px; height: 3px; background: rgb(163, 99, 15); margin-top: 1rem;"></span>
    </h2>

    <div class="reservation-form">
        <form action="../controller/reservationController.php" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Check-in Date</label>
                    <input type="date" class="form-control" name="check_in" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Check-out Date</label>
                    <input type="date" class="form-control" name="check_out" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Room Type</label>
                    <select class="form-select" name="room_id" required>
                        <option value="">Select a room</option>
                        <?php foreach ($rooms as $room): ?>
                            <option value="<?php echo $room['id']; ?>">
                                <?php echo $room['name']; ?> - $<?php echo $room['price']; ?>/night
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Number of Guests</label>
                    <select class="form-select" name="guests" required>
                        <option value="1">1 Guest</option>
                        <option value="2">2 Guests</option>
                        <option value="3">3 Guests</option>
                        <option value="4">4 Guests</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Special Requests</label>
                    <textarea class="form-control" name="special_requests" rows="3"></textarea>
                </div>
                <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Confirm Reservation</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add date validation to ensure check-out is after check-in
    document.querySelector('form').addEventListener('submit', function(e) {
        const checkIn = new Date(document.querySelector('input[name="check_in"]').value);
        const checkOut = new Date(document.querySelector('input[name="check_out"]').value);
        
        if (checkOut <= checkIn) {
            e.preventDefault();
            alert('Check-out date must be after check-in date');
        }
    });
</script>

</body>
</html>
