<?php
session_start();

// Check if there's a success message in the session
$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : 'Operation completed successfully!';

// Clear the success message from session after displaying
unset($_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="success-container">
        <div class="success-message">
            <h1>Success!</h1>
            <p><?php echo htmlspecialchars($successMessage); ?></p>
            <a href="../index.php" class="back-button">Back to Home</a>
        </div>
    </div>
</body>
</html>