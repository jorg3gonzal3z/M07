<?php

$hora = date("G");
$min = date("i");
$seg = date("s");

echo"Hora";
echo"<br>";
for ($i = 0; $i <= 23; $i++) {
    if ($i == $hora){
        echo "<b>" .$i . "</b>" . " ";
    }
    else{
        echo $i . " ";
    }
}

echo"<br>";
echo"Minut";
echo"<br>";
for ($i = 0; $i <= 59; $i++) {
    if ($i == $min){
        echo "<b>" .$i . "</b>" . " ";
    }
    else{
        echo $i . " ";
    }
}

echo"<br>";
echo"Segon";
echo"<br>";

for ($i = 0; $i <= 59; $i++) {
    if ($i == $seg){
        echo "<b>" .$i . "</b>" . " ";
    }
    else{
        echo $i . " ";
    }
}

?>