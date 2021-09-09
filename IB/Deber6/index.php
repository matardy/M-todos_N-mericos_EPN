// En este codigo se debe tomar en cuenta que el usuario
// sabe lo está ingresando, por ende el numero de intervalos
// debe colocarse con criterio

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Compendio de métodos</title>
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
					Sexto Deber: Métodos Numéricos. <br/>
					</strong>
					Algoritmo para encontrar la raices de una Funcion
					no lineal, utilizando diferentes métodos de resolución.
					<br/>
					<img src="imageFunction.png" >
				</font>
				</p>
				<text> Ingrese la función,  los limites del intervalo de interes,<br/>
						número de subintervalos, tolerancia al error y el método que desea utilizar. <br/>
						Nota: Debe ingresar los valores en sintaxis PHP, este codigo no tiene validación del input del usuario <br/>
						por lo tanto si no tienen relación los limites del intervalo con los numeros de subintervalos, el codigo no funcionaría <br/>
						y tampoco funcionaría el concepto matemático.
				<text/>
	<font size = "+2">
		<form action="despliegue.php" method="post">

		<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
		<input name="a" type="text" placeholder="Limite inferior del intervalo" aria-label="Name" /><br/>
		<input name="b" type="text" placeholder="Limite superior del intervalo" aria-label="Name" /><br/>
		<input name="n" type="text" placeholder="Número de subintervalos" aria-label="Name" /><br/>
		<input name="e" type="text" placeholder="Tolerancia al error" aria-label="Name" /><br/>

		<!-- Menu desplegable -->

		<select name="metodo">
			<option value="" disabled selected>Métodos a utilizar</option>
			<option value="Metodo de la bisección">Metodo de la bisección</option>
			<option value="Metodo de Newton">Metodo de Newton</option>
			<option value="Metodo de la secante">Metodo de la secante</option>
			<option value="Metodo hibrido">Metodo hibrido</option>
			<option value="Metodo de la falsa posición">Metodo de la falsa posición</option>
		</select>

		<input type="submit" value = "Calcular">

		</form>

	<font/>
		<center/>
	</body>

	<br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>

	<text> Autor: Gutemberg S. Mendoza <text/>
</html>
