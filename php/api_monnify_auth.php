<?php require_once('../includes/_conn.php'); ?>
<?php
// A very simple PHP example that sends a HTTP POST using CURL to Monnify to get access token

$reqTokenCode	= MoAPI.":".MoSK;
$reqTokenHash	= base64_encode($reqTokenCode);
$url 			= 'https://api.monnify.com/api/v1/auth/login';
//echo $stringk;

//Requesting OAuth Access Token by generating and passing AuthToken
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
   	$ch, CURLOPT_HTTPHEADER, [
		"Content-Type: application/json",
       	"Authorization: Basic ".$reqTokenHash."",
    ]
);
$json = curl_exec($ch);
curl_close($ch);

   $result = json_decode($json, true); //echo $json;
   $accessToken = $result['responseBody']['accessToken'];

//   
//	// 1. Get API Key and Secret Key from Monnify Dashboard
//	$API_Key = "MK_TEST_WN9FQE2E5X";
//	$Secret_Key = "S6N0M0CUKKP9YBELV64BHNUEZ3CKJ8MW";
//
//	$ch = curl_init();
//
//	// Concatenate "ApiKey" + ":" +  "SecretKey", then Base 64 encode the string and prefix with the word "Basic". See in next line
//	$headers = array(
//		'Content-Type:application/json',
//		'Authorization: Basic '. base64_encode($API_Key . ":" . $Secret_Key) 
//	);
//	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//	curl_setopt($ch, CURLOPT_URL,"https://sandbox.monnify.com/api/v1/auth/login");
//	curl_setopt($ch, CURLOPT_POST, 1);
//	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//	$output = curl_exec($ch);
//	if (curl_errno($ch)) {
//		echo 'Curl error: ' . curl_error($ch);
//	} else {
//	    //print($output);
//	}
//
//	curl_close($ch);
//
//	$json = json_decode($output, true);
//	if ($json === null) {
//		echo "JSON decode error: " . json_last_error_msg();
//	} else {
//		//print_r($json);
//	}
//
//	$accessToken = $json['responseBody']['accessToken'];
//
//	// this is your access token
//	print $accessToken;

?>