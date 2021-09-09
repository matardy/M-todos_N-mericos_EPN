<?php
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
function derivar($x, $e, $fun,$str){
	$res = (fnEval($x+$e, $fun,$str) - fnEval($x, $fun,$str))/($e);
	return $res;
};
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
function fnEval_1($valor, $strEval, $str){

	$strEvaluar = str_replace($str,"(".$valor.")",$strEval);
    
	return $strEvaluar; 
}
function derivadaAString($fun,$valorADerivar){
    $h = 0.000001; 
    $u = ""; 
    $u.= $valorADerivar ;
    $u.= "+0.000001";
    $b = $valorADerivar; 
    $f = "" ; // inicializar como string
    $f.= "(";
    $f.= "(" ; 
    $f.= fnEval_1($u, $fun , $b) ; 
    $f.= ")";
    $f.= " - "; 
    $f.= "(" .$fun. ")" ; 
    $f.= ")"; 
    $f.= "/"; 
    $f.="(" .$h. ")" ; 
    return $f ; 
}
function derivadasParcialesString($h,$abecedario, $estimativa){
    $variables = variablesParciales($h,$abecedario);
	$x = $h;
    for($i=0; $i<sizeof($variables); $i++){
            switch ($variables[$i]) {
                case 'a':
                    $value = $estimativa[0];
                    break;
                case 'b':
                    $value = $estimativa[1];
                    break;
                case 'c':
                    $value = $estimativa[2];
                    break;
                case 'd':
                    $value = $estimativa[3];
                    break; 
                default:

                    break;
            }
            // evalua los demas valores a excepcion de que se deriva en primer lugar
            // se basa en que los otros valores se toman como constante. 
			$x =  fnEval_1($value,$x,$variables[$i]); 
            //aqui tocaria poner una funcion recursiva para que me haga denuevo el mismo proceso
            $x1 = fnEval_1($value,$x,$variables[$i]); 
    }
    return $x1 ; 
}
function derivadasParciales($h,$abecedario,$str, $estimativa){
	$x = $h;
    $valorADerivar = $str; 
    $variables = variablesParciales($h,$abecedario);
	
    for($i=0; $i<sizeof($variables); $i++){
        if($variables[$i]!= $valorADerivar){
            switch ($variables[$i]) {
                case 'a':
                    $value = $estimativa[0];
                    break;
                case 'b':
                    $value = $estimativa[1];
                    break;
                case 'c':
                    $value = $estimativa[2];
                    break;
                case 'd':
                    $value = $estimativa[3];
                    break; 
                default:
                    break;
            }
            // evalua los demas valores a excepcion de que se deriva en primer lugar
            // se basa en que los otros valores se toman como constante. 

            //Teorema de la separabilidad
            $x =  fnEval_1($value,$x,$variables[$i]);
            //aqui tocaria poner una funcion recursiva para que me haga denuevo el mismo proceso
            //$x = fnEval_1($value,$x,$variables[$i]);
        }else{
			$valor = $estimativa[$i];
		}
    }
    return derivar($valor, 0.001, $x, $valorADerivar);
}
function Evaluar($strEval){
	$resultado = 0;

	eval("\$resultado = ".$strEval.";");
	if($resultado ==0) {
		$resultado = "0";
	}elseif($resultado == "" || $resultado == "-1.#IND"){
			$resultado = "NAN";
	}
	return $resultado;
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
function norma($v){
    $sum = 0;
    $valorNorma = 0;
    for($i=0; $i<sizeof($v); $i++){
        $sum += pow($v[$i],2);
    }
    $valorNorma = sqrt($sum); 
    return $valorNorma;
}
function convertToNegative(&$F):void{
    for($i=0; $i<sizeof($F); $i++){
        $F[$i] = -1*$F[$i]; 
    }

}

function NMV($funcional){
    $abecedario = ["a", "b", "c", "d"];
    $estimativa = array(1,1,1);
    $k=0;
    $variables = variablesParciales($funcional, $abecedario);
do{
	for($i=0; $i<sizeof($variables); $i++){
		$F[$i] = Evaluar(derivadasParcialesString(derivadaAString($funcional,$variables[$i]),$abecedario,$estimativa));
	}
	for($i=0; $i<sizeof($variables); $i++){
		for($j=0; $j < sizeof($variables) ; $j++){
			$M[$i][$j] =derivadasParciales(derivadaAString($funcional, $variables[$i]), $abecedario, $variables[$j], $estimativa);
		}
	}

    convertToNegative($F);
	triangularSup($M,$F);
	$nueva = retroSubstitucion($M, $F);
	for($i=0; $i<sizeof($variables); $i++){
		$estimativa[$i] = $estimativa[$i] + $nueva[$i];
	}
    $k+=1;
}while(norma($nueva)>=0.0001);
    return $estimativa; 
}
//-----DRIVER CODE 
/*
$variables = variablesParciales($fun,$abecedario);

echo "Estimativa dada por el usuario: " ; 
echo "<br/>";
showVector($estimativa); 
echo "<br/>";
echo "----------------------------------------------";
echo "<br/>"; 
$k=0;
do{
	//---F --- ---------- Pasado a la izq directamente
	//Generamos string f1, f2 y luego evaluamos a PHP
	echo '<br>';
    echo "Iteración número: ", $k+1; 
    echo "<br>"; 
	for($i=0; $i<sizeof($variables); $i++){
		$F[$i] = Evaluar(derivadasParcialesString(derivadaAString($fun,$variables[$i]),$abecedario,$estimativa));
	}
	
	echo "<br/>";
	echo "Vector F: " ; 
    echo "<br/>"; 
    echo "<br/>";
	showVector($F);
	echo "<br/>";

	// ----JACOBIANA con la logica inicial
	// Aqui ya no genera el string de los elementos de la jacobiana simplemente el valor
	for($i=0; $i<sizeof($variables); $i++){
		for($j=0; $j < sizeof($variables) ; $j++){
			$M[$i][$j] =derivadasParciales(derivadaAString($fun, $variables[$i]), $abecedario, $variables[$j], $estimativa);
		}
	}
	echo "<br/>";
    echo "MATRIZ JACOBIANA"; 
    echo "<br/>";
    echo "<br/>";
    convertToNegative($F);
    showMatrix($M);
	triangularSup($M,$F);

	$nueva = retroSubstitucion($M, $F);
    echo "<br/>";
	echo "Valor de Delta X: " ; 
    echo "<br/>";
    echo "<br/>";
    showVector($nueva); 

	for($i=0; $i<sizeof($variables); $i++){
		$estimativa[$i] = $estimativa[$i] + $nueva[$i];
	}
	echo '<br>';
    echo "<br/>";
	echo "Estimativa para la iteración ", $k+1+1;
    echo "<br/>";
    echo '<br>';
	showVector($estimativa); 
	echo '<br>';
    echo "------------------------------------------------------";
    echo "<br/>"; 
    $k+=1;
}while(norma($nueva)>=$_POST["tol"]);
echo "<br/>";
echo "Mínimo de la función:  ";
    echo '<br>';
    echo "<br/>";
	showVector($estimativa); 
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "Total de iteraciones: ", $k ; 
*/