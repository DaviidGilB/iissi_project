<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css"/>
	<title>Inicio</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
		<h1>Novedades</h1>
		<div class="cajon">
			<article>
				<h4>Ampliación del negocio</h4>
				<p>Debido al crecimiento en los últimos años de la empresa, el pasado 2016 se puso la construcción del nuevo almacén y de las nuevas oficinas. Estamos
				instalados allí desde finales de 2017. Econtrarás toda la información <a href="sobre_nosotros.php">aquí.</a><p>
			</article>
		</div>
	<?php
		include_once("pie.php");
	?>
</body>
</html>
