<?php
$fun = $_POST["fun"];
$p = $_POST["x"];
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


echo "El valor evaluado de la funcion es:<br/> " ;
//echo  fnEval($p , $fun) ;

$a = $_POST["a"];
$b = $_POST["b"];

$e = 0.00001;
$f_o = fnEval($a, $fun);
$f_n = fnEval($b, $fun);
$n = 1000;
$h = ($b-$a)/$n ; // aumentan a esta razon
$k = $a ;
$dif = 0;
$intSum = 0;
echo $h;
do {

	$fi = fnEval($k,$fun);
	echo $fi ;
	echo "<br/>";
	$intSum = $intSum + $fi ;
	//$dif = $fi2 - $fi ;
	//echo $fi;
	$k = $k+$h ;
	// echo "iterador " ,$k  ;
	// echo "<br/>";
	//echo "$fi <br/>";

} while ($k <= ($b) );

echo "<br/>";
echo ($h/2)*($f_o + $f_n + (2*$intSum));
