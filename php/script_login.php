<?php require_once('../includes/_conn.php'); ?>
<?php 
//if (isset($_POST['btnSubmit'])) { 
  $email	= tt_sensatize_input($conn, $_POST['username']);
  $password	= tt_sensatize_input($conn, $_POST['password']);
  $remember	= isset($_POST['remember']) ? "Yes" : "No";
 
  $LoginRS = mysqli_query($conn, "SELECT * FROM user WHERE email='".$email."' AND password='".md5($password)."'") or die(mysqli_error($conn));
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser == 1) { echo "User found!";
    	extract(mysqli_fetch_array($LoginRS));
		if($status == "1") {							 
			//declare session variables and assign them
			$_SESSION['MM_ID']	 		= $user_id;
			$_SESSION['MM_Email']	 	= $email;
			$_SESSION['MM_Fullname']	= $fullname;
							 
			//Success redirection
			header("Location: index.php");	
		}else{
			//Unverify account
			header("Location: verification.php");
		}
  }elseif($loginFoundUser > 1) {
  	//Failed redirection
	$msg = "<i class='fa fa-exclamation-circle'></i> OMG! There is user complict in the system, please contect us.";
  } else {
  	//Failed redirection
	$msg = "<i class='fa fa-exclamation-circle'></i> Ops! Invalid Email and/or Password. Please double check and try again.";
  }
echo $msg;
//}
?>