<?php 
require_once('PHPmailer/PHPMailerAutoload.php');
error_reporting(E_ALL & ~E_NOTICE);


        // Get the form fields and remove whitespace.
        $first_name = strip_tags(trim($_POST["first_name"]));
		$first_name = str_replace(array("\r","\n"),array(" "," "),$first_name);
        $last_name = trim($_POST["last_name"]);
        $email = filter_var(trim($_POST["email_address"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone_no"]);
        $message = trim($_POST["con_message"]);

        // Check that data was sent to the mailer.
        if ( empty($first_name) OR ( empty($last_name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

echo $first_name;


$to="njaiswal78@gmail.com";


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
$mail->Body= "Name: $first_name + $last_name\n Phone: $phone\n\n Email: $email\n\n Message:\n$message\n";
$mail->AddAddress($to);
$mail->Send();

?>
