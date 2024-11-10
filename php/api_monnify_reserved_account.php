<?php //require_once('../includes/_conn.php'); ?>
<?php
//session_start();

//----- Requesting OAuth Access Token by generating and passing AuthToken
$reqTokenCode	= MoAPI.":".MoSK;
$reqTokenHash	= base64_encode($reqTokenCode);
$url 			= 'https://api.monnify.com/api/v1/auth/login';
//echo $stringk;

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
  
//echo $accessToken;
	  
//--- Reserved customer account creation
 class ReservedAccountService {
    private static $monnifyReservedAccountsUrl = "https://sandbox.monnify.com/api/v2/bank-transfer/reserved-accounts"; 
	
    public function create($requestBody, $bearerToken) {
        $headers = array(
            "Authorization: Bearer $bearerToken",
            'Content-Type: application/json'
         );
        return CustomCurlClient::build()->POST(self::$monnifyReservedAccountsUrl, $headers, $requestBody);
    }
}

class CustomCurlClient {
    public function POST($apiUrl, $headers, $requestBody) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiUrl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_POSTFIELDS => json_encode($requestBody)
        ));
        
        return curl_exec($curl);
    }
    public static function build() {
      return new CustomCurlClient();
    }
}

//New Virtual Account Request Params
$requestBody = [
    "accountReference" => tt_random_string(26),
    "accountName" => $fullname,
    "currencyCode"=> "NGN",
    "contractCode" => MoCONTRACT,
    "customerEmail" => $email,
    "bvn"=> "00000000000",
    "customerName" => $fullname,
    "getAllAvailableBanks"=> true
]; //"preferredBanks" => ["232","50515","035"]

//New Virtual Account Request Call
//$bearerToken = $accessToken; 
$reservedAccountServiceInstance = new ReservedAccountService();
$response = $reservedAccountServiceInstance->create($requestBody, $accessToken);

//Store Respond Data Temporarily In .TXT File 
file_put_contents("_reserved_account_data.txt", $response);

//Decode responded JSON
$value = json_decode($response, true); 
//echo $response;

if(isset($value["requestSuccessful"])) {
	echo "Request succeed!<br/>";
	
	if($value["responseMessage"] == "success"){
		 
		$account_name  = $value["responseBody"]["accountName"];
		echo $account_name;
		
		//ACCOUNT ONE
		//Sterling  
		if($value["responseBody"]["accounts"][0]["bankCode"]== "232"){
			 $sterling_no	= $value["responseBody"]["accounts"][0]["accountNumber"];
			 $sterling_name = $value["responseBody"]["accounts"][0]["bankName"];
		 
		 //Wema    
		}else if($value["responseBody"]["accounts"][0]["bankCode"]== "035"){
			 $wema_no	= $value["responseBody"]["accounts"][0]["accountNumber"];
			 $wema_name = $value["responseBody"]["accounts"][0]["bankName"];
		 
		 //Rolex
		}else if($value["responseBody"]["accounts"][0]["bankCode"]== "50515"){
			 $rolex_no	 =  $value["responseBody"]["accounts"][0]["accountNumber"];
			 $rolex_name = $value["responseBody"]["accounts"][0]["bankName"];
		 
		}else{ }
		 
		//ACCOUNT TWO
		if($value["responseBody"]["accounts"][1]["bankCode"]== "232"){
			 $sterling_no	=  $value["responseBody"]["accounts"][1]["accountNumber"];
			 $sterling_name = $value["responseBody"]["accounts"][1]["bankName"];
			 
		}else if($value["responseBody"]["accounts"][1]["bankCode"]== "035"){
			 $wema_no 	=  $value["responseBody"]["accounts"][1]["accountNumber"];
			 $wema_name = $value["responseBody"]["accounts"][1]["bankName"];
		 
		}else if($value["responseBody"]["accounts"][1]["bankCode"]== "50515"){
			 $rolex_no 	=  $value["responseBody"]["accounts"][1]["accountNumber"];
			 $rolex_name= $value["responseBody"]["accounts"][1]["bankName"];
		 
		}else{ }
		 
		 //ACCOUNT THREE
		if($value["responseBody"]["accounts"][2]["bankCode"]== "232"){
			 $sterling_no	=  $value["responseBody"]["accounts"][2]["accountNumber"];
			 $sterling_name = $value["responseBody"]["accounts"][2]["bankName"];
			 
		}else if($value["responseBody"]["accounts"][2]["bankCode"]== "035"){
			 $wema_no	=  $value["responseBody"]["accounts"][2]["accountNumber"];
			 $wema_name = $value["responseBody"]["accounts"][2]["bankName"];
		 
		}else if($value["responseBody"]["accounts"][2]["bankCode"]== "50515"){
			 $rolex_no 	=  $value["responseBody"]["accounts"][2]["accountNumber"];
			 $rolex_name= $value["responseBody"]["accounts"][2]["bankName"];
		 
		}else{ }
	 
	   //UPDATE CUSTOMER ACCOUNT	 
	   mysqli_query($conn, "UPDATE user SET 								
							  wema_bank 		= '".$wema_name."',
							  wema_number 		= '".$wema_no."',
							  sterling_bank		= '".$sterling_name."',
							  sterling_number	= '".$sterling_no."',
							  rolex_bank 		= '".$rolex_name."',
							  rolex_number		= '".$rolex_no."'
							WHERE email	= '".$email."'");  
			 
	echo "YAHOO! New Account Request Successfull!<br/>";
	} else { 
		//Remember same email can't register more one
		echo "Response Message is failed : ".$value["responseMessage"]." <br/> Error Code: ".$value["responseCode"];
	}
}else{
	echo "Ops! New Account Request Unsuccessful!<br/>";
}

?>