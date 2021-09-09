<?php

//Algoritmo de Newton para el deber #6.
echo "Metodo de newton.";
echo "<br/>";

// Extraigo variables del formulario
$fun = $_POST["fun"];
$a = $_POST["a"];
$b = $_POST["b"];
$n = $_POST["n"]; // numero de subintervalos
$e = $_POST["e"]; // Tolerancia

//Declaro un objeto array asociativo

// Array para intervalos de cambio de signo
$array_intervalos   = array();
// Array para las iteraciones hasta llegar a la raiz
$arrayIteraciones  = array();

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

// Genera un numero float aleatorio, para el intervalo de cambio de signo
function random_float ($min,$max) {
    return ($min + lcg_value()*(abs($max - $min)));
}

// Funcion derivada
function derivar($x, $e, $fun){
	$res = (fnEval($x+$e, $fun) - fnEval($x, $fun))/($e);
	return $res;
};


//Obtiene los intervalos de cambio de signo
function obtenerIntervalos($a,$b,$n,$fun){
	$auxArr = array();
	$s = ($b - $a) / $n ;
	$i = 0;

	do {
		$x = fnEval($a,$fun);
		$xn = fnEval($a+$s , $fun);
		if(($x*$xn) < 0){ // cambio de signo
			$auxArr[$i]['Limite inferior'] = $a ;
			$auxArr[$i]['Limite superior'] = $a + $s ;
			$auxArr[$i]['Raices'] = 0 ;
			$a = $a + $s;
			$i = $i + 1;
		}else{
			$a = $a + $s;
			$i = $i + 1;

		}
	} while ($a<=$b);
	return $auxArr;
}

// Genero los intervalos de cambio de signo
$array_intervalos =  obtenerIntervalos($a,$b,$n,$fun);

// Iteradores
$k=1;
$i=0;


// Algoritmo metodo de newton
foreach($array_intervalos as $key => $value )
{

	$limInferior = $value['Limite inferior'];
	$limSuperior = $value['Limite superior'];

	$arrayIteraciones[$i]["Iteraciones por intervalo"] = " <strong> [ $limInferior ; $limSuperior] <strong/>";
	$i = $i + 1;
	

	// escojo un aleatorio en el intervalo de cambio de signo
	$x0 = random_float($limInferior, $limSuperior);
	$numMax  = intval(log(($limSuperior-$limInferior) / $e ,2));
	do {

		$frac = ((fnEval($x0,$fun))/(derivar($x0,$e,$fun))) ;
		if(derivar($x0,$e,$fun) == 0){
			echo "Derivada igual a cero." ;
		}

		$x1 = $x0 - $frac;
		$x0 = $x1 ;
		$k = $k+1;

		$arrayIteraciones[$i]["Iteraciones hasta llegar a la raiz."]  = $x1;
		$i = $i + 1 ;

		$f = fnEval($x1, $fun);


	} while (abs($f)>$e);

	$array_intervalos[$key]['Raices'] = $x1;


}


// Desplega el texto
echo "<font size='6.5'>"; // tamaño
echo 'Su funcion es:  <br/><br/>';
echo '<span class = "cmath" > `f(x) =  '.$fun.'` <span/>';
echo '<br/>';

echo "<font size='5'>";
echo "<br/>";
echo "Sus raices se obtuvieron con " , $k-1;
echo " iteraciones.";
