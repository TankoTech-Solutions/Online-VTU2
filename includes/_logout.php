<?php session_start();
	require_once('conn.php');
	
	$_SESSION['MM_ID']  	 = NULL;
	$_SESSION['MM_Fullname'] = NULL;
	$_SESSION['MM_Email'] 	 = NULL;
	
	unset($_SESSION['MM_ID']);
	unset($_SESSION['MM_Fullname']);
	unset($_SESSION['MM_Email']);
	
	unset($_SERVER['HTTP_REFERER']);

	session_unset();
	session_destroy();  	
	
	header("Location: ../php/index.php");
	exit;
?>
