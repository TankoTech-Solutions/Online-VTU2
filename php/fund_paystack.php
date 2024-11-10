<?php require_once('../includes/_conn.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Terms And Conditions - <?= $app_title; ?></title>
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

  <!-- ======= Header ======= -->
	<?php include('../includes/inc_header.php'); ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
	<?php include('../includes/inc_sidebar.php'); ?>
  <!-- End Sidebar-->

  <!-- ======= Main ======= -->
  <main id="main" class="main">
	           
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Fund Wallet</h5>
              
              <!-- Custom Styled Validation -->
              <form method="post" class="row g-3 needs-validation" novalidate>
				  
				<div class="col-md-12">
                  <label for="payMethod" class="form-label">Payment Method:</label>
                  <select name="payMethod" class="form-select" id="payMethod" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Transfer</option>
                    <option>Card</option>
                    <option>USSD</option>
                  </select>
                  <div class="invalid-feedback">Please select your  prepared payment type.</div>
					<small class="text text-info">2% Charge apply</small>
                </div>
				
				<div class="col-md-12">  
                  <label for="amount" class="form-label">Amount:</label>
				<div class="input-group mb-6">
                      <span class="input-group-text">₦</span>
                      <input name="amount" type="text" class="form-control" placeholder="0.00" aria-label="Amount (to the nearest naira)" required>
                      <span class="input-group-text">.00</span>
					<div class="invalid-feedback">Please enter the valid amount.</div>
                    </div>
				  </div>
				  
				  <div class="col-md-12">  
                  <label for="charge" class="form-label">Charge:</label>
				<div class="input-group mb-6">
                      <span class="input-group-text">₦</span>
                      <input name="charge" type="text" class="form-control" placeholder="0.00" aria-label="Amount (to the nearest naira)" disabled required>
                      <span class="input-group-text">.00</span>
                    </div>
				  </div>
				  
			<div class="col-md-12">  
                  <label for="total" class="form-label">Total:</label>
				<div class="input-group mb-6">
                      <span class="input-group-text">₦</span>
                      <input name="total" type="text" class="form-control" placeholder="0.00" aria-label="Amount (to the nearest naira)" disabled required>
                      <span class="input-group-text">.00</span>
                    </div>
				  </div>
				  				  
                <div class="col-12">
                  <button name="submit" class="btn btn-primary" type="submit" onClick="this.innerHTML='Please Wait...'">Proceed</button>
                </div>
								 				  
                <div class="col-12">
                  <img src="../assets/img/paystack.webp" alt="">
				</div>
				  
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>


  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
	<?php include('../includes/inc_footer.php'); ?>
  <!-- End Footer -->

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>