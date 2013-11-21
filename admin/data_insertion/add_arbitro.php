<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"app_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
	/* 
	FUNCION: add_arbitro 
	DESCRIPCION: Agregar un nombre, apellidos, fecha de nacimiento y tipo de arbitro a la tabla Arbitro.
	PARAMETROS:
		- nombre: varchar(100)
		- apellidos: varchar(50)
		- fecha_nacimiento: datetime
		- tipo_arbitro: char(1)
	*/
	function add_arbitro($nombre, $apellidos, $fecha_nacimiento, $tipo_arbitro) {
		include("../system/conectInfo.php");
		/*VALIDACIONES*/
		// verificar_texto ($nombre);
		//verificar_texto ($apellidos);
		//verificar_texto ($tipo_arbitro);
		/* ---------- VALIDACIONES ----------- */
		$sql = "EXEC add_arbitro @NOMBRE = ?, @APELLIDOS = ?, @FECHA_NACIMIENTO = ?, @TIPO_ARBITRO = ?";
		$params = array($nombre, $apellidos, $fecha_nacimiento, $tipo_arbitro);
		$stmt = sqlsrv_query( $conn, $sql, $params);
		if( $stmt === false ) {
			die( print_r( sqlsrv_errors(), true));
		} else {
			setcookie("add_arbitro","t", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	// SI EL USUARIO ES ADMINISTRADOR
	include("../system/verifica_admin.php");
	if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["fecha_n"]) && isset($_POST["tipo"])) {
		$nombre = $_POST["nombre"];
		$nombre = trim(str_replace("  "," ",$nombre));
		$apellido = $_POST["apellido"];
		$apellido = trim(str_replace("  "," ",$apellido));
		$fecha = $_POST["fecha_n"];
		$fecha = trim(str_replace("  "," ",$fecha));
		$tipo = $_POST["tipo"];
		$tipo = trim(str_replace("  "," ",$tipo));
		if ($nombre != "" && $apellido != "" && $fecha != "" && $tipo != "" && ($tipo == "L" || $tipo == "P")) {
			add_arbitro($nombre,$apellido,$fecha,$tipo);
		} else {
			setcookie("add_arbitro","f", time()+10);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		include("../html/error.php");
	}
?>