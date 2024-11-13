<?php require_once('../includes/_conn.php'); ?>
<?php
$logo	= $app_website."/".$img_img.$app_image;
$subject = "Successful Password Reset";
$content = '
<html>
  <head>
<style>
.table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}


.button {
  background-color: #008CBA; /* Blue */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px;
  cursor: pointer;
  
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}

.button:hover {
  background-color: #4CAF50; /* Green */
  color: white;
}

</style>
  </head>
  <body>
	<span><img src="'.$logo.'" height="40" width="40"></span>
	<h3>Hey <span>'.$fullname.'</span>,</h3>

	<p>'.
			wordwrap("We are glad to welcome you on Nigeria	most trusted Instant & Automated digital recharge solution.")
	.'</p>
	
  <p>'.
		wordwrap("We have got lots of stuff to eliminate stress recharging your devices and in turn put some money in your wallet while doing so.")
	.'<p>
	
	<strong>Your login details are as follows:</strong>
		
	<table class="table" > 		  
		  <tr>
			<td width="40%">Password</td>
			<td width="60%"> <span>'.$password.'</span></td>
		  </tr>
		  <tr>
			<td>Account Type</td>
			<td>'.$account.'</td>
		  </tr>
  </table>
	  
	<p><span>'.$app_name.'<span> '.
		wordwrap("give you the instant and automated recharge of Airtime, Internet Data, Gotv, Dstv, Startimes, Electric Token,Smile Internet.")
	.'<p>

	<span>
		<a href="'.$app_website.'/php/" class="btn btn-success">
			Try it Now!
		</a>
	</span>
	<p>Our support team is standby to assist you whenever you need help.<p>
 	<strong>Email: </strong> <span>'.$app_email.'</span>
	<p>Warm Regards, <p>
	<span>'.$app_name.'</span>

 <hr style="border:none;border-top:1px solid #eee" />
	
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
		  <p><strong><span>&copy; ' .$app_title. ' </span></strong></p>
		  <p><span>' .$app_address. ' </span></p>
		</div>
  </div>
  </body>
</html>
'; 
//For testing purposes
// $msg = do_send_mail($app_email, "tankojunaidu@gmail.com", $subject, $content);
// echo $msg; 
// echo $content;
?>