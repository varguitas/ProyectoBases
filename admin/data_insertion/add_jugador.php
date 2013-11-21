<?php
	/* 
	FUNCION: add_jugador 
	DESCRIPCION: Agregar id de posicion, id de pais, nombre, apellidos, fecha de nacimiento a la tabla Jugador.
	PARAMETROS:
		- id_posicion: int
		- id_pais: int
		- nombre: varchar(100)
		- apellidos: varchar(50)
		- fecha_nacimiento: datetime
	*/

	function add_jugador($id_posicion, $id_pais, $nombre, $apellidos, $fecha_nacimiento) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_numero ($id_posicion);
		// verificar_numero ($id_pias);
		// verificar_texto ($nombre);
		// verificar_texto ($apellidos);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_jugador @ID_POSICION = ?, @ID_PAIS = ?, @NOMBRE = ?, @APELLIDOS = ?, @FECHA_NACIMIENTO = ?";
		$params = array($id_posicion, $id_pais, $nombre, $apellidos, $fecha_nacimiento);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_jugador","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["fecha_n"]) && isset($_POST["posicion"]) && isset($_POST["pais"])) {
		$nombre = $_POST["nombre"];
		$nombre = trim(str_replace("  "," ",$nombre));
		$apellidos = $_POST["apellidos"];
		$apellidos = trim(str_replace("  "," ",$apellidos));
		$fecha = $_POST["fecha_n"];
		$fecha = trim(str_replace("  "," ",$fecha));
		$posicion = $_POST["posicion"];
		$posicion = trim(str_replace("  "," ",$posicion));
		$pais = $_POST["pais"];
		$pais = trim(str_replace("  "," ",$pais));
		if ($nombre != "" && $apellidos != "" && $fecha != "" && $posicion != "" && is_int(intval($posicion)) && $pais != "" && is_int(intval($pais))) {
			add_jugador($posicion,$pais,$nombre,$apellidos,$fecha);
		} else {
			setcookie("add_pais","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>