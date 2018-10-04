<?php

    function consultar_pedidos($conexion) {
        try {
            $consulta = "SELECT * FROM PEDIDOS";
            return $conexion->query($consulta);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function consultar_pedido($conexion, $OID_P) {
        try {
            $consulta = "SELECT * FROM PEDIDOS WHERE OID_P = " . $OID_P;
            return $conexion->query($consulta);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function consultar_pedidos_cliente($conexion, $OID_C) {
        try {
            $consulta = "SELECT * FROM PEDIDOS 
            WHERE OID_C = " . $OID_C;
            return $conexion->query($consulta);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

   function alta_pedido($conexion, $pedido) {
        try {
            $consulta = "INSERT INTO PEDIDOS(OID_C, OID_T, Viaje) 
            VALUES(:OID_C, :OID_T, :Viaje) RETURNING OID_P INTO :ID";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':OID_C', $pedido["OID_C"]);
            $stmt->bindParam(':OID_T', $pedido["OID_T"]);
            $stmt->bindParam(':Viaje', $pedido["Viaje"]);
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT, 8);
            $stmt->execute();
            return $ID;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function modificar_pedido($conexion, $OID_P, $estadoP, $OID_T) {
        try {
            $consulta = "UPDATE PEDIDOS SET estadoP = :estadoP,
            OID_T = :OID_T WHERE OID_P = :OID_P";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam('OID_P', $OID_P);
            $stmt->bindParam('estadoP', $estadoP);
            $stmt->bindParam('OID_T', $OID_T);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function eliminar_pedido($conexion, $OID_P) {
        try {
            $consulta = "DELETE FROM PEDIDOS WHERE OID_P = :OID_P";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam('OID_P', $OID_P);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

?>