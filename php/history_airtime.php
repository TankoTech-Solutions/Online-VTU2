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
            <div class="card-body">
              <h5 class="card-title">Airtime TopUp History</h5>
             
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Transaction ID</th>
                    <th>Recipient Number</th>
                    <th>Network</th>
                    <th>Plan Amount</th>
                    <th>Balance Before</th>
                    <th>Balance After</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Date / Time</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Unity Pugh</td>
                    <td>9958</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Theodore Duran</td>
                    <td>8971</td>
                    <td>Dhanbad</td>
                    <td>1999/04/07</td>
                    <td>97%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Kylie Bishop</td>
                    <td>3147</td>
                    <td>Norman</td>
                    <td>2005/09/08</td>
                    <td>63%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Willow Gilliam</td>
                    <td>3497</td>
                    <td>Amqui</td>
                    <td>2009/29/11</td>
                    <td>30%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Blossom Dickerson</td>
                    <td>5018</td>
                    <td>Kempten</td>
                    <td>2006/11/09</td>
                    <td>17%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Elliott Snyder</td>
                    <td>3925</td>
                    <td>Enines</td>
                    <td>2006/03/08</td>
                    <td>57%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Castor Pugh</td>
                    <td>9488</td>
                    <td>Neath</td>
                    <td>2014/23/12</td>
                    <td>93%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Pearl Carlson</td>
                    <td>6231</td>
                    <td>Cobourg</td>
                    <td>2014/31/08</td>
                    <td>100%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Deirdre Bridges</td>
                    <td>1579</td>
                    <td>Eberswalde-Finow</td>
                    <td>2014/26/08</td>
                    <td>44%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Tad Munoz</td>
                    <td>2902</td>
                    <td>Saint-Nazaire</td>
                    <td>2010/09/05</td>
                    <td>65%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Vivien Dominguez</td>
                    <td>5653</td>
                    <td>Bargagli</td>
                    <td>2001/09/01</td>
                    <td>86%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Carissa Lara</td>
                    <td>3241</td>
                    <td>Sherborne</td>
                    <td>2015/07/12</td>
                    <td>72%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Hammett Gordon</td>
                    <td>8101</td>
                    <td>Wah</td>
                    <td>1998/06/09</td>
                    <td>20%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Walker Nixon</td>
                    <td>6901</td>
                    <td>Metz</td>
                    <td>2011/12/11</td>
                    <td>41%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  
                  <tr>
                    <td>Grace Bishop</td>
                    <td>8340</td>
                    <td>Rodez</td>
                    <td>2012/02/10</td>
                    <td>4%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Haviva Hernandez</td>
                    <td>8136</td>
                    <td>Suwałki</td>
                    <td>2000/30/01</td>
                    <td>16%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                  <tr>
                    <td>Zelenia Roman</td>
                    <td>7516</td>
                    <td>Redwater</td>
                    <td>2012/03/03</td>
                    <td>31%</td>
                    <td>Curicó</td>
                    <td>2005/02/11</td>
                    <td>37%</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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