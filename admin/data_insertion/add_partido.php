<?php 
  
    /* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
    $connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123"); 
    $conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo); 
    /*  
    FUNCION: add_partido  
    DESCRIPCION: Agregar id de torneo, id de jornada, id de los equipos que participan, id de la ubicacion, id del arbitro, fecha del partido, goles de casa y de visita, y el estado del partido a la tabla Partido. 
    PARAMETROS: 
        - id_torneo: int
	- id_jornada: int
	- id_equipo_casa: int
	- id_equipo_visita: int
	- id_ubicacion: int
	- id_arbitro_partido: int
	- fecha_partido: datetime 
	- goles_casa: int
	- goles_visita: int
	_ estado_partido: char(1)
    */
    function add_partido($id_torneo, $id_jornada, $id_equipo_casa, $id_equipo_visita, $ubicacion, $id_arbitro_partido, $goles_casa, $goles_visita, $estado_partido) { 
        /*VALIDACIONES*/
	// verificar_numero ($id_torneo);
	// verificar_numero ($id_jornada);
	// verificar_numero ($id_equipo_casa);
	// verificar_numero ($id_equipo_visita);
	// verificar_numero ($id_ubicacion);
	// verificar_numero ($id_arbitro_partido);
	// verificar_numero ($goles_casa);
	// verificar_numero ($goles_visita); 
        // verificar_texto ($estado_partido); 
        /* ---------- VALIDACIONES ----------- */
        $sql = "EXEC add_partido @ID_TORNEO = '?', @ID_JORNADA = '?', @ID_EQUIPO_CASA = '?', @ID_EQUIPO_VISITA = '?', @ID_UBICACION = '?', @ID_ARBITRO_PARTIDO = '?', @FECHA_PARTIDO = '?', @GOLES_CASA = '?', @GOLES_VISITA = '?', @ESTADO_PARTIDO = '?'";    
  
        $params = array($id_torneo, $id_jornada, $id_equipo_casa, $id_equipo_visita, $ubicacion, $id_arbitro_partido, $goles_casa, $goles_visita, $estado_partido); 
        $stmt = sqlsrv_query( $conn, $sql, $params); 
        if( $stmt === false ) { 
            return "error"; 
        } else { 
            return "success"; 
        } 
    } 
?>