<?php

function consultar_num_trabajadores($conexion,$usuario,$contraseña) {
 	try {
		$consulta = "SELECT COUNT(*) AS TOTAL FROM TRABAJADORES WHERE USUARIO=:usuario AND CONTRASEÑA=:contraseña";
		$stmt = $conexion->prepare($consulta);
		$stmt->bindParam(':usuario',$usuario);
		$stmt->bindParam(':contraseña',$contraseña);
		$stmt->execute();
		return $stmt->fetchColumn();
	 } catch(PDOException $e) {
		 return $e->getMessage();
	 }
}

function consultar_trabajadores($conexion) {
	try {
		$consulta = "SELECT * FROM TRABAJADORES";
		return $conexion->query($consulta);
	} catch(PDOException $e) {
		return $e->getMessage();
	}
}


