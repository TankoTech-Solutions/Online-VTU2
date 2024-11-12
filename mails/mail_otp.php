<?php require_once('../includes/_conn.php'); ?>
<?php 
$subject = "Verification OTP";
$content = '
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:80%;padding:20px 0">
  
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
	  	<span>' .$app_title. ' </span>
	  </a>
    </div>
	
    <p style="font-size:1.1em">Hi <span> '.$fullname.',</span></p>
    <p>Thank you for choosing 
		<span> ' .$app_title. ' </span>. 
		Use the following OTP to complete your Sign Up procedures. Its valid only for 5 minutes, please hurry.
	</p>
	
	<p style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:15px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"> 
		<span>'.$otp_code.'</span>
	</p>
	
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">	<span> '.$otp_code.'</span></h2>
    	
		
    <hr style="border:none;border-top:1px solid #eee" />
	
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
		  <p><strong><span>&copy; ' .$app_title. ' </span></strong></p>
		  <p><span>' .$app_addess. ' </span></p>
		</div>
  </div>
</div>
';
    
//For testing purposes
// $msg = do_send_mail($app_email, "tankojunaidu@gmail.com", $subject, $content);
// echo $msg; 
// echo $content;
?>    