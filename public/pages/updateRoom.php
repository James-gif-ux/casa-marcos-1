<?php
require_once '../model/Booking_Model.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_services'])) {
    $bookingModel = new Booking_Model();
    
    // Validate and sanitize input
    $services_id = filter_input(INPUT_POST, 'services_id', FILTER_SANITIZE_NUMBER_INT);
    $services_name = filter_input(INPUT_POST, 'services_name', FILTER_SANITIZE_STRING);
    $services_description = filter_input(INPUT_POST, 'services_description', FILTER_SANITIZE_STRING);
    $services_price = filter_input(INPUT_POST, 'services_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    // Get current image before update
$current_image = $bookingModel->get_service($services_id);
    
    // Handle image upload
    $image_name = $current_image; // Keep current image by default
    
    if (isset($_FILES['servicesimage']) && $_FILES['servicesimage']['size'] > 0) {
        $file = $_FILES['servicesimage'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        
        if (in_array($file['type'], $allowed_types)) {
            $image_name = time() . '_' . basename($file['name']);
            $target_path = "../images/" . $image_name;
            
            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $target_path)) {
                // Delete old image if exists and different
                if (!empty($current_image) && $current_image !== $image_name) {
                    $old_image_path = "../images/" . $current_image;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
            } else {
                $_SESSION['error'] = "Failed to upload image";
                header("Location: ../views/roomsUpload.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Please upload JPEG, PNG, or GIF";
            header("Location: ../views/roomsUpload.php");
            exit();
        }
    }
    
    // Validate all required fields
    if (empty($services_id) || empty($services_name) || empty($services_description) || empty($services_price)) {
        $_SESSION['error'] = "All fields are required";
        header("Location: ../views/roomsUpload.php");
        exit();
    }
    
    // Update room details
    $result = $bookingModel->update_room($services_id, $services_name, $services_description, $services_price, $image_name);
    
    if ($result === true) {
        $_SESSION['success'] = "Room updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update room: " . $result;
    }
    
    header("Location: ../views/roomsUpload.php");
    exit();
}