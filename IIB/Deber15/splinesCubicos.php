<?php
/*
[0][0] [0][2]
[1][0] [1][2]
[2][0] [2][2]
[3][0] [3][2]

*/
/*
printing associative array like matrix
foreach($x as $key=>$row) {
    foreach($row as $key2=>$row2){
        echo $row2;
    }
    echo "<br/>"; 
}
*/
/*
this is how yo print mannually
echo $x[0]['y']; 
*/

/*
Tareas: 
1. Solucionar que txt pueda leer numeros de 2 cifras. 
2. Hacer que los polinomios se creen solos como string 
3. acotar los polinomios



*/



function dataToArray($inputData){
    $x = array(); 
    $myFile = explode("\n", file_get_contents($inputData, )); 
    for($i=0; $i<count($myFile); $i++){
        //$x[$i]["i"] = $i+1; 
        $x[$i]["x"] = sprintf( "%2d" , $myFile[$i][0]);
        $x[$i]["y"] = sprintf( "%2d" , $myFile[$i][2]);
    }
    return $x; 
}

//This function takes an array an put into a table
function arrayToTable($array_assoc):void {
    if (is_array($array_assoc)) {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        list($table_title) = $array_assoc;
        foreach ($table_title as $key => &$value):
            echo '<th>' . $key . '</th>';
        endforeach;
        echo '</tr>';
        echo '</thead>';
        foreach ($array_assoc as &$master):
            echo '<tr>';
            foreach ($master as &$slave):
                echo '<td>' . $slave . '</td>';
            endforeach;
            echo '</tr>';
        endforeach;
        echo '</table>';
    }
}
function showMatrix($M){
    $s = '<table border="1">';
		foreach ( $M as $r ) {
			$s .= '<tr>';
				foreach ( $r as $v ) {
					$s .= '<td>'.$v.'</td>';
				}
			$s .= '</tr>';
		} 
		$s .= '</table>';
		echo $s;
	echo "<br/>";
}
function triangularSup(&$A,&$b):void{
    $n = sizeof($A);
    for($k = 0; $k<$n-1; $k++) {
        for($i=$k+1; $i<$n; $i++){
            $m = $A[$i][$k]/$A[$k][$k];
            for($j = $k; $j<$n; $j++){
                $A[$i][$j] -= ($m*$A[$k][$j]);
            }
            $b[$i] -= $m*$b[$k];
        }
    }
}
function retroSubstitucion($A,$b){
    $n = sizeof($A) ;
    $x[$n-1] = $b[$n-1]/$A[$n-1][$n-1];
    for($i= $n-2; $i>-1; $i--){
        $sum = 0;
        for($j = $i+1; $j<$n; $j++){
            $sum += $A[$i][$j]*$x[$j];
        }
        $x[$i] = ($b[$i] - $sum)/$A[$i][$i];
    }
    return $x; 
}
function showVector($a){
    $n = sizeof($a);
    echo "[";
    for($i=0; $i < $n ; $i++){
        echo $a[$i] ; 
        echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    
    }
    echo "]";
}
function fnEval($x, $strEval,$str){
	$resultado = 0;
	$strEval = str_replace($str,"(".$x.")",$strEval);

	eval("\$resultado = ".$strEval.";");
	if($resultado ==0) {
		$resultado = "0";
	}elseif($resultado == "" || $resultado == "-1.#IND"){
			$resultado = "NAN";
	}
	return $resultado;
}
echo "DATOS EXPERIMENTALES";
print_r(dataToArray("data.txt"));



arraytoTable(dataToArray("data.txt"));
$dataPoints = dataToArray("data.txt"); 
$firstSet = array(); 
$secondSet = array(); 
$f = 0; 

