<?php
    //import database connector
    require_once 'server.php';
    
    class roomsUpload_Model extends Connector {
        function __construct() {
            parent::__construct();
        }
        
        function get_services() {
            $sql = "SELECT * FROM `services_tb`";  // Remove WHERE clause to get all services
            $query = $this->getConnection()->prepare($sql);        
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);  // Changed to fetchAll
        }
        
        function service_update_submit($data) {
            try {
                $sql = "UPDATE `services_tb` SET 
                        `services_name` = :services_name,
                        `services_description` = :services_description,
                        `services_price` = :services_price
                        WHERE `services_id` = :services_id";
                
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(':services_name', $data['room_name']);
                $query->bindParam(':services_description', $data['room_description']);
                $query->bindParam(':services_price', $data['room_price']);
                $query->bindParam(':services_id', $data['edit_services_id']);
                
                return $query->execute();
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return false;
            }
        }

        function upload_service_image($data) {
            try {
                $sql = "UPDATE `services_tb` SET 
                        `services_image` = :services_image 
                        WHERE `services_id` = :services_id";
                
                $query = $this->getConnection()->prepare($sql);
                $query->bindParam(':services_image', $data['room_image']);
                $query->bindParam(':services_id', $data['edit_services_id']);
                
                return $query->execute();
            } catch (PDOException $e) {
                error_log($e->getMessage());
                return false;
            }
        }
    }
?>