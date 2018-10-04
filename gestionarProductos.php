<?php

    function consultar_productos($conexion) {
        $consulta = "SELECT * FROM PRODUCTOS";
        return $conexion->query($consulta);
    }

    function consultar_producto($conexion, $OID_PR) {
        try {
            $consulta = "SELECT * FROM PRODUCTOS WHERE OID_PR = " . $OID_PR;
            return $conexion->query($consulta);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function modificar_producto($conexion, $OID_PR, $nombrePR,
    $descripcionPR, $urlFotoPR, $stockPR, $precioPR) {
        try {
            $consulta = "UPDATE PRODUCTOS SET nombrePR = :nombrePR, 
            descripciónPR = :descripcionPR, urlFotoPR = :urlFotoPR,
            stockPR = :stockPR, precioPR = :precioPR WHERE OID_PR = :OID_PR";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':OID_PR',$OID_PR);
            $stmt->bindParam(':nombrePR',$nombrePR);
            $stmt->bindParam(':descripcionPR',$descripcionPR);
            $stmt->bindParam(':urlFotoPR',$urlFotoPR);
            $stmt->bindParam(':stockPR',$stockPR);
            $stmt->bindParam(':precioPR',$precioPR);
            $stmt->execute();
            return "";
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    function quitar_producto($conexion, $OID_PR) {
        try {
            $consulta = "DELETE FROM PRODUCTOS WHERE OID_PR = :OID_PR";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':OID_PR',$OID_PR);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

?>