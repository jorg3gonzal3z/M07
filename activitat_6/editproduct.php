<?php

include("contrologin.php");
include("funcions.php");
$error=false;
$error_editnom="";
$error_editdescripcio="";
$error_editpreu="";
$error_editcategoria="";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $newnom_producte = test_input($_REQUEST['newnom']);
    $newdescripcio_producte = test_input($_REQUEST['newdescripcio']);
    $newpreu_producte = test_input($_REQUEST['newpreu']);
    $newcategoria_producte = test_input($_REQUEST['newcategoria']);
    $user = $_SESSION["login"];
    $user_id = saberIdUser($user);
    $id_producte = $_REQUEST['idc'];
    
    
    if(empty($newnom_producte)){
    $error=true;
    $error_editnom="no hi cap nom";
    }
    if(empty($newdescripcio_producte)){
    $error=true;
    $error_editdescripcio="no hi cap descripcio";
    }
    if(empty($newpreu_producte)){
    $error=true;
    $error_editpreu="no hi cap preu";
    }
    if(empty($newcategoria_producte)){
    $error=true;
    $error_editcategoria="no hi cap categoria";
    }
    
    if(!$error){

        $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
        $sql1 = "update productes set nom='$newnom_producte',descripcio='$newdescripcio_producte',preu=$newpreu_producte where id=$id_producte ";
        
        if ($conn->query($sql1) === TRUE) {

           /*echo "Conexion establecida";*/
           header('location:privada.php');

        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }

        $sql2 = "update productes_categories set id_categories=$newcategoria_producte where id_productes=$id_producte";
        echo $sql2."<br>";
        if (!$conn->query($sql2)) {
            die("error ejecutando la consulta:".$conn->error);
        }
        echo "Producto creado con exito";

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
<body>
</body>
<form method="post">
    <p>Editar producto:</p>

    nou nom:<input type="text" name="newnom" id=""><span class="error_editnom"><?=$error_editnom;?></span><br>
    nova descripcio:<br><textarea type="text" name="newdescripcio" id=""></textarea><span class="error_editdescripcio"><?=$error_editdescripcio;?><br>
    nou preu:<input type="text" name="newpreu" id=""><span class="error_editpreu"><?=$error_editpreu;?></span><br>
    <label>nova categoria:</label>

    <select name="newcategoria" id="">

    <?php
    
    $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
    $sql = "select * from categories  ";
    
    if (!$resultado1 = $conn->query($sql)) {
        die("error ejecutando la consulta:".$conn->error);
    }
    
    if ($resultado1->num_rows >= 0) {
        while($categoria=$resultado1->fetch_assoc()){
        $cat_nom= $categoria["nom"];
        $cat_id= $categoria["id"];
        
        echo "<option value='$cat_id' >$cat_nom</option>";
        }
    }

        
    ?>

    </select><span class="error_editcategoria"><?=$error_editcategoria;?></span><br>

    <?php
    $id_producte = $_REQUEST['idc'];
    $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
    
    $sql2 = "select * from imatges where id_productes= $id_producte";
    if (!$resultado2 = $conn->query($sql2)) {
        die("error ejecutando la consulta:".$conn->error);
    }
    if ($resultado2->num_rows == 1) {
        
        while($imgdb=$resultado2->fetch_assoc()){
        $img = $imgdb["ruta"];
        $id_img=$imgdb["id"];
        echo "<img whith=40 height=40 src=".$img.">";
        echo "<a href='deleteimg.php?idi=".$id_img."'> [ Elimina la imatge ]</a>";
        echo "<br>";
        
        }

    }
    ?>

    <input type="submit" value="Editar">

    <br><br>

    <a href="privada.php">Tornar</a>

</form>
</html>