//Paso 1
//Solo puedo hacer append en el primero. 
// hi= x_i −x_(i−1)
for($i=1; $i < count($dataPoints); $i++){
    $firstSet[]["h"] = $dataPoints[$i]["x"] - $dataPoints[$i-1]["x"];
}
// sigma : σ=(y_i−y_(i−1))/hi
$contador = 0; 
for($i=1; $i < count($dataPoints); $i++){
    $firstSet[$contador]["sigma"] = ($dataPoints[$i]["y"] - $dataPoints[$i-1]["y"])/ ($firstSet[$contador]["h"]); 
    $contador = $contador + 1 ;
}
$contador = 0; 


//Paso 2



for($i=1; $i < count($dataPoints)-1; $i++){
    //$secondSet[$contador]["lambda"] = $firstSet[$contador+1]["h"]/($firstSet[$contador]["h"] + $firstSet[$contador+2]["h"]);
    $secondSet[$contador]["u"] = $firstSet[$contador]["h"]/($firstSet[$contador]["h"] + $firstSet[$contador+1]["h"]);
    
    $contador = $contador + 1 ;
}
$contador = 0; 

for($i=1; $i < count($dataPoints)-1; $i++){
    $secondSet[$contador]["lambda"] = $firstSet[$contador+1]["h"]/($firstSet[$contador]["h"] + $firstSet[$contador+1]["h"]);
    $secondSet[$contador]["d"] = 6*($firstSet[$contador+1]["sigma"] - $firstSet[$contador]["sigma"])/($firstSet[$contador+1]["h"]+$firstSet[$contador]["h"]);
    $contador  = $contador + 1 ; 
}
$contador = 0; 

for($i=0; $i<3; $i++){
    for($j=0; $j<3; $j++){
        if($i==$j){
            $Matrix[$i][$j] = 2; 
        }else{
            $Matrix[$i][$j] = 0; 
        }
        //Diag inferior
        if($i>$j && ($i-$j)==1){
            $Matrix[$i][$j] = $secondSet[$contador]["u"]; 
            $contador = $contador + 1 ;
        }
        $contador = 0; 
        //diag superior
        if($i<$j && ($j-$i)==1){
            $Matrix[$i][$j] = $secondSet[$contador]["lambda"];
        }
        $contador = 0; 
        
    }
}

$b = array_values(array_column($secondSet, "d")); // associative array ==> List
//showMatrix($Matrix); 
//arrayToTable($firstSet); 
//arrayToTable($secondSet);
triangularSup($Matrix,$b); 
$M  = retroSubstitucion($Matrix, $b); 
$M = array_reverse($M); 
array_unshift($M,0);
array_push($M,0);
//showVector($M); 
 
$contador = 0; 
$thirdSet = array(); 
for($i=1; $i< count($dataPoints); $i++){
    $thirdSet[$contador]["r"] = $M[$i-1]/(6*$firstSet[$contador]["h"]); 
    $thirdSet[$contador]["s"] = $M[$i]/(6*$firstSet[$contador]["h"]); 
    $thirdSet[$contador]["t"]  = ($dataPoints[$i-1]["y"] - ($M[$i-1]*$firstSet[$contador]["h"]*$firstSet[$contador]["h"]/6))/$firstSet[$contador]["h"];
    $thirdSet[$contador]["u_"]  = ($dataPoints[$i]["y"] - ($M[$i]*$firstSet[$contador]["h"]*$firstSet[$contador]["h"]/6))/$firstSet[$contador]["h"];
    $contador = $contador + 1 ;
}
//arrayToTable($thirdSet);
$contador = 0; 
$coefficients = array(); 
for($i=0 ;$i<count($thirdSet); $i++){
    $coefficients[$contador]["v"] = $thirdSet[$i]["s"] - $thirdSet[$i]["r"];
    
    $contador = $contador + 1;  
}
$contador = 0; 
for($i=1 ;$i<count($dataPoints); $i++){
    $coefficients[$contador]["w"] = 3*($thirdSet[$contador]["r"]*$dataPoints[$i]["x"] - $thirdSet[$contador]["s"]*$dataPoints[$i-1]["x"]);
    
    $contador = $contador + 1;  
}
$contador = 0; 

