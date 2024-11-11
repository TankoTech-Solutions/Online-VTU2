<?php 

//This will logout users	
function do_logout($sess_id, $sess_code, $redir_page)
{
	if (isset($_SESSION[$sess_id])) {
		$_SESSION[$sess_id]='';
		unset($_SESSION[$sess_id]);
		session_unregister($sess_id);
	}
	if (isset($_SESSION[$sess_code])) {
		$_SESSION[$sess_code]='';
		unset($_SESSION[$sess_code]);
		session_unregister($sess_code);
	}
		
	header('Location: '.$redir_page);
	exit;
}	

//Ensuring Maximun Security (Escaped SQL-Injection)
function tt_maximize_security() {
	if (!get_magic_quotes_gpc()) {
		if (isset($_POST)) {
			foreach ($_POST as $key => $value) {
				$_POST[$key] =  trim(addslashes($value));
			}
		}
		
		if (isset($_GET)) {
			foreach ($_GET as $key => $value) {
				$_GET[$key] = trim(addslashes($value));
			}
		}	
	}
}

//Clean and sensatize user's input to escape SQL Injection or other Input Attacks.
function tt_sensatize_input($conn, $val) {

	tt_maximize_security();

	$val = trim($val);
	if(is_string($val)){
		$val = mysqli_real_escape_string($conn, $val);
		$val = htmlentities($val);
		#$val = htmlspecialchars($val);
		$val = addslashes($val);
	}
	return $val;
}

// Format home phone no. to international number
function get_intl_phone($num) {
	$intl_code	= "+234";
	$intl_no	= "";
	if(strlen($num) == 11) {
		$intl_no = preg_replace('/^0/', $intl_code, $num);
		return $intl_no;
	}elseif(strlen($num) == 14) {
		return $num;
	}else{
		return 0;	//Online
	}
}

// Check if the site is online or offline
function get_host_state() {
	$this_host	= $_SERVER['REMOTE_ADDR'];
	$this_array = array('localhost', '127.0.0.1', '192.168.0.0', '::1');
	if(in_array($this_host, $this_array)) {
		return true; 	//Offline
	}else{
		return false;	//Online
	}
}

//Return Title Case String 
function tt_case_title($str=NULL) 
{
	 if (empty($str))
		return false;
	$str = strtolower($str);
	$strs_array = explode('-',$str);
	for ($i = 0; $i < count($strs_array); $i++) {	
		if (strncmp($strs_array[$i],'mc',2) == 0 || preg_match('/^[oO]\'[a-zA-Z]/',$strs_array[$i])) 
		{
			$strs_array[$i][2] = strtoupper($strs_array[$i][2]);
		}
		$strs_array[$i] = ucfirst($strs_array[$i]);
	}
	$str = implode('-',$strs_array);
	return ucwords($str);
}

//Return error formatted alert 
function tt_alert($str, $flag) 
{
	//$flag value tells the alert type (Danger or Success)
	$alert = '';
	 if (empty($str))
		return false;
		
	if($flag == 1){ //Success
		$alert = '<div class="alert alert-success" role="alert"><i class="fa fa-info-circle"></i> '.$str.'</div>';
	}elseif($flag == 2){ //Warning
		$alert = '<div class="alert alert-warning" role="alert"><i class="fa fa-info-circle"></i> '.$str.'</div>';
	}else{	//Error
		$alert = '<div class="alert alert-danger" role="alert"><i class="fa fa-info-circle"></i> '.$str.'</div>';
	}
	return $alert;
}

//Return error formatted alertbox 
function tt_alert_box($str, $flag) 
{
	//$flag value tells the alert type (Danger or Success)
	$alert = '';
	 if (empty($str)) return false;
		
	if($flag == 1){ //Success
		$alert = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">
		×</button><strong> '.$str.'</strong></div>';
	}elseif($flag == 2){ //Warning
		$alert = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">
		×</button><strong> '.$str.'</strong></div>';
	}else{	//Error
		$alert = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">
		×</button><strong> '.$str.'</strong></div>';
	}
	return $alert;
}

