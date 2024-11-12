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
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../assets/img/logo.png" alt="Profile" class="rounded-circle">
              <h2><?= $app_acct_number; ?></h2>
              <h3><?= $app_acct_name; ?></h3>
              <h3><?= $app_acct_bank; ?></h3>
				<br/>
				<h3><strong><u>NOTE</u></strong></h3>
              <div class="alert alert-warning">We only except payment in Nigerian Naira</div>
				
			  <!-- Basic Modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Upload Proof Of Payment
              </button>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Proof Of Payment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
					<form enctype="multipart/form-data">  
                    <div class="modal-body">
						<div class="col-md-12">
                       		<input type="file" name="file" class="form-control">
						</div>
						<br/>
						<div class="col-md-12">
						  <label for="comment" class="form-label">Comment (Optional)</label>
							<textarea rows="3" name="comment" class="form-control" value=""></textarea>
						</div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
					</form>	
                  </div>
                </div>
              </div><!-- End Basic Modal-->
	
              </div>
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