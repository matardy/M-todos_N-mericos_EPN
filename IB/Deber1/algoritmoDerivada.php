<?php
 	/*
	Autor: Gutemberg S. Mendoza.

	Vamos a calcular la derivada f(x) = x^3 + 2x + 5
	en 24 con un Error absoluto del 0.00001
	*/


	//function que retorna la funcion matematica que vamos a evaluar
	function f($n){
		return pow($n,2) - (3*$n) + 4;
	};

	function derivar($x, $k){
		$res = (f($x) - f($x-$k))/($k);
		return $res;
	};


	$k=0.1; // valor inicial de delta x
	$i=0; // iterador
	$dif = 0; // valor de convergencia
	$arr = array(); // creamos un array para los valores

	// Columnas de nuestra tabla
	$keys = array(	'Iteraciones',
					'<span class = "cmath"> `f(x)`</span>',
					'<span class = "cmath"> `f(x+\Deltax)`</span>',
					'<span class = "cmath"> `f\'(x)`</span>',
					'<span class = "cmath"> `\Deltax` </span>',
					'Convergencia'	);

	//Algoritmo
	do{
		$aux = derivar($_POST["x"],$k); // Derivada
		$arr[$i]['<span class = "cmath"> `f\'(x)`</span>'] = $aux; //Guardamos los datos en un associative array

		$auxn = derivar($_POST["x"], $k/2);

		$dif = $aux - $auxn ; // Convergencia
		$arr[$i]['Convergencia'] = $dif;

		$k = $k/2; // es menos eficiente si divido a 2 // delta x
		$arr[$i]['<span class = "cmath"> `\Deltax` </span>'] = $k;

		$fun1 = f($_POST["x"]+$k); // y2
		$arr[$i]['<span class = "cmath"> `f(x+\Deltax)`</span>'] = $fun1;

		$fun2 = f($_POST["x"]);// y1
		$arr[$i]['<span class = "cmath"> `f(x)`</span>'] = $fun2;

		// aumento el iterador de vectores y de la convergencia
		$arr[$i]['Iteraciones'] = $i+1;
		$i = $i + 1;


	}while(abs($dif)>=0.001); // criterio de parada absoluto
