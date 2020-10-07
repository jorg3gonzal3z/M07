<!DOCTYPE html>
<html>
	<head>
		<title>Ejeercicio Calendari Jorge</title>
		<meta charset="utf-8">
		<style>
			/*Para colorear la tabla desde el html */
			table caption{
				background-color: silver;
			}
			table, td {
				background-color: white;
				font-size: 24px;
				margin: 0 auto;
			}
		</style>
	</head>
	<body>
		<h1 style="text-align:center">Calendario</h1>
		<?php
			/* Creo las arrais con los dias , los meses,etc*/
			$diasSemana = array('Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do');
			$meses = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
			$time = time();
			$dia = date('d');
			$mes = date('n');
			$ano = date('Y');
			/*Time nos retorna la fecha actual medido por segundos desde la epoca Unix*/
			$newTime = $time - (($dia*24*60*60)-(24*60*60));
			echo ('<table style="width: 300px;">');
			/*Print de la fecha actual,ejemplo: 23 Octubre 2020*/
			echo ('<caption>' . $meses[$mes-1] . ' DE ' . $ano . '</caption>');
			$contador = 0;
			/*Creacion de la primera fila del calendario hasta llegar a tener 7, como dias de la semana */
			for($i=0; $i<7; $i++) {
				echo('<tr>');
				if($i == 0){
					/* Insertamos los dias de la semana en las celdas a medida que estas se van creando */
					for($j=0; $j<7;$j++) {
						echo ('<td>' . $diasSemana[$j] . '<td/>');
					}
				/*Creacion de las filas siguientes hasta acabar el calendario creando filas de 7 celdas cada una */
				} else {
					for($k=0; $k<7; $k++){
						/*De esta manera conseguimos colorear el dia en el que nos encontramos */
						if($contador == ($dia-1)){
							echo('<td style="color:blue;">');
						/*Si no es el dia en el que nos encontramos se inserta por defecto */
						} else {
							echo ('<td>');
						}
						/*Si el dia que vamos a insertar coresponde al mes pasado este se quedara vacio */
						if($i == 1 && $k < ((date('N', $newTime)) - 1) || $contador == date('t', $newTime)) {
							echo('');
						/*Si el dia se encuentra en el mes actual se reyenara la casilla */
						} else {
							echo ++$contador;
						}
						echo('<td/>');
					}
				}
				/*De esta manera paramos de insertar valores que no correspondan al mes en el que nos encontramos */
				echo('<tr/>');
				if($contador == date('t', $newTime)){
					$i = 7;
				}
			}
			echo ('<table/>');
		?>	
	</body>
</html>	