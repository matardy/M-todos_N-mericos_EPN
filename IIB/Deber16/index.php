<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script async="true"
			src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
		 </script>
		 
    </style>
		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
		
		
		<title>Interpolaciones</title>
		<font size = "+2">
					<strong>
					Deber 16 IIB: Métodos Numéricos. <br/>
					</strong>
					Interpolaciones: Interpolación Lineal, Interpolación Cuadrática, Interpolación Lagrangeana.
					
				</font>
				
</head>
	<body>
		
		<center>
		<font size = +1>
			<Strong> 
				Interpolacion Lineal 
			<Strong/>
		</font>
        <?php include "interpolacionLineal.php" ?>
		<br/><br/><br/>
		
        <?php include "interpolacionCuadratica.php" ?>
		<div id="chartContainer1" style="height: 370px; width: 50%;"></div>
		
		<br/><br/><br/>
	
        <?php include "interpolacionLagrangiana.php" ?>
		<script>
					window.onload = function () {
					var chart1 = new CanvasJS.Chart("chartContainer1", {
						animationEnabled: false,
						exportEnabled: true,
						theme: "light2", 
						title:{
							text: "Interpolacion Cuadratica"
						},
						axisX:{
							minimum:-0.5,
							title: "X",
							suffix: ""
						},
						axisY:{
							

							title: "Y",
							suffix: ""
						},
						data: [{
							type: "scatter",
							markerType: "circle",
							markerSize: 9,
							markerColor: "red",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($dataSet, JSON_NUMERIC_CHECK); ?>
						}
						,{
							type: "scatter",
							markerType: "circle",
							markerSize: 2.5,
							markerColor: "blue",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($newData1, JSON_NUMERIC_CHECK); ?>
						}

					]
					});
					
					var chart2 = new CanvasJS.Chart("chartContainer2", {
						animationEnabled: false,
						exportEnabled: true,
						theme: "light2", 
						title:{
							text: "Interpolacion Lagrangiana"
						},
						axisX:{
							minimum:-0.5,
							title: "X",
							suffix: ""
						},
						axisY:{
							

							title: "Y",
							suffix: ""
						},
						data: [{
							type: "scatter",
							markerType: "circle",
							markerSize: 2.5,
							markerColor: "green",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($newData1, JSON_NUMERIC_CHECK); ?>
						},{
							type: "scatter",
							markerType: "circle",
							markerSize: 9,
							markerColor: "red",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($dataSet, JSON_NUMERIC_CHECK); ?>
						}

					]
					});


					chart1.render();
					chart2.render();

					}
		</script>
		<div id="chartContainer2" style="height: 370px; width: 50%;"></div>
				
		<center/> 
		

	</body>
</html>
