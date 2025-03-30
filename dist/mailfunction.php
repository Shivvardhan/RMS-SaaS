<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function mailsent($tomail, $toname, $subjects, $messages)
{

    require('dbcon.php');
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'harshitvarshney39@gmail.com';                     //SMTP username
        $mail->Password   = 'ezeykqouijbbktdp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;

        $to = $tomail;
        $accountname = $toname;
        $mail->setFrom('harshitvarshney39@gmail.com', 'SystemVista');
        $mail->addAddress($to, $accountname);
        $subject = $subjects;




        $mail->isHTML(true);
        $mail->Subject = $subjects;
        $mail->Body    = $messages;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        //  echo "success";

    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //   $_SESSION['message1'] = ' Message could not be sent. :{$mail->ErrorInfo}';
        //   echo "<script>window.location.href = 'forgotpass.php'; </script>";
        // echo "error <br>"; 

        // echo $e->getMessage(); 
    }
}
//  mailsent("harshitvarshney39@gmail.com","","hello","heloo");
