<?php require_once('../includes/_conn.php');?>

<?php
//--- WEBHOOK ENDPOINT CALLBACK

	$dateTime 	= new DateTime('now', new DateTimeZone('Africa/Lagos')); 
	$time		= $dateTime->format("d-M-y  h:i A");
//	$chek 		= mysqli_query($conn, "SELECT * FROM pay");
//	$pdata 		= mysqli_fetch_array($chek);
//	$mapi		= $pdata['mapi']; 	//Monnify API
//	$msk		= $pdata['msk'];	//Monnify Secrete Key
//	$clientSecret = $msk; 

	// Retrieve the request's body and parse it as JSON
     $raw_request = @file_get_contents("php://input");
 
	//Temporarily put the payload data to the text file
     file_put_contents("_webhook_transaction_complete.txt", $raw_request);
  
    // Do something with $event
    //$event = json_decode($raw_request);
	$response = json_decode($raw_request, true);
    //  print_r($response);

	//Now push each value to its assign variable
	if (!empty($response)) {            
          $res_hash 			= $response["eventData"]["transactionHash"];
          $res_email 			= $response["eventData"]["customer"]["email"];
          $res_amount_paid 		= $response["eventData"]["amountPaid"];                
          $res_trans_ref 		= $response["eventData"]["transactionReference"];
          $res_payment_status 	= $response["eventData"]["paymentStatus"];
          $res_paid_on 			= $response["eventData"]["paidOn"];
          $res_payment_ref 		= $response["eventData"]["paymentReference"];
		  $res_event_type		= $response["eventType"]	
			  
 		//--- Get relevant user details
		  $user_query 	= mysqli_query($conn, "SELECT * FROM user WHERE email = '".$res_email."'");
          $user_data  	= mysqli_fetch_array($user_query);
                     
          $user_id 		= $user_data['user_id'];
          $fullname		= $user_data['fullname'];
          $email		= $user_data['email'];
          $phone	 	= $user_data['phone'];
          $prev_balance	= $user_data['balance'];
          $charge		= "0"; //"50";
          $new_amount	= ceil($res_amount_paid - $charge);
          $new_balance 	= $prev_balance + $new_amount;
                  		
		//Set transaction hash
		  $transaction_hash	= MoSK."|$res_payment_ref|$res_amount_paid|$res_paid_on|$res_trans_ref";
          $verify_hash 		= hash('sha512', $transaction_hash);
		
 		if ($hash == $verify_hash) {
 			echo "Hash comparism successfull.";
			
          	if ($res_event_type == 'SUCCESSFUL_TRANSACTION') {
            	echo "Hash comparism successfull.";
				
				//whether ip is from the share internet  
				if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                      $ip = $_SERVER['HTTP_CLIENT_IP'];  
                }
				//whether ip is from the proxy  
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
                }
				//whether ip is from the remote address  
                else{  
                     $ip = $_SERVER['REMOTE_ADDR'];  
                }
				  
			  //Check whether ip is from monnify server
 				if( $ip == "35.242.133.146"){  
					echo "IP is from monnify server"
						;
                     if ($res_payment_status == "PAID") {
						 echo "Payment status is paid";
                                
                         //$ratio 		= 100/101.5;
                         //$ratio 		= "0"; //"50";
                         //$amount 		= $amount_paid - $ratio;
                         //$time_string 	= time();
                         $description 	= "Deposit transaction of ₦".$amount." by the user with email: ".$email." and name: ".$fullname." has been occured.";
                          
						 //NB: Avoid duplicate transaction (Double deposit)
						 $check_query=mysqli_query($conn,"SELECT * FROM deposit WHERE reference_no = '$res_trans_ref'");
        				 $check_row = mysqli_num_rows($check_query);
        
                         if($check_row > 0){
                              http_response_code(200);
                              exit();
                         }else{
                                   
                              //Add into the payers account
							 $add_sql = "INSERT INTO deposit (reference_no, user_id, fullname, amount, charge, status, description, date, method) 
							 VALUES ('$res_trans_ref', '$user_id', '$fullname', '$amount_paid','$amount','1','$description','$time','$description') "
							  $add_query = mysqli_query($conn, $add_sql);       
                                    
                              /////////fund user
    						  $str 		= "UPDATE user SET  balance = '$newbal' WHERE email = '$mnfy_email'";
                              $result 	= mysqli_query($conn, $str);
                                     
                              //  http_response_code(200);
                              http_response_code(200);
                                  exit();
                              }
                            
                          }else{
                                http_response_code(500);
                          }
                      }
                  }
            }
?>