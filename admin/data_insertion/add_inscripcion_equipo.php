<?php
	/* 
	FUNCION: add_inscripcion_equipo 
	DESCRIPCION: Agregar id de equipo,id de torneo y fecha de inscripcion a la tabla Incripcion_Equipo.
	PARAMETROS:
		- id_equipo: int
		- id_torneo: int
		- fecha_inscripcion: datetime
	*/

	function inscribir_equipo($id_equipo, $id_torneo,$id_entrenador,$jugadores) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		$sql = "EXEC inscribir_equipo @ID_EQUIPO = ?, @ID_TORNEO = ?, @ID_ENTRENADOR = ?, @IDS = ?";
		$params = array($id_equipo, $id_torneo, $id_entrenador,$jugadores);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			echo "t";
		}
	}
	include("../system/verifica_admin.php");
	if (isset($_POST["id_equipo"]) && isset($_POST["id_torneo"]) && isset($_POST["id_entrenador"]) && isset($_POST["jugadores"])) {
		$id_equipo = $_POST["id_equipo"];
		$id_equipo = trim(str_replace("  "," ",$id_equipo));
		$id_torneo = $_POST["id_torneo"];
		$id_torneo = trim(str_replace("  "," ",$id_torneo));
		$id_entrenador = $_POST["id_entrenador"];
		$id_entrenador = trim(str_replace("  "," ",$id_entrenador));
		$jugadores = $_POST["jugadores"];
		$jugadores = trim(str_replace("  "," ",$jugadores));
		if ($id_equipo != "" && $jugadores != "" && $id_torneo != "" && $id_entrenador != "" && is_int(intval($id_equipo)) && is_int(intval($id_torneo)) && is_int(intval($id_entrenador))) {
			inscribir_equipo($id_equipo,$id_torneo,$id_entrenador,$jugadores);
		} else {
			echo "f";
		}
	} else {
		include("../html/error.php");
	}
?>