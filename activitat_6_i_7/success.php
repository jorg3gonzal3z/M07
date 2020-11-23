<?php
session_start();
include("funcions.php");


$user = $_SESSION["login"];
$user_id = saberIdUser($user);
$precioTotal = $_SESSION["lista_precios"];
if($_SESSION["Token"] == $_REQUEST["token"]){
  
  $conn1 = connectDB('localhost', 'jgonzalez', 'jgonzalez', 'jgonzalez_activitat_6');
  $sql1 = "insert into comandes (id_usuari,preu_comanda) values ('$user_id','$precioTotal')  ";

  if ($conn1->query($sql1) === TRUE) {
    $last_id = $conn1->insert_id;


    foreach($_SESSION["lista_productos"] as $id){

      $sql2 = "UPDATE `productes` SET `id_comanda` = '$last_id' WHERE `id` = $id";
      if (!$resultado3 = $conn1->query($sql2)) {
        die("error ejecutando la consulta:".$conn1->error);
      }

    }


  } 
  else {
    echo "Error: " . $sql1 . "<br>" . $conn1->error;

  }
}else{
  die("error");
}



?>


<html>
<head>
  <title>Gracies per la comanda!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section>
    <h1>Gracies per la comanda!</h1>
    <p>
      Si tens qualsevol dubte contacta amb nosaltres a:
      <a href="mailto:orders@example.com">orders@example.com</a>.
    </p>
  </section>


  <?php
  
  if(isset($_SESSION["lista_precios"])){

    echo "<h1>La teva comanda</h1>";

    mostrarComanda($last_id);//mostrarcomanda con el id de la ultimacomanda

    echo "<br>"."<br>"."-- Ressum de la comanda --"."<br>"."<br>";

    foreach($_SESSION["lista_productos"] as $id){

        mostrarCarrito($id);
        echo "<hr><br>";
        
    }

    echo"<h4>Preu de la comanda</h4>";
    print_r($_SESSION["lista_precios"]);
    echo "€";

    //despues de mostrar el pedido borro el carrito para que pueda seguir comprando//
    unset($_SESSION["lista_precios"]);
    unset($_SESSION["lista_productos"]);

  }
  else{
    echo"error existeix cap comanda";
  }
  
  echo "<br><br>";
  echo "<a href='privada.php'> [Segueix comprant ]</a>";
  
  ?>


</body>
</html>