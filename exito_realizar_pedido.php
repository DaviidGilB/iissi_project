<?php
    session_start();

    if(!isset($_SESSION["login"]) || !isset($_SESSION["OID_P"])) {
        Header("Location: index.php");
    } else {
        $OID_P = $_SESSION["OID_P"];
        unset($_SESSION["OID_P"]);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
	    <link rel="shortcut icon" href="images/icon.jpg">
	    <link rel="stylesheet" type="text/css"  href="css/estilo.css" />>
		<title>Pedido realizado</title>
	</head>
    <?php
        include_once("cabecera.php");
        include_once("menu.php");
    ?>
    <body>
        <h2>El pedido se ha realizado con éxito.</h2>
        <p>Accede a <a href="pedidos.php">tus pedidos</a> para ver el estado del pedido.</p>
    </body>
    <?php
        include_once("pie.php");
    ?>
</html>