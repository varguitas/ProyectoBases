<title>add_gol</title>
<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_gol 
	DESCRIPCION: Agregar un gol de un partido especifico a la tabla Gol.
	PARAMETROS:
		- id_partido: int                  
   		- id_alineacion: int                 
   		- minuto: int      
   		- id_incidencia: int     
       		- id_asistencia: int = null 
   		- id_penalizado: int = null   
   		- distancia: int = null 
	*/
	function add_gol($id_partido, $id_alineacion, $minuto, $id_incidencia, $id_asistencia, $id_penalizado, $distancia) {
		/*VALIDACIONES*/
		// verificar_numero ($id_partido);
		// verificar_numero ($id_alineacion);
		// verificar_numero ($minuto);
		// verificar_numero ($id_incidencia);
		// verificar_numero ($id_asistencia);
		// verificar_numero ($id_penalizado);
		// verificar_numero ($distancia);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_gol @ID_PARTIDO = '?', @ID_ALINEACION = '?', @MINUTO = '?', @ID_INCIDENCIA = '?', @ID_ASISTENCIA = '?', @ID_PENALIZADO = '?', @DISTANCIA = '?'";
		$params = array($id_partido, $id_alineacion, $minuto, $id_incidencia, $id_asistencia, $id_penalizado, $distancia);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>