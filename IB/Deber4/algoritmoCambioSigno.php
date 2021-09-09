<?php

// Extraigo variables del formulario
$fun = $_POST["fun"];
$a = $_POST["a"];
$b = $_POST["b"];
$n = $_POST["n"]; // numero de subintervalos
$e = $_POST["e"]; // Tolerancia

//Declaro un objeto array asociativo

// Array para intervalos de cambio de signo
$array_intervalos   = array();
// Funcion que recibe la funcion matematica
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


// Funcion que retorna los intervalos donde cambia el signo en un array

function obtenerIntervalos($a,$b,$n,$fun){
	$auxArr = array();
	$s = ($b - $a) / $n ;
	$i = 0;

	do {
		$x = fnEval($a,$fun);
		$xn = fnEval($a+$s , $fun);
		if(($x*$xn) < 0){
			$auxArr[$i]['Limite inferior'] = $a ;
			$auxArr[$i]['Limite superior'] = $a + $s ;
			$auxArr[$i]['Raices'] = 0 ;
			$a = $a + $s;
			$i = $i + 1;
		}else{ // aqui no puede haber una asignacion al array
			$a = $a + $s;
			$i = $i + 1;

		}
	} while ($a<=$b);
	return $auxArr;
}

// array de intervalos para obtener la tabla
$array_intervalos =  obtenerIntervalos($a,$b,$n,$fun);

// ojo los arrays keys van en numeros pares

$i = 0;

//Algoritmo biseccion
foreach($array_intervalos as $key => $value )
{
	$limInferior = $value['Limite inferior'];
	   $limSuperior = $value['Limite superior'];


	do {
		$c = ($limInferior + $limSuperior) / 2 ;
		if(fnEval($limSuperior,$fun)*fnEval($c,$fun) <=0 ){
			$limInferior = $c ;
			$c = ($limInferior + $limSuperior) / 2;
			$i  = $i + 1;
		}else{
			$limSuperior = $c ;
			$c = ($limInferior + $limSuperior) / 2 ;
			$i  = $i + 1;

		}

	} while (abs($limSuperior - $c)>=$e && abs(fnEval($c,$fun))>$e);
	$array_intervalos[$key]['Raices'] = $c ; // debo usar el $key como index


}





//Despliegua texto informativo

echo "<font size='6.5'>"; // tamaño
echo 'Su funcion es:  <br/><br/>';
echo '<span class = "cmath" > `f(x) =  '.$fun.'` <span/>';
echo '<br/><br/>';

echo "<font size='5'>";
echo 'La raices se obtuvieron con ' , $i ;
echo ' iteraciones.';
