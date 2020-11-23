<?php

include("funcions.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$pass="";
if(userExists($_REQUEST["email"])){

    $pass=  generate_string(6);

    

    updatePasswordUser($_REQUEST["email"],$pass);



    $mail = new PHPMailer(true);

    try {
    
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP

        

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = 'javipj@gmail.com';

    //Password to use for SMTP authentication
    $mail->Password = 'schelxchvjxmakht';

    //Set who the message is to be sent from
    $mail->setFrom('javipj@gmail.com', 'Password recovery from my web');



    //Set who the message is to be sent to
    $mail->addAddress($_REQUEST["email"]);



        // Content
        $mail->isHTML(true);   

    //Set the subject line
    $mail->Subject = 'Nou password';





                                // Set email format to HTML

        $mail->Body    = "La nova password és <b>$pass</b>";

        
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }





}





echo "Si l'usuari existeix, rebràs la nova password al teu correu.";



?>