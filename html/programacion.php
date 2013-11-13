<?php
	/*
	PROGRAMACION.PHP
	OBTENER LA PROGRAMACION DE UN TORNEO
	*/
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
				include("../system/conectInfo.php");
				?>
                    <div id="subtitulo">
                            <h3>Programación</h3>
                    </div>
                    <div id="barra_bloques_partidos">
                        <div id="bloque_estado_partidos">
                            <div class="completos">Completos</div>
                            <div class="active">Hoy</div>
                            <div class="proximos">Próximos</div>
                        </div>
                    </div>
                    <div id="partidos_completos">
                    <?php
					$sql = "EXEC get_programacion_torneo_hoy @ID_TORNEO = ?";
					$params = array($tid);
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
					} else {
						if (sqlsrv_has_rows($stmt)) {
							while ($partido_concluido = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {?>
                                <div class="programacion_partido" data-pid="<?php echo $partido_concluido["ID_PARTIDO"]; ?>">
                                    <div class="titulo">
                                        <span class="fecha"><?php echo $partido_concluido["FECHA"]; ?></span>
                                        <span class="hora"><?php echo $partido_concluido["HORA"]; ?></span>
                                    </div>
                                    <div class="equipo equipo-primero">
                                        <img class="escudo-equipo" src="../img/escudo-real.png" alt="equipo escudo"/>
                                        <span class="nombre"><?php echo $partido_concluido["EQUIPO_CASA"]; ?></span>
                                        <span class="goles"><?php echo $partido_concluido["GOLES_CASA"]; ?></span>
                                    </div>
                                    <div class="equipo">
                                        <img class="escudo-equipo" src="../img/escudo-real.png" alt="equipo escudo"/>
                                        <span class="nombre"><?php echo $partido_concluido["EQUIPO_VISITA"]; ?></span>
                                        <span class="goles"><?php echo $partido_concluido["GOLES_VISITA"]; ?></span>
                                    </div>
                                </div>			
					<?php	}
						} else {?>
                            <br>
                            <br>
                            <br>
                            <div class='no_disponible'><p>No hay partidos completados</p></div>
						<?php }
					?>
                    </div>
<?php
				}
			}
		}
	}
?>