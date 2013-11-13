<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_ubicacion
	DESCRIPCION: Agregar una ubicacion a la tabla Ubicacion.
	PARAMETROS:
		- nombre: 		varchar(100)
		- direccion: 	varchar(100), opcional
     	- contacto:		varchar(100)
     	- telefono:		varchar(10)

	*/
	function add_ubicacion($nombre,$direccion,$contacto,$telefono) {
		/*VALIDACIONES*/
		// verificar_texto ($nombre);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_ubicacion @NOMBRE = '?',@DIRECCION = '?',@CONTACTO = '?',@TELEFONO = '?'";
		$params = array($nombre,$direccion,$contacto,$telefono);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			return "error";
		} else {
			return "success";
		}
	}
?>