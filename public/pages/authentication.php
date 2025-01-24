<?php
session_start();
include('../model/connector.php'); // Make sure to include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_user = $_POST['admin_user'];
    $admin_password = $_POST['admin_password'];

    // Query to check if the user exists
    $query = "SELECT * FROM admin_tb WHERE admin_user = ? AND admin_password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $admin_user, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['admin_user'] = $row['admin_user'];
        $_SESSION['admin_type'] = $row['admin_type'];
        header("Location: ../views/dashboard.php"); // Redirect to the dashboard or any other page
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<?php
	//import model
	include_once '../model/authenticationModel.php';

	$page_info['page'] = 'login'; //for page that needs to be called
	$page_info['sub_page'] = isset($_GET['sub_page'])? $_GET['sub_page'] : 'login'; //for function to be loaded
		
	//-----------------------//
	//--     --//
	//-----------------------//
	session_start();
	if(!isset($_SESSION['loggedin'])){
		try {//used try to catch unfortunate errors
			//check for active function
			if (isset($_GET['function'])){
				new LoginActive($page_info);
			}else{
				//no active function, use the default page to view
				new Login($page_info);
			}		
			
		}catch (Throwable $e){ //get the encountered error
			echo '<h1>ERROR 404</h1>';
			echo $e->getMessage();
		}//end of validation
	}else{
		header("Location: ../page/home.php");
	}
	
	
	//-----------------------//
	//--  Class Navigation --//
	//-----------------------//
	class Login{
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
		function login(){
			include '../views/login.php';
		}
		
	}
	
	//-----------------------//
	//-- Active Class      --//
	//-----------------------//
	class LoginActive{
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
		
		//-----------------------------------//
		//--  active function start here   --//
		
		function loggedin(){ //validate login
			//instantiate class model
			
			$loggedin = new authenticationModel();
			

			$result = $loggedin->loggedin($_POST);
			
			if($result){
				if($result['admin_type'] === 'admin'){
					header('Location: ../page/dashboard?sub_page=dashboard');
				}else{
					header('Location: ../page/dashboard?sub_page=dashboard');
				}
			}else{
				$msg = "Invalid Username or Password!";
			}

			
		}
		
		
	
	}
	
?>

