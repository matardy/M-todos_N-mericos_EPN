<?php

//IMPLEMENTACION ALGORITMO DE THOMAS
// Crea una matrix cuadrada dada su dimension

function fillMatriz($A){
    for($i = 0; $i < sizeof($A); $i++){
        for($j = 0; $j < sizeof($A); $j++){
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



// Las funciones void funcionan con c++
// Transforma la matriz a triangular superior
function sum_seidel($A,$b,$i){
    $suma = 0; 
    for($j = 0; $j<=$i-1; $j++){
        $suma = $suma + $A[$i][$j]*$b[$j];
    }
    return $suma; 
}

function sum_seidel_2($A, $b, $i){
    $suma = 0; 
    for($j=$i+2; $j<sizeof($A); $j++){
        $suma = $suma + $A[$i][$j]*$b[$j]; 

    }
    return $suma; 
}

function diagonal_dominante($A){
    $n = sizeof($A);
    $m = sizeof($A[0]);
    for($i=0; $i<$n; $i++){
        $diagonal = $A[$i][$i]; 
        for($j=0; $j<$m; $j++){
            if($diagonal < $A[$i][$j] || $diagonal < $A[$j][$i]){
                return false; 
            }
        }
    }
    return true; 
}
function gauss_seidel($matriz, $vector){
    $numFilas = sizeof($matriz);
	$numColum = sizeof($matriz[0]);
	$tamanio_vector = sizeof($vector);
	$vector_x = array(1,1,1);
	$vector_x2 = array();
	$tol = 1e-14;

	if(diagonal_dominante($matriz) && $numFilas == $numColum && $numColum == $tamanio_vector){
		do{ 
			
			$flag = false;

			for ($i=0; $i < $numFilas; $i++) { 
                $vector_x2[$i] = (1 / $matriz[$i][$i])*($vector[$i] - sum_seidel($matriz,$vector_x2,$i) - 
                sum_seidel_2($matriz,$vector_x,$i));
			}

			/** Se obtiene el valor absoluto de la resta de los vectores x y x2 
			 * para conocer si sobrepasan la tolerancia **/
			for($i = 0; $i < sizeof($vector_x2); $i++){
				$vector_x[$i] = abs($vector_x[$i] - $vector_x2[$i]);
				if($vector_x[$i] > $tol){
					$flag = true;
					break;
				}
			}
			$vector_x = $vector_x2;
		}while($flag);

	}else{
		echo "E: Matriz con diagonal no dominante o el número de columnas no coincide con el tamaño del vector";
	}
	return $vector_x; 
 }
 
// Driver code --------------------------------
 
//Valores iniciales

$A = array(array(9,3,1),
array(1,3,1),
array(1,3,15)); 
$b = array(13,5,40);

echo "<font size='6.5'>";
echo "Matriz ingresada: ";
echo "<br />"; 
showMatrix($A);
echo "<br/>";
echo "Vector de coeficientes: ";
echo "<br/><br/>";
showVector($b);
echo "<br/><br/>";

// Gaus Jacobi Seidel-------------------------------------------
$solved = gauss_seidel($A,$b);
echo "Vector Solucion: "; 
echo "<br/>";
showVector($solved);

