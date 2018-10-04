<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarPedidos.php");
    require_once("gestionarLineasPedidos.php");

    if(!isset($_SESSION["login"])) {
        Header("Location: login.php");
    } else if(!isset($_POST["submitPedido"])) {
        $_SESSION["mensaje"] = "¡Error en el pedido!";
        $_SESSION["excepcion"] = "No se ha podido realizar el pedido.";
        Header("Location: excepcion.php");
    } else if(isset($_SESSION["login"]) && isset($_POST["submitPedido"]) && isset($_SESSION["lineasPedidos"])) {
        unset($_POST["submitPedido"]);
        $conexion = crearConexionBD();
        $pedido["OID_C"] = $_SESSION["login"];
        $OID_P = alta_pedido($conexion, $pedido);
        $lineasPedidos = $_SESSION["lineasPedidos"];
        for($i = 0; $i < count($lineasPedidos); $i++) {
            $OID_LP = $lineasPedidos[$i];
            $lineas = consultar_linea_pedido($conexion, $OID_LP);
            foreach($lineas as $linea) {
                $cantidadLP = $linea["CANTIDADLP"];
            }
            $mod = modificar_linea_pedido($conexion, $OID_LP,
            $cantidadLP , $i+1, $OID_P);
            if(!$mod) {
                $_SESSION["mensaje"] = "¡Error en el pedido!";
                $_SESSION["excepcion"] = "No se ha podido realizar el pedido.";
                Header("Location: excepcion.php");
            }
        }
        unset($_SESSION["lineasPedidos"]);
        $_SESSION["OID_P"] = $OID_P;
        cerrarConexionBD($conexion);
        Header("Location: exito_realizar_pedido.php");
    } else {
        $_SESSION["mensaje"] = "¡Error inesperado!";
        $_SESSION["excepcion"] = "Un error fatal ha ocurrido.";
        Header("Location: excepcion.php");
    }
?>