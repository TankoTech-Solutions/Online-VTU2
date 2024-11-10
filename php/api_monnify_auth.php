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

//	// this is your access token
//	print $accessToken;

?>