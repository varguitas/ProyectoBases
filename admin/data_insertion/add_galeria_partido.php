<?php 
  
    /* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
    $connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123"); 
    $conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo); 
    /*  
    FUNCION: add_galeria_partido 
    DESCRIPCION: Agregar id de partido, nombre, archivo, formato, tamaño y tipo de galeria a la tabla Galeria_Partido. 
    PARAMETROS: 
        - id_partido: int
	- nombre: varchar(100)
	- archivo: image
	- formato: varchar(100)
	- tamano: int
	- tipo_galeria: char(1)
	
    */
    function add_galeria_partido($id_partido, $nombre, $archivo, $formato, $tamano, $tipo_galeria) { 
        /*VALIDACIONES*/
	// verificar_numero ($id_partido);
	// verificar_numero ($tamano);  
        // verificar_texto ($nombre); 
	// verificar_texto ($formato);
	// verificar_texto ($tipo_galeria);
        /* ---------- VALIDACIONES ----------- */
        $sql = "EXEC add_galeria_partido @ID_PARTIDO = '?', @NOMBRE = '?', @ARCHIVO = '?', @FORMATO = '?', @TAMANO = '?', @TIPO_GALERIA = '?'";   

        $params = array($id_partido, $nombre, $archivo, $formato, $tamano, $tipo_galeria); 
        $stmt = sqlsrv_query( $conn, $sql, $params); 
        if( $stmt === false ) { 
            return "error"; 
        } else { 
            return "success"; 
        } 
    } 
?>