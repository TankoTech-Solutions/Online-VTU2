<?php require_once('../includes/_conn.php'); ?>
<?php
$noted = "";

$msg	= "";
$otp	= "";
$email	= $_SESSION['MM_Email'];
$user_id= $_SESSION['MM_ID'];
  
if (isset($_POST['btnSubmit'])) { 
  $otp	= tt_sensatize_input($conn, $_POST['otp']);
 
	if($otp=='' || empty($otp)){
	 	$noted = tt_alert(' OTP code is required!', 0); 
	}
	elseif(!is_numeric($otp)){
	 	$noted = tt_alert(' OTP code must be numeric only!', 0); 
	}
	elseif(strlen($otp) < 6 || strlen($otp) > 6){
	 	$noted = tt_alert(' OTP code must be 6-digits number! Please check.', 0); 
	}else{
	
		$query = mysqli_query($conn, "SELECT * FROM otp WHERE otp='".md5($otp)."' AND
  								user_id='".$user_id."' AND status='0'") or die(mysqli_error($conn));
	
	  $count = mysqli_num_rows($query);
	  if ($count == 1) { echo "Record found!";
			extract(mysqli_fetch_array($query));

			mysqli_query($conn, "UPDATE user SET status = '1' WHERE user_id = $user_id");
			mysqli_query($conn, "UPDATE otp SET status = '1' WHERE user_id = ".$user_id." AND otp = ".md5($otp));

				//--- Auto login
				$_SESSION['MM_ID']	 		= $user_id;
				$_SESSION['MM_Email']	 	= $email;
				$_SESSION['MM_Fullname']	= $fullname;
				$noted = tt_alert(' New account create successfully.', 1);

			//Success redirection
			header("Location: index.php");	
	  }elseif($count > 1) {
		//Failed redirection
		$msg = "<i class='fa fa-exclamation-circle'></i> OMG! There is user complict in the system, please contect us.";
	  } else {
		//Failed redirection
		$msg = "<i class='fa fa-exclamation-circle'></i> Ops! Invalid Email and/or Password. Please double check and try again.";
	  }
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Account Verification - <?= $app_title; ?></title>
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
			
			<!-- Received OPT -->
				<div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"> Account Verification</h5>
                    <p class="text-center small" id="noted">
						We have sent a 6-digit OTP to your email (<?= $_SESSION['MM_Email']; ?>), input it below to verify your account.
					 </p>	
					 <?php if($noted != "") { echo $noted; } ?>
                  </div>

                  <form method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label"> OTP Code:</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                      	<input type="number" name="otp" class="form-control" id="otp" value="<?= $otp; ?>" required>
                      	<div class="invalid-feedback">Please enter a valid 6-DIGITS OTP that we have sent to you!</div>
					  </div>
                    </div>
					
                    <div class="col-12">
                      <button name="btnSubmit" class="btn btn-primary w-100" id="btn_submit" type="submit">Verify</button>
                    </div>
					
                    <div class="col-12">
                      <p class="small mb-0">Don't received the  OTP? 
						  <a id="countdown" href="#">Wait 90 seconds</a>
						  <a id="resend" class="btn btn-default" href="#" onClick="resendOtp()">Resend</a>
						  <input type="hidden" name="email" id="email" value="<?= $_SESSION["MM_Email"]; ?>" required>
                      	
					  </p>
                    </div>
                  </form>
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
	
<!-- Display the countdown timer in an element -->
<script>
var countDown	= document.getElementById("countdown");
var resend		= document.getElementById("resend");
var countDownDate = new Date().getTime() + (60 * 9000); //Now plus 90 second.

countdown.style.display='inline';	
resend.style.display='none';	
	
// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;
  var seconds = Math.floor((distance % (1500 * 60)) / 1000);

  // Display the result in the element with id="demo"
  countDown.innerHTML = seconds + " seconds";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
	countdown.style.display='none';	
	resend.style.display='inline';	
  }
}, 1000);
	
//--	Resend OTP ajax.
function resendOtp(){
	var thismail 	= document.getElementById("email").value;
	var countDown	= document.getElementById("countdown");
	var resend		= document.getElementById("resend");
	var btnSub		= document.getElementById("btn_submit");

	countdown.style.display='inline';	
	resend.style.display='none';	
	btnSub.innerHTML = 'Please Wait...';
	//alert(thismail);
	
	var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			countdown.style.display='none';	
			resend.style.display='inline';	
            document.getElementById("noted").innerHTML = this.responseText;
			btnSub.innerHTML = 'Verify';
       }
    };
    xhttp.open("GET", "script_resend_otp.php?mail="+thismail, true);
    xhttp.send();
	
}
</script>
</body>

</html>