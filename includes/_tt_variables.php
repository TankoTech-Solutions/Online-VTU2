<?php
//**********************//
// VARIABLE DECLARATION //
//******* **************//

//Settings Variables (Setting's Data)
	//$newslimit		= 3; 					//Number of news to display at a time.
	$cookies_life		= time()+(365*24*60*60);//Cookie maximum life time (1 year)
	$session_life		= time() + (30 * 60);	//After 30 minutes of inactivity session will expire.
	$self				= $_SERVER['PHP_SELF'];	//Form submit to itself.
	$redirect_after_update = true; 				//Redicted to item preview page after item updated successfully.
	$select_start_year	= 1999; 				//Gregorian year start value in the select field.
	if (isset($_SERVER['HTTPS']) == 'on') { 	//Autimate SSL and off-SSL certificate of the host name.
		$HTTP = 'https://';
	} else {
		$HTTP = 'http://';
	}
	$show_disabled_program	= false;	
	$view_records_count		= 15;		//Pagination
	$view_pages_count		= 5;		//Pagination
	$max_view				= 10;		//Pagination
	$imgP_height			= 600; 		//This define the height og the each picture to be upload as USER/ADMIN profile.
	$imgG_height			= 800; 		//This define the height og the each picture to be upload as GALLERY profile.
	$imgN_height			= 600; 		//This define the height og the each picture to be upload as NEWS profile.
	
//Prices Variables Declaration (Setting's Data)
	$appBanks			= "Zenith Bank";
	$price_app_form		= 1000;
	$price_exam_sit		= 2000;	
	$price_exam_resit	= 500; //per course	
	$price_scratch_apply = 1000;
	$price_scratch_reg	= 1000;
	$price_id_card		= 1000;
	$clear_amount		= 10000;	//Ten Thausand
	
//Directory Variables Declaration
	$site_root		= $HTTP.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'])."/";
	$img_upload 	= "assets/upload/";
	$img_img 		= "assets/img/";
	
//Files Variables Declaration 
	$img_admin_passpot	= $img_img."admin_passport.jpg";
	$img_defualt		= $img_img.'_defualt.jpg'; 				//student's directory
	$img_avatar			= 'images/Avatar.jpg'; 					//admin's directory
	$defualt_gallery	= $img_img.'img_defualt.jpg'; 			//gallery defualt's directory
	$pdf_temp_file		= $site_root.'/admission_letter.php';	//temp directory for the generated pdf file.
	$pdf_temp_file_test	= 'http://www.google.com';				//temp directory for the generated pdf file.
	$img_ok 			= '<img src="images/_mark.png" id="img_icon"/>';
  	$img_no 			= '<img src="images/_cancle.png" id="img_icon"/>';
	$dir_qr_code		= $site_root."/admission_letter.php?uid=";	//Embedded into QR code
	$dir_qr_link		= $site_root."/print_certificate.php?sID=";	//Embedded into QR code
	#$dir_qr_link		= APP_HOST_URL."/print_certificate.php?uid=";	//Embedded into QR code

	
//TankoTech Special Directories
	$online_host		= "https://www.tankotech.com.ng/";		//TankoTech sourse domain
	$online_portal		= $online_host."index.php";				//Portal home
	$online_projects	= $online_host."project/";				//Computer students projects
	$online_solutions	= $online_host."#";						//Premium software/website projects
	$online_pos			= $online_host."#";						//POS Services directory
	$online_school 		= "index.php";							//TankoTech Computer Training School
	$online_school_admin = "admin/";//TankoTech Computer Training School administrater
	$offline_host		= "localhost/";							//TankoTech sourse domain
	$offline_portal		= "../TankoTechPortal/";		//Computer students projects
	$offline_projects	= "../TankoTechnology/";		//Computer students projects
	$offline_solutions	= "#";					//Premium software/website projects
	$offline_pos		= "#";					//POS Services directory
	$offline_school 	= "index.php";	//TankoTech Computer Training School
	$offline_school_admin = "admin/"; //TankoTech Computer Training School administrater
	
//TankoTech Social Network Addresses
	$twitter	= 'https://twitter.com/tankotech';
	$facebook	= 'https://www.facebook.com/TankoTech/';
	$linkedin	= 'https://www.linkedin.com/in/tankotech-solutions-958347193/';
	$youtube	= 'https://www.youtube.com/channel/UCvD9zPLX1abSSrnE8VNC9aw/';
	$intagram	= '#';
	$gmail		= 'mailto:tankotechsolutions@gmail.com';
	
//Strings word
$no_access		= '<div id="error">You don\'t have privilege to view this page! Contact super admin please.</div>';	
$str_most_fill	= '<i class="fa fa-info-circle"></i> All fields with * must be filled!';			
?>