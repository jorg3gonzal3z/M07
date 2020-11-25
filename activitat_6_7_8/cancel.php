<html>
<head>
  <title>Pagament Cancelat</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section>
    <p>Hi ha hagut algun error a l'hora de dur a terme el pagament!</p>
  </section>
</body>
<?php
if(isset($_SESSION["lista_precios"])){
  unset($_SESSION["lista_precios"]);
  unset($_SESSION["lista_productos"]);
}
echo "<br><br>";
echo "<a href='privada.php'> [Segueix comprant ]</a>";
?>
</html>