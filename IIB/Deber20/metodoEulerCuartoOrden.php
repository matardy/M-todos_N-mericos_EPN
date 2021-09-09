<?php 
//Funciones
include "functions.php";

function fun($x, $y){
    return (1/(1+pow($x,2))) - (2*pow($y,2));
}






if(isset($_POST['x']) && isset($_POST['y']) && isset($_POST['h']) && isset($_POST['x_'])){
    $xi = $_POST['x']; 
    $y = $_POST['y']; 
    $x_ = $_POST['x_'];
    $h = $_POST['h']; 
    
    // Numero de pasos
   $N =  ($xi - $x_)/$h ; 

    $dataSet = array(); 
    $valorAumento = 0; 

    for($i=0; $i<$N+1; $i++){
        $dataSet[$i]["n"] = $i; 
        $dataSet[$i]["xn"] = $valorAumento; 
        $dataSet[$i]["y"] = $y; 
        $valorAumento = $valorAumento + $h ; 
    }

    //Calcular los valores de k: 

    for($i=0; $i<$N; $i++){
        $k1 = fun($dataSet[$i]["xn"], $dataSet[$i]["y"]);
        $k2= fun($dataSet[$i]["xn"] + ($h/2), $dataSet[$i]["y"] + (($h/2)*($k1)));
        $k3= fun($dataSet[$i]["xn"] + ($h/2), $dataSet[$i]["y"] + (($h/2)*($k2)));
        $k4= fun($dataSet[$i]["xn"] + ($h/2), $dataSet[$i]["y"] + (($h/2)*($k3)));

        //m+1 
        $dataSet[$i+1]["y"] = $dataSet[$i]["y"] + ($h/6)*($k1 + 2*$k2 + 2*$k3 + $k4); 
    
    }
    arrayToTable($dataSet); 
    echo "<br/>"; 
    echo "La solucion es: ", $dataSet[$N]["y"]; 
}

