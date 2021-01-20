<?php
session_start();
include("funcions.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$pass="";
if(userExists($_REQUEST["username"])){

    $pass=  generate_string(8);

    $_SESSION["nova_pass"] = $pass;

    $_SESSION["username"] =$_REQUEST["username"];

    updatePasswordUser($_REQUEST["username"],$pass);

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
    $mail->Username = 'jgonzalezg@fp.insjoaquimmir.cat';

    //Password to use for SMTP authentication
    $mail->Password = 'jgonzalezg2020';

    //Set who the message is to be sent from
    $mail->setFrom('jgonzalezg@fp.insjoaquimmir.cat', 'Password recovery from my web');



    //Set who the message is to be sent to
    
    $mail->addAddress($_REQUEST["username"]);



        // Content
        $mail->isHTML(true);   

    //Set the subject line
    $mail->Subject = 'Nou password';





                                // Set email format to HTML
        $link =  "https://dawjavi.insjoaquimmir.cat/jgonzalez/M07/prova_uf1/B/index.php";
        $mail->Body    = "La nova password és <b>$pass<b> ,<b><a href= $link> Log In </a></b>";
        
        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }





}


echo "Si l'usuari existeix, rebràs la nova password al teu correu.";
echo "<br><br>";
echo "<a href='index.php'> [Tornar ]</a>";



?>