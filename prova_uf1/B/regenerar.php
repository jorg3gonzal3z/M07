
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function check(){

            if(!document.forms[0].username.value.length>0){
                alert("has d'intruduir un username");
            }else{


                location.href="recoverypassword.php?username="+document.forms[0].username.value;
            }

        }
    
    </script>
</head>