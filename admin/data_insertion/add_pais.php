<?php
	/* 
	FUNCION: add_pais 
	DESCRIPCION: Agregar un pais a la tabla Pais.
	PARAMETROS:
		- nombre: varchar(100)
	*/
	function add_pais($nombre) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_texto ($nombre);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_pais @NOMBRE = ?";
		$params = array($nombre);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_pais","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	// SI EL USUARIO ES ADMINISTRADOR
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"])) {
		$n = $_POST["nombre"];
		$n = trim(str_replace("  "," ",$n));
		if ($n != "") {
			add_pais($n);
		} else {
			setcookie("add_pais","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>