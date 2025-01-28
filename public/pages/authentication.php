<?php
ob_start();
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connector class
require '../model/Connector.php'; // Adjust the path as necessary

// Create an instance of the Connector
$dbConnector = new Connector();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the submitted username and password
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];

    // Prepare SQL for selecting user
    $sql = "SELECT * FROM admin_tb WHERE admin_username = :admin_username"; // Use named parameters for clarity
    $params = ['admin_username' => $submitted_username];

    // Execute the query
    $user = $dbConnector->executeQuery($sql, $params);

    // Debug: Check the returned user data
    var_dump($user); // Check the structure of the fetched data

    // Check if user exists and verify password
    if (is_array($user) && count($user) > 0) { // Ensure $user is an array and check if user is found
        $user = $user[0]; // Fetch the first result
        // Debug: Show hashed password from the database
        echo 'Hashed Password in DB: ' . $user['password'] . '<br>';
        // Verify password
        if (password_verify($submitted_password, $user['password'])) {
            // Password is correct, start user session and redirect to dashboard
            $_SESSION['admin_username'] = $submitted_username; // Store session variable
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            // Invalid password
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        // User does not exist
        $_SESSION['error'] = "User does not exist.";
    }

    // Redirect back to login page in case of post request to show error string.
    header("Location: ../views/adminpanel.php");
    exit;
}
?>