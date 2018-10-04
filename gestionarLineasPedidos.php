<?php

    function consultar_lineas_pedidos($conexion) {
        $consulta = "SELECT * FROM LÍNEASPEDIDOS";
        return $conexion->query($consulta);
    }

    function consultar_linea_pedido($conexion, $OID_LP) {
        try {
            $consulta = "SELECT * FROM LÍNEASPEDIDOS WHERE OID_LP = " . $OID_LP;
            return $conexion->query($consulta);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function consultar_lineas_pedido_concreto($conexion, $OID_P) {
        try {
            $consulta = "SELECT * FROM LÍNEASPEDIDOS NATURAL JOIN PEDIDOS 
                NATURAL JOIN PRODUCTOS WHERE OID_P = " . $OID_P;
            return $conexion->query($consulta);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function alta_linea_pedido($conexion, $lineaPedido) {
        try {
            $consulta = "INSERT INTO LÍNEASPEDIDOS(cantidadLP, ordenLP,
            OID_P, OID_PR) VALUES(:cantidadLP, :ordenLP, :OID_P, :OID_PR)
            RETURNING OID_LP INTO :ID";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':cantidadLP', $lineaPedido["cantidadLP"]);
            $stmt->bindParam(':ordenLP', $lineaPedido["ordenLP"]);
            $stmt->bindParam(':OID_P', $lineaPedido["OID_P"]);
            $stmt->bindParam(':OID_PR', $lineaPedido["OID_PR"]);
            $stmt->bindParam(':ID', $ID, PDO::PARAM_INT, 8);
            $stmt->execute();
            return $ID;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function modificar_linea_pedido($conexion, $OID_LP,
        $cantidadLP, $ordenLP, $OID_P) {
            try {
                $consulta = "UPDATE LÍNEASPEDIDOS SET ORDENLP = :ordenLP, 
                CANTIDADLP = :cantidadLP, OID_P = :OID_P WHERE OID_LP = :OID_LP";
                $stmt = $conexion->prepare($consulta);
                $stmt->bindParam(':OID_LP', $OID_LP);
                $stmt->bindParam(':cantidadLP', $cantidadLP);
                $stmt->bindParam(':ordenLP', $ordenLP);
                $stmt->bindParam(':OID_P', $OID_P);
                $stmt->execute();
                return true;
            } catch(PDOException $e) {
                return $e->getMessage();
            }
        }

    function quitar_linea_pedido($conexion, $OID_LP) {
        try {
            $consulta = "DELETE FROM LÍNEASPEDIDOS WHERE OID_LP = :OID_LP";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':OID_LP', $OID_LP);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

?>