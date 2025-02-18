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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<style>
    /* General reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and Background */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
}

/* Reservation Page (Flex layout) */
.reservation-page {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 100%;
    max-width: 1200px;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

/* Room Image Section */
.room-image-section {
    width: 45%;
    text-align: center;
    padding-right: 20px;
}

.room-image {
    width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease-in-out;
}

.room-image:hover {
    transform: scale(1.05);
}

h3 {
    margin-top: 15px;
    color: #3e3e3e;
    font-size: 28px;
    font-weight: 600;
}

p {
    margin-top: 10px;
    font-size: 18px;
    color: #777;
}

/* Reservation Form Section */
.reservation-container {
    width: 55%;
}

.right-section {
    padding-left: 30px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1a1a1a;
    font-size: 32px;
    font-weight: 600;
    letter-spacing: 1px;
}

/* Alerts (Success/Error) */
.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    text-align: center;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Form Styling */
.reservation-form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

input, textarea {
    width: 100%;
    padding: 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    color: #333;
    background-color:rgb(249, 249, 249);
    transition: border-color 0.3s ease;
}

input:focus, textarea:focus {
    outline: none;
    border-color:rgb(80, 59, 31);
    background-color: #fff;
}

textarea {
    resize: vertical;
}

/* Button Styling */
.submit-btn {
    background-color:rgb(218, 191, 156);
    color: #fff;
    padding: 15px;
    font-size: 18px;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: rgb(80, 59, 31);
}

.submit-btn:active {
    background-color: #333;
}

/* Hover Effects for Form Inputs and Button */
input:hover, textarea:hover, .submit-btn:hover {
    transform: translateY(-2px);
}

</style>
<body>
    <div class="reservation-page">
        <!-- Room Image Section -->
        <div class="room-image-section">
            <img src="../images/11.jpg" alt="Room Image" class="room-image">
            <h3>Deluxe Room</h3>
            <p>Relax in our luxurious Deluxe Room, featuring a king-sized bed, marble bathrooms, and stunning views. Perfect for an unforgettable getaway.</p>
        </div>

        <!-- Reservation Form Section -->
        <div class="reservation-container">
            <div class="right-section">
                <h2>Make a Reservation</h2>
                
                <?php if (isset($success_message)): ?>
                    <div class="alert success"><?php echo $success_message; ?></div>
                <?php endif; ?>

                <?php if (isset($error_message)): ?>
                    <div class="alert error"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="reservation-form">
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
        </div>
    </div>
</body>
</html>
