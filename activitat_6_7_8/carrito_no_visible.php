<?php

    session_start();
    $error=false;

    if($_SESSION["login"]){
        
        foreach($_SESSION["lista_productos"] as $id){
            if($id == $_REQUEST['idp']){

                $error=true;

            }
        }

        if(!$error){

            $_SESSION["lista_productos"][]=$_REQUEST['idp'];
            $_SESSION["lista_precios"]+=$_REQUEST['precio'];
    
        
        }
    
    header('Location: privada.php');
    
    }
    
    else{
        die("error no has iniciado session");
    }

?>