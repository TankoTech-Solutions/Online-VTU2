<?php require_once('../includes/_conn.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$msg		= "";
$cook_user	= "";
$cook_pass	= "";

//Set/Unset remember me cookie
//if(isset($_POST["remember"])){
//	if(!isset($_COOKIE["cookie_user"])) {
//  		setcookie("cookie_user", 1, time() * 60 * 24, "/");
//	}else{
//		setcookie("cookie_user", "", time() - 3600);
//	}
//	if(!isset($_COOKIE["cookie_pass"])) {
//  		setcookie("cookie_pass", 1, time() * 60 * 24, "/");	
//	}else{
//		setcookie("cookie_pass", "", time() - 3600);
//	}
//	$cook_user = $_COOKIE["cookie_user"];
//	$cook_pass = $_COOKIE["cookie_pass"];
//}
  
if (isset($_POST['btnSubmit'])) { 
  $email	= tt_sensatize_input($conn, $_POST['email']);
  $password	= tt_sensatize_input($conn, $_POST['password']);
  $remember	= isset($_POST['remember']) ? "Yes" : "No";
 
  $LoginRS = mysqli_query($conn, "SELECT * FROM user WHERE email='".$email."' AND password='".md5($password)."'") 
	or die(mysqli_error($conn));
  	$loginFoundUser = mysqli_num_rows($LoginRS);
	
  if ($loginFoundUser == 1) { //echo "User found!";
    	extract(mysqli_fetch_array($LoginRS));
		
		if($status == 0) {		
			//Unverify account
			header("Location: verification.php");				 
			
		}else{
			//declare session variables and assign them
			$_SESSION['MM_ID']	 		= $user_id;
			$_SESSION['MM_Email']	 	= $email;
			$_SESSION['MM_Fullname']	= $fullname;
							 
			//Success redirection
			$msg = tt_alert(" Login Successfully.", 1);		
			header("Location: index.php");
		}						 
   				 
  }elseif($loginFoundUser > 1) {
  	//Failed redirection
	$msg = tt_alert(" OMG! There is a user complict in the system, please contect us.", 0);
  } else {
  	//Failed redirection
	$msg = tt_alert(" Ops! Invalid Email and/or Password. Please double check and try again.", 0);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - <?= $app_title; ?></title>
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
                    <h5 class="card-title text-center pb-0 fs-4"> Account Login</h5>
                    <p class="text-center small">Enter your  email & password to login</p>
					<?php if($msg != "") { echo $msg; } ?>
                  </div>

                  <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="email" class="form-label"> Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="email" required>
                        <div class="invalid-feedback">Please enter your valid email.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button name="btnSubmit" class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? 
						  <a class="link link-default" href="register.php">Create an account</a></p>
                      <p class="small mb-0">Forget your password? 
						  <a class="link link-default" href="password_forget.php">Reset it here</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
				  <div class="copyright">
					  Copyright &copy;<?= $app_copyright; ?> <strong><span><?= $app_title; ?></span></strong>. All Rights Reserved
					</div>
					<p align="center">
					  Designed by <a href="<?= $app_dev_email; ?>"><?= $app_dev_name; ?></a>
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