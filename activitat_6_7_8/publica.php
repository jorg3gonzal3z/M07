<?php
include("funcions.php");

session_start();
$error=FALSE;
$errormsg="";


if(isset($_REQUEST["okp"])){

    setcookie('politica', 1, time() + 365*24*60*60); 
    header("location:publica.php");


}

if(isset($_COOKIE["email"])){


    if(validaUsuari($_COOKIE["email"],$_COOKIE["password"])){



            $_SESSION["login"]=$_COOKIE["email"];
            header('location:privada.php');

    }else{

        setcookie('email', null, 0,'/'); 
        setcookie('password', null, 0,'/'); 

    }

}


if($_SERVER['REQUEST_METHOD'] == 'POST'&&!isset($_REQUEST["buscar"])) {


        $pass=test_input($_REQUEST["password"]);


        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error=TRUE;
            $errormsg.= "Invalid email format";
        }

        $password = test_input($_POST["password"]);
        if (!preg_match("/^[a-zA-Z0-9' ]*$/",$password)) {
            $error=TRUE;
            $errormsg.=  "Only letters and numbers allowed";
        }
        

        if(!$error){


            if(validaUsuari($_REQUEST["email"],md5($_REQUEST["password"]))){

                echo "Ok de autenticación";
                $_SESSION["login"]=$_REQUEST["email"];

                if(isset($_REQUEST["recorda"])){
                    setcookie('email', $_REQUEST["email"], time() + 365*24*60*60,'/'); 
                    setcookie('password', md5($_REQUEST["password"]), time() + 365*24*60*60,'/'); 
                }

                header('location:home.php');
    
            }else{
    
                echo "Error de autenticación";
                setcookie('contador', null, 0); 
    
    
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

            if(!document.forms[0].email.value.length>0){
                alert("has d'intruduir un email");
            }else{


                location.href="recoverypassword.php?email="+document.forms[0].email.value;
            }

        }
    
    </script>
</head>
<body>


<?php

if(!isset($_COOKIE["politica"])){


?>

política....<br>
<a href="?okp">Accepto</a><br>
<a href="http://www.google.com">No Accepto</a>


<?php

}else{


    
?>


    <h1><?=$errormsg?></h1>
    <form method="post">
        email:<input type="text" name="email" id=""><br>
        password: <input type="password" name="password" id="">
        autologin<input type="checkbox" name="recorda" id="">
        <input type="submit" value="envia">
    
    </form>
    <br>
    <a href="#" onclick="check();"> Regenerar password</a>
    <a href="register.php">Crear nou usuari</a><br>
    <form method="post">
        <br>
        buscar produco:<input type="text" name="buscar"></input>
        <input type="submit" value="buscar">
    </form>
    <?

}


?>

<?php

$conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
if(isset($_REQUEST['buscar'])){
    $sql = "select * from productes where upper(nom) like concat('%',upper('".$_REQUEST["buscar"]."'),'%') ";
}
else{
    $sql = "select * from productes ";
}
if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
}
    echo "<br>"."<br>"."-- Llistat de productes --"."<br>"."<br>";

    while($productes=$resultado->fetch_assoc()){

        if(!$productes["id_comanda"]){
            echo "Id del pruducte: ".$productes["id"].", Nom del producte: ".$productes["nom"].", Descripcio del producte: ".$productes["descripcio"].", Preu del producte: ".$productes["preu"]."€";
            $id_producte = $productes["id"];
            $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
            
            $sql2 = "select * from imatges where id_productes= $id_producte";
            if (!$resultado2 = $conn->query($sql2)) {
                die("error ejecutando la consulta:".$conn->error);
            }
            if ($resultado2->num_rows == 1) {
                
                while($imgdb=$resultado2->fetch_assoc()){
                $img = $imgdb["ruta"];
                echo "<img whith=40 height=40 src=".$img.">";
                echo "<br>";
                
                }

            }
            echo "<hr>";
            echo "<br>";
        }

    }
    


?>
</body>
</html>
