<?php
	/*
	FUNCION: add_formato 
	DESCRIPCION: Agregar una descripcion a la tabla formato.
	PARAMETROS:
		- descripcion: varchar(100)
	*/
	function add_formato($descripcion) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");		
		/*VALIDACIONES*/
		// verificar_texto ($descripcion);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_formato @DESCRIPCION = ?";
		$params = array($descripcion);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_formato","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	// SI EL USUARIO ES ADMINISTRADOR
	include("../system/verifica_admin.php");
	if (isset($_POST["descripcion"])) {
		$d = $_POST["descripcion"];
		$d = trim(str_replace("  "," ",$d));
		if ($d != "") {
			add_formato($d);
		} else {
			setcookie("add_formato","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>