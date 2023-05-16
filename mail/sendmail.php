<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//get data from form

$email = $_POST['email'];


// preparing mail content
$messagecontent ="

<html>

 <h1>Project Management System</h1>
  Here is what the team is using to work seamlessly and accomplish more. together: 
 <br>
 <br>
 <h4>You have been invited to collaborate on the project .....</h4>
 <a href='http://www.localhost/pms/admin/user/signup_invite.php'>Join</a>


</html>";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //$mail->SMTPDebug = 1;
    $mail->isSMTP();                                            //Send using SMTP
    //$mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->Host       = 'smtp.gmail.com';     
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rpaganan@dci.ph';                     //SMTP username
    $mail->Password   = 'Lefur@491994';                               //SMTP password
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer'=> false,
        'verify_peer_name' => false,
        'allow_self_signed' => true)
    );

    //Recipients
    $mail->setFrom('rpaganan@dci.ph', 'Mailer');
    $mail->addAddress($email, 'Collaborator');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments

    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('photo.jpeg', 'photo.jpeg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Team Invitation';
    $mail->Body    = $messagecontent;
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}