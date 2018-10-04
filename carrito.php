<?php

    session_start();

    require_once("gestionBD.php");
    require_once("gestionarLineasPedidos.php");
    require_once("gestionarProductos.php");
    require_once("gestionarClientes.php");

    if(!isset($_SESSION["login"])) {
        Header("Location: login.php");
    }
    
    if(isset($_SESSION["lineasPedidos"])) {
        $lineasPedidos = $_SESSION["lineasPedidos"];
    } else {
        $lineasPedidos = array();
        $_SESSION["lineasPedidos"] = $lineasPedidos;
    } 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
	<title>Cesta de la compra</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	
		if(count($lineasPedidos)==0) { ?>
            <h3>¡No hay ningún producto!</h3>
            <p>No has añadido ningún producto a la cesta. Vuelve a la página de <a href="productos.php">productos</a> para hacer tu compra.</p>
        <?php } else {
            $conexion = crearConexionBD();
        ?>
        <table class="tablaCarrito">
            <thead>
				<tr>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>¿Quieres eliminarlo?</th>
				</tr>
            </thead>
        <?php
            foreach($lineasPedidos as $OID_LP) { 
        ?>
            <tr>    
        <?php
            $filas = consultar_linea_pedido($conexion, $OID_LP);
            foreach($filas as $fila) { ?> 
                <form method="post" action="accion_quitar_linea_pedido.php">
                <input type="hidden" id="OID_LP" name="OID_LP" value="<?php echo $fila["OID_LP"]; ?>"/>
                <?php $cantidad = $fila["CANTIDADLP"];
                $OID_PR = $fila["OID_PR"];
                break; 
			} 
		?>
        <?php 
            $filas2 = consultar_producto($conexion, $OID_PR);
            foreach($filas2 as $fila2) {
				$nombrePR = $fila2["NOMBREPR"];
                $precio = str_replace(",",".", $fila2["PRECIOPR"]);
                break; 
			} 
            $totalLinea = $precio*$cantidad; ?>
            <td><?php echo $nombrePR; ?></td>
            <td><?php echo $cantidad; ?></td>
            <td><?php echo $totalLinea; ?>€</td>
        <?php
            if(!isset($total)) {
                $total = "0";
            }
            $total = $total + $totalLinea; ?>
            <td>
                <input type="submit" id="submit" name="submit" value="Eliminar"/>
            </td>
                </form>
            </tr>
        <?php } ?>
        </table>
		<b>Total: </b><?php echo $total . "€. "; ?> <a href="productos.php">Seguir comprando.</a>
        <?php } ?>
        <div class="cajon">
            <h2>Tus datos:</h2>
            <p><b>Dirección de entrega: </b>
            <?php
                $id = $_SESSION["login"];
                $infoCliente = consultar_cliente($conexion, $id);
                foreach($infoCliente as $info) {
                    if(isset($info["DNI_C"])) {
                        $doc = $info["DNI_C"];
                    } else {
                        $doc = $info["CIF_C"];
                    }
                    echo $info["NOMBREC"] . " " . $info["APELLIDOSC"] . " (" . $doc . "), ";
                    echo $info["DIRECCIÓNC"];
                } 
            ?>
            </p>  
            <p>
				<b>Información de contacto: </b>
				<?php
					$id = $_SESSION["login"];
					$infoCliente = consultar_cliente($conexion, $id);
					foreach($infoCliente as $info) {
						echo $info["TELEFONOC"] . " - " . $info["CORREOC"];
					} 
				?>
			</p>
            <form action="accion_realizar_pedido.php" method="post">
            <?php if(count($lineasPedidos)==0) {} else { ?>
                <input type="submit" id="submitPedido" name="submitPedido" value="Confirmar pedido"/></form>
            <?php } ?>
		</div>
	<?php
        cerrarConexionBD($conexion);
		
		include_once("pie.php");
	?>
</body>
</html>