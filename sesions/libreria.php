<?php

#funcion para evitar ataques sqli njection
function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
}

#funcion validar correo
function is_valid_email($str){
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}

?>