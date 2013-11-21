<?php
	include("../system/conectInfo.php");
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
			include("../system/conectInfo.php");
			$sql = "EXEC get_torneo_info @ID_TORNEO = ?";
			$params = array($tid);
			$stmt = sqlsrv_query( $conn, $sql, $params);
			if( $stmt === false ) {
            	include("error.php");
			} else {
				$torneo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				?>
                <div id="subtitulo">
                    <h3><?php echo $torneo["NOMBRE"]; ?></h3>
                </div>
                <!--CIERRA SUBTITULO-->
                
                
                <!--Descripcion del Torneo-->
                <div class="descripcion">
                    <div class="descripcion_texto">Descripcion del torneo</div>
                    <div class= "text_bg_azul"><p>FALTA AGREGAR DESCRIPCION A TABLA TORNEO</p></div>
                </div>
                <!--Descripcion del Torneo-->
                
                <!--FECHA-->
                <div class="fecha_info">
                    <span class="fecha_ini">Fecha de inicio: </span>
                    <span class="span-info"><?php echo $torneo["dini"]; ?></span>
                    <span>/</span>
                    <span class="span-info"><?php echo $torneo["mini"]; ?></span>
                    <span>/</span>
                    <span class="span-info"><?php echo $torneo["yini"]; ?></span>
                </div>
                <div class="fecha_info">
                    <span class="fecha_fin">Fecha de fin: </span>
                    <span class="span-info"><?php echo $torneo["dfin"]; ?></span>
                    <span>/</span>
                    <span class="span-info"><?php echo $torneo["mfin"]; ?></span>
                    <span>/</span>
                    <span class="span-info"><?php echo $torneo["yfin"]; ?></span>
                </div>
                <div class="fecha_info">
                    <span class="fecha_fin">País </span>
                    <span class="span-info"><?php echo $torneo["pais"]; ?></span>
                </div>
                
                <!--CIERRA FECHA-->
                
                <!--InFORMACION DEL TORNEO-->
                 <div class="torneo_informacion" data-tid="<?php echo $torneo["ID_TORNEO"] ;?>">
                    <div class="encabezado">Informacion del Torneo</div>
                        <div id="torneo_to_programacion" class="divisor">
                            <span>Programacion</span>
                            <div class="flecha"></div>
                        </div>
                        
                        <div id="torneo_to_posiciones" class="divisor">
                            <span>Tabla de Posiciones</span>
                            <div class="flecha"></div>
                        </div>
                        <div id="torneo_to_goleadores" class="divisor">
                            <span>Goleadores</span>
                            <div class="flecha"></div>
                        </div>
                        <div id="torneo_to_multimedia" class="divisor">
                            <span>Multmedia</span>
                            <div class="flecha"></div>
                        </div>                   
                 </div>
                 <br>
                 <br>
                 <br>
                 <br>
                <!--InFORMACION DEL TORNEO-->
<?php
				}
			}
		}
	}
?>