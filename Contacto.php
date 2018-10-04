<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
	<title>Contacto</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<div>
		<h1 class="recuadro">Contacta con Don Garbanzo</h1>
	</div>
    <div>
    	<p>Si tienes cualquier duda o quieres información sobre cualquier producto, no dudes en contactar con nosotros.
		Siempre estamos para ayudarte.</p>
    </div>
    <div class="cajon">
    	<h4 class="subrayado">Dirección:</h4>
    	<p>Calle José Luis Ramírez Dópido 31,
		Polígono Industrial Las Picadas II, Parcela 79, 
    	06200 ALMENDRALEJO (Badajoz)
    	</p>
    </div>
    <div class="cajon">
    	<h4 class="subrayado">Teléfono-Email</h4>
    	<ul>
			<li><b>Teléfono: </b>924 666 644</li>
			<li><b>Móvil: </b>676 966 836</li>
			<li><b>E-mail: </b>dongarbanzo@hotmail.com</li>
			<li><b>E-mail: </b>info@legumbresdongarbanzo.com</li>
		</ul>
    </div>
	<?php
		include_once("pie.php");
	?>
</body>
</html>


