<?php
	session_start();
	
	if(!isset($_SESSION["formulario"])) {
		$formulario["user"] = "";
		$formulario["pass"] = "";
		$formulario["cpass"] = "";
		$formulario["nom"] = "";
		$formulario["ape"] = "";
		$formulario["tel"] = "";
		$formulario["email"] = "";
		$formulario["dir"] = "";
		$formulario["doc"] = "";
		$formulario["tipo"] = "P";
		
		$_SESSION["formulario"] = $formulario;
	}
	else {
		$formulario = $_SESSION["formulario"];
	}
	
	if(isset($_SESSION["errores"])) {
		$errores = $_SESSION["errores"];
	}
	
	unset($_POST["submit"]);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="images/icon.jpg">
		<script src="js/validacion_cliente_alta_usuario.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
		<title>Alta cliente</title>
	</head>
	<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>

	<?php
		if(isset($errores) && count($errores)>0) {
			echo "<h4>Errores en el formulario:</h4>
			<div id='div_errores' class='error'>";
    		foreach($errores as $error) echo $error; 
			echo "</div>";
		}
	?>
	
	<body>
		<h2>Formulario de registro</h2>
		<div class="container">
		<form id="altaUsuario" method="post" action="accion_alta_cliente.php" onsubmit="return validateForm()">
			<p><i>Los campos obligatorios están marcados con </i><em>*</em></p>
				<div class="row">
					<div class="col-25">
					<label  for="user">Usuario <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="user" name="user" type="text" title="Mínimo 5 caracteres cualesquiera" value="<?php echo $formulario["user"]; ?>" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label  for="pass">Contraseña<em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="pass" name="pass" type="password" placeholder="Mínimo 8 caracteres entre legras y dígitos" value="<?php echo $formulario["pass"]; ?>" 
					onkeyup="passwordColor()"
					onsubmit="passwordValidation()"
					required/>
				</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label  for="cpass">Confirmar Contraseña <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="cpass" name="cpass" type="password" placeholder="Repita la contraseña" required />
					</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label  for="nom">Nombre <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="nom" name="nom" type="text" value="<?php echo $formulario["nom"]; ?>" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label  for="ape">Apellidos <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="ape" name="ape" type="text" value="<?php echo $formulario["ape"]; ?>" required/>
					</div>
				</div>
				
				<div class="row">
					<div class="col-25">
					<label  for="tel">Teléfono <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="tel" name="tel" type="text" value="<?php echo $formulario["tel"]; ?>" pattern="^[0-9]{9}" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label  for="email">Correo electrónico <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="email" name="email" type="email" placeholder="usuario@dominio.extension" value="<?php echo $formulario["email"]; ?>" required/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label  for="dir">Dirección </label>
					</div>
					<div class="col-75">
					<input class="form" id="dir" name="dir" type="text" value="<?php echo $formulario["dir"]; ?>" placeholder="Calle y número, localidad y código postal"/>
					</div>
				</div>
				<div class="row">
					<div class="col-25">
					<label for="tipo">Tipo <em>*</em></label>
					</div>
					<label>
						<input name="tipo" type="radio" value="P" <?php if($formulario["tipo"]=='P') echo 'checked' ?>/>
						Pequeña empresa</label>
					<label>
						<input name="tipo" type="radio" value="E" <?php if($formulario["tipo"]=='E') echo 'checked' ?>/>
						Gran empresa</label>
						</div>
				<div class="row">
					<div class="col-25">
					<label  for="user">DNI/CIF <em>*</em></label>
					</div>
					<div class="col-75">
					<input class="form" id="doc" name="doc" type="text" placeholder="12345678X" value="<?php echo $formulario["doc"]; ?>" required/>
					</div>
					</div>
					</div>
			<div class="row">
					<input class="submit" id="submit" name="submit" type="submit" value="¡Regístrame!"/>
					</div>
				</form>
			</body>
	
	<?php
		include_once("pie.php");
	?>
	
</html>
