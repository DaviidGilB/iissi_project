<?php
	session_start();
  	
  	require_once("gestionBD.php");
 	require_once("gestionarTrabajadores.php");
	
	if(isset($_SESSION["login_trabajadores"])) {
		unset($_SESSION["login_trabajadores"]);
	}
	
	if (isset($_POST['submit'])){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		unset($_POST['user']);
		unset($_POST['user']);
		unset($_POST["submit"]);

		$conexion = crearConexionBD();
		$num_trabajadores = consultar_num_trabajadores($conexion,$user,$pass);	 
	
		if ($num_trabajadores == 0)
			$login_trabajadores= "error";	
		else {
			
			$trabajadores = consultar_trabajadores($conexion);
			
			foreach ($trabajadores as $trabajador) {
				if($trabajador["USUARIO"]==$user && $trabajador["CONTRASEÑA"]==$pass) {
					$_SESSION["login_trabajadores"] = $trabajador["OID_T"];
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
  <meta charset="utf-8">
  <link rel="shortcut icon" href="images/icon.jpg">
  <link rel="stylesheet" type="text/css"  href="css/estilo.css" />
  <title>Acceso (Empresa)</title>
</head>
<body>
<?php
	include_once("cabecera.php");
	include_once("menu.php");

	if (isset($login_trabajadores)) {
		echo "<div class=\"error\">";
		echo "<p>Error en la contraseña o no existe el usuario.</p>";
		echo "</div>";
	}	
?>
	<h2>Inicio de sesión (Empresa)</h2>
	 <form action="login_trabajadores.php" method="post">
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
<?php
	include_once("pie.php");
?>
</body>
</html>

