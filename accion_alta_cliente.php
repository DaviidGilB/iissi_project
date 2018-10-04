<?php
	session_start();
	
	require_once("gestionBD.php");
	
	if(isset($_SESSION["formulario"])) {
		
		if($_POST["tipo"]=="P") {
			$nuevoCliente["usuario"] = $_POST["user"];
			$nuevoCliente["contraseña"] = $_POST["pass"];
			$nuevoCliente["nombreC"] = $_POST["nom"];
			$nuevoCliente["apellidosC"] = $_POST["ape"];
			$nuevoCliente["telefonoC"] = $_POST["tel"];
			$nuevoCliente["correoC"] = $_POST["email"];
			$nuevoCliente["direcciónC"] = $_POST["dir"];
			$nuevoCliente["DNI_C"] = $_POST["doc"];
			$nuevoCliente["CIF_C"] = null;
			$nuevoCliente["tipoC"] = $_POST["tipo"];
		
			$nuevoCliente["cpass"] = $_POST["cpass"];
		} else if($_POST["tipo"]=="E") {
			$nuevoCliente["usuario"] = $_POST["user"];
			$nuevoCliente["contraseña"] = $_POST["pass"];
			$nuevoCliente["nombreC"] = $_POST["nom"];
			$nuevoCliente["apellidosC"] = $_POST["ape"];
			$nuevoCliente["telefonoC"] = $_POST["tel"];
			$nuevoCliente["correoC"] = $_POST["email"];
			$nuevoCliente["direcciónC"] = $_POST["dir"];
			$nuevoCliente["DNI_C"] = null;
			$nuevoCliente["CIF_C"] = $_POST["doc"];
			$nuevoCliente["tipoC"] = $_POST["tipo"];

			$nuevoCliente["cpass"] = $_POST["cpass"];
		}
	}
	else {
		Header("Location:form_alta_cliente.php");
	}
	
		$formulario["user"] = $_POST["user"];
		$formulario["pass"] = $_POST["pass"];
		$formulario["cpass"] = $_POST["cpass"];
		$formulario["nom"] = $_POST["nom"];
		$formulario["ape"] = $_POST["ape"];
		$formulario["tel"] = $_POST["tel"];
		$formulario["email"] = $_POST["email"];
		$formulario["dir"] = $_POST["dir"];
		$formulario["doc"] = $_POST["doc"];
		$formulario["tipo"] = $_POST["tipo"];
	
		$_SESSION["formulario"] = $formulario;
	
	$errores = validarDatosCliente($nuevoCliente);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: form_alta_cliente.php');
	} else {
		Header('Location: exito_alta_cliente.php');
		$_SESSION["nuevoCliente"] = $nuevoCliente;
	}
	
	function validarDatosCliente($nuevoCliente) {
		$errores=array();
		// Validación de la contraseña
		if(!isset($nuevoCliente["contraseña"]) || strlen($nuevoCliente["contraseña"])<8){
			$errores[] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoCliente["contraseña"]) || 
			!preg_match("/[A-Z]+/", $nuevoCliente["contraseña"]) || !preg_match("/[0-9]+/", $nuevoCliente["contraseña"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		}
		
		else if($nuevoCliente["contraseña"] != $nuevoCliente["cpass"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
		
			
		// Validación del email
		if($nuevoCliente["correoC"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoCliente["correoC"], FILTER_VALIDATE_EMAIL)){
			$errores[] = "<p>El email es incorrecto: " . $nuevoCliente["correoC"]. "</p>";
		}
			
		// Validación del NIF/CIF
		if($nuevoCliente["tipoC"]=="P") {
			if($nuevoCliente["DNI_C"]=="") {
			$errores[] = "<p>El DNI no puede estar vacío</p>";
			} else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoCliente["DNI_C"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoCliente["DNI_C"]. "</p>";
			}
		} else {
			if($nuevoCliente["CIF_C"]=="") {
			$errores[] = "<p>El CIF no puede estar vacío</p>";
			} else if(!preg_match("/^[A-Z][0-9]{8}$/", $nuevoCliente["CIF_C"])){
			$errores[] = "<p>El CIF debe contener una letra mayúscula y 8 números: " . $nuevoCliente["CIF_C"]. "</p>";
			}
		}
		
		// Validación del tipo
		if($nuevoCliente["tipoC"] != "P" &&
			$nuevoCliente["tipoC"] != "E") {
			$errores[] = "<p>El tipo debe ser pequeña o gran empresa</p>";
		}
		
		return $errores;
	}
	
?>