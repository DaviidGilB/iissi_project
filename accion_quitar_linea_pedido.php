<?php
    session_start();

    require_once("gestionBD.php");
    require_once("gestionarLineasPedidos.php");

    if(isset($_POST["submit"])) {
        $OID_LP = $_POST["OID_LP"];
        unset($_POST["submit"]);
        unset($_POST["OID_LP"]);
    } else {
        Header("Location: productos.php");
    }

    $conexion = crearConexionBD();

    $el = quitar_linea_pedido($conexion, $OID_LP);

    cerrarConexionBD($conexion);
    
    if($el) {
        $lineasPedidos = $_SESSION["lineasPedidos"];
        foreach(array_keys($lineasPedidos, $OID_LP) as $key) {
            echo $key;
            unset($lineasPedidos[$key]);
       }
        $_SESSION["lineasPedidos"] = $lineasPedidos;
        Header("Location: carrito.php");
    } else {
        $_SESSION["mensaje"] = "¡Error de eliminación!";
        $_SESSION["excepcion"] = "No se ha podido eliminar el producto.";
        Header("Location: excepcion.php");
    }
    
?>