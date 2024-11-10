<?php require_once('../includes/_conn.php') ;?>

<?php
//--- WEBHOOK ENDPOINT CALLBACK

// I sets this text file to collect any error when ever webhook response occured
$myfile = fopen("_track_callback_response.txt", "w") or die("Unable to open track_callback_response.txt file!");
fwrite($myfile, "--- NEW TRANSACTION COMPLETE RESPONSE ---\n");

	$dateTime 	= new DateTime('now', new DateTimeZone('Africa/Lagos')); 
	$time		= $dateTime->format("d-M-y  h:i A");
	fwrite($myfile, $time."\n");
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
    fwrite($myfile, 'RESPOND: '.$response."\n");

	//Now push each value to its assign variable
	if (!empty($response)) {            
          $res_hash 			= $response["eventData"]["transactionHash"];
          $res_email 			= $response["eventData"]["customer"]["email"];
          $res_amount_paid 		= $response["eventData"]["amountPaid"];                
          $res_trans_ref 		= $response["eventData"]["transactionReference"];
          $res_payment_status 	= $response["eventData"]["paymentStatus"];
          $res_paid_on 			= $response["eventData"]["paidOn"];
          $res_payment_ref 		= $response["eventData"]["paymentReference"];
		  $res_event_type		= $response["eventType"];	
          $res_method 			= $response["eventData"]["product"]["type"];
			 
			  
 		//--- Get relevant user details
		  $user_query 	= mysqli_query($conn, "SELECT * FROM user WHERE email = '".$res_email."'");
          $user_data  	= mysqli_fetch_array($user_query);
                     
          $user_id 		= $user_data['user_id'];
          $fullname		= $user_data['fullname'];
          $email		= $user_data['email'];
          $phone	 	= $user_data['phone'];
          $prev_balance	= $user_data['balance'];
          $charge		= "0"; //"50";
          $new_amount	= ceil($res_amount_paid - $charge); //@deposit table
          $new_balance 	= $prev_balance + $new_amount; //@user's table
                  		
		//Set transaction hash
//		  $transaction_hash	= MoSK."|$res_payment_ref|$res_amount_paid|$res_paid_on|$res_trans_ref";
//          $verify_hash 		= hash('sha512', $transaction_hash);
		
		// monnify-signature is sent as an header to your webhook endpoint, we get the value and store in this variable.
		$signature = $_SERVER['HTTP_MONNIFY_SIGNATURE']; 
		
		// hash generated
		$computedHash = hash_hmac('sha512', $raw_request, MoSK); 
		//fwrite($myfile, "Signature: ".$signature."\n\n");
		//fwrite($myfile, "CompHash: ".$computedHash."\n");
		
		if( $computedHash == $signature) { 
 			fwrite($myfile, "Hash comparism successfull.\n");
			
          	if ($res_event_type == 'SUCCESSFUL_TRANSACTION') {
            	fwrite($myfile, "Event type is SUCCESSFUL_TRANSACTION.\n");
				
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
					fwrite($myfile, "IP is from monnify server\n");
					
                     if ($res_payment_status == "PAID") {
						 fwrite($myfile, "Payment status is paid\n");
                         
						 //Build description
                         $description 	= "Deposit transaction of ₦".$amount." by the user with email: ".$email." and name: ".$fullname." has been occured.";
                          
						 //NB: Avoid duplicate transaction (Double deposit)
						 $check_query=mysqli_query($conn,"SELECT * FROM deposit WHERE reference_no = '$res_trans_ref'");
        				 $check_row = mysqli_num_rows($check_query) or die(mysqli_error($conn));
        
                         if($check_row > 0){
							 fwrite($myfile, "Transaction already exist\n");
                              http_response_code(200);
                              exit();
                         }else{
							 
                              //Add into the payers account
							 $add_sql = "INSERT INTO deposit (reference_no, user_id, fullname, prev_amount, paid_amount, new_amount, charge_amount, status, description, date, method) 
							 VALUES ('$res_trans_ref', '$user_id', '$fullname', '$prev_balance', '$res_amount_paid' '$new_amount', '$charge_amount' ,'1','$description','$time','$res_method')";
							 if (mysqli_query($conn, $add_sql)) { 
									fwrite($myfile, "Insert deposit query executed successfull!\n");
								} else { 
									// Query failed 
									fwrite($myfile, "Error: ".$mysqli_error($conn)."\n"); 
								}   
							 
                              //--- Update user's balance
    						  $user_sql	= "UPDATE user SET  balance = '$new_balance' WHERE email = '$res_email'";
                              if (mysqli_query($conn, $db_user)) { 
									fwrite($myfile, "Update user balance query executed successfull!\n");
								} else { 
									// Query failed 
									fwrite($myfile, "Error: ".$mysqli_error($conn)."\n"); 
								}   
                                    
							 fwrite($myfile, "All transaction stages is successful.\n");
                              
							 //  http_response_code(200);
                              http_response_code(200);
                              exit();
						   }
						 
                         }else{
						 	fwrite($myfile, "Payment status is not paid!\n");
                          	http_response_code(500);
                         }
					
					}else{
						fwrite($myfile, "IP address if not from monnify server!\n");
                   	}
				
				}else{
					fwrite($myfile, "Event type is not SUCCESSFUL_TRANSACTION!\n");
                }
			
			}else{
				fwrite($myfile, "Hash comparism is not successful!\n");
            }
	}else{
		fwrite($myfile, "Response data is empty!\n");
	}

fwrite($myfile, "--- RESPONSE END ---\n");
fclose($myfile);
?>