<title>add_cambio</title>
<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_cambio 
	DESCRIPCION: Agregar un cambio de un jugador a la tabla Cambio.
	PARAMETROS:
		- id_incidencia int
		- id_alineacion int
	*/
	function add_cambio($id_incidencia, $id_alineacion) {
		/*VALIDACIONES*/
		// verificar_numero ($id_incidencia);
		// verificar_numero ($id_alineacion);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_cambio @ID_INCIDENCIA = '?', @ID_ALINEACION = '?'";
		$params = array($id_incidencia, $id_alineacion);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>