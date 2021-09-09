<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Integración Númerica</title>
		<script async="true"
		src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
		 </script>
	</head>
	<body>
		<center>
			<center>
				<p>
				<br/>loca
				<font size = "+2">
					<strong>
					Segundo Deber: Métodos Numéricos. <br/>
					</strong>

					Algoritmo numérico para calcular la integral de
					de una función por el<br/>
					Método de los trapecios <br/>
					<br/>
					<span class = "cmath">
						`\int_(x_o)^(x_n) f(x)dx = \frac{h}{2}(f(x_o) + f(x_n) + 2\sum_(i=1)^(n-1)f(x_i))`
					<span/>
				</font>
				</p>
				<text> Ingrese la función a integrar, la tolerancia
				y los limites de integración:<br/>
				Nota: Debe ingresar los valores en sintaxis PHP. <text/>
	<font size = "+2">
		<form action="despliegue.php" method="post">
		<input name="fun" type="text" placeholder="Ingrese la función" aria-label="Name" /><br/>
		<input name="e" type="text" placeholder="Tolerancia" aria-label="Name" /><br/>
		<input name="a" type="text" placeholder="Limite inferior" aria-label="Name" /><br/>
		<input name="b" type="text" placeholder="Limite superior" aria-label="Name" /><br/>
		<input type="submit" value = "Calcular integral">
		</form>
	<font/>
		<center/>
	</body>
	<br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
	<br/> <br/><br/>
	<text> Autor: Gutemberg S. Mendoza <text/>
</html>
