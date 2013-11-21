<?php
	/*
	TORNEO.PHP
	OBTENER LA INFORMACION DE UN TORNEO
	*/
	// CONEXION BASE DE DATOS
	if (!isset($_GET["tid"])) {
    	include("error.php");
	} else {
		$tid = $_GET["tid"];
		if (!is_numeric($tid)) {
			include("error.php");
		} else {
			if (!is_int(intval($tid))) {
				include("error.php");
			} else {
			/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
			include("../system/conectInfo.php");?>
                <div id="subtitulo">
                    <h3>Tabla de Goleadores</h3>
                </div>
                <div class="tabla_posiciones">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="25">Goleadores</th>
                                    <th>Goles</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
							$sql = "EXEC get_tabla_goleadores @ID_TORNEO = ?";
							$params = array($tid);
							$stmt = sqlsrv_query( $conn, $sql, $params);
							if( $stmt === false ) {
								include("error.php");
							} else {
								while($goleador = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){?>
                                <tr>
                                    <td colspan="25"><?php echo $goleador["NOMBRE"]; ?></td>
                                    <td><?php echo $goleador["GOLES"]; ?></td>
                                </tr>
                            <?php } 
							}
							?>
                            </tbody>
                        </table>
                </div>
<?php 
			}
		}
	}
?>