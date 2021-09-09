<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

		<script async="true"
			src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
		 </script>

		<meta charset="utf-8">
		<link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
		
		
		<title>Splines Cubicos</title>
		<font size = "+2">
					<strong>
					Deber 15 IIB: Métodos Numéricos. <br/>
					</strong>
					Splines Cubicos
					<br/>
					<span class = "cmath">
						<!-- `S = \sum_{i=1}^{n}(Y_i - (ax_i + b))^2` -->
					<span/>
				</font>
				
				
</head>
	<body>
		<center>
		<?php include "splinesCubicos.php" ?> 
				<script>
					window.onload = function () {
					var chart = new CanvasJS.Chart("chartContainer", {
						animationEnabled: false,
						exportEnabled: true,
						theme: "light2", 
						title:{
							text: "Splines Cubicos"
						},
						axisX:{
							gridColor: "gray",
							maximum: 6,
							minimum: 0.8,
							gridThickness: 1,
							title: "",
							suffix: ""
						},
						axisY:{
							gridColor: "gray",
							maximum: 20,
							minimum: -10,
							gridThickness: 1,
							tickLength: 10	,
							scaleStepWidth:10,
							title: "",
							suffix: ""
						},
						data: [{
							type: "scatter",
							markerType: "circle",
							markerSize: 9,
							markerColor: "red",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
						},{
							type: "scatter",
							markerType: "circle",
							markerSize: 2,
							markerColor: "green",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($newData, JSON_NUMERIC_CHECK); ?>
						},{
							type: "scatter",
							markerType: "circle",
							markerSize: 2,
							markerColor: "blue",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($newData1, JSON_NUMERIC_CHECK); ?>
						},{
							type: "scatter",
							markerType: "circle",
							markerSize: 2,
							markerColor: "pink",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($newData2, JSON_NUMERIC_CHECK); ?>
						},{
							type: "scatter",
							markerType: "circle",
							markerSize: 2,
							markerColor: "black",
							toolTipContent: "Y: {y} <br>X: {x}",
							dataPoints: <?php echo json_encode($newData3, JSON_NUMERIC_CHECK); ?>
						}]
					});
					chart.render();
					var inputValue = document.getElementById("value");
					inputValue.addEventListener("change", function(){
					var pixelX = chart.axisY[0].convertValueToPixel(parseInt(inputValue.value));     
					document.getElementById("displayPixel").innerHTML = " = Pixel Position on Axis X: " + pixelX;
					});
    
				}
				</script>
				<div id="chartContainer" style="height: 370px; width: 75%;"></div>
				Axis X  value:<input id="value" type="number" style="width: 85px;" placeholder="Enter Value"/>
  <span id="displayPixel"></span>
				
		<center/> 
		

	</body>
</html>
