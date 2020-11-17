<?php
session_start();


if(isset($_REQUEST["logout"])){

    $_SESSION=null;
    setcookie('email', null, 0,'/'); 
    setcookie('password', null, 0,'/'); 
    session_destroy();

}


if(!isset($_SESSION["login"])){

    header('location:publica.php');


}


echo '<a href="?logout"\>[logout]</a>';





?>