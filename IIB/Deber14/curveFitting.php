<?php
include "NMVFunctions.php"; // Incluye todas las funciones necesarios para el metodo de NMV

function evaluationString($valor, $strEval, $str){

	$strEvaluar = str_replace($str,"(".$valor.")",$strEval);
    
	return $strEvaluar; 
}

function generatingSum($array1, $array2, $model){
    $mySum = "";

    $valor = "pow($model , 2)"; 
    $x = $array1; 
    $y = $array2; 
    $aux = 0; 
    $dataSize = count($x); 
    for($i=0;$i<$dataSize; $i++){
        $mySum.= " ";
        $mySum.= evaluationString($x[$i],evaluationString($y[$i], $valor, "y"), "x");
        $mySum.= " ";
        $mySum.= " + ";
    }
        $mySum .= " 0 ";
    return $mySum; 
}




// Driver Code 

$x = array(2,4,6,8); 
$y = array(5,15,37,63);
$model = "y - (a*x*x + b*x + c)";

$ajuste = NMV(generatingSum($x,$y,$model));

echo "Datos experimentales:" ;
echo "<br/><br/>"; 

for($i=0;$i<count($x); $i++){
    echo "x(",$i+1,")", " = " , $x[$i] , " | " , "y(",$i+1,")", " = " , $y[$i];
    echo "<br /> ";
}

echo "<br/>";
echo "Modelo cuadratico: ";
echo "y = ax^2 + bx + c";
echo "<br/><br/>";
echo "Valores de a, b y c: " ;
echo "<br/><br/>";
showVector($ajuste);