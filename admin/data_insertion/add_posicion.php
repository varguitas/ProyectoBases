<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_posicion 
	DESCRIPCION: Agregar una posicion a la tabla Posicion.
	PARAMETROS:
		- nombre: varchar(100)
	*/
	function add_posicion($nombre) {
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_texto ($nombre);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_posicion @NOMBRE = ?";
		$params = array($nombre);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_posicion","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	// SI EL USUARIO ES ADMINISTRADOR
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"])) {
		$n = $_POST["nombre"];
		$n = trim(str_replace("  "," ",$n));
		if ($n != "") {
			add_posicion($n);
		} else {
			setcookie("add_posicion","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>