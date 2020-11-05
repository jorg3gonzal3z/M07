<?php
    
    $errornom="";
    $errorpasswd="";
    $error=false;
    $saludar="";

    session_start();
    
    if (!isset($_SESSION["usuario"]) and !isset($_SESSION["contrasena"])){
        header("location:sesions.php");
    }else{
        $saludar = "Hola: ".$_SESSION["usuario"];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        include "libreria.php";

        #correo electronico correcto
        $updateusu = $_SESSION["usuario"];
        $updatepasswd = $_REQUEST["updatepasswd"];
        if(is_valid_email($updateusu)== false) {
            $errornom="El usuario debe ser un correo electronico";
            $error=true;
        }
        #contraseña correcta
        if(preg_match ("/^[a-zA-Z0-9]+$/", $updatepasswd)== false) {
            $errorpasswd="La contraseña deben ser numeros o letras";
            $error=true;
        }
        #si todo es correcto update el usuario y nos enviara a sesions.php
        if($error==false){
            try{
                $conn = new mysqli('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql="UPDATE sesion SET passwd='$updatepasswd' WHERE usu='$updateusu'";
                mysqli_query($conn, $sql);
                header('Location: sesions.php');
            }catch(mysqli_sql_exception $e) {
                $e->errorMessage();
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
</head>
<style>
    .estilo {background-color: #93F1FA ; padding: 5px; font: condensed 120% sans-serif;color:#67BBC4;}
    .saludar {font: condensed 150% sans-serif;color:#67BBC4;}
    h3 {font: condensed 120% sans-serif; color:#53969C;}
    button {border-radius: 2px; background-color:white;border: none;font-size: 16px;}
</style>
<body>
<div class="estilo" style="margin: 30px 10%;">

    
    <form action="sesions2.php" method="post" id="myform" name="myform">

        <span class="saludar"><?=$saludar;?></span><br /><br />
        
        <h3>Actualizar contraseña</h3>

        <label>Usuario:</label> <input type="text" size="30" maxlength="100" name="updateusu" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["updateusu"];?>" required /><span class="errornom"><?=$errornom;?></span><br /><br />

        <label>Nueva Contraseña:</label> <input type="text" size="30" maxlength="100" name="updatepasswd" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["updatepasswd"];?>" required /><span class="errorpasswd"><?=$errorpasswd;?></span><br /><br />

        <button id="mysubmit" type="submit">Update Usuario</button><br /><br />

    </form>

    <form action="sesions3.php" method="post" id="myform" name="myform">

        <button id="mysubmit" type="submit">Logout</button><br /><br />

    </form>
    
</div>
</body>
</html>