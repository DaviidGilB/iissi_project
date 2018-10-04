<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		
		unset($_SESSION["producto"]); 
		
		require_once("gestionBD.php");
		require_once("gestionarProductos.php");
		
		$conexion = crearConexionBD();		
		$prod = modificar_producto($conexion, $producto["OID_PR"], $producto["NOMBREPR"],
		$producto["DESCRIPCIÓNPR"], $producto["URLFOTOPR"], $producto["STOCKPR"], $producto["PRECIOPR"]);
		cerrarConexionBD($conexion);
			
		if ($prod<>"") {
			$_SESSION["excepcion"] = "Error en la edición del producto";
			$_SESSION["destino"] = "editar_productos.php";
			$_SESSION["mensaje"] = "No se ha podido editar el producto.";
			Header("Location: excepcion.php");
		}
		else
			Header("Location:editar_productos.php");
	} 
	else Header("Location: editar_productos.php"); 
?>
