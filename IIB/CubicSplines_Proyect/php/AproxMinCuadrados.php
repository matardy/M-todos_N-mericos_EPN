<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral</title>
    <link rel="icon" type="image/ico" href="../img/icono.ico" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" >
    <script src="https://mauriciopoppe.github.io/function-plot/js/function-plot.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!--<div class="loader-page"></div>-->
    <div class="contenedor">
        <header style="text-align: left;">
        <h2>Programa que interpola con el método de Splines Cúbicos </h2>
        <h1>Método de Splines Cúbicos</h1>
            <h2>Métodos Numéricos</h2>
        </header>

        <section class="contenido">
            <div class="resultado">
            <center>
            
            <h3>
    
            <?php

            
                if(isset($_POST['btnA']))
                {    
                    echo  "<div class = figura>
                    <section id='Spines Cubicos' class='margen'>
                    <div id='ggb-element' style='margin: 0 auto'></div>
                    <script>
                    var ggbApp = new GGBApplet({
                        'appName': 'graphing',
                        'showZoomButtons':false,
                        'height': 500,
                        'showToolBar': false,
                        'showToolBarHelp':false,
                        'showAlgebraInput': false,
                        'showMenuBar': false,
                        'appletOnLoad': function(api) {";
                            for($i=0;$i< $dimX;$i++){
                                $a=$x[$i];
                                $b=$y[$i];
                                echo "api.evalCommand('($a,$b)');";
                            }
                            for($i=0;$i< $dimX-1;$i++){
                                $a=$x[$i];
                                $b=$x[$i+1];
                                $c=$p[$i];
                                echo "api.evalCommand('Function($c,$a,$b)');";
                            }
                            echo "}}, true);
                            window.addEventListener('load', function() {
                                ggbApp.inject('ggb-element');
                            });
                    </script>
                    </section>
                </div>";

                $archivo = fopen("datos.txt.","r") or die ("Error");
                $i=0;
                while(!feof($archivo)){
                    $linea=fgets($archivo); 
                    $tok = strtok($linea, ",");
                        $x[$i]=(float)$tok;
                        $tok = strtok(",");
                        $y[$i]=(float)$tok;
                        $saltodelinea=nl2br($linea);
                        $i++; 
                }
                fclose($archivo);  

            $h=array(); 
            $sigma=array();
            $lambda=array();
            $niu=array();
            $d=array();
            $dimX=count($x);
            $dimY=count($y);
            echo '<div class=tabla><table><tr><td>X</td><td>Y</td></tr>';
            
            echo "<p>Datos obtenidos:</p>";

                imprimir($x,$y);
            echo '</table></div>';

            echo "<p>Funciones obtenidas:</p>";



        #PASO 1
            for ($i=1;$i<$dimX;$i++){
                $h[$i]=$x[$i]-$x[$i-1];
                #echo 'h='.$h[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX;$i++){
                $sigma[$i]=($y[$i]-$y[$i-1])/$h[$i];
                #echo 'sigma='.$sigma[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX-1;$i++){
                $lambda[$i]=$h[$i+1]/($h[$i]+$h[$i+1]);
                #echo 'lambda='.$lambda[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX-1;$i++){
                $niu[$i]=$h[$i]/($h[$i]+$h[$i+1]);
                #echo 'niu='.$niu[$i].'<br>'; 
            }

            for ($i=1;$i<$dimX-1;$i++){
                $d[$i]=6*(($sigma[$i+1]-$sigma[$i])/($h[$i]+$h[$i+1]));
                #echo 'd='.$d[$i].'<br>'; 
            }

        #PASO 2
            for ($i=0;$i<$dimX-2;$i++){
                for($j=0;$j<$dimX-2;$j++){
                    if ($i==$j)
                        $matriz[$i][$j]=2;
                    elseif($i-$j==-1)
                        $matriz[$i][$j]=$lambda[$j];
                    elseif ($i-$j==1)
                        $matriz[$i][$j]=$niu[$i+1];
                    else
                        $matriz[$i][$j]=0;
                }
            }
            for($i=0;$i<count($d);$i++){
                $aux1[$i]=$d[$i+1];
            }
            $aux=metodoThomas($matriz,$aux1);

            for ($i=0;$i<$dimX;$i++){
                if($i==0)
                    $M[$i]=0;
                elseif($i==$dimX-1)
                    $M[$i]=0;
                else{
                    $M[$i]=$aux[$i-1];
                }
                #echo 'M='.$M[$i].'<br>'; 
            }

        #PASO 3
            for ($i=1;$i<$dimX;$i++){
                $r[$i]=$M[$i-1]/(6*$h[$i]);
                #echo 'r='.$r[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX;$i++){
                $s[$i]=$M[$i]/(6*$h[$i]);
                #echo 's='.$s[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX;$i++){
                $t[$i]=($y[$i-1]-$M[$i-1]*(pow($h[$i],2)/6))/$h[$i];
                #echo 't='.$t[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX;$i++){
                $u[$i]=($y[$i]-$M[$i]*(pow($h[$i],2)/6))/$h[$i];
                #echo 'u='.$u[$i].'<br>'; 
            }

        #PASO 4 
            for ($i=1;$i<$dimX;$i++){
                $v[$i]=$s[$i]-$r[$i];
                #echo 'v='.$v[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX;$i++){
                $w[$i]=3*($r[$i]*$x[$i]-$s[$i]*$x[$i-1]);
                #echo 'w='.$w[$i].'<br>'; 
            }   
            for ($i=1;$i<$dimX;$i++){
                $f[$i]=3*($s[$i]*pow($x[$i-1],2)-$r[$i]*pow($x[$i],2))+$u[$i]-$t[$i];
                #echo 'F='.$f[$i].'<br>'; 
            }
            for ($i=1;$i<$dimX;$i++){
                $g[$i]=$x[$i]*($r[$i]*pow($x[$i],2)+$t[$i])-$x[$i-1]*($s[$i]*pow($x[$i-1],2)+$u[$i]);
                #echo 'g='.$g[$i].'<br>'; 
            }

            $p=array();
            for ($i=0; $i <$dimX-1; $i++) { 
                $p[$i]["polinomio"]=$v[$i+1].'*(x*x*x) +' .$w[$i+1].'*(x*x) +'.$f[$i+1].'*(x) +'.$g[$i+1];
                //echo 'p='.$p[$i].'<br>'; 
            }
            ////////////////////
           echo "prueba";


            $linea = array();
            for($i=0;$i<sizeof($x)-1;$i++){
                $linea[$i]=$v[$i+1].'*(x*x*x) +' .$w[$i+1].'*(x*x) +'.$f[$i+1].'*(x) +'.$g[$i+1];
            }

                $intervalos = array();
            for ($i=0; $i <sizeof($x)-1; $i++) { 
                $vec = array();

                array_push($vec, $x[$i]);
                $p[$i]["intervalos"]=$x[$i];
                $p[$i]["intervalo1"]=$x[$i+1];

                array_push($vec, $x[$i+1]);
                array_push($intervalos, $vec);
            }
            arrayToTable($p);  

            for($i=0; $i <sizeof($x)-1; $i++){
                if($p[$i]["intervalos"]<= 3.5 && $p[$i]["intervalo1"]>=3.5 ){
                    echo ($p[$i]["polinomio"]);
                    echo '<br/>';
                    echo fnEval(3.5, $p[$i]["polinomio"]);
                }
            //fnEval($x, $strEval,$str)
            }

            echo "<p>Gráfica obtenida:</p>";

                    echo plot($linea, $intervalos);



                }


           #Resolucion del sistemas de ecuaciones con el metodo de thomas
            function metodoThomas($matriz, $vector){
                $resultados=array();
                $dim_vector=count($vector);
            
                for ($i=1; $i <count($matriz) ; $i++) { 
                    $matriz[$i][$i]-=(($matriz[$i][$i-1]*$matriz[$i-1][$i])/$matriz[$i-1][$i-1]);
                    $vector[$i]-=(($matriz[$i][$i-1]*$vector[$i-1])/$matriz[$i-1][$i-1]);
                    $matriz[$i][$i-1]=0;
                }
            
                $resultado[$dim_vector-1]=$vector[$dim_vector-1]/$matriz[$dim_vector-1][$dim_vector-1];
            
                for($j=count($vector)-2; $j>=0 ;$j--){
                    $resultado[$j]=($vector[$j]-($matriz[$j][$j+1]*$resultado[$j+1]))/$matriz[$j][$j];
                }
            return $resultado;
            }

            #imprimir vectores
            function imprimir($x,$y){
                for($i=0;$i<count($x);$i++){
                    echo "<tr>";
                    echo "<td>".$x[$i]."</td><td>".$y[$i]."</td>";
                    echo "</tr>";
                }
                echo "<br>";
            }

            function imprimirV($v){
                $filas = sizeof($v);
                $linea = "<table>";
                for ($j=0; $j < $filas; $j++) { 
                    $linea = $linea."<tr><td>".$v[$j]."</td></tr>";
                }
                $linea = $linea."</table>";
                echo $linea;
            }

                //Grafica
                function plot($linea, $intervalos){
                    $size = sizeof($intervalos);
                    $imprimir = "
                    <div class='Fbg'><div style='padding: 25px;width: 800px;height: 400px;' class='myFunction'></div></div>
                    <script type='text/javascript'>
                            var parameters = {
                                target: '.myFunction',
                                width: 800,
                                height: 400,
                                data: [";
                    for ($i=0; $i < $size; $i++) { 
                        $imprimir = $imprimir."{ fn: '".$linea[$i]."', range: [".$intervalos[$i][0].",".$intervalos[$i][1]."]},";
                    }
                    $imprimir = $imprimir."],
                                grid: true,
                                yAxis: {label: 'Eje: y=f(x)', domain: [-5, 5], },
                                xAxis: {label: 'Eje: x', domain: [".($intervalos[0][0]-1).", ".($intervalos[$size-1][1]+1)."]}
                            };
                
                            functionPlot(parameters);
                    </script>
                    ";
                    return $imprimir;
                    }



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


                    function fnEval($x, $strEval){
                        $resultado = 0;
                        $strEval = str_replace("x","(".$x.")",$strEval);
                        eval("\$resultado = ".$strEval.";");
                        if($resultado ==0) {
                            $resultado = "0";
                        }elseif($resultado == "" || $resultado == "-1.#IND"){
                                $resultado = "NAN";
                        }
                        return $resultado;
                    }

                    


        

            ?>
               </center>
            </div>
        </section>

        <footer  style="text-align: right;">
            <h4>Julio Mora.</h4>
            <p>GR1COM</p>
        </footer>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
            $(window).on('load', function () {
                setTimeout(function () {
                $(".loader-page").css({visibility:"hidden",opacity:"0"})
                }, 2000);
            });
    </script>
</body>

</html>