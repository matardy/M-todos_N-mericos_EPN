<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Metodo de Euler</title>
		<script async="true"
		src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
		 </script>
		<link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">

	</head>
	<body>
		<center>
			<center>
				<p>
				<br/>
				<font size = "+2">
					<strong>
					Deber #21: Métodos Numéricos. <br/>
					</strong>
					Metodo de varios pasos. 
					<br/>
					<img src="euler.jpg" width="400" height="200"/>
				</font>
				</p>
				<text> Ingrese el punto x de interes, y(0) y el paso h.<br/>
				<text/>
	<font size = "+2">
		<form action="index.php" method="post">
		<input name="x" type="text" placeholder="Ingrese el punto de interes" aria-label="Name" /><br/>
		<input name="x_" type="text" placeholder="Condicion inicial de x:" aria-label="Name" /><br/>
		<input name="y" type="text" placeholder="Condicion inicial de y(x):" aria-label="Name" /><br/>
		
        <input name="h" type="text" placeholder="Ingrese el paso h" aria-label="Name" /><br/>
		<input type="submit" value = "Calcular">
		</form>

	<font/>

    <?php include "metodoVariosPasos.php" ?>

		<center/>
	</body>

	<br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>

	<text> Autor: Gutemberg S. Mendoza <text/>
</html>
