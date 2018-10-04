<?php

 function alta_cliente($conexion,$usuario) {
	try {
		$consulta = "INSERT INTO CLIENTES(usuario, contraseña,
        	nombreC, apellidosC, telefonoC, correoC, direcciónC,
			DNI_C, CIF_C, tipoC) VALUES(:usuario, :contraseña,
        	:nombreC, :apellidosC, :telefonoC, :correoC, :direcciónC,
			:DNI_C, :CIF_C, :tipoC) RETURNING OID_C INTO :ID";
        $stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':usuario',$usuario["usuario"]);
		$stmt->bindParam(':contraseña',$usuario["contraseña"]);
		$stmt->bindParam(':nombreC',$usuario["nombreC"]);
		$stmt->bindParam(':apellidosC',$usuario["apellidosC"]);
		$stmt->bindParam(':telefonoC',$usuario["telefonoC"]);
		$stmt->bindParam(':correoC',$usuario["correoC"]);
		$stmt->bindParam(':direcciónC',$usuario["direcciónC"]);
		$stmt->bindParam(':DNI_C',$usuario["DNI_C"]);
		$stmt->bindParam(':CIF_C',$usuario["CIF_C"]);
		$stmt->bindParam(':tipoC',$usuario["tipoC"]);
        $stmt->bindParam(':ID', $ID, PDO::PARAM_INT, 8);
        $stmt->execute();
        return $ID;
	} catch(PDOException $e) {
		return $e->getMessage();
    }
	
}

function consultar_num_clientes($conexion,$usuario,$contraseña) {
	try {
		$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTES WHERE USUARIO=:usuario AND CONTRASEÑA=:contraseña";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':usuario',$usuario);
		$stmt->bindParam(':contraseña',$contraseña);
		$stmt->execute();
		return $stmt->fetchColumn();
	} catch(PDOException $e) {
		return $e->getMessage();
	}
}

function consultar_clientes($conexion) {
	try {
		$consulta = "SELECT * FROM CLIENTES";
		return $conexion->query($consulta);
	} catch(PDOException $e) {
		return $e->getMessage();
	}
}

function consultar_cliente($conexion, $OID_C) {
	try {
		$consulta = "SELECT * FROM CLIENTES WHERE OID_C = " . $OID_C;
		return $conexion->query($consulta);
	} catch(PDOException $e) {
		return $e->getMessage();
	}
}