//Get single value
function get_value($conn, $table, $field, $wField, $wValue) {	
	$sql 	= mysqli_query($conn, "SELECT ".$field." FROM ".$table." WHERE ".$wField." = '".$wValue."'");

	if(mysqli_num_rows($sql) > 0){
		$row 	= mysqli_fetch_assoc($sql);
		return $row[$field];
	}	
	return "";
}

//Check if their is banning?
function isBanned($getBan) {	
		$msg	= "";
		$sql 	= mysqli_query($conn, "SELECT * FROM bankpayment WHERE id ='$getBan'");

		if(mysqli_num_rows($sql) > 0){
			$ade 	= mysqli_fetch_assoc($sql);
		}
		$username 	= $ade['username'];

		if (empty($username)) {
			$msg=tt_alert_box('The username is empty!', 2);
		}else{
			mysqli_query($conn, "UPDATE bankpayment SET status=2 WHERE id = '$getBan'");
			$msg= tt_alert_box('Successful Banned.', 1);
		}	
	return $msg;
}

//Check deletion
function isDelete($getDel){
	$msg = "";
	$sql = mysqli_query($conn, "SELECT * FROM transactions WHERE id ='$getDel'");
	
	if(mysqli_num_rows($sql) > 0) {
		$ade = mysqli_fetch_assoc($sql);
	}
	
	$username = $ade['username'];
	
	if (empty($username)) {
		$msg1 = tt_alert_box('The username is empty!', 2);
	} else {
		mysqli_query($conn, "DELETE FROM transactions  WHERE id = '$id'");
	
		if (mysqli_query($conn, $query)) {
			$msg = tt_alert_box('Successful Deleted.', 1);
		}
	}
	return $msg;
}

//Check change
function isChange($getChange) {
    $sql = mysqli_query($conn, "SELECT * FROM transactions WHERE id ='$getChange'");
    
	if(mysqli_num_rows($sql) > 0) {
      $ade = mysqli_fetch_assoc($sql);
    }
    $username = $ade['username'];
    $price = $ade['amount'];
    $plan = $ade['plans'];
	
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    
	if(mysqli_num_rows($sql) > 0) {
      $usem = mysqli_fetch_assoc($sql);
    }
    $bal = $usem['bal'];
    $add = $bal + $price;
    $msg1 = "";
    
	if (empty($price)) {
      $msg = tt_alert_box('There is no Price Admin', 2);
    } else {
      mysqli_query($conn, "UPDATE user SET bal = '$add'  WHERE username = '$username'");
      mysqli_query($conn, "UPDATE transactions SET status =0  WHERE id = '$id'");

      $msg = tt_alert_box('Successful.', 1);
    }
	
	return $msg;
}

/*/Return current active page
function set_active($active)
{
	$set	= explode('?', basename($active));	
	switch($set[0])
	{
		case 'index.php';
			return 1;
			break;
		case 'programme.php';
			return 2;
			break;
		case 'courses.php';
			return 3;	
			break;
		case 'student.php';
			return 4;	
			break;
		case 'aboutus.php';
			return 5;	
			break;
		case 'help.php';
			return 6;	
			break;
		case 'price.php';
			return 7;	
			break;				
		default: return 0;	
	}
} */

//Return current active page
function set_active($active, $page)
{
	$setter		= explode('?', basename($active));
	$this_page	= $setter[0];
	if($this_page == $page)
	{
		return 'active';
	}else{
		return '';
	}
}

//Generate random strings
function tt_random_string($count) 
{
	$chars = "abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= $count) {
		$num 	= rand() % 33;
		$tmp 	= substr($chars, $num, 1);
		$pass  .= $tmp;
		$i++;
	}
	return $pass;
}

