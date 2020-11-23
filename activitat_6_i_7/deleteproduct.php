<?php

include("contrologin.php");
include("funcions.php");
$id_producte = $_REQUEST['idc'];

$conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
    $sql = "delete from productes where id= $id_producte ";
    
    if (!$resultado1 = $conn->query($sql)) {
        die("error ejecutando la consulta:".$conn->error);
    }
    header('location:privada.php');

?>