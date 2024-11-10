<?php require_once('../includes/_conn.php');?>

<?php
//--- WEBHOOK ENDPOINT CALLBACK

# Monnify Webhooks  ✨

// IP Whitelist - Verify IP address against monnify IP  35.242.133.146
$ip = ($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$_SERVER['REMOTE_HOST'];
if( $ip != "35.242.133.146") die("Invalid IP");

// get raw json request string 
//{"eventData":{"product":{"reference":"111222333","type":"OFFLINE_PAYMENT_AGENT"},"transactionReference":"MNFY|76|20211117154810|000001","paymentReference":"0.01462001097368737","paidOn":"17/11/2021 3:48:10 PM","paymentDescription":"Mockaroo Jesse","metaData":{},"destinationAccountInformation":{},"paymentSourceInformation":{},"amountPaid":78000,"totalPayable":78000,"offlineProductInformation":{"code":"41470","type":"DYNAMIC"},"cardDetails":{},"paymentMethod":"CASH","currency":"NGN","settlementAmount":77600,"paymentStatus":"PAID","customer":{"name":"Mockaroo Jesse","email":"111222333@ZZAMZ4WT4Y3E.monnify"}},"eventType":"SUCCESSFUL_TRANSACTION"}
$raw_request = file_get_contents('php://input');

// your Secret Key found in your monnidy dashboard, developer menu
$SECRET_KEY = MoSK;

// next, we need to compute and compare hash sent via header as "monnify-signature". To check if it is same as hash we generate using our secret key and the request payload. If it is not then the request is rejected
$signature = $_SERVER['HTTP_MONNIFY_SIGNATURE']; // monnify-signature is sent as an header to your webhook endpoint, we get the value and store in this variable
$computedHash = hash_hmac('sha512', $raw_request, $SECRET_KEY); // hash generated
if( $computedHash != $signature) die("invalid Hash");

echo "OK";

// parse request to array
$request_array = json_decode( $raw_request );


// Don't forget to Check for duplicate notifications: When a new notification is received, always check that this has not been processed before giving value bfore, you can do this by tracing all notification with your own reference and alo monnify reference and update status once it has been proceesed

// Process your business logic here... give user value.. that's all!







//Whether ip is from monnify server
// 				if( $ip == "35.242.133.146"){        
//                     if ( $res["eventData"]["paymentStatus"] == "PAID") {
//                                
//                         // $ratio 		= 100/101.5;
//                         $ratio 		= "0"; //"50";
//                         $amount 		= $amount_paid - $ratio;
//                         $time_string 	= time();
//                         $description 	= "Monnify funded ₦".$amount." on user".$username;
//                               
//        				 $check = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM deposit WHERE reference_no = '$mnfy_trans_ref'"));
//        
//                         if($check > 0){
//                              http_response_code(200);
//                              exit();
//                         }else{
//                                   
//                              //Add into the payers account
//                              $newbal =  $wallet + $amount;   
//                              ////////////////////////////////////////////                                     
//                                     
//							  $insert = mysqli_query($conn, "INSERT INTO deposit (reference_no, fullname, amount, charge, status, description, date, method) VALUES ('$mnfy_trans_ref', '$username', '$amount_paid','$amount','1','$description','$time','$description') ");       
//                                    
//                              /////////fund user
//    						  $str 		= "UPDATE user SET  balance = '$newbal' WHERE email = '$mnfy_email'";
//                              $result 	= mysqli_query($conn, $str);
//                                     
//                              //  http_response_code(200);
//                              http_response_code(200);
//                                  exit();
//                              }
//                            
//                          }else{
//                                http_response_code(500);
//                          }
//                      }
//                  }
//            }
?>