<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
	<!-- Titulo -->
    <title>Practica HTML</title>
	<style>
	table,
      td,
      th {
        padding: 5px;
        border: 2px solid #1c87c9;
        border-radius: 5px;
        background-color: #e5e5e5;
        text-align: center;
      }
    </style>
	<!-- Ingreso esto para usar notación matematica -->
	<script async="true"
	src="https://cdn.jsdelivr.net/npm/mathjax@2/MathJax.js?config=AM_CHTML">
	 </script>
  </head>
  <body>
	<center>
    <?php
		include "arrays.php"
	?>
	<?php if (count($arr) > 0): ?>
	<table>
	  <thead>
	    <tr>
	      <th><?php echo implode('</th><th>', array_keys(current($arr))); ?></th>
	    </tr>
	  </thead>
	  <tbody>
	<?php foreach ($arr as $row): array_map('htmlentities', $row); ?>
	    <tr>
	      <td><?php echo implode('</td><td>', $row); ?></td>
	    </tr>
	<?php endforeach; ?>
	  </tbody>
	</table>
	<?php endif; ?>



	</center>
  </body>
</html>
