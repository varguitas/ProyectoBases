<title>add_tarjeta</title>
<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_tarjeta 
	DESCRIPCION: Agregar una tarjeta de un partido a la tabla Tarjeta.
	PARAMETROS:
		- id_incidencia: int
		- color: varchar(10)
	*/
	function add_tarjeta($id_incidencia, $color) {
		/*VALIDACIONES*/
		// verificar_numero ($id_incidencia);
		// verificar_texto ($color);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_tarjeta @ID_INCIDENCIA = '?', @COLOR = '?'";
		$params = array($id_incidencia, $color);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>