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
			<?php include "algoritmoCuadraturaGaussiana.php" ?>

			<p>
			<font size = "+2">
				<strong>
				TABLA DE VALORES. <br/>
				</strong>
				<text> valor integrales <text/>
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



			<br/>
			<text> Autor: Gutemberg S. Mendoza <br/>
				<text/>



		<center/>

	</body>
</html>