//Generate random number (OTP)
function tt_random_number($count) 
{
	$chars = "0123456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$otp = '' ;
	while ($i <= $count) {
		$num 	= rand() % 33;
		$tmp 	= substr($chars, $num, 1);
		$otp  .= $tmp;
		$i++;
	}
	return $otp;
}

//Upload picture file to the server.
function tt_upload_picture($conn, $_file, $new_dir, $new_name, $new_height, $sql) 
{	
	//Validate file upload field to be sure that the user attached a file.
		if ($_FILES[$_file]['name'] != "" and isset($_FILES[$_file])) {
        	
			/* Variables Declaration and Assignments */
			$imagename 		= $_FILES[$_file]["name"];					//Name that attached to $_file array.
			$imagetmp_name 	= $_FILES[$_file]['tmp_name'];				//Temporary address's name in the memory.
			$file_size 		= filesize($_FILES[$_file]['tmp_name']);	//Size of the temporary file that is in the memory.
			$file_ext 		= pathinfo($imagename, PATHINFO_EXTENSION);	//Extension of file (file type).
			$max_size 		= 3096*3096; 								//Maximum allowed file size. (Defualt: unknown)
			$name_path		= $new_dir.$new_name;						//File path and name together with it's extension.
	
		//Validate attached file for allowed file extension (type)
        if ($file_ext	!= "GIF"	&& $file_ext	!= "gif" 	&& $file_ext	!= "JPG" && $file_ext != "jpg" &&
			$file_ext	!= "JPEG" 	&& $file_ext	!= "jpeg" 	&& $file_ext	!= "PNG" && $file_ext != "png") 
			{
			return tt_alert('Invalid file type. Use .jpg, .jpeg or .gif!', 0);
		//Validate attached file to avoid large files
  		}elseif ($file_size > $max_size) { 
			return tt_alert('Picture is too big! Most be less than or equal to 2MB!', 0);
		}else{
			/* Create images based on their file types */
			if(in_array($file_ext, array("gif", "GIF"))) {
				$image_src = imagecreatefromgif($imagetmp_name); 
			}elseif(in_array($file_ext, array("jpg", "JPG", "jpeg", "JPEG"))) {
				$image_src = imagecreatefromjpeg($imagetmp_name);
			}elseif(in_array($file_ext, array("png", "PNG"))) {
				$image_src = imagecreatefrompng($imagetmp_name);
			}
			
			//Get  and store temp image width and height in the '$define...' variables.
			list($definewidth, $definehight) = getimagesize($imagetmp_name);
			
			//Resizes the image height to the set level. NOTE: This may generate division by 0 error  
			if(@($definehight/$definewidth) <= 0 ) { 
				return tt_alert('Division by zero error! Resize you picture and try again!', 0);
			}else{
				$image_new_height 	= ($definehight/$definewidth)*$new_height;
				$image_tmp 			= @imagecreatetruecolor($new_height,$image_new_height);
			}
				
			//Resize the image file
			imagecopyresampled($image_tmp, $image_src,0,0,0,0, $new_height, $image_new_height, $definewidth, $definehight);
				
			//Validate new file's path (Directory).
			if($name_path==''){
				return tt_alert('You most supply 2nd parameter (New directory that will point the picture)!', 0);
			}else{  
				//If already file exists, delete it first.
				if(file_exists($name_path)){
					unlink($name_path); 
				}
				
				//Upload the images to the directory.
				imagejpeg($image_tmp, $name_path, 100);
				//You can also use below single line to upload any file.
				//move_uploaded_file($fileTempName, $newPath.$newName);
				
				//Update database with new picture name (optional). 
				if($sql!=NULL and $sql!='') {         
					$conn->query($sql) or die("Not upload picture: ".mysqli_error($conn));
				} //echo $sql;
				
				//Destroy the temp file after uploaded to free up buffered space.
				imagedestroy($image_src);
				imagedestroy($image_tmp);
			
				//Succeeded.
				return tt_alert('New Picture Updated Successfully!', 1);
				} 
			}

	}else{
		return tt_alert('Please, Browse your picture before upload!', 0);
	}
}

