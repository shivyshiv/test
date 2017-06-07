<?php
include 'PHPMailerAutoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class peoplemodel extends CI_Model {
 public function sendmessage($username,$book_id,$number,$sender,$vendor_name,$vendor_mob){   
	$email = $sender;
        //$response = FALSE;
     if($email =="") 
     {  //dont send email go back

           echo ("UNSUCCESSFUL:Please Enter Your Email");              
             } else {    //try sending email


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


  
  
    
  
              if($mail->Send()==TRUE) {
               return TRUE;
             } 
             else {
               //   $response= "TechnicalProblems:Yourmessagewasnotsent";
                 return FALSE;
             }
             
             

}
         
             
/// SMS code 


        }
        
       

}