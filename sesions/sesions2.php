<?php
    
    session_start();
    
    if (!isset($_SESSION["usuario"]) and !isset($_SESSION["contrasena"])){
        header("location:sesions.php");
    }else{
        echo ("Hola: ".$_SESSION["usuario"]);
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
    <form action="sesions3.php" method="post" id="myform" name="myform">
    <button id="mysubmit" type="submit">Logout</button><br /><br />
    </form>
</body>
</html>