<?php
	//import model
	include_once '../model/roomModel.php';
	$page_info['page'] = 'roomstry'; //for page that needs to be called
	$page_info['sub_page'] = isset($_GET['sub_page'])? $_GET['sub_page'] : 'roomstry'; //for function to be loaded
	
	
	if(isset($_POST['search_dates'])) {
	    $checkin_date = $_POST['checkin_date'];
	    $checkout_date = $_POST['checkout_date'];
	    
	    // Store in session for persistence
	    $_SESSION['checkin_date'] = $checkin_date;
	    $_SESSION['checkout_date'] = $checkout_date;
	}
		
	
	try {//used try to catch unfortunate errors
		//check for active function
		
		//no active function, use the default page to view
		new roomstry ($page_info);
		
	}catch (Throwable $e){ //get the encountered error
		echo '<h1>ERROR 404</h1>';
		echo $e->getMessage();
	}//end of validation
	
	
	//-----------------------//
	//--  Class Navigation --//
	//-----------------------//
	class roomstry {
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
		function roomstry(){
			include '../views/roomstry.php';
		}
		
	}

?>