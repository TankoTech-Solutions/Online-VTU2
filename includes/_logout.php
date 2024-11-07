<?php session_start();
	require_once('conn.php');
	
	$_SESSION['id']   = NULL;
	$_SESSION['mail'] = NULL;
	$_SESSION['name'] = NULL;
	
	unset($_SESSION['id']);
	unset($_SESSION['mail']);
	unset($_SESSION['name']);
	
	unset($_SERVER['HTTP_REFERER']);

	session_unset();
	session_destroy();  	
	
	header("Location: ../index.php");
	exit;
?>
