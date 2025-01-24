<?php
session_start();
include_once '../model/authenticationModel.php';

if(isset($_GET['function']) && $_GET['function'] == 'login') {
    $auth = new authenticationModel();
    $result = $auth->loggedin($_POST);
    
    if($result) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['admin_id'] = $result['admin_id'];
        $_SESSION['admin_user'] = $result['admin_user'];
        $_SESSION['admin_type'] = $result['admin_type'];
        
        // Redirect to dashboard
        header('Location: ../views/dashboard.php');
        exit();
    } else {
        // Handle login failure
        $_SESSION['error'] = "Invalid Username or Password!";
        header('Location: ../views/login.php');
        exit();
    }
}

// Handle unauthorized access
if(!isset($_SESSION['loggedin'])) {
    header('Location: ../views/login.php');
    exit();
}
?>