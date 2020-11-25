<?php

include("contrologin.php");
include("funcions.php");
$error=false;
$error_nom="";
$error_descripcio="";
$error_preu="";
$error_categoria="";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
  .carrito {float:right;}
</style>

<div class="carrito">
  <?php echo "<a href='carrito.php'> [ Tu Carrito ]</a>"; ?>
</div>

<body>
    Hola,
    <a href="edituser.php?emailc=<?=$_SESSION["login"]?>">Edita les teves dades</a>
<br>

    <?php
        if(isAdmin($_SESSION["login"])){

            $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
            $sql = "select * from usuaris  ";
            if (!$resultado = $conn->query($sql)) {
              die("error ejecutando la consulta:".$conn->error);
            }
            
              while($usuari=$resultado->fetch_assoc()){
                echo $usuari["nom"].",".$usuari["email"]."<a href=\"edituser.php?emailc=".$usuari["email"]."\">[E]</a><a onclick=\"return confirm('Are you sure?')\" href=\"delete.php?id=".$usuari["id"]."\">[D]</a><br>";
                $usuari["nom"];
              }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

          $nom_producte = test_input($_REQUEST['nom']);
          $descripcio_producte = test_input($_REQUEST['descripcio']);
          $preu_producte = test_input($_REQUEST['preu']);
          $categoria_producte = test_input($_REQUEST['categoria']);
          $user = $_SESSION["login"];
          $user_id = saberIdUser($user);
          
          
          if(empty($nom_producte)){
            $error=true;
            $error_nom="no hi cap nom";
          }
          if(empty($descripcio_producte)){
            $error=true;
            $error_descripcio="no hi cap descripcio";
          }
          if(empty($preu_producte)){
            $error=true;
            $error_preu="no hi cap preu";
          }
          if(empty($categoria_producte)){
            $error=true;
            $error_categoria="no hi cap categoria";
          }

          
          if(!$error){
            $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
            $sql1 = "insert into productes (nom,descripcio,preu,id_usuaris) values ('$nom_producte','$descripcio_producte','$preu_producte','$user_id ')  ";
            
            if ($conn->query($sql1) === TRUE) {
              $last_id = $conn->insert_id;

            } else {
              echo "Error: " . $sql1 . "<br>" . $conn->error;
            }
            $sql2 = "insert into productes_categories (id_productes,id_categories) values ('$last_id','$categoria_producte')  ";
            if (!$conn->query($sql2)) {
              die("error ejecutando la consulta:".$conn->error);
            }
            echo "Producto creado con exito";
            
            if(isset($_FILES["archivo"])){

              if (!file_exists("imatges/".saberIdUser($_SESSION["login"]))){
                mkdir("imatges/".saberIdUser($_SESSION["login"]), 0777);
              }
              
              $dirFitxers='imatges/'.saberIdUser($_SESSION["login"])."/";
              $fitxers = array_filter($_FILES['archivo']['name']);
              $total = count($_FILES['archivo']['name']);
      
              for( $i=0 ; $i < $total ; $i++ ) {   
                $fitxertemporal = $_FILES['archivo']['tmp_name'][$i];
    
                
                if ($fitxertemporal != ""){
                    
                  $fitxerfinal = $dirFitxers . $_FILES['archivo']['name'][$i];

                  
                  if(!move_uploaded_file($fitxertemporal, $fitxerfinal)) {

                    echo "algo ha sortit malament";  
                      
                  }else{
                    
                    addImgProducte($_FILES['archivo']['name'][$i],$fitxerfinal,$last_id);
                  }
                }
              }
      
            } 
            

          }

          
        }

    ?>
</body>
<form method="post" enctype="multipart/form-data">

  <p>Añadir un producto:</p>

  nom:<input type="text" name="nom" id=""><span class="error_nom"><?=$error_nom;?></span><br>
  descripcio:<br><textarea type="text" name="descripcio" id=""></textarea><span class="error_descripcio"><?=$error_descripcio;?><br>
  preu:<input type="text" name="preu" id=""><span class="error_preu"><?=$error_preu;?></span><br>
  <label>categoria:</label>

  <select name="categoria" id="">

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

  </select><span class="error_categoria"><?=$error_categoria;?></span><br>

  <label for="archivo[]"> imatges:</label><input type="file" name="archivo[]" id="" multiple><br>

  <input type="submit" value="afegir">

</form>
<?php
$user2 = $_SESSION["login"];
$id_user = saberIdUser($user2);

mostrarProductos($id_user,$user2);
mostrarAllProductos($id_user);

?>
</html>