<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	include("../../system/conectInfo.php");
	/* 
	FUNCION: add_pais 
	DESCRIPCION: Agregar un pais a la tabla Pais.
	PARAMETROS:
		- nombre: varchar(100)
	*/
	function add_pais($nombre) {
		/*VALIDACIONES*/
		// verificar_texto ($nombre);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_pais @NOMBRE = '?'";
		$params = array($nombre);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>