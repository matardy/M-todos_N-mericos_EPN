<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Tablas de valores y resultado</title>
		<!-- Aplico el estilo de la tabla -->
		<style>
		table,
		  td,
		  th {
			padding: 4px;
			border: 2px solid #1c87c9;
			border-radius: 4px;
			background-color: #e5e5e5;
			text-align: center;
		  }
		</style>

		<!-- Ingreso este script para usar notación matematica -->
		<script async="true"
		src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
		</script>
	</head>
	<body>
		<center>
			<!-- Script Principal -->
			<?php
				switch ($_POST["metodo"]) {
					case 'Metodo de Newton':
						include "algoritmoNewton.php" ;
						break;

					case 'Metodo de la bisección':
						include "algoritmoBiseccion.php" ;
						break;

					case 'Metodo de la secante':
						include "algoritmoSecante.php" ;
						break;

					case 'Metodo hibrido':
						include "AlgoritmoHibrido.php" ;
						break;

					case 'Metodo de la falsa posición':
						include "AlgoritmoFalsaPosicion.php" ;
						break;

					default:
						// code...
						break;
				}

			?>

			<p>
			<font size = "+2">
				<strong>
				TABLA DE VALORES. <br/>
				</strong>
				<text> Se muestra el limite inferior y superior de cambio de signo con su raiz asociada. <text/>
			</font>
			</p>

			<!-- De Array Asociativo de Php a Tabla que muestra la raiz final por intervalo.-->

			<?php if (count($array_intervalos) > 0 ): ?>
			<table>
			  <thead>
				<tr>
				  <th><?php echo implode('</th><th>', array_keys(current($array_intervalos))); ?></th>
				</tr>
			  </thead>
			  <tbody>
			<?php foreach ($array_intervalos as $row): array_map('htmlentities', $row); ?>
				<tr>
				  <td><?php echo implode('</td><td>', $row); ?></td>
				</tr>
			<?php endforeach; ?>
			  </tbody>
			</table>
			<?php endif; ?>

			<!-- Tabla que muestra los valores por iteracion. -->
			<p>
			<font size = "+2">
				<strong>
				TABLA DE VALORES. <br/>
				</strong>
				<text> Se muestra los valores por iteracion hasta llegar a la raiz con una tolerancia dada.<text/>
			</font>
			</p>
			<br/>
			<?php if (count($arrayIteraciones) > 0): ?>
			<table>
			  <thead>
				<tr>
				  <th><?php echo implode('</th><th>', array_keys(current($arrayIteraciones))); ?></th>
				</tr>
			  </thead>
			  <tbody>
			<?php foreach ($arrayIteraciones as $row): array_map('htmlentities', $row); ?>
				<tr>
				  <td><?php echo implode('</td><td>', $row); ?></td>
				</tr>
			<?php endforeach; ?>
			  </tbody>
			</table>
			<?php endif; ?>



			<br/>
			<text> Autor: Gutemberg S. Mendoza <br/>
				<text/>



		<center/>

	</body>
</html>
