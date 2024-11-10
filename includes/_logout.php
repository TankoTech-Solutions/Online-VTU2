<?php session_start();
	
	$_SESSION['MM_ID']  	 = NULL;
	$_SESSION['MM_Fullname'] = NULL;
	$_SESSION['MM_Email'] 	 = NULL;
	$_SERVER['HTTP_REFERER'] = NULL;
	
	unset($_SESSION['MM_ID']);
	unset($_SESSION['MM_Fullname']);
	unset($_SESSION['MM_Email']);	
	unset($_SERVER['HTTP_REFERER']);

	session_unset();
	session_destroy();  	
	
	header("Location: ../php/login.php");
	exit;
?>
