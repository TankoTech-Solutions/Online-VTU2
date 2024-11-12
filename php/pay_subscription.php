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
              <h5 class="card-title">Cables Subscription</h5>
              
              <!-- Custom Styled Validation -->
              <form method="post" class="row g-3 needs-validation" novalidate>
				  
				<div class="col-md-12">
                  <label for="cableName" class="form-label">Cable Name:</label>
                  <select name="cableName" class="form-select" id="cableName" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="gotv">GOTV</option>
					<option value="dstv">DSTV</option>
					<option value="startimes">STARTIME</option>
					<option value="showmax">SHOWMAX</option>
                  </select>
                  <div class="invalid-feedback">Please select the TV Cable type.</div>
                </div>
				  
				 <div class="col-md-12">
                  <label for="cardNumber" class="form-label">Smart Card Number / IUC Number</label>
                  <input name="cardNumber" type="number" class="form-control" id="cardNumber" value="" required>
                  <div class="invalid-feedback">Please enter valid start card number of your cable type.</div>
                </div>
				  
				<div class="col-md-12">
                  <label for="subsPlan" class="form-label">Subscription Plan:</label>
                  <select name="subsPlan" class="form-select" id="subsPlan" required>
                    <option selected disabled value="">Choose...</option>
					  
					<!-- DSTV -->	  
                      <option value="dstv-padi" class="dstv" style="">DStv Padi N2,150 N2150</option> 
					  <option value="dstv-yanga" class="dstv" style="">DStv Yanga N2,950 N2950</option> 
					  <option value="dstv-confam" class="dstv" style="">Dstv Confam N5,300 N5300</option> 
					  <option value="dstv79" class="dstv" style="">DStv  Compact N9,000 N9000</option> 
					  <option value="dstv3" class="dstv" style="">DStv Premium N21,000 N21000</option> 
					  <option value="dstv6" class="dstv" style="">DStv Asia N7,100 N7100</option> 
					  <option value="dstv7" class="dstv" style="">DStv Compact Plus N14,250 N14250</option> 
					  <option value="dstv6" class="dstv" style="">DStv Premium-French N29,300 N29300</option> 
					  <option value="dstv10" class="dstv" style="">DStv Premium-Asia N23,500 N23500</option> 
					  <option value="confam-extra" class="dstv" style="">DStv Confam + ExtraView N8,200 N8200</option>
					  <option value="yanga-extra" class="dstv" style="">DStv Yanga + ExtraView N5,850 N5850</option> <option value="padi-extra" class="dstv" style="">DStv Padi + ExtraView N5,050 N5050</option> 
					  <option value="com-asia" class="dstv" style="">DStv Compact + Asia N16,100 N16100</option> 
					  <option value="dstv30" class="dstv" style="">DStv Compact + Extra View N11,900 N11900</option> 
			<option value="com-frenchtouch" class="dstv" style="">DStv Compact + French Touch N11,650 N11650</option> 
					  <option value="dstv33" class="dstv" style="">DStv Premium + Extra View N23,900 N23900</option> <option value="dstv40" class="dstv" style="">DStv Compact Plus + Asia N21,350 N21350</option>
					  <option value="com-frenchtouch-extra" class="dstv" style="">
						  DStv Compact + French Touch + ExtraView N14,550 N14550 </option> 
					  <option value="com-asia-extra" class="dstv" style="">
						  DStv Compact + Asia + ExtraView N19,000 N19000</option> 
					  <option value="dstv43" class="dstv" style="">
						  DStv Compact Plus + French Plus N23,550 N23550</option> 
					  <option value="complus-frenchtouch" class="dstv" style="">
						  DStv Compact Plus + French Touch N16,900 N16900</option> 
					  <option value="dstv45" class="dstv" style="">
						  DStv Compact Plus + Extra View N17,150 N17150</option> 
					  <option value="complus-french-extraview" class="dstv" style="">
						  DStv Compact Plus + FrenchPlus + Extra View N26,450 N26450</option> 
					  <option value="dstv47" class="dstv" style="">DStv Compact + French Plus N18,300 N18300</option> 
					  <option value="dstv48" class="dstv" style="">
						  DStv Compact Plus + Asia + ExtraView N24,250 N24250</option> 
					  <option value="dstv61" class="dstv" style="">
						  DStv Premium + Asia + Extra View N31,000 N31000</option> 
					  <option value="dstv62" class="dstv" style="">
						  DStv Premium + French + Extra View N28,000 N28000</option> 
					  <option value="dstv-cplus-movie-addon" class="dstv" style="">
						  DStv Compact Plus Movie Bundle Add-on E36 - N2,500 N2500</option> 
					  <option value="frenchplus-addon" class="dstv" style="">
						  DStv French Plus Add-on N9,300 N9300</option> 
					  <option value="asia-addon" class="dstv" style="">DStv Asian Add-on N7,100 N7100</option> 
					  <option value="dstv-movie-addon" class="dstv" style="">DStv Movie Bundle Add-on E36 - N2,500 N2500</option> 
					  <option value="frenchtouch-addon" class="dstv" style="">DStv French Touch Add-on N2,650 N2650</option> 
					  <option value="extraview-access" class="dstv" style="">ExtraView Access N2,900 N2900</option> <option value="french11" class="dstv" style="">DStv French 11 N4,100 N4100</option> 
					  <option value="gotv-max" class="gotv" style="display: none;">GOtv Max N4,150 N4150</option> 
					  <option value="gotv-jolli" class="gotv" style="display: none;">GOtv Jolli N2,800 N2800</option> 
					  <option value="gotv-jinja" class="gotv" style="display: none;">GOtv Jinja N1,900 N1900</option> 
					  <option value="gotv-smallie" class="gotv" style="display: none;">
						  GOtv Smallie - monthly N900 N900</option> <option value="gotv-smallie-3months" class="gotv" style="display: none;">GOtv Smallie - quarterly N2,400 N2400</option> 
					  <option value="gotv-smallie-1year" class="gotv" style="display: none;">
						  GOtv Smallie - yearly N7,000 N7000</option> 
					  <option value="gotv-supa" class="gotv" style="display: none;">
						  GOtv Supa - monthly N5,500 N5500</option> 
					  <option value="nova" class="startimes" style="display: none;">
						  Nova - 900 Naira - 1 Month N899</option> 
					  <option value="nova" class="startimes" style="display: none;">
						  Nova - 900 Naira - 1 Month N900</option> 
					  <option value="basic" class="startimes" style="display: none;">Basic (Antenna) - 1,850 Naira - 1 Month N1850</option> 
					  <option value="smart" class="startimes" style="display: none;">Smart (Dish) - 2,600 Naira - 1 Month N2600</option> 
					  <option value="classic" class="startimes" style="display: none;">Classic (Antenna) - 2,750 Naira - 1 Month N2750</option> 
					  <option value="super" class="startimes" style="display: none;">Super (Dish) - 4,900 Naira - 1 Month N4900</option> 
					  <option value="nova-weekly" class="startimes" style="display: none;">Nova - 300 Naira - 1 Week N300</option> 
					  <option value="basic-weekly" class="startimes" style="display: none;">Basic (Antenna) - 600 Naira - 1 Week N600</option> 
					  <option value="smart-weekly" class="startimes" style="display: none;">Smart (Dish) - 700 Naira - 1 Week N700</option> 
					  <option value="classic-weekly" class="startimes" style="display: none;">Classic (Antenna) - 1200 Naira - 1 Week N1200</option> 
					  <option value="super-weekly" class="startimes" style="display: none;">Super (Dish) - 1,500 Naira - 1 Week N1500</option> 
					  <option value="nova-daily" class="startimes" style="display: none;">Nova - 90 Naira - 1 Day N90</option> 
					  <option value="basic-daily" class="startimes" style="display: none;">Basic (Antenna) - 160 Naira - 1 Day N160</option> 
					  <option value="smart-daily" class="startimes" style="display: none;">Smart (Dish) - 200 Naira - 1 Day N200</option> 
					  <option value="classic-daily" class="startimes" style="display: none;">Classic (Antenna) - 320 Naira - 1 Day N320</option> 
					  <option value="super-daily" class="startimes" style="display: none;">Super (Dish) - 400 Naira - 1 Day N400</option> 
					  <option value="full" class="showmax" style="display: none;">Full - N2,900 N2900</option> 
					  <option value="mobile_only" class="showmax" style="display: none;">Mobile Only - N1,450 N1450</option> 
					  <option value="sports_full" class="showmax" style="display: none;">Sports Full - N6,300 N6300</option> 
					  <option value="sports_mobile_only" class="showmax" style="display: none;">Sports Mobile Only - N3,200 N3200</option>
					  					
					<!-- GO TV -->
					    
					<!-- StarTime -->  
             
					<!-- ShowMax -->
          			

                        </select>		  
					  
					  
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