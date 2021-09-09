<?php 
//data1

$dataSet = dataToArray('data1.txt');
echo "<br/>"; 
echo "Datos experimentales para interpolacion cuadratica y lagrangiana." ; 
arrayToTable($dataSet);
// Definicion de la matriz: 
for($i = 0; $i < 3; $i++){
    for($j = 0 ; $j <3 ; $j++){
        if($j==0){
            $M[$i][$j] = 1; 
        }
        if($j==1){
            $M[$i][$j] = $dataSet[$i]["x"]; 
        }
        if($j==2){
            $M[$i][$j] = $dataSet[$i]["x"]*$dataSet[$i]["x"]; 
        }
    }
} 


$b = array_values(array_column($dataSet, "y")); // associative array ==> List
triangularSup($M,$b); 
$resultante = retroSubstitucion($M,$b); 
echo "Coeficiente del polinomio: " ; 
echo "<br/>";

//Polinomio de ajuste
$polinomio = "" ; 
$polinomio.= "(" ;
$polinomio.=$resultante[0].")";
$polinomio.= " + ( " .$resultante[1]. "*x ) + " ;
$polinomio.="(".$resultante[2]."*x*x)";
echo $polinomio;
echo "<br/>"; 
//$valor, $strEval, $str
$newData = array();  
$i=1; 
$j = 0; 
while($i<=8){
    $newData[$j]["x"] = $i ; 
    $newData[$j]["y"] = fnEval($i, $polinomio, "x"); 
    $i = $i + 0.1; 
    $j++; 
}
//arrayToTable($newData); 

