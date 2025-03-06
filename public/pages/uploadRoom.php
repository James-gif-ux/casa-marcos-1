<?php
require_once '../model/server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $connector = new Connector();
        
        $services_name = $_POST['room_name'];
        $services_description = $_POST['room_description'];
        $services_price = $_POST['room_price'];
        
        // Handle file upload
        $target_dir = "../images/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file = $_FILES['room_image'];
        $fileName = time() . '_' . basename($file['name']);
        $targetFilePath = $target_dir . $fileName;
        
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            $services_image = $fileName;
            
            $query = "INSERT INTO services_tb (services_name, services_description, services_price, services_image) VALUES (:services_name, :services_description, :services_price, :services_image)";
            $stmt = $connector->getConnection()->prepare($query);
            $stmt->bindParam(':services_name', $services_name);
            $stmt->bindParam(':services_description', $services_description);
            $stmt->bindParam(':services_price', $services_price);
            $stmt->bindParam(':services_image', $services_image);
            $stmt->execute();

            $query = "UPDATE services_tb SET services_name = :services_name, services_description = :services_description, services_price = :services_price, services_image = :services_image WHERE services_id = :services_id";
            $stmt = $connector->getConnection()->prepare($query);
            $stmt->bindParam(':services_name', $services_name);
            $stmt->bindParam(':services_description', $services_description);
            $stmt->bindParam(':services_price', $services_price);
            $stmt->bindParam(':services_image', $services_image);
            $stmt->bindParam(':services_id', $services_id);
            $stmt->execute();
            
            
            header("Location: ../pages/roomsUpload.php?success=1");
            exit();
        } else {
            header("Location: ../pages/roomsUpload.php?error=upload");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../views/roomsUpload.php?error=" . urlencode($e->getMessage()));
        exit();
    }

    
}
?>