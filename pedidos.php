<?php
    session_start();

    require_once("gestionarLineasPedidos.php");
    require_once("gestionBD.php");
    require_once("gestionarPedidos.php");
    
    if(!isset($_SESSION["login"])) {
        Header("Location: login.php");
    }

    $conexion = crearConexionBD();

    $filasPedidos = consultar_pedidos_cliente($conexion, $_SESSION["login"]);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
	<title>Pedidos</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
    <?php foreach($filasPedidos as $filaPedido) { 
		$filasLineasPedidos = consultar_lineas_pedido_concreto($conexion, $filaPedido["OID_P"]);
		$total = "0";
		foreach($filasLineasPedidos as $filaLineaPedido) {
			$precio = str_replace(",",".", $filaLineaPedido["PRECIOPR"]);
			$total = $total + $precio*$filaLineaPedido["CANTIDADLP"]; 
		} 
	?>
	<div>
		<b>Pedido número: </b><?php echo $filaPedido["OID_P"]; ?> - <b>Fecha: </b><?php echo $filaPedido["FECHAP"]; ?> - <b>Estado: </b><?php echo $filaPedido["ESTADOP"]; ?> - <b>Total: </b><?php echo $total; ?>€
		<table class="tablaPedidos">
			<thead>
				<tr>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
				</tr>
			</thead>
			<?php
				$filasLineasPedidos = consultar_lineas_pedido_concreto($conexion, $filaPedido["OID_P"]);
				foreach($filasLineasPedidos as $filaLineaPedido) {
					$precio = str_replace(",",".", $filaLineaPedido["PRECIOPR"]);
				?>
				<tr>
					<td><?php echo $filaLineaPedido["NOMBREPR"]; ?></td>
					<td><?php echo $filaLineaPedido["CANTIDADLP"] . " unidades"; ?></td>
					<td><?php echo $precio*$filaLineaPedido["CANTIDADLP"] . "€"; ?></td>
				</tr>   
		<?php } ?>
		</table>
	</div>
	<?php } ?>
    <p>Realiza una compra añadiendo productos desde nuestro <a href="productos.php">catálogo de productos.</a></p>
	<?php
		include_once("pie.php");
	?>
</body>
</html>