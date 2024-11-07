
<?php	
// *** Restrict Access To Page: Grant or deny access to this page
if (!isset($_SESSION['mail'])  || empty($_SESSION['mail'])) 
{
	session_destroy();
	header("Location: ../login/"); 
	exit;	
}

//After 30 minutes of inactivity; session will reset.
	$session_life = time() + (30 * 60);	//30 minutes.
	$_SESSION["expire"] = $session_life;
	 
if(time() > $_SESSION['expire']) 
{
	header("Location: logout.php"); 
} else {
	$_SESSION["expire"] = $session_life;
}
?>