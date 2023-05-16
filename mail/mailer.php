<?php
    

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//function sendmail($recepient, $subject, $message, $host, $username, $password, $port){
function sendmail($recepient, $subject, $message){    

    //$message=$_GET['message'];
    //$recepient=$_GET['email'];
    // preparing mail content
    $messagecontent ="

    <html>

        <h1>Asset Inventory Management System</h1>
  
        <br>
        <br>
        <h4>".$message."</h4>
 

    </html>";

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        //$mail->SMTPDebug = 1;
        $mail->isSMTP();                                            //Send using SMTP
        
        $mail->Host       = 'smtp.gmail.com';
        //$mail->Host = $host;
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rpaganan@dci.ph';
        //$mail->Username = $username; 
        $mail->Password   = '491994Lefur';    
        //$mail->Password = $password;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->SMTPSecure = "tls";
        //$mail->Port       = 587;
        $mail->Port = $port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer'=> false,
            'verify_peer_name' => false,
            'allow_self_signed' => true)
        );

        //Recipients
        $mail->setFrom('rpaganan@dci.ph', 'AIMS Mailer');
        //$mail->setFrom($username,'AIMS Mailer');  
        $mail->addAddress($recepient);    
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments

        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('photo.jpeg', 'photo.jpeg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $messagecontent;
    

        $mail->send();
        return;
        //echo 'Message has been sent';
    } catch (Exception $e) {
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    }
    return;
}