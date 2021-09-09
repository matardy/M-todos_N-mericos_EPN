<?php 
$aux = 1;
$piString = "" ; 

// creacion de pi string 
$contador = 0; 
for($i = 0; $i <3; $i++){
    for($j=0; $j<3; $j++){
        if($i!=$j){
            $piString.= "(x " ; 
            $piString.= "- " .$dataSet[$j]["x"]. " )";
            $contador = $contador + 1 ; 

        }
        
        if($i!=$j && $contador ==1){
            $piString.= "*";

        }

    }
    $contador = 0; 
    $piStringArray[$i] =  $piString ;
    $piString = ""; 
}  
//Creacion de pi valor
for($i = 0; $i<3; $i++){
    for($j=0; $j<3; $j++){
        if($i!=$j){
            $aux = $aux*($dataSet[$i]["x"] - $dataSet[$j]["x"]);

        }
        
    }
    $pi[] = $aux ; 
    $aux = 1; 
}
echo "<br/>";
//print_r($pi);

for($i = 0; $i <3; $i++){
    $b[$i] = ($dataSet[$i]["y"] / $pi[$i]) ; 
}
echo "<br/>";
//print_r($b);
$polinomio = ""; 
for($i=0; $i<3; $i++){
    $polinomio.= "( " .$b[$i]."*".$piStringArray[$i]. ")";
    $polinomio.= " + "; 
}
$polinomio.= " 0"; 

$newData1 = array();  
$i=1; 
$j = 0; 
while($i<=8){
    $newData1[$j]["x"] = $i ; 
    $newData1[$j]["y"] = fnEval($i, $polinomio, "x"); 
    $i = $i + 0.1; 
    $j++; 
}