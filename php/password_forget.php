<?php require_once('../includes/_conn.php'); ?>

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

  <style>
	#show_form{
		display: inline;		
	  }
	#show_note{
		display: none;
	  }
  </style>
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
                    <h5 class="card-title text-center pb-0 fs-4">Forget Password</h5>
                    <p class="text-center small">Enter your registered email below to initiate the password reset process.</p>
                  </div>
				  
				  <?php //if(isset($_POST['initiate'])) { ?>
				  <span id="show_note">
					  
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">Initiated</h4>
						<p>We have sent you an email with the Password Reset link, follow the link and reset your password.</p>
						<hr>
						   <p class="mb-0">If you did not find the email after some time, please re-initiate the password reset process <a href="password_forget.php">Here</a></p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					  </div>
					  
				  </span>
				  <?php //}else{ ?>
				  <span id="show_form"> 
						
					<p class="text-center small" id="noted"></p>  
					<form method="post" class="row g-3 needs-validation" novalidate>
                    
					  <div class="col-12">
                      <label for="email" class="form-label"> Email</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                      	<input type="email" name="email" class="form-control" id="email" required>
                      	<div class="invalid-feedback">Please enter a valid Email adddress!</div>
					  </div>
                    </div>
                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" onClick="resetPassword()" name="initiate" id="btn_submit" type="submit">Initiate</button>
                    </div>
					  
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                  </form>
					  
				  </span>
				  <?php //} ?>
					
                </div>
			</div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
				  Designed by <a target="_blank" href="<?= $app_dev_website; ?>"><?= $app_dev_name; ?></a>
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

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let response= this.responseText;
				const obj 	= JSON.parse(response);
				
				//alert(obj["note"]);
				if (obj["success"] == 1) {
					showform.style.display='none';	
					shownote.style.display='inline';
				}
				document.getElementById("noted").innerHTML = obj["note"];
				btnSub.innerHTML = 'Initiate';
		   }
		};
    xhttp.open("GET", "script_reset_password.php?mail="+thismail, true);
    xhttp.send();
	
}
</script>
</body>

</html>