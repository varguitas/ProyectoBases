<?php 
    /* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
    $connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123"); 
    $conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo); 
    /*  
    FUNCION: add_inscripcion_jugador  
    DESCRIPCION: Agregar id de jugador, id de inscripcion del equipo, id de posicion en el equipo, id de posicion en el torneo, fecha de inscripcion, fecha de desinscripcion y estado a la tabla Inscripcion_jugador. 
    PARAMETROS: 
        - id_inscripcion_equipo: int 
        - id_jugador: int
	- id_posicion: int
	- id_posicion: int 
        - fecha_inscripcion: datetime 
        - fecha_desinscripcion: datetime 
        - estado: char(1) 
    */
    function add_inscripcion_jugador($id_inscripcion_equipo, $id_jugador, $id_posicion, $id_posicion, $fecha_inscripcion, $fecha_desinscripcion, $estado) { 
        /*VALIDACIONES*/
	// verificar_numero ($id_inscripcion_equipo);
	// verificar_numero ($id_jugador);
	// verificar_numero ($id_posicion);
	// verificar_numero ($id_posicion);
	// verificar_numero ($estado); 
        /* ---------- VALIDACIONES ----------- */
        $sql = "EXEC add_inscripcion_jugador @ID_INSCRIPCION_EQUIPO = '?', @ID_JUGADOR = '?', @ID_POSICION = '?', @ID_POSICION = '?', @FECHA_INSCRIPCION = '?', @FECHA_DESINSCRIPCION = '?', @ESTADO = '?'"; 
        $params = array($id_inscripcion_equipo, $id_jugador, $id_posicion, $id_posicion, $fecha_inscripcion, $fecha_desinscripcion, $estado); 
        $stmt = sqlsrv_query( $conn, $sql, $params); 
        if( $stmt === false ) { 
            return "error"; 
        } else { 
            return "success"; 
        } 
    } 
?>