//Restrict Access To Page: Grant or deny access to this page
function tt_restric_page_access($session_uid, $redirect_page) {
	if (!isset($session_uid) || empty($session_uid)) {
		header("Location: ".$redirect_page);
		exit;
	}
}

//Get string initials letter
function tt_get_initials($str) {
	$words = explode(' ', $str);
	$acronym = "";
	
	foreach($words as $word) 
	{
		$acronym .= strtoupper($word[0]);
	}
	return $acronym;
}
 
//Trim long sreing into short
function tt_str_trim($str, $count, $url) {
		
        $words = explode(" ", $str);
		if(count($words) > $count) 
			{ 
				$words = array_splice($words,0,$count);       
        		$str = implode(" ",$words);
				if($url){
					$str .= ' ... <a href="'.$url.'">More</a>';
				}else{	
					$str .= ' ...';
				}
				return $str;
			} else {
				return $str;
			}
}
 
//function to send email
function do_send_mail($from, $to, $subj, $msg) {
	include('Mail.php'); // includes the PEAR Mail class, already on your server.
	
	//The email headers	
	$cont_type	= "text/html; charset=UTF-8\r\n";
	$headers 	= array ('From' => $from, 'To' => $to, 'Subject' => $subj, "Content-Type" => $cont_type); 
	
	// SMTP protocol with the username and password of an existing email account in your hosting account
	$smtp = Mail::factory('smtp', array ('host'=>'localhost', 'auth'=>true, 'username'=>MAIL_USER, 'password'=>MAIL_PASS, 'port'=>'25'));
	//Do send mail
	$mail = $smtp->send($to, $headers, wordwrap($msg));
	
	if (PEAR::isError($mail)){
		return tt_alert('Email error : '.$mail->getMessage(), 0);
	}else {
		return "";
		//return tt_alert('Email sent successfully.', 1);
		// header("Location: http://www.example.com/"); // you can redirect page on successful submission.
	}
}

//function to send email
function do_send_mail_01($from, $to, $subj, $msg) {
	$header 	= "From: ".$from."\r\n";
	$header 	.= "MIME-Version: 1.0\r\n";
	$header 	.= "Content-type: text/html\r\n";
	$do_send 	= mail($to, "Subject: ".$subj, wordwrap($msg), $header);
}
	///////////////FURTHER STUDY////////////
/* Create the paging links */
function getPagingNav($conn, $sql, $pageNum, $rowsPerPage, $queryString = '')
{
	$result	= $conn->query($sql) or die("Page Navigation SQL Error: ".mysqli_error($conn));
	$numrows= $result->num_rows;			//Get number of rows found.	
	$row 	= $result->fetch_assoc();		//Get rows.
	//$numrows= $row['numrows'];
	$maxPage = ceil($numrows/$rowsPerPage); // how many pages we have when using paging?
	
	//$self = $_SERVER['PHP_SELF'];
	
	// creating 'previous' and 'next' link, plus 'first page' and 'last page' link //
	
	// print 'previous' link only if we're not on page one.
	if ($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev = " <a href=\"$self?page=$page{$queryString}\">[Previous]</a> ";
		$first = " <a href=\"$self?page=1{$queryString}\">[First]</a> ";
	}
	else
	{
		$prev  = ' [Previous] ';       	// we're on page one, don't enable 'previous' link
		$first = ' [First] '; 			// nor 'first page' link
	}
	
	// print 'next' link only if we're not on the last page
	if ($pageNum < $maxPage)
	{
		$page = $pageNum + 1;
		$next = " <a href=\"$self?page=$page{$queryString}\">[Next]</a> ";
		$last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Last Page]</a> ";
	}
	else
	{
		$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
		$last = ' [Last] '; // nor 'last page' link
	}
	
	// return the page navigation link
	return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 
}

?>
