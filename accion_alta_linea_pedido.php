<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarLineasPedidos.php");

    if(isset($_SESSION["login"])) {
        if(isset($_POST["submit"])) {
            $OID_PR = $_POST["OID_PR"];
            $cantidadLP = $_POST["cantidadLP"];
            unset($_POST["submit"]);
            unset($_POST["OID_PR"]);
            unset($_POST["cantidadLP"]);
        } else {
            $_SESSION["mensaje"] = "¡Error al añadir el producto!";
            $_SESSION["excepcion"] = "No se ha podido añadir el producto, inténtelo de nuevo.";
            Header("Location: excepcion.php");
        }
    } else {
        Header("Location: login.php");
    }

    $conexion = crearConexionBD();

    $lineaPedido["OID_PR"] = $OID_PR;
    $lineaPedido["cantidadLP"] = $cantidadLP;

    $id = alta_linea_pedido($conexion, $lineaPedido);

    cerrarConexionBD($conexion);

    if(!is_numeric($id)) {
        $_SESSION["mensaje"] = "¡Error al añadir el producto!";
        $_SESSION["excepcion"] = "No se ha podido añadir el producto, inténtelo de nuevo.";
        Header("Location: excepcion.php");
    } else {
        if(isset($_SESSION["lineasPedidos"])) {
            $lineasPedidos = $_SESSION["lineasPedidos"];
            $lineasPedidos[] = $id;
            $_SESSION["lineasPedidos"] = $lineasPedidos;
            $_SESSION["cuentaLP"] = count($lineasPedidos);
        } else {
            $lineasPedidos = array();
            $lineasPedidos[] = $id;
            $_SESSION["lineasPedidos"] = $lineasPedidos;
            $_SESSION["cuentaLP"] = count($lineasPedidos);
        }
        Header("Location: carrito.php");
    }
?>