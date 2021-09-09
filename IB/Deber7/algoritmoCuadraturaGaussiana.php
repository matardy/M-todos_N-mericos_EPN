<?php

// Extraigo variables del formulario
$fun = $_POST["fun"];
$a = $_POST["a"];
$b = $_POST["b"];
$n = $_POST["n"]; // grado del polinomio
//para una tolerania menor a 0.0001 el programa tarda mucho
// esto aumenta segun el grado del polinomio.

//Declaro el array asociaativo
$array_intervalos = array();
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

function derivar($x, $e, $fun){
	$res = (fnEval($x+$e, $fun) - fnEval($x, $fun))/($e);
	return $res;
};




// Intervalos cambio de signo para legendere
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

// para integrar
$a = -2;
$b = 3;
$fun = "(x*x - 3)";

$frac = (($b-$a)/2) ;

$valorSuma = 0;

//genera polinomios de legendere
$u=2 ; //variable de prueba
$p = 0; // iterador polinomioal
$p_o  = "1";
$p_1 = "x" ;
$j = 0;
do{

	$pn = "(1/$u)*(((2*$u - 1)*x*($p_1)) - (($u-1)*$p_o))";
	$polinomios[$p] = $pn;

	//tengo mi polinomio
	//echo $pn;
	//echo "<br/>";

	$p += 1;
	//echo $pn; // aqui tengo mi polinomio de legendere
	//obtengo los intervalos de acmbio de signo de ese polinomio
	$array_intervalos = obtenerIntervalos(-1,1,40,$pn);

	// Aplico biseccion para encontrar las soluciones del polinomio de legendre

	foreach($array_intervalos as $key => $value )
	{
		$limInferior = $value['Limite inferior'];
		   $limSuperior = $value['Limite superior'];

		do {
			$c = ($limInferior + $limSuperior) / 2 ;
			if(fnEval($limSuperior,$pn)*fnEval($c,$pn) <=0 ){
				$limInferior = $c ;
				$c = ($limInferior + $limSuperior) / 2;

			}else{
				$limSuperior = $c ;
				$c = ($limInferior + $limSuperior) / 2 ;


			}

		} while (abs($limSuperior - $c)>=0.0001 && abs(fnEval($c,$pn))>0.0001);
		$array_intervalos[$key]['Raices'] = $c;
		$raices[$j] = $c ;

		//echo $c; // tengo mis raices asociadas al i polinomio legendre
		//echo "<br/>";
		$j += 1 ;
	}
	$x_i = ((($b - $a)/2)*$c) + (($b+$a)/2) ;
	$w_i = -2 / (($u+1)*derivar($c, 0.0001, $p_1)*fnEval($c,$pn));

	$valorSuma += fnEval($x_i, $fun)*$w_i ;
	//echo $valorSuma;
	//echo "<br/>";
	$p_o = $p_1;
	$p_1 = $pn;

	//echo "<br/>";
	$u += 1;
}while($u<=5);





$valorIntegral = $frac * $valorSuma;
//echo "<br/>";
//echo "El valor de la integral es: ";
//echo $valorIntegral;
$g = 1;
$limiteInf = 1;

$contadorGrado;
for($i=1; $i<=count($polinomios); $i += 1){
	echo $polinomios[$i-1];
	echo "<br/>";
	echo "<br/>";
	$limiteSup = $i+1;
	for($j = $limiteInf; $j<=$limiteSup; $j += 1){
		echo $raices[$j-1];
		echo "<br/>";
	}
	$limiteInf = $limiteSup + 1 ;

}


// echo 'La integral a calcular es: <br/><br/>';
// echo '<span class = "cmath '.$a.'" > `\int_'.$a.'^'.$b.' ('.$fun.')dx` <span/>';
// echo '<br/>';
// echo "<font size='5'>";
// echo "El valor de la integral es: ", $xn, '<br/>';
// echo "Y se alcanzo con " , $i-1 ," iteraciones. ";
// echo "Con una tolerancia igual a: ", $e;
