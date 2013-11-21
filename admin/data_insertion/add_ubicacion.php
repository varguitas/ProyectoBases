<?php
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
		/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
		include("../system/conectInfo.php");
		$sql = "EXEC add_ubicacion @NOMBRE = ?,@DIRECCION = ?,@CONTACTO = ?,@TELEFONO = ?";
		$params = array($nombre,$direccion,$contacto,$telefono);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_ubicacion","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"]) && isset($_POST["direccion"]) && isset($_POST["contacto"]) && isset($_POST["telefono"])) {
		$nombre = $_POST["nombre"];
		$nombre = trim(str_replace("  "," ",$nombre));
		$direccion = $_POST["direccion"];
		$direccion = trim(str_replace("  "," ",$direccion));
		$contacto = $_POST["contacto"];
		$contacto = trim(str_replace("  "," ",$contacto));
		$telefono = $_POST["telefono"];
		$telefono = trim(str_replace("  "," ",$telefono));
		if ($nombre != "" && $direccion != "" && $contacto != "" && $telefono != "") {
			add_ubicacion($nombre,$direccion,$contacto,$telefono);
		} else {
			setcookie("add_ubicacion","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>