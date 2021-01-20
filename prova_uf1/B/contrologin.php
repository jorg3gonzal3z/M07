<?php
session_start();


if(isset($_REQUEST["logout"])){

    $_SESSION=null;
    
    session_destroy();

}


if(!isset($_SESSION["login"])){

    header('location:index.php');


}


echo '<a href="?logout"\>[logout]</a>';





?>