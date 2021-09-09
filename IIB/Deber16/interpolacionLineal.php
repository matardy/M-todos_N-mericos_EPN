<?php 
include "functions.php" ;

$dataSet = dataToArray('data.txt'); 
echo "<br/>";
echo "Datos experimentales: " ;
arrayToTable(dataToArray('data.txt'));
$beta = random_float($dataSet[0]["x"], $dataSet[1]["x"]); 
$alfa = ($beta - $dataSet[0]["x"]) / ($dataSet[1]["x"] - $dataSet[0]["x"]) ; 
$f_beta = ((1-$alfa)*$dataSet[0]["y"]) + ($alfa*$dataSet[0]["y"]); 
echo "beta: ", $beta; 
echo "<br/>" ; 
echo "f(beta): " , $f_beta; 