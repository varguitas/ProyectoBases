<?php
	include("../system/verifica_admin.php");
	if (!isset($_GET["tid"])) {
		die("Debe suminstrar el ID del torneo");
	}
	if (!isset($_GET["dia_uno"])) {
		die("Debe suminstrar el dia uno");
	}
	if (!isset($_GET["dia_dos"])) {
		die("Debe suminstrar el dia dos");
	}
	// OBTENER INFOMACION DE LOS EQUIPOS INSCRITOS
	$tid = $_GET["tid"];
	include("../system/conectInfo.php");
	$sql = "EXEC get_equipos_inscritos @ID_TORNEO = ?";
	$params = array($tid);
	$stmt = sqlsrv_query( $conn, $sql, $params);
	if( $stmt === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	if (!sqlsrv_has_rows($stmt)) {
		die("No hay una cantidad suficiente de equipos inscritos");
	}
	if (sqlsrv_num_rows($stmt)%2!=0) {
		die("No hay una cantidad suficiente de equipos inscritos");
	}
	$lista_equipos = "";
	while ($equipo_inscrito = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		$lista_equipos.=$equipo_inscrito["ID_INSCRIPCION_EQUIPO"].",";
	}
	$l = strlen($lista_equipos);
	$lista_equipos = substr($lista_equipos,0,$l-1);
	// OBTENER INFORMACON DEL TORNEO
	$sql = "EXEC get_torneo_info @ID_TORNEO = ?";
	$params = array($tid);
	$stmt = sqlsrv_query( $conn, $sql, $params);
	if( $stmt === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	if (!sqlsrv_has_rows($stmt)) {
		die("Torneo no existe.");
	}
	// VERIFIQUE SI TODOS LOS EQUIPOS SON VALIDOS Y CUENTAN CON LA CANTIDAD SUFICIENTE DE JUGADORES
	$torneo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
	$fecha_ini = $torneo["FECHA_INICIO"];
	$dia1 = $_GET["dia_uno"];
	$dia2 = $_GET["dia_dos"];
	sqlsrv_close ( $conn );
	try{
		iniciar_torneo($tid,$lista_equipos,$fecha_ini,$dia1,$dia2);
	} catch(Exception $e) {
		die( print_r( $e, true));
	}
	//Función: Obtener días de calendario para los partidos
	function calendario ($date, $equipos, $dia1, $dia2)
	{
		$date=new DateTime($date);
		$cont = 0;
		$jornada = 2 * ($equipos - 1);
		$fechas = array();
		
		//Este while se encarga de guardar las fechas en un arreglo de nombre $fechas
		while($cont < $jornada)
			{	
			$date = $date->modify("Next ".$dia1); 	
			array_push($fechas,$date->format('Y-m-d'));
			$cont++;
			$date = $date->modify("Next ".$dia2); 	
			array_push($fechas,$date->format('Y-m-d'));
			$cont++;
			}
		return $fechas;
	}
	
	function generar_torneo($equipos,$calendario)
	{
		//Variable cantidad de equipos
		$cant_equipos=sizeof($equipos);
		
		//Procedimiento para crear el arreglo jornada
		$partidos_jornada = $cant_equipos/2;
		$jornada = array();
		for ($i=0; $i<>$partidos_jornada; $i++)
		{
			array_push($jornada,array());
		}
		//crear arreglo del torneo
		$cant_jornada=2*($cant_equipos-1);
		$torneo=array();
		for($i=0;$i<>$cant_jornada;$i++)
		{
			array_push($torneo,$jornada);
		}
		//Ya tenemos el array vacío listo y procedemos a cargarlo con los partidos
		//Primer proceso: colocar a los equipos menos al ultimo en todos y cada uno de los partidos por jornada
		$e = 0;
		$p = $cant_equipos-2;
		for ($i=0; $i<>$cant_jornada; $i++)
		{
			for ($j=0;$j<>$partidos_jornada; $j++)
			{
				array_push($torneo[$i][$j],$equipos[$e]);
				if ($e<>$p)
				{
					$e=$e+1;
				}
				else
				{
					$e=0;
				}
			}
		}
		//Segundo proceso: Colocar a los equipos menos el ultimo en orden contrario al primer proceso ignorando la primer posición
		$e = 0;
		for ($i=($cant_jornada-1); $i<>-1; $i--)
		{
			for ($j=($partidos_jornada-1);$j<>0; $j--)
			{
				array_push($torneo[$i][$j],$equipos[$e]);
				if ($e<>$p)
				{
					$e=$e+1;
				}
				else
				{
					$e=0;
				}
			}
		}
		//Tercer paso: colocar al ultimo equipo eal principio de las jornadas alternando casa, visita
		$lugar=0;
		$ultimo=$cant_equipos-1;
		for ($i=0; $i<>$cant_jornada; $i++)
		{
			if($lugar==0)
			{
				array_unshift($torneo[$i][0],$equipos[$ultimo]);
				$lugar=1;
			}
			else
			{
				array_push($torneo[$i][0],$equipos[$ultimo]);
				$lugar=0;
			}
		}
		//Cuarto Paso: Invertir partidos a mitad de jornada ignorando el primero que ya está invertido... 
		for ($i=($cant_jornada/2); $i<>$cant_jornada; $i++)
		{
			for ($j=0;$j<>$partidos_jornada; $j++)
			{
				if ($j<>0)
				{
					$torneo[$i][$j]= array_reverse($torneo[$i][$j]);
				}
			}	
		}
		//Quinto paso: Asignamos fechas a las jornadas, como atributo al final del arreglo
		for ($i=0; $i<>$cant_jornada; $i++)
		{
				array_push ($torneo[$i],$calendario[$i]);
		}
		
		//retorno
		return $torneo;
	}
	function iniciar_torneo ($id_torneo,$equipos,$fecha_ini,$dia1,$dia2)
	{
		$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"adm_user", "PWD"=>"Bases123");
		$conexion = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
		/* Begin the transaction. */
		if ( sqlsrv_begin_transaction( $conexion ) === false ) {
			echo "todo mal<br>";
			 die( print_r( sqlsrv_errors(), true ));
		}
		$equipos = explode(",",$equipos);
		$calendario=calendario($fecha_ini,sizeof($equipos),$dia1,$dia2);
		$torneo=generar_torneo($equipos,$calendario);
		$cant_equipos=sizeof($equipos);
		$cant_jornada=2*($cant_equipos-1);
		$pxj=$cant_equipos/2;
		for ($i=0;$i<$cant_jornada;$i++)
		{
			//Hay que insertar las jornadas en la tabla JORNADA
			$fecha_partido=end($torneo[$i]);
			$sql = "EXEC add_jornada ?,?,?";
			$params = array($id_torneo,$i,$fecha_partido);
			$stmt = sqlsrv_query( $conexion, $sql, $params);
			if( $stmt === false ) {
					sqlsrv_rollback ( $conexion );
					throw new Exception('No se logro insertar el equipo en el partido.');
			}
			for ($j=0;$j<$pxj;$j++)
			{
				//Por cada jornada se crea el partido para aprovechar el for loop partido
				$equipo_casa=$torneo[$i][$j][0];
				$equipo_visita=$torneo[$i][$j][1];
				$sql = "EXEC get_ubicacion_equipo @ID_EQUIPO_INSCRITO = ?";
				$params = array($equipo_casa);
				$stmt = sqlsrv_query( $conexion, $sql, $params);
				if( $stmt === false ) {
					sqlsrv_rollback ( $conexion );
					throw new Exception('No se logro insertar el equipo en el partido.');
				}
				$id_ubicacion = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				$id_ubicacion = $id_ubicacion["ID_UBICACION"];
				$sql = "EXEC add_partido @ID_TORNEO= ? , @ID_JORNADA = ? , @ID_EQUIPO_CASA = ? , @ID_EQUIPO_VISITA = ?, @FECHA_PARTIDO = ? , @ID_UBICACION = ?";
				$params = array($id_torneo,$i,$equipo_casa,$equipo_visita,$fecha_partido." 15:00:00", $id_ubicacion);
				$stmt = sqlsrv_query( $conexion, $sql, $params);
				if( $stmt === false ) {
					sqlsrv_rollback ( $conexion );
					throw new Exception( print_r( sqlsrv_errors(), true));
					die();
				}
			}
			
		}
		$sql = "EXEC actualizar_torneo @ID_TORNEO= ?";
		$params = array($id_torneo);
		$stmt = sqlsrv_query( $conexion, $sql, $params);
		if( $stmt === false ) {
			sqlsrv_rollback ( $conexion );
			throw new Exception( print_r( sqlsrv_errors(), true));
			die();
		}
		sqlsrv_commit ( $conexion );
		setcookie("iniciar_torneo","t", time()+10);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	
?>
