<?php

// Extraigo variables del formulario
$fun = $_POST["fun"];
$a = $_POST["a"];
$b = $_POST["b"];
$e = $_POST["e"];

// Columnas
$arr = array();
$keys = array('Iteraciones', 'Valor de la integral', 'Convergencia');

// Funcion para que el usuario ingrese su funcion
function fnEval($x, $strEval){
	$resultado = 0;
	$strEval = str_replace("x","(".$x.")",$strEval);
	eval("\$resultado = ".$strEval.";");
	if($resultado ==0) {
		$resultado = "0";
	}elseif($resultado == "" || $resultado == "-1.#IND"){
			$resultado = "NAN";
	}
	return $resultado;
}

//Funcion para integrar por el Metodos de Trapecios
function integrar($a, $b, $n,$fun){
	$h = ($b-$a)/$n;
	$f_o = fnEval($a, $fun); // f(0)
	$f_n = fnEval($b, $fun); // f(n)
	$intSum = 0;
	for($k=$a; $k<$b; $k = $k+$h){
		$fi = fnEval($k,$fun);
		$intSum = $intSum + $fi ;
	}
	return ($h/2)*($f_o + $f_n + (2*$intSum));
}

// iteradores
$k = 1;

// Algoritmo para el criterio de parada
do {

	$x = integrar($a,$b,$k,$fun);
	$xn = integrar($a,$b,$k+1,$fun);
	$dif  = abs($xn - $x) ; // Convergencia

	$k = $k + 1 ;
	$arr[$k]['Iteraciones']  = $k;

	$arr[$k]['Convergencia'] = $dif ;

	$arr[$k]['<span class = "cmath"> `\int_'.$a.'^'.$b.'f(x_(i-1))dx`<span/>'] = $xn;
	$arr[$k]['<span class = "cmath"> `\int_'.$a.'^'.$b.'f(x_(i))dx `<span/>'] = $x;


} while ($dif >= ($e));
// Para una tolencia manor al 0.001 el codigo tarda
// una cantidad de tiempo considerable, esto es una problema
// como tal de php pues en C++ es inmediato.


//Desplegar valores
echo "<font size='6.5'>"; // tamaño
echo 'La integral a calcular es: <br/><br/>';
echo '<span class = "cmath '.$a.'" > `\int_'.$a.'^'.$b.' ('.$fun.')dx` <span/>';
echo '<br/>';
echo "<font size='5'>";
echo "El valor de la integral es: ", $x, '<br/>';
echo "Y se alcanzo con " , $k ," iteraciones.";
