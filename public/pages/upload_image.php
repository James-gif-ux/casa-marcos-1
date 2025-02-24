<?php
require_once '../model/server.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $connector = new Connector();
    
    try {
        $image_name = $_POST['image_name'];
        $image_description = $_POST['image_description'];
        
        // Handle file upload
        $target_dir = "../uploads/gallery/";
        $file_extension = strtolower(pathinfo($_FILES["image_img"]["name"], PATHINFO_EXTENSION));
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        // Check if image file is actual image
        if (!getimagesize($_FILES["image_img"]["tmp_name"])) {
            throw new Exception("File is not an image.");
        }
        
        // Move uploaded file
        if (!move_uploaded_file($_FILES["image_img"]["tmp_name"], $target_file)) {
            throw new Exception("Failed to upload file.");
        }
        
        // Insert into database
        $sql = "INSERT INTO image_tb (image_name, image_img, image_description) VALUES (:name, :img, :description)";
        $stmt = $connector->getConnection()->prepare($sql);
        $stmt->execute([
            ':name' => $image_name,
            ':img' => $new_filename,
            ':description' => $image_description
        ]);
        
        header("Location: ../views/images.php?success=1");
        exit();
        
    } catch (Exception $e) {
        header("Location: ../views/images.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>