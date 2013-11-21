<?php
	/* 
	FUNCION: add_entrenador 
	DESCRIPCION: Agregar nombre, apellidos, fecha de nacimiento a la tabla Entrenador.
	PARAMETROS:
		- nombre: varchar(100)
		- apellidos: varchar(50)
		- fecha_nacimiento: datetime
	*/

	function add_entrenador($id_pais,$nombre, $apellidos, $fecha_nacimiento) {
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_texto ($nombre);
		// verificar_texto ($apellidos);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_entrenador @ID_PAIS = ?, @NOMBRE = ?, @APELLIDOS = ?, @FECHA_NACIMIENTO = ?";
		$params = array($id_pais,$nombre, $apellidos, $fecha_nacimiento);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_entrenador","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	// SI EL USUARIO ES ADMINISTRADOR
	include("../system/verifica_admin.php");
	if (isset($_POST["id_pais"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["fecha_n"])) {
		$nombre = $_POST["nombre"];
		$nombre = trim(str_replace("  "," ",$nombre));
		$apellido = $_POST["apellidos"];
		$apellido = trim(str_replace("  "," ",$apellido));
		$fecha = $_POST["fecha_n"];
		$fecha = trim(str_replace("  "," ",$fecha));
		$id_pais = $_POST["id_pais"];
		$id_pais = trim(str_replace("  "," ",$id_pais));
		if ($nombre != "" && $id_pais != "" && is_int(intval($id_pais)) && $apellido != "" && $fecha != "" ) {
			add_entrenador($id_pais,$nombre,$apellido,$fecha);
		} else {
			//setcookie("add_entrenador","f", time()+10);
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>