<?php

// Extraigo variables del formulario
$fun = $_POST["fun"];
$a = $_POST["a"];
$b = $_POST["b"];
$e = $_POST["e"];
//para una tolerania menor a 0.0001 el programa tarda mucho
// esto aumenta segun el grado del polinomio.

//Declaro el array asociaativo
$arr = array();

//Funcion para leer un string que es la funcion
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

//Funcion para saber si un numero es par oo impar
function esPar($n){
	if($n%2 == 0){
		return 1;
	}
	return 0;
}

//Funcion para integrar con la regla de simpson
function integrar($a, $b, $n, $fun){
	$h = ($b- $a)/$n ;
	$fo = fnEval($a,$fun);
	$fn = fnEval($b,$fun);
	$sumaPar = 0;
	$sumaImpar = 0;

	for($i = 1; $i<$n; $i = $i+1){
		if((esPar($i)==0)){
			$fi = fnEval($a+($i*$h),$fun); // Avance a proporcion de la base
			$sumaImpar = $sumaImpar + $fi;
		};
	};

	for($j = 1; $j<$n; $j = $j+1){
		if(esPar($j)==1){
			$fj = fnEval($a+($j*$h),$fun);
			$sumaPar = $sumaPar + $fj ;
		};
	};


	return ($h/3)*($fo +  4*$sumaImpar + 2*$sumaPar + $fn ) ;
}

$k=1;
$i=0;
do {
	$x = integrar($a,$b,$k,$fun);

	$xn = integrar($a,$b,$k+2,$fun); // de 3 en 3
	$arr[$i]['Valor de la integral'] = $xn;
	$k = $k + 2; // Los intervalos son de 3 puntos, debe avanzar de

	$dif = abs($xn-$x);
	$arr[$i]['Convergencia'] = $dif;
	$arr[$i]['Iteraciones'] = $i;
	$i = $i + 1;
} while ($dif>=$e);

//Desplegar valores


echo "<font size='6.5'>"; // tamaño
echo 'La integral a calcular es: <br/><br/>';
echo '<span class = "cmath '.$a.'" > `\int_'.$a.'^'.$b.' ('.$fun.')dx` <span/>';
echo '<br/>';
echo "<font size='5'>";
echo "El valor de la integral es: ", $xn, '<br/>';
echo "Y se alcanzo con " , $i-1 ," iteraciones. ";
echo "Con una tolerancia igual a: ", $e;
