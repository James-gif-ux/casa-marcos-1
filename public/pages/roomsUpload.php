<?php
    //import model
    include '../model/roomsUpload_Model.php';
    
    // Initialize page info
    $page_info = [
        'page' => 'roomsUpload',
        'sub_page' => isset($_GET['sub_page']) ? $_GET['sub_page'] : 'roomsUpload'
    ];

    try {
        if (isset($_POST['edit_services_id'])) {
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
            if (is_array($page_info)) {
                $this->page = $page_info['page'];
                $this->sub_page = $page_info['sub_page'];
                $this->roomsUpload();
            }
        }
        
        function roomsUpload() {
            $rooms = new roomsUpload_Model();
            $services = $rooms->get_services();
            include '../views/roomsUpload.php';
        }
    }

    class Rooms_Upload {
        private $page = '';
        private $sub_page = '';

        function __construct($page_info) {
            if (is_array($page_info)) {
                $this->page = $page_info['page'];
                $this->sub_page = $page_info['sub_page'];
                $this->updateRoom();
            }
        }
    
        function updateRoom() {
            $rooms = new roomsUpload_Model();
            
            $updateData = [
                'services_name' => $_POST['services_name'],
                'services_price' => $_POST['services_price'],
                'services_description' => $_POST['services_description'],
                'services_id' => $_POST['edit_services_id']
            ];

            if (!empty($_FILES['services_image']['name'])) {
                $target_dir = "../images/";
                $file = $_FILES['services_image'];
                $fileName = time() . '_' . basename($file['name']);
                $targetFilePath = $target_dir . $fileName;
                
                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $updateData['services_image'] = $fileName;
                }
            }

            $result = $rooms->updateRoom($updateData);
            
            if ($result) {
                header('Location: ../pages/roomsUpload.php?success=1');
            } else {
                header('Location: ../pages/roomsUpload.php?error=1');
            }
            exit();
        }
    }
?>