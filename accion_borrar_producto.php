<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
		
		require_once("gestionBD.php");
		require_once("gestionarProductos.php");
		
		$id = $producto["OID_PR"];

		$conexion = crearConexionBD();		
		$prod = quitar_producto($conexion, $producto["OID_PR"]);
		cerrarConexionBD($conexion);
			
		if ($prod) {
			Header("Location: editar_productos.php");
		} else {
			$_SESSION["excepcion"] = "Error al borrar el producto";
			$_SESSION["mensaje"] = "No se ha podido borrar el producto";
			Header("Location: excepcion.php");
		}
	}

	else Header("Location: editar_productos.php"); 
?>
