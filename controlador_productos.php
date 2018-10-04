<?php	
	session_start();

	if (isset($_POST["OID_PR"])){
		$producto["OID_PR"] = $_POST["OID_PR"];
		$producto["NOMBREPR"] = $_POST["NOMBREPR"];
		$producto["DESCRIPCIÓNPR"] = $_POST["DESCRIPCIÓNPR"];
		$producto["URLFOTOPR"] = $_POST["URLFOTOPR"];
		$producto["STOCKPR"] = $_POST["STOCKPR"];
		$producto["PRECIOPR"] = $_POST["PRECIOPR"];
		
		$_SESSION["producto"] = $producto;
			
		if (isset($_POST["editar"]))  {
			unset($_POST["editar"]);
			Header("Location: editar_productos.php"); 
		}
		else if (isset($_POST["grabar"])) {
			unset($_POST["grabar"]);
			Header("Location: accion_modificar_producto.php");
		} 
		else if (isset($_POST["borrar"])) {
			unset($_POST["borrar"]);
			Header("Location: accion_borrar_producto.php");
		}
	} 
	else 
		Header("Location: editar_productos.php");

?>
