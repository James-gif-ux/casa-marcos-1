<?php
	//import database connector
	require_once 'connector.php';
	
	//-------------------------------//
	//--class for login page active--//
	//-------------------------------//
	class authenticationModel extends Connector{
        protected $conn;
		function __construct(){
			parent::__construct();
		}
		
		//-------------------------------//
		//--  function starts here      --//
		function loggedin(){
			//prepare the sql
            $sql = "SELECT * FROM `admin_tb` WHERE admin_user = :user AND admin_password = :password";
            $query = $this->conn->prepare($sql);
            $query->bindParam(':user', $_POST['user']);
            $query->bindParam(':password', $_POST['password']);
			//prepare query
			$query = $this->conn->prepare($sql);
			

			//execute query
			$query->execute();
			//return
			return $query->fetch(PDO::FETCH_ASSOC);
		}

		
	}
?>