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
                    <h3>Tabla de Posiciones</h3>
                </div>
                <!--CIERRA SUBTITULO-->
                <div class="tabla_posiciones">
                        <table class="table" id="tabla_de_posiciones">
                            <thead>
                                <tr>
                                    <th colspan="8">Equipos</th>
                                    <th>PJ</th>
                                    <th>PG</th>
                                    <th>PE</th>
                                    <th>PP</th>
                                    <th>GF</th>
                                    <th>GC</th>
                                    <th>GD</th>
                                    <th>PTS</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
							$sql = "EXEC get_tabla_posicion @ID_TORNEO = ?";
							$params = array($tid);
							$stmt = sqlsrv_query( $conn, $sql, $params);
							if( $stmt === false ) {
								include("error.php");
							} else {
								while($posicion = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){?>
                                <tr>
                                    <td colspan="8"><?php echo $posicion["NOMBRE"]; ?></td>
                                    <td><?php echo $posicion["PARTIDOS_JUGADOS"]; ?></td>
                                    <td><?php echo $posicion["PARTIDOS_GANADOS"]; ?></td>
                                    <td><?php echo $posicion["PARTIDOS_EMPATADOS"]; ?></td>
                                    <td><?php echo $posicion["PARTIDOS_PERDIDOS"]; ?></td>
                                    <td><?php echo $posicion["GOLES_A_FAVOR"]; ?></td>
                                    <td><?php echo $posicion["GOLES_EN_CONTRA"]; ?></td>
                                    <td><?php echo $posicion["DIFERENCIA_GOLES"]; ?></td>
                                    <td><?php echo $posicion["PUNTOS"]; ?></td>
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