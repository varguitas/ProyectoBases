<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_entrenador_equipo 
	DESCRIPCION: Agregar id de entrenador, id de inscripcion del equipo, fecha de inscripcion, fecha de cese y estado a la tabla Entrenador_Equipo.
	PARAMETROS:
		- id_entrenador: int
		- id_inscripcion_equipo: int
		- fecha_inscripcion: datetime
		- fecha_cese: datetime
		- estado: char(1)
	*/
	function add_entrenador_equipo($id_entrenador, $id_inscripcion_equipo, $fecha_inscripcion, $fecha_cese, $estado) {
		/*VALIDACIONES*/
		// verificar_numero ($id_entrenador);
		// verificar_numero ($id_inscripcion_equipo);
		// verificar_texto ($estado);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_entrenador_equipo @ID_ENTRENADOR = '?', @ID_INSCRIPCION_EQUIPO = '?', @FECHA_INSCRIPCION = '?', @FECHA_CESE = '?', @ESTADO = '?'";
		$params = array($id_entrenador, $id_inscripcion_equipo, $fecha_inscripcion, $fecha_cese, $estado);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>