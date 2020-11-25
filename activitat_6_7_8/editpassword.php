<?php
session_start();
include("funcions.php");
$error_pass="";
$error=false;
$errormsg="";

if($_REQUEST["token_recovery"] == $_SESSION["Token_recovery"]){

    $data2=time();
    $token_data= $_SESSION["Token_recovery"];
    $conn1 = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
    $sql1 = "select temps_token from usuaris where token='$token_data' ";
    if (!$resultado1=$conn1->query($sql1)){
        die("error al ejecutar la consulta".$conn1->error);
    }
    $resultdata = $resultado1->fetch_assoc();
    $data1 = $resultdata["temps_token"];

    if($data2>($data1 + 300)){

        die("error , el token ha expirado<br><a href='publica.php'>Tornar</a><br>");


    }
    else{

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $token3= $_SESSION["Token_recovery"];
            $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
            $sql = "select email from usuaris where token='$token3' ";
    
            if (!$resultado=$conn->query($sql)){
                die("error al ejecutar la consulta".$conn->error);
            }
            $result = $resultado->fetch_assoc();
            $email = $result["email"];
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
                updatePasswordUser($email,$pass2);
                header("location:publica.php");
            }
            $error_pass="la pass no coincide";
    
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
        <form method="post">
            <label for="pass1">Pass:</label>
            <input type="password" name="pass1" id="pass1" required><span class="error_pass1"><?=$errormsg;?></span><br>
            <label for="pass2">Repeteix pass:</label>
            <input type="password" name="pass2" id="pass2" required><span class="error_pass2"><?=$errormsg;?></span><span class="error_pass"><?=$error_pass;?></span><br>
            <input type="submit" value="Update Pass">
        </form>
        <br>
        </body>
        </html>
    <?php
    
    }


}else{
    die("error , el token no coincide<br><a href='publica.php'>Tornar</a><br>");
}
?>
