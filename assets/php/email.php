<?php 

require_once('PHPmailer/PHPMailerAutoload.php');


        // Get the form fields and remove whitespace.

        // Check that data was sent to the mailer.
$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$email=$_POST["email"];
$phone=$_POST["phone_no"];
$message=$_POST["con_message"];



$mail=new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth='true';
$mail->SMTPSecure='ssl';
$mail->Host="smtp.gmail.com";
//$mail->Host="smtp.hostinger.in";

$mail->Port='465';
$mail->isHTML();
$mail->Username="socialplayerdotin@gmail.com";
$mail->Password='natrajan807';
$mail->SetFrom('hello@socialplayer.in');
$mail->AddReplyTo('hello@socialplayer.in');
$mail->FromName='Priyanka Singh';
$mail->Subject="Welcome to Socialplayer";
$mail->Body= "Name: $first_name + $last_name + $phone + $email + $message";
$mail->addAddress('njaiswal78@gmail.com');
if(!$mail->Send())
{
   echo "Error sending: " . $mail->ErrorInfo;
}
else
{
   echo "E-mail sent";
}


?>
