<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_jornada 
	DESCRIPCION: Agregar id de torneo y fecha a la tabla Jornada.
	PARAMETROS:
		- id_torneo: int
		- fecha: datetime
	*/

	function add_jornada($id_torneo, $fecha) {
		/*VALIDACIONES*/
		// verificar_numero ($id_torneo);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_jornada @ID_TORNEO = '?', @FECHA = '?'";
		$params = array($id_torneo, $fecha);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>