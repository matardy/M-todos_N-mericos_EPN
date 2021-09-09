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
    // valor index 1:
    $fm= fun($dataSet[0]["xn"], $dataSet[0]["y"]);
    $dataSet[1]["y"] =$dataSet[0]["y"] + $h*fun( $dataSet[0]["xn"] + ($h/2)  , $dataSet[0]["y"] + ($h/2)*$fm );
     
    $e = 0.00001 ;        
    $valor_y_ = $dataSet[1]["y"];

    for($i=1; $i<$N; $i++){
        $valor_x = $dataSet[$i]["xn"];
        $valor_y = $dataSet[$i]["y"];
        $valor_x_ = $dataSet[$i+1]["xn"];
        
        do{
            
            $y_m = $valor_y + (($h/2)*(fun($valor_x, $valor_y) + fun($valor_x_, $valor_y_))); 
            $sum  = $y_m - $valor_y_; 
            $valor_y_ = $y_m ; 
            

       }while(abs($sum)>=$e);
        $dataSet[$i+1]["y"] = $y_m;
        $valor_y_ = $y_m; 
    }
    arrayToTable($dataSet); 
    echo "<br/>"; 
    echo "La solucion es: ", $dataSet[$N]["y"]; 
}

