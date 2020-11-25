<?php


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function connectDB($server,$user,$pass,$db){
    $conn = new mysqli($server,$user,$pass,$db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function isAdmin($email){


  $admin=false;
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from usuaris where email='$email'  and id_rol=1 ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    $admin=true;

  }
  
  return $admin;

}

function getUserData($email){

  $usuari;
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from usuaris where email='$email'  ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    
    
    $usuari = $resultado->fetch_assoc();
   

  }
  
  return $usuari;

}


 
function generate_string( $strength = 16) {
     $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}




function userExists($email){

  $exists=false;
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from usuaris where email='$email'  ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    
    
    $exists=true;
   

  }
  
  return $exists;

}

function deleteUser($id){



  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "delete from usuaris where id=$id ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}

function updatePasswordUser($email,$password){



  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "update usuaris set password=md5('$password') where email='$email' ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}

function updateUser($nom,$email,$password,$id){



  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "update usuaris set nom='$nom',email='$email',password=md5('$password') where id=$id ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}

function addUser($nom,$email,$password){



  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "insert into usuaris (email,password,nom) values ('$email',md5('$password'),'$nom')  ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}
/**
 * return true si email existeix
 * return false si email no existeix
 */
function checkIfEmailExists($email){


  $resultat=false;
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from usuaris where email='$email'  ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    $resultat=true;
  }
  
  return $resultat;


}
/**
 * 
 * return true usuari i pasword correcte
 * return false cas contrari
 */
function validaUsuari($email,$password){

    $resultat=false;
    $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
    $sql = "select * from usuaris where email='$email' and password='$password' ";
    if (!$resultado = $conn->query($sql)) {
      die("error ejecutando la consulta:".$conn->error);
    }
    if ($resultado->num_rows == 1) {
      $resultat=true;
    }
    
    return $resultat;

}


function saberIdUser($user) {
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from usuaris where email='$user'";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    
    while($usuaridb=$resultado->fetch_assoc()){
      $user_id = $usuaridb["id"];
      return $user_id;
    }
    
  }
}

function addImgProducte($name,$url,$id_product) {
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "insert into imatges (nom,ruta,id_productes) values ('$name','$url',$id_product)  ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;
}

//muestra todos los productos del usuario
function mostrarProductos($id_user,$user2){

  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from productes where id_usuaris='$id_user' ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
    echo "<br>"."<br>"."-- Llistat de productes de ". $user2 . " --"."<br>"."<br>";

    while($productes=$resultado->fetch_assoc()){
      if(!$productes["id_comanda"]){
      echo "Id del pruducte: ".$productes["id"].", Nom del producte: ".$productes["nom"].", Descripcio del producte: ".$productes["descripcio"].", Preu del producte: ".$productes["preu"]."€";
      
      $id_product= $productes["id"];
      $sql2 = "select * from imatges where id_productes= $id_product";
      if (!$resultado2 = $conn->query($sql2)) {
        die("error ejecutando la consulta:".$conn->error);
      }
      if ($resultado2->num_rows == 1) {
        
        while($imgdb=$resultado2->fetch_assoc()){
          $img = $imgdb["ruta"];
          echo "<img whith=40 height=40 src=".$img.">     ";
          
        }

      }
      echo "<a href='editproduct.php?idc=".$productes["id"]."'> [ Edita el producte ]</a>";
      echo "<a href='deleteproduct.php?idc=".$productes["id"]."'> [ Elimina el producte ]</a>";
      echo "<hr>";
      echo "<br>";
      }
    }

}

//mustra todos los productos menos los que son de ese mismo usuario//
function mostrarAllProductos($id_user){
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from productes  where id_usuaris!=$id_user ";

  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
    echo "<br>"."<br>"."-- Llistat de productes per comprar --"."<br>"."<br>";
    while($productes=$resultado->fetch_assoc()){

      if(!$productes["id_comanda"]){
        echo "Id del pruducte: ".$productes["id"].", Nom del producte: ".$productes["nom"].", Descripcio del producte: ".$productes["descripcio"].", Preu del producte: ".$productes["preu"]."€";
        $id_producte = $productes["id"];
        
        $sql2 = "select * from imatges where id_productes= $id_producte";
        if (!$resultado2 = $conn->query($sql2)) {
            die("error ejecutando la consulta:".$conn->error);
        }
        if ($resultado2->num_rows == 1) {
            
            while($imgdb=$resultado2->fetch_assoc()){
            $img = $imgdb["ruta"];
            echo "<img whith=40 height=40 src=".$img.">";

            
            }

        }
        //envia el id del producto seleccionado a carrito_no_visible.php//
        $producto=$productes["id"];
        $precio=$productes["preu"];
        echo "<a href='carrito_no_visible.php?idp=".$producto."&precio=".$precio."'> [ Añade al carrito ]</a>";

        echo "<hr>";
        echo "<br>";
      }

    }
}

function mostrarCarrito($idp){
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from productes  where id=$idp ";

  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }

    while($productes=$resultado->fetch_assoc()){
    echo "Id del pruducte: ".$productes["id"].", Nom del producte: ".$productes["nom"].", Descripcio del producte: ".$productes["descripcio"].", Preu del producte: ".$productes["preu"]."€";
    $id_producte = $productes["id"];
    
    $sql2 = "select * from imatges where id_productes= $id_producte";
    if (!$resultado2 = $conn->query($sql2)) {
        die("error ejecutando la consulta:".$conn->error);
    }
    if ($resultado2->num_rows == 1) {
        
        while($imgdb=$resultado2->fetch_assoc()){
        $img = $imgdb["ruta"];
        echo "<img whith=40 height=40 src=".$img.">";
        }

    }
    }
}

function mostrarComanda($idc){
  $conn = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql = "select * from comandes  where id=$idc ";

  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
    while($comandes=$resultado->fetch_assoc()){
    echo "Id de la comanda: ".$comandes["id"].", Id del usuari que ha fet la comanda: ".$comandes["id_usuari"].", Data de la comanda: ".$comandes["data"].", Preu de la comanda: ".$comandes["preu_comanda"]."€";
    }

}

?>