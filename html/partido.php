<?php
	/*
	TORNEO.PHP
	OBTENER LA INFORMACION DE UN TORNEO
	*/
	// CONEXION BASE DE DATOS
	if (!isset($_GET["pid"])) {
    	include("error.php");
	} else {
		$pid = $_GET["pid"];
		if (!is_numeric($pid)) {
			include("error.php");
		} else {
			if (!is_int(intval($pid))) {
				include("error.php");
			} else {
			/* SE CREA CONEXION A LA BASE DE DATOS DE SQL SERVER */
			include("../system/conectInfo.php");
			$sql = "EXEC get_partido_info @ID_PARTIDO = ?";
			$params = array($pid);
			$stmt = sqlsrv_query( $conn, $sql, $params);
			if( $stmt === false ) {
            	include("error.php");
			} else {
				$partido_info = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				$equipo_casa = $partido_info["ID_EQUIPO_CASA"];
				$equipo_visita = $partido_info["ID_EQUIPO_VISITA"];
				$simp_casa = strtoupper(substr($partido_info["EQUIPO_CASA"],0,3));
				$simp_visita = strtoupper(substr($partido_info["EQUIPO_VISITA"],0,3));
				?>
                <!--SUBTITULO-->
                <div id="subtitulo">
                    <h3>Partido</h3>
                </div>
                <!-- Partido -->
                <div class="programacion_partido">
                    <div class="titulo">
                        <span class="fecha"><?php echo $partido_info["FECHA"]; ?></span>
                        <span class="hora"><?php echo $partido_info["HORA"]; ?></span>
                    </div>
                    <div class="equipo equipo-primero">
                        <img class="escudo-equipo" src="../img/escudo-real.png" alt="equipo escudo"/>
                        <span class="nombre"><?php echo $partido_info["EQUIPO_CASA"]; ?></span>
                        <span class="goles"><?php echo $partido_info["GOLES_CASA"]; ?></span>
                    </div>
                    <div class="equipo">
                        <img class="escudo-equipo" src="../img/escudo-real.png" alt="equipo escudo"/>
                        <span class="nombre"><?php echo $partido_info["EQUIPO_VISITA"]; ?></span>
                        <span class="goles"><?php echo $partido_info["GOLES_VISITA"]; ?></span>
                    </div>
                </div>      
                <!-- RESUMEN TARJETAS --->
                <?php
					$sql = "EXEC get_partido_tarjetas @ID_PARTIDO = ?, @ID_EQUIPO_INSCRITO = ?,@COLOR = ?";
					$params = array($pid,$equipo_casa,'AMARILLA');
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
						die();
					}
					$amarillas_casa = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
					$sql = "EXEC get_partido_tarjetas @ID_PARTIDO = ?, @ID_EQUIPO_INSCRITO = ?,@COLOR = ?";
					$params = array($pid,$equipo_visita,'AMARILLA');
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
						die();
					}
					$amarillas_visita = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
					$sql = "EXEC get_partido_tarjetas @ID_PARTIDO = ?, @ID_EQUIPO_INSCRITO = ?,@COLOR = ?";
					$params = array($pid,$equipo_casa,'ROJA');
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
						die();
					}
					$rojas_casa = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
					$sql = "EXEC get_partido_tarjetas @ID_PARTIDO = ?, @ID_EQUIPO_INSCRITO = ?,@COLOR = ?";
					$params = array($pid,$equipo_visita,'ROJA');
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
						die();
					}
					$rojas_visita = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
					?>
					<div class="contenedor_bg_gris">
						<div class="encabezado">Estadisticas</div>
						<div class="divisor">
							<div class="primer_colum padding_1">
							</div>
							<div class="segunda_colum padding_2"><?php echo $simp_casa; ?></div>
							<div class="tercer_colum padding_2"><?php echo $simp_visita; ?></div>
						</div>
						<div class="divisor">
							<div class="primer_colum padding_1">
								<span>Amarillas</span>
							</div>
							<div class="segunda_colum padding_2"><?php echo $amarillas_casa["CANTIDAD"]?></div>
							<div class="tercer_colum padding_2"><?php echo $amarillas_visita["CANTIDAD"]?></div>
						</div>
						<div class="divisor">
							<div class="primer_colum padding_1">
								<span>Rojas</span>
							</div>
							<div class="segunda_colum padding_2"><?php echo $rojas_casa["CANTIDAD"]?></div>
							<div class="tercer_colum padding_2"><?php echo $rojas_visita["CANTIDAD"]?></div>
						</div>                   
					</div>
                <div class="contenedor_bg_gris">
                    <div class="encabezado">Resumen Anotaciones</div>
                    <div class="divisor">
                        <div class="primer_colum padding_2">
                        </div>
                        <div class="segunda_colum padding_3"><?php echo $simp_casa; ?></div>
                        <div class="tercer_colum padding_3"><?php echo $simp_visita; ?></div>
                    </div>
                    <?php
					$sql = "EXEC get_partido_goles @ID_PARTIDO = ?, @ID_EQUIPO_CASA = ?,@ID_EQUIPO_VISITA = ?";
					$params = array($pid,$equipo_casa,$equipo_visita);
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
						die();
					}
					while ($gol = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
					?>
                        <div class="divisor">
                            <div class="primer_colum padding_2">
                                <span><?php echo $gol["MINUTO"]; ?></span>
                            </div>
                            <?php
							if ($gol["NUMERO_EQUIPO"] == 1){
								echo "<div class='segunda_colum padding_3'>".$gol["NOMBRE"]."</div><div class='tercer_colum padding_3'></div>";
							}else {
								echo "<div class='segunda_colum padding_3'></div><div class='tercer_colum padding_3'>".$gol["NOMBRE"]."</div>";
							}
							?>
                        </div>
                    <?php
					}
					?>               
                </div>                 
                <div class="contenedor_bg_gris ">
                    <div class="encabezado">Resumen Tarjetas</div>
                    <div class="divisor">
                        <div class="primer_colum padding_2">
                        </div>
                        <div class="segunda_colum padding_3"><?php echo $simp_casa; ?></div>
                        <div class="tercer_colum padding_3"><?php echo $simp_visita; ?></div>
                    </div>
                    <?php
					$sql = "EXEC get_partido_tarjetas_resumen @ID_PARTIDO = ?, @ID_EQUIPO_CASA = ?,@ID_EQUIPO_VISITA = ?";
					$params = array($pid,$equipo_casa,$equipo_visita);
					$stmt = sqlsrv_query( $conn, $sql, $params);
					if( $stmt === false ) {
						include("error.php");
						die();
					}
					while ($tarjeta = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)){
						if ($tarjeta["COLOR"]=="AMARILLA") {
							$clase = "t_amarilla";
						} else {
							$clase = "t_roja";
						}
						if ($tarjeta["NUMERO_EQUIPO"]==1){
					?>
                            <div class="divisor">
                                <div class="primer_colum padding_2">
                                    <span><?php echo $tarjeta["MINUTO"]; ?></span>
                                </div>
                                <div class="segunda_colum padding_3">
                                    <div class="<?php echo $clase; ?>"></div>
                                    <span><?php echo $tarjeta["NOMBRE"]; ?></span>
                                </div>
                                <div class="tercer_colum padding_3">
                                    <div></div>
                                    <span></span>
                                </div>
                            </div>
                <?php
                         }
						 else {?>
                            <div class="divisor">
                                <div class="primer_colum padding_2">
                                    <span><?php echo $tarjeta["MINUTO"]; ?></span>
                                </div>
                                <div class="segunda_colum padding_3">
                                    <div></div>
                                    <span></span>
                                </div>
                                <div class="segunda_colum padding_3">
                                    <div class="<?php echo $clase; ?>"></div>
                                    <span><?php echo $tarjeta["NOMBRE"]; ?></span>
                                </div>
                            </div>
						 <?php }
				} ?>        
                </div>                 
                
                <!-- -->
                
                <div class="contenedor_bg_gris">
                    <div class="encabezado">Árbitros</div>
                    <ol>
                    
                        <div class="divisor">
                            <div class="primer_colum padding_4">
                            </div>
                            <div class="segunda_colum padding_5">Posición</div>
                        </div>
						<?php
                        $sql = "EXEC get_arbitros_partido @ID_PARTIDO = ?";
                        $params = array($pid);
                        $stmt = sqlsrv_query( $conn, $sql, $params);
                        if( $stmt === false ) {
                            include("error.php");
                            die();
                        }
                        $arbitro = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)
                        ?>
                        <div class="divisor">
                            <div class="primer_colum padding_4">
                                <li><?php echo $arbitro["ARBITRO_PRINCIPAL"]; ?></li>
                            </div>
                            <div class="segunda_colum padding_5">Principal</div>
                        </div>
                        
                        <div class="divisor">
                            <div class="primer_colum padding_4">
                                <li><?php echo $arbitro["ARBITRO_LINEA_1"]; ?></li>
                            </div>
                            <div class="segunda_colum padding_5">Línea 1</div>
                        </div>
                        
                        <div class="divisor">
                            <div class="primer_colum padding_4">
                                <li><?php echo $arbitro["ARBITRO_LINEA_2"]; ?></li>
                            </div>
                            <div class="segunda_colum padding_5">Línea 2</div>
                        </div>  
                       
                        <div class="divisor">
                            <div class="primer_colum padding_4">
                                <li><?php echo $arbitro["ARBITRO_CUARTO"]; ?></li>
                            </div>
                            <div class="segunda_colum padding_5">Cuarto árbitro</div>
                        </div>  
                    </ol>     
                </div> 
                <br>
                <br>
                <br>
                <br>             
<?php
				}
			}
		}
	}
?>
    
