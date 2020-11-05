<?php
    session_start();

    unset($_COOKIE["user"]);
    unset($_COOKIE["passwd"]);
    setcookie('user', null);
    setcookie('passwd', null);
        
    session_destroy();
    header('location: sesions.php')
   
        
?>