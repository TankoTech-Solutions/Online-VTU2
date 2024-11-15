<?php require_once('../includes/_conn.php'); ?>
<?php

	$offset		= 0;
	$email 		= "";
	$user_id 	= "";
	$noted		= "";
		
if (isset($_POST["btnSubmit"])) { 
	
	$email 		= tt_sensatize_input($conn, strtolower($_POST["email"]));
	$check_user	= get_value($conn, "user", "user_id", "email", $email);	
	$user_id 	= get_value($conn, "user", "user_id", "email", $email);
	$check_otp	= get_value($conn, "otp", "status", "user_id", $user_id);	
	
	if($email=='' || empty($email)){
	 	$noted = tt_alert(" Email address is required!", 0);
	}
	elseif($user_id == ""){
	 	$noted = tt_alert(" Your account is not recognized! You may register again please.", 0);
	}
	elseif($check_user != ""){
		
		if($check_otp == 0) {
			
			//Delete existing otp
			$sql_delete = "DELETE FROM otp WHERE user_id = ".$user_id."";
				
			if($conn->query($sql_delete) === TRUE) {
				
				$add_date	= date("Y/m/d H:i A");
				$otp_code	= tt_random_number(6);				
				$fullname	= get_value($conn, "user", "fullname", "user_id", $user_id);	
				
				//Insert and send the otp.
				$sql_otp = "INSERT INTO otp (user_id, otp, purpose, sent_via, date_time, status)
				VALUES ('".$user_id."', '".md5($otp_code)."',	'Password Reset', 'E-Mail', '".$add_date."', '0')";
				
				if($conn->query($sql_otp) === TRUE) {
			
					//--- Create verification OTP and send it to email.
					include("../mails/mail_reset.php");
					$err_mail = do_send_mail($app_email, $email, $subject, $content);

					if($err_mail == "") {
						$offset = 1;

						//--- Refer dashboard page.			
						$_SESSION['MM_ID']	 	= $user_id;			
						$_SESSION['MM_Email']	= $email;	
						
	 					$noted = tt_alert(" A 6-digits OTP has been resend to your email (".$email."), use it to verify your account please.", 1);
					}else{ 
	 					$noted = $err_mail; //Show failed email error (Already formatted with tt_alert)
					}
				}else{
	 				$noted = tt_alert(" Failed to generate new and resend the OTP! ".$conn->error, 0);
				}
			}else{
	 			$noted = tt_alert(" Error process resending OTP! please try again.", 0);
			}
		}else{
	 	$noted = tt_alert(" Error resending OTP! Old OTP not found.", 0);
		}
	}else{
	 	$noted = tt_alert(" Error resending OTP! Customer not found.", 0);
	} 
}//end if form submit

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forget Password - <?= $app_title; ?></title>
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

<!--
  <style>
	#show_form{
		display: inline;		
	  }
	#show_note{
		display: none;
	  }
  </style>
-->
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
                    <h5 class="card-title text-center pb-0 fs-4">Forget Password</h5>
                    <p class="text-center small">Enter your registered email below to initiate the password reset process.</p>
                  </div>
				  
				  <?php if($offset == 1) {
				  echo '<span id="show_note">
					  
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">Initiated</h4>
						<p>We have sent you an email with the Password Reset link, follow the link and reset your password.</p>
						<hr>
						   <p class="mb-0">If you did not find the email after some time, please re-initiate the password reset process <a href="password_forget.php">Here</a></p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					  </div>
					  
				  </span>';
				   }else{ 
				  echo '<span id="show_form">';
						
					 if($noted != "") { echo $noted; }  
				  echo	'<form method="post" class="row g-3 needs-validation" novalidate>
                    
					  <div class="col-12">
                      <label for="email" class="form-label"> Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                      	<input type="email" name="email" class="form-control" id="email" required>
                      	<div class="invalid-feedback">Please enter a valid Email adddress!</div>
					  </div>
                    </div>
                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="btnSubmit" id="btn_submit" type="submit">Initiate</button>
                    </div>
					  
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                  </form>
					  
				  </span>';
				   } ?>
					
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
  <script>	  
	  function resetPassword(){
		  
		var thismail 	= document.getElementById("email").value;
		var showform	= document.getElementById("show_form");
		var shownote	= document.getElementById("show_note");
		var btnSub		= document.getElementById("btn_submit");

		btnSub.innerHTML = 'Please Wait...';
		//alert(thismail);

//		var xhttp = new XMLHttpRequest();
//		xhttp.onreadystatechange = function() {
//			if (this.readyState == 4 && this.status == 200) {
//				let response= this.responseText;
//				const obj 	= JSON.parse(response);
//				
//				alert(response);
//				if (obj["success"] == 1) {
//					showform.style.display='none';	
//					shownote.style.display='inline';
//				}
//				document.getElementById("noted").innerHTML = obj["note"];
//				btnSub.innerHTML = 'Initiate';
//		   }
//		};
//    xhttp.open("GET", "script_reset_password.php?mail="+thismail, true);
//    xhttp.send();
//	
}
</script>
</body>

</html>