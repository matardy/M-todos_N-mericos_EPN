<?php 
function dataToArray($inputData){
    $x = array(); 
    $myFile = explode("\n", file_get_contents($inputData, 'r')); 
    for($i=0; $i<count($myFile); $i++){
        $x[$i]["x"] = $myFile[$i][0];
        $x[$i]["y"] = $myFile[$i][2];
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
function evaluationString($valor, $strEval, $str){

	$strEvaluar = str_replace($str,"(".$valor.")",$strEval);
    
	return $strEvaluar; 
}
function random_float ($min,$max) {
    return ($min + lcg_value()*(abs($max - $min)));
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
function showVector($a){
    $n = sizeof($a);
    echo "[";
    for($i=0; $i < $n ; $i++){
        echo $a[$i] ; 
        echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    
    }
    echo "]";
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

if($p[$i]["intervalos"]<= 0.15 && $p[$i]["intervalo1"]>=0.15 ){
    print_r($p[$i]);
}