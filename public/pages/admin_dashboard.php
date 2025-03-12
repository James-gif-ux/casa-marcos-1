<?php
	//import model

	$page_info['page'] = 'admin_dashboard'; //for page that needs to be called
	$page_info['sub_page'] = isset($_GET['sub_page'])? $_GET['sub_page'] : 'admin_dashboard'; //for function to be loaded
		
	
	try {//used try to catch unfortunate errors
		//check for active function
		
		//no active function, use the default page to view
		new admin_dashboard($page_info);
		
	}catch (Throwable $e){ //get the encountered error
		echo '<h1>ERROR 404</h1>';
		echo $e->getMessage();
	}//end of validation
	
	
	//-----------------------//
	//--  Class Navigation --//
	//-----------------------//
	class admin_dashboard{
		//set default page info
		private $page = '';
		private $sub_page = '';
		
		//run function construct
		function __construct($page_info){
			//assign page info
			$this->page = $page_info['page'];
			$this->sub_page = $page_info['sub_page'];
			
			//run the function
			$this->{$page_info['sub_page']}();
		}
		
		//-----------------------------//
		//--   function start here   --//
		function dashboard(){
			include '../views/dashboard.php';
		}
		function booking(){
			include '../views/booking.php';
		}
		function customer(){
			include '../views/customer.php';
		}
		function messages(){
			include '../views/messages.php';
		}
		function payment(){
			include '../views/payment.php';
		}
		function settings(){
			include '../views/settings.php';
		}
		function reports(){
			include '../views/reports.php';
		}
		function roomsUpload(){
			include '../views/roomsUpload.php';
		}
		function food(){
			include '../views/food.php';
		}
	}
?>