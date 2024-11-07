<?php include('../includes/_conn.php'); ?>

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
              <h5 class="card-title">Electricity Bill Payment</h5>
              
              <!-- Custom Styled Validation -->
              <form method="post" class="row g-3 needs-validation" novalidate>
				  
				<div class="col-md-12">
                  <label for="network" class="form-label">Select Disco Name:</label>
                  <select name="network" class="form-select" id="network" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="ikeja-electric">Ikeja Electric</option>
                            <option value="eko-electric">Eko Electric</option>
                            <option value="abuja-electric">Abuja Electric</option>
                            <option value="kano-electric">Kano Electric</option>
                            <option value="portharcourt-electric">Port Harcout Electric</option>
                            <option value="ibadan-electric">Ibadan Electric</option>
                            <option value="kaduna-electric">Kaduna Electric</option>
                            <option value="jos-electric">Jos Electric</option>
                  </select>
                  <div class="invalid-feedback">Please select a network.</div>
                </div>
				  
				 <div class="col-md-12">
                  <label for="meterNumber" class="form-label">Meter Number</label>
                  <input name="meterNumbwer" type="number" class="form-control" id="meterNumbwer" value="" required>
                  <div class="invalid-feedback">Please enter valid meter number</div>
                </div>
				  
				<div class="col-md-12">
                  <label for="subsType" class="form-label">Subscription Type:</label>
                  <select name="subsType" class="form-select" id="subsType" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Prepaid</option>
                    <option>Postpaid</option>
                  </select>
                  <div class="invalid-feedback">Please select a valid data type.</div>
                </div>
				  
				<div  class="col-md-12">  
                  <label for="phone" class="form-label">Client Phone Number:</label>
				<div class="input-group mb-6">
                      <span class="input-group-text" id="basic-addon1">+234</span>
                      <input name="phone" type="text" class="form-control" placeholder="7012345678" aria-label="phone" aria-describedby="basic-addon1" required>
					<div class="invalid-feedback">Please a valid phone number.</div>
                  </div>
				  </div>
				 
				<div class="col-md-12">  
                  <label for="amount" class="form-label">Amount:</label>
				<div class="input-group mb-6">
                      <span class="input-group-text">₦</span>
                      <input name="amount" type="text" class="form-control" placeholder="0.00" aria-label="Amount (to the nearest naira)" required>
                      <span class="input-group-text">.00</span>
					<div class="invalid-feedback">Please wait for the amount to generate.</div>
                    </div>
				  </div>
				  
				  <div class="col-md-12"> 
				  <div class="form-check form-switch">
                      <input name="skipvalidation" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                      <label class="form-check-label" for="flexSwitchCheckChecked">Skip phone number validation</label>
                    </div>
				  </div>
				  
                <div class="col-12">
                  <button name="submit" id="btn" class="btn btn-primary" type="submit">Validate Meter</button>
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