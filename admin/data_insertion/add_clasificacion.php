<?php 
  
    /* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
    $connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123"); 
    $conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo); 
    /*  
    FUNCION: add_clasificacion  
    DESCRIPCION: Agregar id de equipo inscrito, cantidad de partidos jugados, ganados, perdidos y empatados, goles a favor y en contra, y total de puntos a la tabla Clasificacion. 
    PARAMETROS: 
        - id_inscripcion_equipo: int
	- partidos_jugados: int 
	- partidos_ganados: int
	- partidos_empatados: int
	- partidos_perdidos: int
	- goles_a_favor: int
	- goles_en_contra: int
	_ puntos: int
    */
    function add_clasificacion($id_inscripcion_equipo, $partidos_jugados, $partidos_ganados, $partidos_empatados, $partidos_perdidos, $goles_a_favor, $goles_en_contra, $puntos) { 
        /*VALIDACIONES*/
        // verificar_numero (id_inscripcion_equipo); 
	// verificar_numero (partidos_jugados);
	// verificar_numero (partidos_ganados);
	// verificar_numero (partidos_empatados);
	// verificar_numero (partidos_perdidos);
	// verificar_numero (goles_a_favor);
	// verificar_numero (goles_en_contra);
	// verificar_numero (puntos);
        /* ---------- VALIDACIONES ----------- */
        $sql = "EXEC add_clasificacion @ID_INSCRIPCION_EQUIPO = '?', @PARTIDOS_JUGADOS = '?', @PARTIDOS_GANADOS = '?', @PARTIDOS_EMPATADOS = '?', @PARTIDOS_PERDIDOS = '?', @GOLES_A_FAVOR = '?', @GOLES_EN_CONTRA = '?', @PUNTOS = '?'"; 
        $params = array($id_inscripcion_equipo, $partidos_jugados, $partidos_ganados, $partidos_empatados, $partidos_perdidos, $goles_a_favor, $goles_en_contra, $puntos); 
        $stmt = sqlsrv_query( $conn, $sql, $params); 
        if( $stmt === false ) { 
            return "error"; 
        } else { 
            return "success"; 
        } 
    } 
?>