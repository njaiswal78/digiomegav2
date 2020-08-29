<?php
/**
 * PHPMailer simple file upload and send example
 */
$msg = '';
if (array_key_exists('userfile', $_FILES)) {
    // First handle the upload
    // Don't trust provided filename - same goes for MIME types
    // See http://php.net/manual/en/features.file-upload.php#114004 for more thorough upload validation
    $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name']));
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        // Upload handled successfully
        // Now create a message
        // This should be somewhere in your include_path
        require '../PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->setFrom('from@example.com', 'First Last');
        $mail->addAddress('whoto@example.com', 'John Doe');
        $mail->Subject = 'PHPMailer file sender';
        $mail->Body = 'My message body';
        // Attach the uploaded file
        $mail->addAttachment($uploadfile, 'My uploaded file');
        if (!$mail->send()) {
            $msg .= "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $msg .= "Message sent!";
        }
    } else {
        $msg .= 'Failed to move file to ' . $uploadfile;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>PHPMailer Upload</title>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2864756660439220');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2864756660439220&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code --></head>
<body>
<?php if (empty($msg)) { ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000"> Send this file: <input name="userfile" type="file">
        <input type="submit" value="Send File">
    </form>
<?php } else {
    echo $msg;
} ?>
</body>
</html>