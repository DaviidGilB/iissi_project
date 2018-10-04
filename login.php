<?php
	session_start();
  	
  	require_once("gestionBD.php");
 	require_once("gestionarClientes.php");
	
	if(isset($_SESSION["login"])) {
		unset($_SESSION["login"]);
	}
	
	if (isset($_POST['submit'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		unset($_POST['user']);
		unset($_POST['user']);
		unset($_POST["submit"]);

		$conexion = crearConexionBD();
		$num_clientes = consultar_num_clientes($conexion,$user,$pass);	
	
		if ($num_clientes == 0)
			$login = "error";	
		else {
			
			$clientes = consultar_clientes($conexion);
			
			foreach ($clientes as $cliente) {
				if($cliente["USUARIO"]==$user && $cliente["CONTRASEÑA"]==$pass) {
					$_SESSION["login"] = $cliente["OID_C"];
					break;
				}
			}
			
			cerrarConexionBD($conexion);
			Header("Location:index.php");
		}	
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css"/>
  	<title>Acceso</title>
</head>
<body> 
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	
		if (isset($login)) {
			echo "<div class=\"error\">";
			echo "<p>Error en la contraseña o no existe el usuario.</p>";
			echo "</div>";
	} ?>
	<h2>Inicio de sesión</h2>
	<form action="login.php" method="post">
	<div class="container">
		<div class="row">
			<div class="col-25">
				<label for="user">Usuario: </label>
			</div>
			<div class="col-75">
				<input class="form" type="text" name="user" id="user" />
			</div>
		</div>
		<div class="row">
			<div class="col-25">
				<label for="pass">Contraseña: </label>
			</div>
			<div class="col-75">
				<input class="form" type="password" name="pass" id="pass" />
			</div>
		</div>
	</div>
	<div class="row">
		<input class="submit" id="submit" name="submit" type="submit" value="Acceder" />
	</div>
	</form>	
	<p>¿No estás registrado? <a href="form_alta_cliente.php">¡Registrate!</a></p>
	<?php
		include_once("pie.php");
	?>
</body>
</html>

