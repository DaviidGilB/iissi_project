<?php

	session_start();
	
	require_once("gestionBD.php");
	require_once("gestionarProductos.php");
	require_once("paginacion_consulta.php");
	
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;
		
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();
	
	$query = 'SELECT * '
		.'FROM PRODUCTOS ';
	
	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++; 
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;
	
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);

	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="images/icon.jpg">
	<link rel="stylesheet" type="text/css"  href="css/estilo.css" />
	<title>Productos</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<h2>Catálogo de productos</h2>
	<div class="paginacion">
	 	<form method="get" action="productos.php">
			Páginas: 
			<?php
				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
					if ( $pagina == $pagina_seleccionada) { 	?>
						<?php echo $pagina; ?>
			<?php }	else { ?>
				<a href="productos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
			Mostrando
			<input id="PAG_TAM" name="PAG_TAM" type="number"
				min="1" max="<?php echo $total_registros; ?>"
				value="<?php echo $pag_tam?>" autofocus="autofocus" />
			entradas de <?php echo $total_registros?>
			<input id="productos" name="productos" type="submit" value="Cambiar">
		</form>
	</div>
		<table class="tablaProductos">	
		<thead> 
			<tr>
				<th>Foto</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Stock</th>
				<?php if(isset($_SESSION["login"])) { ?>
					<th>¡Compra!</th>
				<?php } ?> 
			</tr>
		</thead>
		<?php 
			foreach($filas as $fila) { 
		?>
		<form method="post" action="accion_alta_linea_pedido.php">
			<input name="OID_PR" type="hidden" value="<?php echo $fila["OID_PR"]; ?>"/>
					<tr>
						<td>
							<img alt="<?php echo $fila["NOMBREPR"]; ?>" src="<?php echo $fila["URLFOTOPR"]; ?>" width="60" height="60"/>
						</td>
						<td>
							<?php echo $fila["NOMBREPR"]; ?>
						</td>
						<td>
							<i><?php echo $fila["DESCRIPCIÓNPR"]; ?></i>
						</td>
						<td>
							<?php echo $fila["PRECIOPR"]; ?> €/Kg
						</td>
						<td>
							<?php echo $fila["STOCKPR"]; ?> Kg
						</td>
						<?php if(isset($_SESSION["login"])) { ?>
						<td>
							<input name="cantidadLP" type="number" value="1" min="0"/>
							<input name="submit" type="submit" value="Añadir"/>
						</td>
						<?php } ?> 
					</tr>
				</form>
			<?php } ?>
		</table>
	<?php
		include_once("pie.php");
	?>
</body>
</html>