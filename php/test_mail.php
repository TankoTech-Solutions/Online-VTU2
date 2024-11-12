<?php require_once('../includes/_conn.php'); ?>
<?php
			
					//--- Create verification OTP and send it to email.
					include("../mails/mail_otp.php");
					$err_mail = do_send_mail($app_email, "tankojunaidu@gmail.com", $subject, $content);

					echo $err_mail;

?>