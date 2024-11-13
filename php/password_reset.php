<?php require_once('../includes/_conn.php'); ?>
<?php
$offset = 0;
$user_id= "";

if(isset($_GET['token'])) {
	$otp_get = tt_sensatize_input($conn, $_GET['token']);
	$email	 = tt_sensatize_input($conn, base64_decode($_GET['psRv25']));
	$user_id = get_value($conn, "user", "user_id", "email", $email);
	
	$sql = "SELECT otp, status FROM otp WHERE otp='".$otp_get."' AND user_id=".$user_id;
	$result = $conn->query($sql);

	// Check if the query was successful
	if ($result && $result->num_rows > 0) {
		// Fetch and return the data
		$rows = $result->fetch_assoc();
		extract($rows);
	
		//When the OTPs matched
		if($otp_get == $otp) {
			
			//When otp is not been used before
			if($status == 0){	
				
				//Update otp status to used value				
				mysqli_query($conn, "UPDATE otp SET status = '1' WHERE user_id = ".$user_id." AND otp = ".$otp_get);
				$offset = 1;
				
			}else{
	 			$noted = tt_alert(" This OTP is already been used! Please re-initiate another process from <a href='password_forget.php'>this page</a>.", 0);
			}
		}else{
	 		$noted = tt_alert(" Unrecognize account! Please re-initiate another process from <a href='password_forget.php'>this page</a>.", 0);
		}
	}else{
	 	$noted = tt_alert(" There is an error resetting your password! Please re-initiate another process from <a href='password_forget.php'>this page</a>. ".$conn->error, 0);
	}
}

if (isset($_POST['btnSubmit'])) {           
		  $user_id 	= mysqli_real_escape_string($conn, $_POST['id']);     
		  $password = mysqli_real_escape_string($conn, $_POST['newpassword']);
  		  $cpassword= mysqli_real_escape_string($conn, $_POST['confpassword']);
		  $str_length = strlen($password); 
	
	if($password=='' || empty($password)){
	 	$noted = tt_alert(' A valid password is required!', 0); 
	}
	elseif(strlen($password) < 8) {
		$noted = tt_alert("Password length most be at least 8 characters!", 0);
	}
	
	elseif($cpassword=='' || empty($cpassword)){
	 	$noted = tt_alert(' A valid confirm password is required!', 0); 
	}
	elseif(strlen($cpassword) < 8) {
		$noted = tt_alert("Confirm password length most be at least 8 characters!", 0);
	}
	
	elseif ($password	!= $cpassword) {
		$noted = tt_alert("Your password and confirm password did not match!", 0);
	}elseif($str_length < 8) {
	  	$noted = tt_alert("Password length most be at least 8 characters!", 0);
	}elseif($password	== $cpassword) {
			  	
			  //Encrypt password.
  				$hash_pass	= substr(sha1(md5($password)), 3, 10);
			  
			  //Update it to database
    			$query		= mysqli_query($conn, "UPDATE user SET password='$hash_pass' WHERE user_id='$user_id'") or die(mysqli_error());
    			
				if($query) {
					$email	  = get_value($conn, "user", "email", "user_id", $user_id);
					$fullname = get_value($conn, "user", "fullname", "user_id", $user_id);
					$account  = get_value($conn, "user", "acct_type", "user_id", $user_id);
				
					//Auto login
					$_SESSION['MM_ID']	 		= $user_id;
					$_SESSION['MM_Email']	 	= $email;
					$_SESSION['MM_Fullname']	= $fullname;
					
					include("../mails/mail_verified.php");
					$err_mail = do_send_mail($app_email, $email, $subject, $content);

					if($err_mail != "") {
						$noted = $err_mail; //Show failed email error (Already formatted with tt_alert)
					}
				?>
					<script> 
						if(confirm("Your password has now been changed. Do you wanted to proceed into your account dashboard?")) {
							window.location.replace("index.php");
						}else{
							window.location.replace("login.php");
						}	
					</script>
			<?php  }else{
						$noted = tt_alert(" There is a problem resetting your password! Please try again.", 0);
				  }
			}else{
				$noted = tt_alert(" An Error occured! Please contact us <a href='contact.php'>here</a>", 0);
			}
}	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reset Password - <?= $app_title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?= strtoupper($app_title); ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Reset Your Password</h5>
                    <p class="text-center small">Enter your new password below.</p>
					<?php if($noted != "") { echo $noted; } ?>						
                  </div>
				  
				  <?php if(isset($_GET['token'])) { ?>
				  
                  <form method="post" class="row g-3 needs-validation" novalidate>                    
                    <div class="col-12">
						<label for="newpassword" class="requiredField">New  Password:</label>
						<input type="password" name="newpassword" class="textinput form-control" 
							   required id="newpassword" value="<?php if (isset($password)) echo $password; ?>">
						<input type="hidden" id="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
						<small id="newpassword" class="form-text text-muted">
							Min length = 8, Alphanumeric Characters [i.e abcd1234]
					  	</small>						
                      	<div class="invalid-feedback">Please enter a valid password!</div>
						
					</div>
		        			
					<div class="col-12">
						<label for="confpassword" class="requiredField">Confirm  Password:</label>
        				<div class="input-group-addon">
                  			<input type="password" name="confpassword"  class="textinput form-control" id="confpassword" value="<?php if (isset($cpassword)) echo $cpassword; ?>" required>
                    	</div>
                      <div class="invalid-feedback">Please confirm your new password!</div>
                    </div>
                    
                    <div class="col-12">
					  <input type="hidden" name="id" value="<?= $user_id; ?>" required>
                      <button class="btn btn-primary w-100" type="submit" name="btnSubmit">Change</button>
                    </div>
					  
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="../pages-login.html">Login</a></p>
                    </div>
                  </form>

				  <?php }else{ ?>
				
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Ops!!!</h4>
                <p>We did not recognize you, please check out your email and click on the Password Reset link that we already set to you.</p>
                <hr>
				   <p class="mb-0">If you did not find the email, please re-initiate the password reset process <a href="password_forget.php">Here</a></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
				  
				  <?php } ?>
					
                </div>
			</div>

              <div class="credits">
				  <div align="center" class="copyright">
					  Copyright &copy;<?= $app_copyright; ?> <strong><span><?= $app_title; ?></span></strong>.
					</div>
					<p align="center">
					  Designed by <a href="<?= $app_dev_website; ?>" target="_blank"><?= $app_dev_name; ?></a>
					</p>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>