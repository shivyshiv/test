<?php
include 'PHPMailerAutoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class people extends CI_Controller {
    

    function __construct(){
        parent::__construct();
       // $this->load->database();
        //$this->load->model('peoplemodel');
     
    }

	public function index()
	{
            $result['res']=TRUE;    
         //   $this->load->model('peoplemodel');
           
           
        //  if($this->input->server('REQUEST_METHOD')=='POST'){
                
                $username = $this->input->post('username');
                $book_id = $this->input->post('book_id');
                $number = $this->input->post('number');
                $sender = $this->input->post('sender');
                $vendor_name = $this->input->post('vendor_name');
                $vendor_mob = $this->input->post('vendor_mob');
              
          $email = $sender;
        //$response = FALSE;
     /*if($email =="") 
     {  //dont send email go back

           echo ("UNSUCCESSFUL:Please Enter Your Email");              
             } else*/ {    //try sending email


 $subject = "Mr/Mrs ".$username." " ;
 
 $temp_text ="<p>We have received a booking </p>  <p> Shop : ". $vendor_name . " <br> BOOKING ID : ". $book_id ." <br> Please check your app to track the above booking :  <br> Contact care@caring.com for queries and use your BOOKING ID as reference </p>";
  


    $mail = new PHPMailer();
    $mail->IsHTML(true);
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
  
    $mail->Host = "sg2plcpnl0163.prod.sin2.secureserver.net"; 
    $mail->SMTPAuth = true;   
    $mail->Username = "care@car-ing.com"; 
    $mail->Password = "qwertyasd";
    $mail->port = 465;


$mail->addReplyTo('care@car-ing.com');
$mail->setFrom('care@car-ing.com');



$mail->addAddress($email);
$mail->addAddress("care4caring@gmail.com");
$mail->Subject = $subject;
$mail->Body = $temp_text;


  
  
    
  
              if($mail->Send()) {
           $result['res']="send";
             } 
             else {
               
               //   $response=
               //    "TechnicalProblems:Yourmessagewasnotsent";
                 $result['res']="Failed";
             }
             
             

}
            
//sms code
$senderid="caring";
///$this->load->library('curl');
  $message = " your is successful ID : ";
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
//echo $obj["ErrorMessage"];
$result['ans']="message sent to user";
$vendor_number=$vendor_mob;
$mess = "Dear ".$vendor_name.", you have received a service request from ".$username." cont - +".$number." please check your app to accept it or reject it";

$service_url1 = "http://pts.promotionkart.com/api/mt/SendSMS?APIKey=caringapp67&senderid=caring&channel=Trans&DCS=0&flashsms=1&number=".$vendor_mob."&text=".$mess."&route=4";
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
$result['ans1']="message sent to vendor";
//echo $obj["ErrorMessage"];
//$response['mai']= $obj["ErrorMessage"];






















        
           $this->load->view('name_display',$result); 
            
          
        }
        
}
