<?php 
session_start();

require_once("gestionBD.php");
require_once("gestionarProductos.php");
require_once("paginacion_consulta.php");

if(!isset($_SESSION['login_trabajadores'])) {
	Header("Location:login_trabajadores.php");
}

if (isset($_SESSION["producto"])){
	$producto = $_SESSION["producto"];
	unset($_SESSION["producto"]);
} 

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
  	<title>Editar productos</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<h2>Editar productos</h2>
	<nav>
		<div class="paginacion">
	 		<form method="get" action="editar_productos.php">
				Páginas: 
				<?php
					for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )
						if ( $pagina == $pagina_seleccionada) { 	?>
							<?php echo $pagina; ?>
				<?php }	else { ?>
							<a href="editar_productos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
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
	</nav>
	<table class="tablaEditar">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Producto</th>
				<th>Descripción</th>
				<th>Precio</th>
				<th>Stock</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<?php
			foreach($filas as $fila) {
		?>
		<form method="post" action="controlador_productos.php">
			<tr>
				<div class="fila_producto">
					<div class="datos_producto">		
						<input id="OID_PR" name="OID_PR"
							type="hidden" value="<?php echo $fila["OID_PR"]; ?>"/>
						<input id="NOMBREPR" name="NOMBREPR"
							type="hidden" value="<?php echo $fila["NOMBREPR"]; ?>"/>
						<input id="DESCRIPCIÓNPR" name="DESCRIPCIÓNPR"
							type="hidden" value="<?php echo $fila["DESCRIPCIÓNPR"]; ?>"/>
						<input id="URLFOTOPR" name="URLFOTOPR"
							type="hidden" value="<?php echo $fila["URLFOTOPR"]; ?>"/>
						<input id="STOCKPR" name="STOCKPR"
							type="hidden" value="<?php echo $fila["STOCKPR"]; ?>"/>
						<input id="PRECIOPR" name="PRECIOPR"
							type="hidden" value="<?php echo $fila["PRECIOPR"]; ?>"/>	
					<?php
						if (isset($producto) and ($producto["OID_PR"] == $fila["OID_PR"])) { ?>
							<!-- Editando el producto --> 
							<td><img src="<?php echo $fila["URLFOTOPR"]; ?>" width="60" height="60"/></td>
							<td><input id="NOMBREPR" name="NOMBREPR" type="text" value="<?php echo $fila["NOMBREPR"]; ?>"/></td>
							<td><i><?php echo $fila["DESCRIPCIÓNPR"]; ?></i></td>
							<td><input id="PRECIOPR" name="PRECIOPR" type="text" value="<?php echo $fila["PRECIOPR"]; ?>"/></td>
							<td><?php echo $fila["STOCKPR"]." unidades."; ?></td>
					<?php }	else { ?>
							<!-- mostrando datos -->
							<td><img src="<?php echo $fila["URLFOTOPR"]; ?>" width="60" height="60"/></td>
							<td><?php echo $fila["NOMBREPR"]; ?></td>
							<td><i><?php echo $fila["DESCRIPCIÓNPR"]; ?></i></td>
							<td><?php echo $fila["PRECIOPR"]." €/Kg."; ?></td>
							<td><?php echo $fila["STOCKPR"]." unidades."; ?></td>
					<?php } ?>
					</div>
					<div id="botones_fila">
					<?php if (isset($producto) and ($producto["OID_PR"] == $fila["OID_PR"])) { ?>
						<td>
							<button id="grabar" name="grabar" type="submit" class="editar_fila">
								<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">
							</button>
						</td>
					<?php } else { ?>
						<td>
							<button id="editar" name="editar" type="submit" class="editar_fila">
								<img src="images/pencil_menuito.bmp" class="editar_fila" alt="Editar producto">
							</button>
						</td>
					<?php } ?>
						<td>
							<button id="borrar" name="borrar" type="submit" class="editar_fila">
								<img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar producto">
							</button>
						</td>
					</div>
				</div>
			</tr>
		</form>
	<?php } ?>
	</table>
	<?php 
		include_once("pie.php"); 
	?>
</body>
</html>