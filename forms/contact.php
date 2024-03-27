<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

  $mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Debugoutput = 'html';
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host       = 'smtp.gmail.com';
    $mail->Port       = 465;
    $mail->Username   = 'i.salifoualassane@gmail.com'; // Replace with your email address
    $mail->Password   = ''; // Replace with your email password
    
    

    //Recipients
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('i.salifoualassane@gmail.com'); // Replace with your email address

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->msgHTML($_POST['message']);
    $mail->IsHTML(true);

    $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
    );

    if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo "Message has been sent";
    }
  } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
  }


?>
