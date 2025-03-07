<?php
	//import database connector
	require_once 'server.php';
	
	//-------------------------------//
	//--class for login page active--//
	//-------------------------------//
	class roomsUpload_Model extends Connector{
		function __construct(){
			parent::__construct();
		}
		
		//-------------------------------//
		//--  function starts here      --//
		function get_services(){
            $sql = "SELECT * FROM `services_tb` WHERE `services_id` = 1";
            $query = $this->getConnection()->prepare($sql);        
            //execute query
            $query->execute();
            //return
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        
        function updateRoom(){
            $sql = "UPDATE `services_tb` 
                    SET `services_name` = '{$_POST['services_name']}', `services_price` = '{$_POST['services_price']}', `services_description` = '{$_POST['services_description']}' 
                    WHERE `services_id` = '{$_GET['id']}'";
            $query = $this->getConnection()->prepare($sql);
            //execute query
            $query->execute();
            //return
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        function upload_service_image($data){
            $sql = "UPDATE `services_tb` SET `services_image` = :services_image WHERE `services_id` = 1";
            $query = $this->getConnection()->prepare($sql);
            $query->bindParam(':services_image', $data['services_image']);
            //execute query
            $query->execute();
            //return
            return $query->fetch(PDO::FETCH_ASSOC);
        }
	 }
?>