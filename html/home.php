<?php
	include("../system/conectInfo.php");
	$sql = "EXEC get_act_torneo";
	$params = array();
	$stmt = sqlsrv_query( $conn, $sql, $params);
	if( $stmt === false ) {
        include("error.php");
	} else {
		if (sqlsrv_has_rows($stmt)) {
			echo "<div class='top-fixer'></div>";
			while ($torneo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
				echo "<div data-tid=".$torneo["ID_TORNEO"]." class='basic_container main_container_torneo'><h3>".$torneo["NOMBRE"]."</h3></div>";
			}
		}
		else {?>
        	<br>
            <br>
            <br>
			<div class='no_disponible'><p>No hay torneos disponibles</p></div>
        <?php
		}
	}
?>

