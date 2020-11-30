<?php
$errormsgpass="";
$erroremail2="";
$errormsgpass2="";
$error=false;
include("funcions.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = test_input($_POST["username"]);
   
    $password = test_input($_POST["password"]);

    if(empty($_REQUEST["username"])){ 
        $error=TRUE;
        $erroremail2= "Email buit";
    }

    if (!preg_match("/^[a-zA-Z0-9' ]*$/",$password)) {
        $error=TRUE;
        $errormsgpass=  "Nomes lletres i numeros";
    }

    else if(empty($_REQUEST["password"])){
        $error=TRUE;
        $errormsgpass2= "Constrasenya buida";
    }

    if(!$error){
       
        if(validaUsuari($_REQUEST["username"],md5($_REQUEST["password"]))){

            echo "Ok de autenticación";
            $_SESSION["login"]=$_REQUEST["username"];
            header('location:home.php');

        }else{

            echo "Error de autenticación";   

        }

    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function check(){

            //if(!document.forms[0].suma.value.length>0){
                //alert("has d'intruduir un resultat de la suma");
            //}

            if(!document.forms[0].username.value.length>0){
                alert("has d'intruduir un username");
            }else{


                location.href="recoverypassword.php?username="+document.forms[0].username.value;
            }

        }
    
    </script>
</head>
<body>

<h1>Formulari login</h1>
<h4><?=$erroremail2?></h4>
<h4><?=$errormsgpass2?></h4>
<h4><?=$errormsgpass?></h4>
<?php
$num_1 = 4;
$num_2 = 4;
$resultado_suma = $num_1 + $num_2;
?>
<form method="post">
    username:<input type="text" name="username" id=""><br>
    password: <input type="password" name="password" id=""><br><br>
    <input type="submit" value="Envia"><br><br>
    
    
</form>

<?php echo "$num_2 " . "+" . "$num_2" . " " ?><input name="suma" id="">
<a href="#" onclick="check();"> Regenerar password</a>

</body>
</html>



