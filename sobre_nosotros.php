<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
  	<title>Sobre la empresa</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<div>
		<h2 class="recuadro">Quiénes somos: </h2>
		<p class="parrafo">Somos una empresa en expansión en la que se realizan numerosas actividades,
		tanto secundarias como principales. La actividad principal se encuentra centrada en
		la compraventa de legumbre, actividad que es realizada tanto en territorio nacional como en el extranjero.
		Estamos ubicados en Almendralejo (Badajoz).
		Contamos con personal cualificado y especializado dispuesto siempre a atenderle.</p>
	</div>
	<div>
		<h2 class="recuadro">Qué hacemos: </h2>
		<p class="parrafo">Somos Don Garbanzo, especialistas en la compraventa al por mayor de legumbres como garbanzos,
		lentejas y judías. Disponemos de la experiencia y los conocimientos necesarios para prestarle
		un servicio integral. El objetivo principal es su satisfacción, por eso le ofrecemos un trato 
		amable y personalizado ajustado a sus necesidades y requerimientos.
		No dude en contactarnos.</p>
	</div>
	<div id="map">
		<iframe width="600" height="450" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJb8nlt3unFg0RSK6A6cxnWnM&key=AIzaSyAtVQaOBZvu3WtsYfZu7L8qnWlitTTBZi4" 
			allowfullscreen>
		</iframe> 
	</div>
	<?php
		include_once("pie.php");
	?>
</body>
</html>