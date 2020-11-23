<?php
session_start();
unset($_SESSION["lista_precios"]);
unset($_SESSION["lista_productos"]);
header('Location: carrito.php');
?>