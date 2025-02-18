<?php
session_start();

// Database connection (adjust these settings according to your database)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resrot_db";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, date, message) 
                               VALUES (:name, :email, :phone, :date, :message)");
        
        $stmt->execute([
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':phone' => $_POST['phone'],
            ':date' => $_POST['date'],
            ':message' => $_POST['message']
        ]);

        $success_message = "Reservation submitted successfully!";
    } catch(PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservred Booking</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="reservation-container">
        <h2>Make a Reservation</h2>
        
        <?php if (isset($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="message">Special Requests:</label>
                <textarea id="message" name="message" rows="4"></textarea>
            </div>

            <button type="submit" class="submit-btn">Make Reservation</button>
        </form>
    </div>
</body>
</html>