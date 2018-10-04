<?php
	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionarClientes.php");
	
	if(isset($_SESSION["nuevoCliente"])) {
		$nuevoCliente = $_SESSION["nuevoCliente"];
		unset($_SESSION["formulario"]);
		unset($_SESSION["nuevoCliente"]);
		unset($_SESSION["errores"]);
	} else {
		Header("Location:form_alta_cliente.php");
	}
	
	$conexion = crearConexionBD();
 
 ?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
	<title>Registro realizado</title>
</head>
<body>
<?php
	include_once("cabecera.php");
	include_once("menu.php");
		
	$id = alta_cliente($conexion, $nuevoCliente);
	if(is_numeric($id)) {
		$_SESSION["login"] = $id;
?>
	<h1>Hola <?php echo $nuevoCliente["nombreC"]; ?>, gracias por registrarte</h1>
		<div>	
			Pulsa <a href="productos.php">aquí</a> para ver todos nuestros productos.
		</div>
	<?php } else { ?>
			<h1>El usuario ya existe en la base de datos.</h1>
			<div>	
				Pulsa <a href="form_alta_cliente.php">aquí</a> para volver al formulario.
			</div>
<?php }
	include_once("pie.php");
?>
</body>
</html>