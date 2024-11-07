<?php
$app_url = "https://tankotech.com.ng";
	
//Ensuring Maximun Security (Escaped SQL-Injection)
	if (!get_magic_quotes_gpc()) {
		if (isset($_POST)) {
			foreach ($_POST as $key => $value) {
				$_POST[$key] =  trim(addslashes($value));
			}
		}
		
		if (isset($_GET)) {
			foreach ($_GET as $key => $value) {
				$_GET[$key] = trim(addslashes($value));
			}
		}	
	}
	
// Configure database connection //
/***********************************/	
	$this_host		= $_SERVER['REMOTE_ADDR'];
	$this_array 	= array('localhost', '127.0.0.1', '192.168.0.0', '::1');
	if(in_array($this_host, $this_array)) {		//Offline
		$db_name 	= "online_vtu2";
	}else{										//Online
		$db_name 	= "tankote3_vtu";	
	}
		$host 		= "localhost";
		$db_user 	= "getjunaidu86";
		$db_pass 	= "2004kiyawa";
	
// Create connection
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

	// Check connection
	if ($conn->connect_error) {
		die("Database connection failed: " . $conn->connect_error);
	} 
	
	// Get all the application table values and make them available to any page.
	$result = $conn->query("SELECT * FROM  application LIMIT 1");
	$count 	= $result->num_rows;
   	if($count > 0){
       	$app = $result->fetch_assoc();
		extract($app);
	}
?>
	
<?php 
	
	//initialize the session
	 if(!session_start())
		{
			session_start();
			ob_start();
		}
 
	//Import reqired files
	if(file_exists('../includes/_tt_functions.php')) {
		include_once('../includes/_tt_functions.php');
		include_once('../includes/_tt_variables.php');
	} else {
		include_once('includes/_tt_functions.php');
		include_once('includes/_tt_variables.php');
	}
	
$min = -1; //This refers to minimum amount banch-mark.	   
?>