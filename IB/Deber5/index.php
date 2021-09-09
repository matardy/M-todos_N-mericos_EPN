<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Busqueda del Cambio de Signo</title>
		<script async="true"
		src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
		 </script>
	</head>
	<body>
		<center>
			<center>
				<p>
				<br/>
				<font size = "+2">
					<strong>
					Quinto Deber: Métodos Numéricos. <br/>
					</strong>

					Algoritmo para encontrar el intervalo donde cambia <br/>
					el signo de una función y posteriormente por el metodo de newton encuentra las raices. <br/>
					<br/>
					<span class = "cmath">
						` x_k = x_(k-1) - \frac{f(x_(k-1))}{f'(x_(k-1))} `
					<span/>
				</font>
				</p>
				<text> Ingrese la función,  los limites del intervalo de interes,<br/>
					número de subintervalos, tolerancia al error.
				Nota: Debe ingresar los valores en sintaxis PHP. <text/>
	<font size = "+2">
		<form action="despliegue.php" method="post">
		<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
		<input name="a" type="text" placeholder="Limite inferior del intervalo" aria-label="Name" /><br/>
		<input name="b" type="text" placeholder="Limite superior del intervalo" aria-label="Name" /><br/>
		<input name="n" type="text" placeholder="Número de subintervalos" aria-label="Name" /><br/>
		<input name="e" type="text" placeholder="Tolerancia al error" aria-label="Name" /><br/>
		<input type="submit" value = "Calcular">
		</form>
	<font/>
		<center/>
	</body>
	<br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
	<br/> <br/><br/>
	<text> Autor: Gutemberg S. Mendoza <text/>
</html>
