<?php
//import model
include '../model/roomsUpload_Model.php';
$page_info['page'] = 'roomsUpload';
$page_info['sub_page'] = isset($_GET['sub_page']) ? $_GET['sub_page'] : 'roomsUpload';

try {
    if (isset($_POST['update'])) {
        $rooms = new Rooms_Upload($page_info);
    } else {
        $rooms = new roomsUpload($page_info);
    }
} catch (Throwable $e) {
    echo '<h1>ERROR 404</h1>';
    echo $e->getMessage();
}

class roomsUpload {
    private $page = '';
    private $sub_page = '';
    
    function __construct($page_info) {
        $this->page = $page_info['page'];
        $this->sub_page = $page_info['sub_page'];
        $this->roomsUpload();
    }
    
    function roomsUpload() {
        $rooms = new roomsUpload_Model();
        $result = $rooms->service_update_submit($_POST); // Get all services
        include '../views/roomsUpload.php';
    }
}

class Rooms_Upload {
    private $page = '';
    private $sub_page = '';

    function __construct($page_info) {
        $this->page = $page_info['page'];
        $this->sub_page = $page_info['sub_page'];
        $this->service_update_submit();
    }

    function service_update_submit() {
        $rooms = new roomsUpload_Model();
        
        // Check if file is uploaded
        if (!empty($_FILES['services_image']['name'])) {
            $target_dir = "../images/";
            $file = $_FILES['services_image'];
            $fileName = time() . '_' . basename($file['name']);
            $targetFilePath = $target_dir . $fileName;
            
            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                $result = $rooms->service_update_submit(
                    $_POST['services_id'],
                    $_POST['services_name'],
                    $_POST['services_price'],
                    $_POST['services_description'],
                    $fileName
                );
            }
        } else {
            $result = $rooms->service_update_submit(
                $_POST['services_id'],
                $_POST['services_name'],
                $_POST['services_price'],
                $_POST['services_description'],
                null // Keep existing image
            );
        }

        if ($result) {
            header("Location: ../views/roomsUpload.php?success=updated");
        } else {
            header("Location: ../views/roomsUpload.php?error=update_failed");
        }
        exit();
    }
}
?>