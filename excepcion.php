<?php 
	session_start();
	
	if (isset ($_SESSION["excepcion"]) && isset($_SESSION["mensaje"])) {
		$excepcion = $_SESSION["excepcion"];
		unset($_SESSION["excepcion"]);
		$mensaje = $_SESSION["mensaje"];
		unset($_SESSION["mensaje"]);
	} else {
		Header("Location:index.php");
	}	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
	<title>¡Se ha producido un problema!</title>
</head>
<body>	
<?php	
	include_once("cabecera.php");
	include_once("menu.php");
?>
	<div>
		<h2>Ups!</h2>
		<p><?php echo $mensaje; ?></p>
	</div>
	<h4>DETALLES:</h4>	
	<div class='excepcion'>	
		<?php echo $excepcion; ?>
	</div>
<?php	
	include_once("pie.php");
?>	
</body>
</html>