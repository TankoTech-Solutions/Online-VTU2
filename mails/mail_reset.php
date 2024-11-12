<?php require_once('../includes/_conn.php'); ?>
<?php

$otp_link= $app_website."/php/password_reset.php?view=".md5($otp_code);
$subject = "Password Reset Confirmation";
$content = '
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:80%;padding:20px 0">
  
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
	  	<span>' .$app_title. ' </span>
	  </a>
    </div> 
	
    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik,sans-serif;">
		<span> '.$fullname.' </span> did you request for password reset?
	</h1>                                        
       <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
           '.wordwrap("We cannot simply send you the old password because only you know it. However we can help you reset it, right now we have set you a unique OTP code to use and reset your password. You can follow the link below to initiate password reset or just abondan this email and keep using your old password.").'
	  	</p>
		
		<p>
			<a href="'.$otp_link.'" style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:15px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;"> 
				<span>Proceed To Reset</span>
			</a>
		</p>  
		<p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
			Best regards.
		</p>
		
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