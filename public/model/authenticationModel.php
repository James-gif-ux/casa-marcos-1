<?php
	//import database connector
	require_once 'connector.php';

	//-------------------------------//
	//--class for login page active--//
	//-------------------------------//
	class authenticationModel extends Connector{
		function __construct(){
			parent::__construct();
		}
		
		//-------------------------------//
		//--  function starts here      --//
		function loggedin(){
			//prepare the sql
			$sql = "SELECT * FROM `admin_tb` WHERE admin_user = '{$_POST['user']}' and admin_password = '{$_POST['password']}'";
			//prepare query
			$query = $this->conn->prepare($sql);
			

			//execute query
			$query->execute();
			//return
			return $query->fetch(PDO::FETCH_ASSOC);
		}

		function register(){

			$sql = "INSERT INTO `admin_tb` (`admin_user`, `admin_password`) 
								VALUE ('{$_POST['user']}','{$_POST['password']}')";
			$query = $this->conn->prepare($sql);
			

			//execute query
			$query->execute();
			//return
			return true;


		}
	}
?>