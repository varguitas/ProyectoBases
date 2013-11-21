<?php
	/* 
	FUNCION: add_torneo 
	DESCRIPCION: Agregar id de formato, id de pais, nombre, fecha de inicio, fecha de finalizacion y estado de torneo a la tabla Torneo.
	PARAMETROS:
		- id_formato: int
		- id_pais: int
		- nombre: varchar(100)
		- fecha_inicio: datetime
		- fecha_fin: datetime
		- estado_torneo: char(1)
	*/
	function add_torneo($id_formato, $id_pais, $nombre, $fecha_inicio, $fecha_fin) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_numero ($id_formato);
		// verificar_numero ($id_pais);
		// verificar_texto ($nombre);
		// verificar_texto ($estado_torneo);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_torneo @ID_FORMATO = ?, @ID_PAIS = ?, @NOMBRE = ?, @FECHA_INICIO = ?, @FECHA_FIN = ?";
		$params = array($id_formato, $id_pais, $nombre, $fecha_inicio, $fecha_fin);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_torneo","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"]) && isset($_POST["fecha_ini"]) && isset($_POST["fecha_fin"]) && isset($_POST["id_pais"]) && isset($_POST["id_formato"])) {
		$nombre = $_POST["nombre"];
		$nombre = trim(str_replace("  "," ",$nombre));
		$fecha_ini = $_POST["fecha_ini"];
		$fecha_ini = trim(str_replace("  "," ",$fecha_ini));
		$fecha_fin = $_POST["fecha_fin"];
		$fecha_fin = trim(str_replace("  "," ",$fecha_fin));
		$pais = $_POST["id_pais"];
		$pais = trim(str_replace("  "," ",$pais));
		$formato = $_POST["id_formato"];
		$formato = trim(str_replace("  "," ",$formato));
		if ($nombre != "" && $fecha_ini != "" && $fecha_fin != ""&& $pais != "" && is_int(intval($pais)) && $formato != "" && is_int(intval($formato))) {
			add_torneo($formato,$pais,$nombre,$fecha_ini,$fecha_fin);
		} else {
			setcookie("add_torneo","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>