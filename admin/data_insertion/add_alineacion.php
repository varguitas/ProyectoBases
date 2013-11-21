<title>add_alineacion</title>
<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_alineacion 
	DESCRIPCION: Agregar una alineación de un partido a la tabla Alineacion.
	PARAMETROS:
		- id_partido int                
   		- id_incripcion_jugador int          
   		- titular bit                
   		- numero_camisa int              
  
	*/
	function add_alineacion($id_partido, $id_incripcion_jugador, $titular, $numero_camisa ) {
		/*VALIDACIONES*/
		// verificar_numero ($id_partido);
		// verificar_numero ($id_incripcion_jugador);
		// verificar_numero ($numero_camisa);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_alineacion @ID_PARTIDO = '?' , @ID_INSCRIPCION_JUGADOR = '?' , @TITULAR = '?' , @NUMERO_CAMISETA = '?'";
		$params = array($id_partido, $id_incripcion_jugador, $titular, $numero_camisa);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>