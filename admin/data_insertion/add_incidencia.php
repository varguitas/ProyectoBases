<title>add_incidencia</title>
<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_incidencia 
	DESCRIPCION: Agregar una incidencia de un partido a la tabla Incidencia.
	PARAMETROS:
		- id_partido: int
   		- id_alineacion: int
   		- minuto: int
	*/
	function add_incidencia($id_partido, $id_alineacion, $minuto) {
		/*VALIDACIONES*/
		// verificar_numero ($id_partido);
		// verificar_numero ($id_alineacion);
		// verificar_numero ($minuto);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_incidencia @ID_PARTIDO = '?' , @ID_ALINEACION = '?' , @MINUTO = '?'";
		$params = array($id_partido, $id_alineacion, $minuto);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>