for($i=1 ;$i<count($dataPoints); $i++){
    $coefficients[$contador]["f"] = 3*($thirdSet[$contador]["s"]*pow($dataPoints[$i-1]["x"],2) - $thirdSet[$contador]["r"]*pow($dataPoints[$i]["x"],2)) + $thirdSet[$contador]["u_"] - $thirdSet[$contador]["t"];
    $coefficients[$contador]["g"] = $dataPoints[$i]["x"]*($thirdSet[$contador]["r"]*pow($dataPoints[$i]["x"],2) + $thirdSet[$contador]["t"]) - $dataPoints[$i-1]["x"]*(($thirdSet[$contador]["s"]*pow($dataPoints[$i-1]["x"],2)) + $thirdSet[$contador]["u_"]);
    
    $contador = $contador + 1;  
}
echo "TABLA DE COEFICIENTES: "; 
arrayToTable($coefficients);
/*
$polinomio = "" ; 
$polinomio.= "(" ;
$polinomio.=$resultante[0].")";
$polinomio.= " + ( " .$resultante[1]. "*x ) + " ;
$polinomio.="(".$resultante[2]."*x*x)";
*/
$polinomio = "" ;
$polinomio.= "(" ;
$polinomio.=$coefficients[0]["g"].")";
$polinomio.= " + ( " .$coefficients[0]["f"]. "*x ) + " ;
$polinomio.="(".$coefficients[0]["w"]."*x*x) + ";
$polinomio.="(".$coefficients[0]["v"]."*x*x*x)";
$newData = array();  
$i=1; 
$j = 0; 
while($i<=2){
    $newData[$j]["x"] = $i ; 
    $newData[$j]["y"] = fnEval($i, $polinomio, "x"); 
    $i = $i + 0.01; 
    $j++; 
} 

$polinomio1 = "" ;
$polinomio1.= "(" ;
$polinomio1.=$coefficients[1]["g"].")";
$polinomio1.= " + ( " .$coefficients[1]["f"]. "*x ) + " ;
$polinomio1.="(".$coefficients[1]["w"]."*x*x) + ";
$polinomio1.="(".$coefficients[1]["v"]."*x*x*x)";
$newData1 = array();  
$i=2; 
$j = 0; 
while($i<=3){
    $newData1[$j]["x"] = $i ; 
    $newData1[$j]["y"] = fnEval($i, $polinomio1, "x"); 
    $i = $i + 0.01; 
    $j++; 
} 

$polinomio2 = "" ;
$polinomio2.= "(" ;
$polinomio2.=$coefficients[2]["g"].")";
$polinomio2.= " + ( " .$coefficients[2]["f"]. "*x ) + " ;
$polinomio2.="(".$coefficients[2]["w"]."*x*x) + ";
$polinomio2.="(".$coefficients[2]["v"]."*x*x*x)";
$newData2 = array();  
$i=3; 
$j = 0; 
while($i<=4){
    $newData2[$j]["x"] = $i ; 
    $newData2[$j]["y"] = fnEval($i, $polinomio2, "x"); 
    $i = $i + 0.01; 
    $j++; 
} 

$polinomio3 = "" ;
$polinomio3.= "(" ;
$polinomio3.=$coefficients[3]["g"].")";
$polinomio3.= " + ( " .$coefficients[3]["f"]. "*x ) + " ;
$polinomio3.="(".$coefficients[3]["w"]."*x*x) + ";
$polinomio3.="(".$coefficients[3]["v"]."*x*x*x)";
$newData3 = array();  
$i=4; 
$j = 0; 
while($i<=5){
    $newData3[$j]["x"] = $i ; 
    $newData3[$j]["y"] = fnEval($i, $polinomio3, "x"); 
    $i = $i + 0.01; 
    $j++; 
} 
// 1 y 2 polinomio 
// 2 y 3 polinomio1  