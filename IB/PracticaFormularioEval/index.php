<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Practica Form</title>
	</head>
	<body>

		<center>
		<form action="index.php" method="post">
		<input name="fun" type="text" placeholder="funcion" aria-label="Name" /><br/>
		<!-- <input name="x" type="text" placeholder="valor de x" aria-label="Name" /><br/>
		<input name="a" type="text" placeholder="valor de a" aria-label="Name" /><br/>
		<input name="b" type="text" placeholder="valor de b" aria-label="Name" /><br/>-->
		<input type="submit" value = "Calcular integral"> 
		</form>
		<center/>
		<?php  
		function variablesParciales($fun, $abecedario){
			// Separa string en array
			$arr = str_split($fun);
			// busco las variables
			$result = array_intersect($arr,$abecedario);// a b a b a b  = array()
			$result = array_unique($result,SORT_STRING);// a b
			//Quito array asociativo

			foreach($result as $x => $x_value) {
				$value[] = $x_value;
			}

			//ordeno
			
			sort($value); //array()

			//quito array asociativo
			foreach($value as $x => $x_value) {
				$resultante[] = $x_value;
			}
			
			return $resultante;

		}
			if(isset($_POST["fun"])){
				$fun =  $_POST["fun"];
				$abc = ['a', 'b', 'c', 'd'];
				$valores =  sizeof(variablesParciales($fun,$abc));

			}?>
			<?php if($valores == 1){?> 
				<form action="despliegue.php" method="post">
				<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
				<input type="submit" value = "Calcular integral">
				</form>
			<?php
			}?>
			<?php if($valores == 2){?> 
				<form action="despliegue.php" method="post">
				<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
				<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
				
				<input type="submit" value = "Calcular integral">
				</form>
			<?php
			}?>
			<?php if($valores == 3){?> 
				<form action="despliegue.php" method="post">
				<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
				<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
				<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
				
				<input type="submit" value = "Calcular integral">
				</form>
			<?php
			}?>


			
	</body>

</html>
