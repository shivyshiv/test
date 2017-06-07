<?php

	$number = $_POST["number"];
	$senderid = $_POST["sender"];
	$username = $_POST["username"];
        $book_id = $_POST["book_id"];
        $vendor_name = $_POST["vendor_name"];
        $vendor_number = $_POST["vendor_mob"];
        $message = $_POST["message"];
        
        //$message = "".$username." your booking is successful ID : ".$book_id."  SHOP NAME - ".$vendor_name." Track your order on APP";
$service_url = "http://pts.promotionkart.com/api/mt/SendSMS?APIKey=caringapp67&senderid=".$senderid."&channel=Trans&DCS=0&flashsms=1&number=".$number."&text=".$message."&route=4";
$service_url = str_replace(" ", '%20', $service_url);

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $service_url);

$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
$obj = json_decode($curl_response,true);
echo $obj["ErrorMessage"];

$mess = "Dear ".$vendor_name.", you have received a service request from ".$username." cont - +".$number." please check your app to accept it or reject it";

$service_url1 = "http://pts.promotionkart.com/api/mt/SendSMS?APIKey=caringapp67&senderid=".$senderid."&channel=Trans&DCS=0&flashsms=1&number=".$vendor_number."&text=".$mess."&route=4";
$service_url1 = str_replace(" ", '%20', $service_url1);

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $service_url1);

$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
$obj = json_decode($curl_response,true);
echo $obj["ErrorMessage"];



             
?>