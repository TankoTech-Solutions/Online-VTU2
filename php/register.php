<?php require_once('../includes/_conn.php'); ?>
<?php
	$noted		= "";
	$user_id 	= "";
	$fullname 	= "";
	$email 		= "";	
	$phone 		= "";
	$password 	= "";		
	$accept_term= "";	

if (isset($_POST["btnSave"])) { 	
	$flag = 0; //display form or not?
	
	//$user_id 	= tt_sensatize_input($conn, $_POST['id']);
	$fullname 	= tt_sensatize_input($conn, tt_case_title($_POST['fullname']));
	$email 		= tt_sensatize_input($conn, strtolower($_POST['email']));
	$phone 		= tt_sensatize_input($conn, $_POST['phone']);
	$password 	= tt_sensatize_input($conn, $_POST['password']);
	$accept_term= tt_sensatize_input($conn, $_POST['terms']);
	  	
	if($fullname=='' || empty($fullname)){
		$noted = tt_alert(' Your full name is required!', 0);
	}
	
	elseif($email=='' || empty($email)){
	 	$noted = tt_alert(' Email address is required!', 0); 
	}
	elseif(isExists($conn, "user", "email", $email)){
		$noted = tt_alert(' This email address has been use by another customer!', 0); 
	}

	elseif($phone=='' || empty($phone)){
	 	$noted = tt_alert(' Phone number is required!', 0); 
	}
	elseif(!is_numeric($phone)){
	 	$noted = tt_alert(' Invalid phone number!', 0); 
	}
	elseif(strlen($phone) < 10 || strlen($phone) > 15){
	 	$noted = tt_alert(' Phone number is either too short or too much! Please check.', 0); 
	} 
	elseif(isExists($conn, "user", "phone", $phone)){
		$noted = tt_alert(' This phone number is in use by another customer!', 0);  
	}
	
	elseif(!isset($accept_term)){
		$noted = tt_alert(' You need to accept our terms of service to register!', 0);  
	
	}else{     

		$hash_pass 	= md5($password);
		$refer_code	= strtoupper(tt_get_initials($fullname).tt_random_string(6));
		$add_date	= date("Y/m/d H:i A");
		$user_ip	= getenv("REMOTE_ADDR");
		$acct_type	= "Smart Earner";
		$otp_code	= tt_random_number(6);
		
		$sql = "INSERT INTO user (fullname, email, phone, status, password, balance, refer_balance, 
		refer_code, kyc_update, date_add, user_ip, acct_type)
		VALUES ('".$fullname."', '".$email."',	'".$phone."', '0','".$hash_pass."',	'0',	
				'0',	'".$refer_code."',	'0', '".$add_date."', '".$user_ip."','".$acct_type."')";
		
		if ($conn->query($sql) === TRUE) {
		  	$user_id = $conn->insert_id;	
			
			//Insert and send the otp.
			$sql_otp = "INSERT INTO otp (user_id, otp, purpose, sent_via, date_time, status)
			VALUES ('".$user_id."', '".md5($otp_code)."',	'New Registration', 'E-Mail', '".$add_date."', '0')";
			
			if($conn->query($sql_otp) === TRUE) {

				//--- Create wallet reserved account here
				include("api_monnify_reserved_account.php");

				//If account created without error
				if($err_wallet == "") {

					//--- Create verification OTP and send it to email.
					include("../mails/mail_otp.php");
					$err_mail = do_send_mail($app_email, $email, $subject, $content);

					if($err_mail == "") {

						//--- Refer dashboard page.			
						$_SESSION['MM_ID']	 	= $user_id;			
						$_SESSION['MM_Email']	= $email;	
						
						header("Location: verification.php");
					}else{ 
						$noted = $err_mail; //Show failed email error (Already formatted with tt_alert)
					}
				}else{
					$noted = tt_alert($err_wallet, 0); //Show failed wallet account error
				}
			}else{
				$noted = tt_alert("Failed to generate and save OTP!", 0);
			}
		} else {
		  $noted = tt_alert("Error: " . $sql . "<br>" . $conn->error, 0);
		}
		
	} 
}//end if form submit
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register - <?= $app_title; ?></title>
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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="../index.html" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?= strtoupper($app_title); ?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
					<?php if($noted != "") { echo $noted; } ?>
                  </div>

                  <form method="post" class="row g-3 needs-validation" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label"> Full Name</label>
                      <input type="text" name="fullname" class="form-control" id="yourName" value="<?= $fullname; ?>" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label"> Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                      	<input type="email" name="email" class="form-control" id="yourEmail" value="<?= $email; ?>" required>
                      	<div class="invalid-feedback">Please enter a valid Email adddress!</div>
					  </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPhone" class="form-label"> Phone No.</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">+234</span>
                        <input type="number" name="phone" class="form-control" id="yourPhone" value="<?= $phone; ?>" required>
                        <div class="invalid-feedback">Please enter your phone number.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" value="<?= $password; ?>" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox"  <?php if(isset($accept_term)) { echo 'checked'; }else{ echo ''; } ?> required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button name="btnSave" class="btn btn-primary w-100" type="submit" onClick="this.innHTML='Please Wait...'">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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