
<?php
include("funcions.php");
$errors=true;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  //control errors formulari, assegurar que el nom és nom, email és email....pass....


  if($_REQUEST["pass1"]==$_REQUEST["pass2"]){
    if(!checkIfEmailExists($_REQUEST["email"])){

        if(addUser($_REQUEST["nom"],$_REQUEST["email"],$_REQUEST["pass1"])){

                echo "Usuari creat correctament, pots fer login <a href=\"publica.php\">aquí</a>";
                $errors=false;
        }

    }else{
        echo "Aquest email ja existeix....<br>";  
    }


  }else{
      echo "Els passwords no coincideixen....<br>";
  }

}

if($errors){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        <label for="pass1">Pass:</label>
        <input type="password" name="pass1" id="pass1"><br>
        <label for="pass2">Repeteix pass:</label>
        <input type="password" name="pass2" id="pass2"><br>
        <input type="submit" value="Afegeix">
    
    
    
    
    </form>
</body>
</html>
<?php
}
?>