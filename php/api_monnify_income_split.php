<?php require_once('../includes/_conn.php'); ?>
<?php
	
## Split payments on Reserved Accounts
##Reserve Account Request with SubAccount

require_once("api_monnify_auth");
$access_token = getMonnifyAccessToken(); // add your access token here

$postData = array(     
      "accountReference" => tt_random_string(26), // unique reference
           "accountName" => "Junaidu Tanko",
          "currencyCode" => "NGN",
          "contractCode" => MoCONTRACT,
         "customerEmail" => "test@tester.com",
                   "bvn" => "2233445566778899",
          "customerName" => "Junaidu Tanko Abdulrahman",
  "getAllAvailableBanks" => true,
     "incomeSplitConfig" => [
         {
           "subAccountCode" => "MFY_SUB_319452883228",
            "feePercentage" => 10.5,
          "splitPercentage" => 20,
                "feeBearer" => true
         }
      ]
);

$handler = curl_init();
$headers[] = 'Authorization: bearer '.$access_token;
$headers[] = 'Content-Type: application/json';

curl_setopt($handler, CURLOPT_URL, "https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts");
curl_setopt($handler, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($handler, CURLOPT_HTTPHEADER,$headers);
curl_setopt($handler, CURLOPT_POST, true);

$response = curl_exec($handler); 

if($response !==false)
{
  var_dump($response); // you can parse this response to get the reserved account details
}
else {
  print "Could not get a response";
}

?>