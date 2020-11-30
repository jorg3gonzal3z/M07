<?php
session_start();
include("funcions.php");
$error_pass="";
$error=false;
$errormsg="";

if($_SESSION["codigook"]){

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $username = $_SESSION["username"];
        $pass1 = test_input($_REQUEST["pass1"]);
        $pass2 = test_input($_REQUEST["pass2"]);

        if (!preg_match("/^[a-zA-Z0-9' ]*$/",$pass1)) {
            $error=TRUE;
            $errormsg=  "Only letters and numbers allowed";
        }

        if (!preg_match("/^[a-zA-Z0-9' ]*$/",$pass2)) {
            $error=TRUE;
            $errormsg=  "Only letters and numbers allowed";
        }

        if($pass1==$pass2 and !$error){
        
            updatePasswordUser($username,$pass2);
            header("location:index.php");

            $_SESSION["nova_pass"]=null;
     
            /*if(validaUsuari($username,md5($pass2))){

                echo "Ok de autenticación";
                $_SESSION["login"]=$_REQUEST["username"];
                header('location:home.php');
    
            }else{
    
                header("location:index.php");
    
            }
            */
        }
        $error_pass="la pass no coincide";
        

    }

}
else{
    die("No puedes estar aqui");
}

?>     
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Nova contrasenya</h1>
<form method="post">
    <label for="pass1">Pass:</label>
    <input type="password" name="pass1" id="pass1" required><span class="error_pass1"><?=$errormsg;?></span><br>
    <label for="pass2">Repeteix pass:</label>
    <input type="password" name="pass2" id="pass2" required><span class="error_pass2"><?=$errormsg;?></span><span class="error_pass"><?=$error_pass;?></span><br>
    <input type="submit" value="Update Pass">
</form>
</body>
</html>

