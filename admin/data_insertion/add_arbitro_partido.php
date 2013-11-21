<?php 
    /* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
    $connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123"); 
    $conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo); 
    /*  
    FUNCION: add_arbitro_partido  
    DESCRIPCION: Agregar id de los arbitros a la tabla Arbitro_partido. 
    PARAMETROS: 
        - id_arbitro_principal: int 
        - id_arbitro_linea1: int
	- id_arbitro_linea2: int
	- id_cuarto_arbitro: int 
        
    */
    function add_arbitro_partido($id_arbitro_principal, $id_arbitro_linea1, $id_arbitro_linea2, $id_cuarto_arbitro) { 
        /*VALIDACIONES*/
        // verificar_numero ($id_arbitro_principal);
	// verificar_numero ($id_arbitro_linea1);
	// verificar_numero ($id_arbitro_linea2);
	// verificar_numero ($id_cuarto_arbitro); 
        /* ---------- VALIDACIONES ----------- */
        $sql = "EXEC add_arbitro_partido @ID_ARBITRO_PRINCIPAL = '?', @ID_ARBITRO_LINEA1 = '?', @ID_ARBITRO_LINEA2 = '?', @ID_CUARTO_ARBITRO = '?'"; 
        $params = array($id_arbitro_principal, $id_arbitro_linea1, $id_arbitro_linea2,$ id_cuarto_arbitro); 
        $stmt = sqlsrv_query( $conn, $sql, $params); 
        if( $stmt === false ) { 
            return "error"; 
        } else { 
            return "success"; 
        } 
    } 
?>