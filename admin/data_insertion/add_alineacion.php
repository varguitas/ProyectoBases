<?php
	/* 
	FUNCION: add_alineacion 
	DESCRIPCION: Agregar una alineación de un partido a la tabla Alineacion.
	PARAMETROS:
		- id_partido int                
   		- id_incripcion_jugador int          
   		- titular bit                
   		- numero_camisa int              
  
	*/
	function add_alineacion($id_partido, $ids ) {
		/* ---------- VALIDACIONES ----------- */
		include("../system/conectInfo.php");
		$sql = "EXEC add_alineacion @ID_PARTIDO = ? , @IDS = ?";
		$params = array($id_partido, $ids);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			echo "t";
		}
	}
	include("../system/verifica_admin.php");
	if (isset($_POST["id_partido"]) && isset($_POST["ids"])) {
		$id_partido = $_POST["id_partido"];
		$id_partido = trim(str_replace("  "," ",$id_partido));
		$ids = $_POST["ids"];
		$ids = trim(str_replace("  "," ",$ids));
		if ($id_partido != "" && $ids != "") {
			add_alineacion($id_partido,$ids);
		} else {
			echo "f";
		}
	} else {
		include("../html/error.php");
	}
?>