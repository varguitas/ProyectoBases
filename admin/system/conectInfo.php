<?php
	/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
	$connectionInfo = array( "Database"=>"Proyecto", "UID"=>"adm_user", "PWD"=>"Bases123");
	$conn = sqlsrv_connect( 'VARGAS-PC', $connectionInfo);
?>