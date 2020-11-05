<?php

    $errornom="";
    $errorpasswd="";
    $errorusu="";
    $error=false;

    

    #validacion mediante cookies
    /*esto serviria para guardar las cookies si hago toda la validacion en el archivo y marco el checkbox*/

    if($_COOKIE["user"] and $_COOKIE["passwd"]){

        $conn = new mysqli('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $tryuser=$_COOKIE["user"];
        $trypasswd=$_COOKIE["passwd"];

        $query = "SELECT * FROM sesion WHERE usu='$tryuser' AND passwd='$trypasswd' ";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            header("Location: sesions2.php");
        }

    }

    //////////////////////////////////////
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        include "libreria.php";

        session_start();

        //conexion con la base de datos
        $conn = new mysqli('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        /////////////////////////////ADMIN////////////////////////////////////

        //conexion con la base de datos para comprobar contraseña y usu
        $query = "SELECT * FROM sesion WHERE usuadmin= 1 AND usu='admin@gmail.com'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $adminusu = mysqli_num_rows($result);

        #si la validacion de contrasena y usuario es correcta:
        if ($adminusu == 1){
            
            header('location: admin.php');
        }

        ///////////////////////////////////////////////////////////////////////

        $user=test_input($_REQUEST["usuari"]);
        $passwd=test_input($_REQUEST["contrasena"]);
        $passwdsegura = sha1(md5($_REQUEST["contrasena"]));

        //conexion con la base de datos para comprobar contraseña y usu
        $query = "SELECT * FROM sesion WHERE usuadmin= 0 AND usu='$user' AND passwd='$passwdsegura' ";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $resultado = mysqli_num_rows($result);

        #si la validacion de contrasena y usuario es correcta:
        if ($resultado == 1){
            $errorusu="";
            $_SESSION["usuario"]=$_REQUEST["usuari"];
            $_SESSION["contrasena"]=$_REQUEST["contrasena"];

            if(isset($_REQUEST["checkbox"])){
                
                unset($_COOKIE["user"]);
                unset($_COOKIE["passwd"]);
                setcookie('user', ($user), time() + 365 * 24 * 60 * 60);    
                setcookie('passwd', sha1(md5($passwd)), time() + 365 * 24 * 60 * 60);
                
            }

            header('Location: sesions2.php');
            
        }else{

            if ($resultado == 0) {
                $errorusu = "Esta cuenta no existe";
            }
            #correo electronico correcto
            if(is_valid_email($user)== false) {
                $errornom="El usuario debe ser un correo electronico";
                $error=true;
            }
            #contraseña correcta
            if(preg_match ("/^[a-zA-Z0-9]+$/", $passwd)== false) {
                $errorpasswd="La contraseña deben ser numeros o letras";
                $error=true;
            }
            
        }
    }
    
?>

<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Exemple de sesions</title>
</head>
<style>
    .estilo {background-color: #93F1FA ; padding: 5px; font: condensed 120% sans-serif;color:#67BBC4;}
    h1 {font: condensed 120% sans-serif; color:#53969C;}
    button {border-radius: 2px; background-color:white;border: none;font-size: 16px;}
</style>
<body>
    <div class = "estilo" style="margin: 30px 10%;">

        <h1>Validacion</h1>

        <form action="sesions.php" method="post" id="myform" name="myform">

            <label>Usuario:</label> <input type="text" size="30" maxlength="100" name="usuari" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["usuari"];?>" required /><span class="errornom"><?=$errornom;?></span><br /><br />

            <label>Contraseña:</label> <input type="text" size="30" maxlength="100" name="contrasena" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["contrasena"];?>" required /><span class="errorpasswd"><?=$errorpasswd;?></span><br /><br />

            <input type="checkbox" name="checkbox" value="1" /> Mantener sesion iniciada<br /><br />

            <button id="mysubmit" type="submit">Login</button>

        </form>

        <form action="register.php"><button> Register</button></form>

        <span class="errorusu"><?=$errorusu;?></span>
        
        
    </div>

</body>
</html>