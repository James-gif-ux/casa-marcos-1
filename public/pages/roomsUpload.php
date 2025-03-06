<?php
require_once '../model/server.php';
include_once '../model/BookingModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $connector = new Connector();
    
    try {
        $services_name = $_POST['services_name'];
        $services_description = $_POST['services_description'];
        $services_price = $_POST['services_price'];
        
        // Handle file upload
        $target_dir = "../images/";
        $file_extension = strtolower(pathinfo($_FILES["service_img"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        // Check if image file is actual image
        if (!getimagesize($_FILES["services_img"]["tmp_name"])) {
            throw new Exception("File is not an image.");
        }
        
        // Move uploaded file
        if (!move_uploaded_file($_FILES["services_img"]["tmp_name"], $target_file)) {
            throw new Exception("Failed to upload file.");
        }
        
        // Insert into database
        $sql = "INSERT INTO services_tb (service_name, services_img, services_description, services_price) 
                VALUES (:name, :img, :description, :price)";
        $stmt = $connector->getConnection()->prepare($sql);
        $stmt->execute([
            ':name' => $service_name,
            ':img' => $new_filename,
            ':description' => $service_description,
            ':price' => $service_price
        ]);
        
        header("Location: ../views/roomsUpload.php?success=1");
        exit();
        
    } catch (Exception $e) {
        header("Location: ../views/roomsUpload.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>