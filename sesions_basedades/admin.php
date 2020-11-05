<?php

    $errornom="";
    $errorpasswd="";
    $error=false;


    include "libreria.php";

    /////////////////////////////ADMIN////////////////////////////////////

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        
        #correo electronico correcto
        $nouusuari = $_REQUEST["nouusuari"];
        $novacontrasena = sha1(md5($_REQUEST["novacontrasena"]));
        if(is_valid_email($nouusuari)== false) {
            $errornom="El usuario debe ser un correo electronico";
            $error=true;
        }
        #contraseña correcta
        if(preg_match ("/^[a-zA-Z0-9]+$/", $novacontrasena)== false) {
            $errorpasswd="La contraseña deben ser numeros o letras";
            $error=true;
        }
        #si todo es correcto creara el usuario y nos enviara a sesions.php
        if($error==false){

            try{
                $conn = new mysqli('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "INSERT INTO sesion (usu, passwd) VALUES (?, ?)";
                $result=$conn->prepare($sql);
                $result->bind_param("ss", $nouusuari, $novacontrasena);
                $result->execute();
                $conn->close();
                header("Location: sesions.php");
            }catch(mysqli_sql_exception $e) {
                $e->errorMessage();
            }
            
        }
    }

    ///////////////////////////////////////////////////////////////////////
    
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
    .saludar {font: condensed 120% sans-serif;color:#67BBC4;}
    h3 {font: condensed 100% sans-serif; color:#53969C;}
    h2 {font: condensed 120% sans-serif; color:#53969C;}
    button {border-radius: 2px; background-color:white;border: none;font-size: 16px;}
</style>
<body>
    
    <div class="estilo" style="margin: 30px 10%;">

        <h2>ADMIN</h2>

        <h3>Crear usuarios:</h3>
        
        <form action="register.php" method="post" id="myform" name="myform">

            <label>Nuevo Usuario:</label> <input type="text" size="30" maxlength="100" name="nouusuari" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["nouusuari"];?>" /><span class="errornom"><?=$errornom;?></span><br /><br />

            <label>Nueva Contraseña:</label> <input type="text" size="30" maxlength="100" name="novacontrasena" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["novacontrasena"];?>"/><span class="errorpasswd"><?=$errorpasswd;?></span><br /><br />

            <button id="mysubmit" type="submit">Crear Usuario</button><br /><br />

        </form>

        <form action="sesions3.php" method="post" id="myform" name="myform">

        <button id="mysubmit" type="submit">Logout</button><br /><br />

        </form>
    </div>

    <div class="estilo" style="margin: 30px 10%;">

        <h3>Eliminar Usuarios</h3>

        <form action="register.php" method="post" id="myform" name="myform">

            <label>Nombre Usuario:</label> <input type="text" size="30" maxlength="100" name="borrarusu" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["nouusuari"];?>" /><span class="errornom"><?=$errornom;?></span><br /><br />

            <button id="mysubmit" type="submit">Eliminar Usuario</button><br /><br />

        </form>
    </div>
</body>
</html>