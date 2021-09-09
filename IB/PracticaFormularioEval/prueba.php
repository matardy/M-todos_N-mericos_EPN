<?php

$fun =  $_POST["fun"];
$abc = ['a', 'b', 'c', 'd'];

function variablesParciales($fun, $abecedario){
    // Separa string en array
    $arr = str_split($fun);
    // busco las variables
    $result = array_intersect($arr,$abecedario);// a b a b a b  = array()
    $result = array_unique($result,SORT_STRING);// a b
    //Quito array asociativo

    foreach($result as $x => $x_value) {
        $value[] = $x_value;
      }

    //ordeno
    
    sort($value); //array()

    //quito array asociativo
    foreach($value as $x => $x_value) {
        $resultante[] = $x_value;
      }
    
    return $resultante;

}
echo sizeof(variablesParciales($fun,$abc));
