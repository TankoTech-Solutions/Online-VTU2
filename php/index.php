<?php require_once('../includes/_conn.php'); ?>
<?php require_once('../includes/_restrict.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard -  <?= $app_title; ?></title>
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

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Account Balance Card -->
            <div class="col-xxl-12 col-md-12">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Wallet Balance <span>| Now</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-exchange"></i>
                    </div>
                    <div class="ps-3">
                      <h6>₦2104.62</h6>
                      <span class="text-success small pt-1 fw-bold">₦264</span> <span class="text-muted small pt-2 ps-1">Referal Balance</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Account Balance Card -->

            <!-- CusBank Account  Card -->
            <div class="col-xxl-6 col-xl-12">
              <div class="card info-card customers-card">

                <div class="card-body">
					<div style="position: absolute; left: 334px; top: 16px;">
						<img src="../assets/img/mastercard.png" width="62" height="34"/>						
					</div>	
                  <h5 class="card-title">Sterling Bank<span> | 1.08% Charge</span></h5>			
				
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <img src="../assets/img/bank_sterling_icon.png" width="60" height="60" /></i>
                    </div>
                    <div class="ps-3">
					  <a href="#" class="badge rounded-pill bg-info text-dark" onClick="copy()">Copy</a>
                      <h6 id="acctSterling">0116870025</h6>
						<span class="text-muted small pt-2 ps-1">Acct. Name:</span>
                      <span class="text-danger small pt-1 fw-bold">Junaidu Tanko Abdulrahman</span>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Bank Account Card -->
			  
            <!-- CusBank Account  Card -->
            <div class="col-xxl-6 col-xl-12">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <div style="position: absolute; left: 334px; top: 16px;"> <img src="../assets/img/mastercard.png" width="62" height="34"/> </div>
                  <h5 class="card-title">Wema Bank<span> | 1.08% Charge</span></h5>			
				
                  <div class="d-flex align-items-center">
                     <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <img src="../assets/img/bank_wema_icon.png" width="60" height="60" /></i>
                    </div>
                    <div class="ps-3">
					  <a href="#" class="badge rounded-pill bg-info text-dark" onClick="copy()">Copy</a>
						<h6 id="acctWema">0116870025</h6>
						<span class="text-muted small pt-2 ps-1">Acct. Name:</span>
                      <span class="text-danger small pt-1 fw-bold">Junaidu Tanko Abdulrahman</span>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Bank Account Card -->
		             
			<!-- Recent Activity -->
           <div class="card info-card customers-card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Voluptatem blanditiis blanditiis eveniet
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Voluptates corrupti molestias voluptatem
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">1 day</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 days</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Est sit eum reiciendis exercitationem
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4 weeks</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                  </div>
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Recent Activity -->
			  
          </div>
        </div><!-- End Left side columns -->

    </section>

  </main>
	<!-- End #main -->

  <!-- ======= Footer ======= -->
	<?php include('../includes/inc_footer.php'); ?>
  <!-- End Footer -->

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>