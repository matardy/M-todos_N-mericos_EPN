<?php


// Crea una matrix cuadrada dada su dimension
function createMatrix($dimension){
    for($i = 0; $i < $dimension ; $i++){
        for($j = 0; $j <$dimension ; $j++){
            $A[$i][$j] = $i*$j; 
        }
    }
    return $A; 
}
function fillMatriz($A, $n){
    for($i = 0; $i < $n; $i++){
        for($j = 0; $j < $n; $j++){
            $A[$i][$j]= 0;
        }
    }
    return $A;
}

function showMatrix($A){
    for($i = 0; $i < sizeof($A) ; $i++){
        for($j = 0; $j <sizeof($A) ; $j++){
            echo $A[$i][$j]." ";
            echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
            


        }
            echo "<br/>"; 
    }
}
function showVector($a){
    $n = sizeof($a);
    for($i=0; $i < sizeof($a) ; $i++){
        echo $a[$i] ; 
        echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
    }
}

function swapRows($A, $s1, $s2){
    for($i = 0; $i < sizeof($A) ; $i++){
        $temp = $A[$s2][$i];
        $A[$s2][$i] = $A[$s1][$i];
        $A[$s1][$i] = $temp; 
    }
    return $A;
}



// Las funciones void funcionan con c++
// Transforma la matriz a triangular superior
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

function LU(&$A, &$b,  &$L, &$U):void{
    $n = sizeof($A); // dimension de la matriz
    $U = $A ; // U parte de A
    triangularSup($U,$b); // Genera la matriz uupper
    $L = fillMatriz($L,$n); 

    // Algoritmo matriz L: A
    
     for($i=0; $i<$n; $i++){
        for($k = $i; $k< $n; $k++){
            if($i == $k){
                $L[$i][$i] = 1; 
            }else{
                $sum = 0; 
                for($j = 0; $j<$i; $j++){
                    $sum += ($L[$k][$j] * $U[$j][$i]); 

                }
                $L[$k][$i] = (($A[$k][$i] - $sum)/($U[$i][$i]));
            
            } 
        }
    }    

}


// Driver code --------------------------------
 
//Valores iniciales

$A = array(array(1,-1,3),
array(4,1,-1),
array(2,-1,3)); 
$b = array(11,-4,10);

echo "<font size='6.5'>";
echo "Matriz ingresada: ";
echo "<br />"; 
showMatrix($A);
echo "<br/>";
echo "Vector de coeficientes: ";
echo "<br/><br/>";
showVector($b);
echo "<br/><br/>";

//Gaussiana
echo "<font size='5'>";
$A1 = $A;  
triangularSup($A1,$b);
echo "Matriz triangular superior por gaus: ";
echo "<br />"; 
showMatrix($A1);
$solve = retroSubstitucion($A1,$b);

echo "Vector de soluciones: "; 
echo "<br />";
showVector($solve);
echo "<br/>"; 

//Descomposicion LU
echo "<br/>"; 
echo "<font size='6.5'>";
echo "Descomposicion LU" ;
echo "<br/>";
LU($A,$b,$L,$U);
showMatrix($L); 
echo "<br/>";
showMatrix($U);

// THOMAS ----------

