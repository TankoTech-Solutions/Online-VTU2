<?php require_once('../includes/_conn.php'); ?>
<?php
	header('Content-Type: application/json');

	$noted[]	= "";
	$email 		= "";	

if (isset($_GET["mail"])) { 
	
	$email 		= tt_sensatize_input($conn, strtolower($_GET["mail"]));
	$user_id 	= get_value($conn, "user", "user_id", "email", $email);
	//echo '<script>alert('.$user_id.');</script>';
	
	if($email=='' || empty($email)){
	 	$noted['success'] = 0;
	 	$noted['note'] = tt_alert(" Email address is required!", 0);
	}
	elseif($user_id == ""){
		$noted['success'] = 0;
	 	$noted['note'] = tt_alert(" Your account is not recognized!, you may register again please.", 0);
	}
	elseif($check_user == 0){
		
		if($check_otp == 0) {
			
			//Delete existing otp
			$sql_delete = "DELETE FROM otp WHERE user_id = ".$user_id."";
				
			
			if($conn->query($sql_delete) === TRUE) {
				
				$add_date	= date("Y/m/d H:i A");
				$otp_code	= tt_random_number(6);
		
				//Insert and send the otp.
				$sql_otp = "INSERT INTO otp (user_id, otp, purpose, sent_via, date_time, status)
				VALUES ('".$user_id."', '".md5($otp_code)."',	'Password Reset', 'E-Mail', '".$add_date."', '0')";
				
				if($conn->query($sql_otp) === TRUE) {
			
					//--- Create verification OTP and send it to email.
					include("../mails/mail_reset.php");
					$err_mail = do_send_mail($app_email, $email, $subject, $content);

					if($err_mail == "") {

						//--- Refer dashboard page.			
						$_SESSION['MM_ID']	 	= $user_id;			
						$_SESSION['MM_Email']	= $email;	
						
						$noted['success'] = 1;
	 					$noted['note'] = tt_alert(" A 6-digits OTP has been resend to your email (".$email."), use it to verify your account please.", 1);
					}else{ 
						$noted['success'] = 0;
	 					$noted['note'] = $err_mail; //Show failed email error (Already formatted with tt_alert)
					}
				}else{
					$noted['success'] = 0;
	 				$noted['note'] = tt_alert(" Failed to generate new and resend the OTP! ".$conn->error, 0);
				}
			}else{
				$noted['success'] = 0;
	 			$noted['note'] = tt_alert(" Error process resending OTP! please try again.", 0);
			}
		}else{
			$noted['success'] = 0;
	 	$noted['note'] = tt_alert(" Error resending OTP! Old OTP not found.", 0);
		}
	}else{
		$noted['success'] = 0;
	 	$noted['note'] = tt_alert(" Error resending OTP! Customer not found.", 0);
	} 
}else{
	$noted['success'] = 0;
	$noted['note'] = tt_alert(" You must enter Email Address!", 0); 
}//end if form submit

echo json_encode($noted);

?>