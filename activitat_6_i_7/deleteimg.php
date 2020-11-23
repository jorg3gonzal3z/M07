<?php

include("contrologin.php");
include("funcions.php");
$id_img = $_REQUEST['idi'];

$conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
    $sql = "delete from imatges where id= $id_img";
    
    if (!$resultado1 = $conn->query($sql)) {
        die("error ejecutando la consulta:".$conn->error);
    }
    header('location:privada.php');

?>