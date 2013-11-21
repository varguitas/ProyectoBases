<?php
	/*
	FUNCION: add_equipo 
	DESCRIPCION: Agregar id de ubicacion,nombre,fecha de fundacion e historia a la tabla Equipo.
	PARAMETROS:
		- id_ubicacion: int
		- nombre: varchar(100)
		- fecha_fundacion: datetime
		- historia: varchar(100)
	*/
	function add_equipo($id_ubicacion, $nombre, $fecha_fundacion, $historia) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_numero ($id_ubicacion);
		// verificar_texto ($nombre);
		// verificar_texto ($historia);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_equipo @ID_UBICACION = ?, @NOMBRE = ?, @FECHA_FUNDACION = ?, @HISTORIA = ?";
		$params = array($id_ubicacion, $nombre, $fecha_fundacion, $historia);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_equipo","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	// SI EL USUARIO ES ADMINISTRADOR
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"]) && isset($_POST["ubicacion"]) && isset($_POST["fecha_fund"]) && isset($_POST["historia"])) {
		$nombre = $_POST["nombre"];
		$nombre = trim(str_replace("  "," ",$nombre));
		$ubicacion = $_POST["ubicacion"];
		$ubicacion = trim(str_replace("  "," ",$ubicacion));
		$fecha = $_POST["fecha_fund"];
		$fecha = trim(str_replace("  "," ",$fecha));
		$historia = $_POST["historia"];
		$historia = trim(str_replace("  "," ",$historia));
		if ($nombre != "" && $fecha != "" && $historia != "" && $ubicacion != "" && is_int(intval($ubicacion))) {
			add_equipo($ubicacion,$nombre,$fecha,$historia);
		} else {
			setcookie("add_equipo","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>