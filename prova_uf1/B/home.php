<?php

include("contrologin.php");
include("funcions.php");
echo"<h1>Benvingut a la pagina privada de ".$_SESSION["login"]." </h1>";

if(isset($_SESSION["nova_pass"])){
    $_SESSION["codigook"]=true;
    header('location:editpassword.php');
}

?>

