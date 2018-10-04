<nav class="menu">
	<ul class="lista">
		<li><a href="index.php" id="inicio" class="navegacion">Inicio</a></li>
		<li><a href="productos.php" class="navegacion">Productos</a></li>
		<li><a href="sobre_nosotros.php" class="navegacion">Sobre nosotros</a></li>
		<li><a href="contacto.php" class="navegacion">Página de contacto</a></li>
		<?php if(!isset($_SESSION["login"])) { ?>
			<li><a href="login.php" class="navegacion">Acceso clientes</a></li>
		<?php } if(isset($_SESSION["login"])) { ?>
			<li><a href="carrito.php" class="navegacion">Cesta</a></li>
			<li><a href="pedidos.php" class="navegacion">Pedidos</a></li>
		<?php } if(isset($_SESSION['login'])) { ?>
			<li><a href="logout.php" id="desconectar" class="navegacion">Desconectar</a></li>
			<li id="nombreUser" class="navegacion">
				<?php 
					require_once("gestionarClientes.php");
					require_once("gestionBD.php");
					$conexion = crearConexionBD();
					$clientes = consultar_clientes($conexion);
					foreach($clientes as $cliente) {
						if($cliente["OID_C"]==$_SESSION["login"]) {
							echo " " . $cliente["NOMBREC"] . " " . $cliente["APELLIDOSC"];
							break;
						} 
					} 
			} ?>
	</ul>
</nav>