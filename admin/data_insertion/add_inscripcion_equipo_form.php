<?php
	if (!isset($_GET["tid"])) {
		include("../html/error.php");
		die();
	}
	$tid = $_GET["tid"];
	// SE VERIFICA SI ES ADMIN
	include("../system/verifica_admin.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Off Canvas Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/offcanvas.css" rel="stylesheet">
    
    <!-- Custom style -->
    <link href="../css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../../css/jquery-ui-1.10.3.custom.min.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  	<?php
    	include("../html/header.php");
	?>

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
            	<?php
                	if (isset($_COOKIE["add_inscripcion_equipo"])) {
						if ( $_COOKIE["add_inscripcion_equipo"] == "t") {
							echo "<div class='add_ok'>Inscripción realizada con éxito</div>";
						} else if ($_COOKIE["add_inscripcion_equipo"] == "t") {
							
						} else {
							echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
						}
						unset($_COOKIE['add_inscripcion_equipo']);
					}
				?>
          <!-- /Jumbotron -->
          <div class="jumbotron">
            <button type="button" class="btn btn-primary btn-lg toggle_button">Inscribir Equipo</button>
            <div class="toggled_container">                  
            <div class="form-group">
                 <label class="col-sm-2 control-label" style="margin-left:0.8em">Equipo</label>
                 <div class="col-sm-8" style="margin-top:0.5em">
                 <select id="equipo" name="id_equipo" class="form-control">
                 <?php
                    include("../system/conectInfo.php");
                    $sql = "EXEC get_equipos_no_inscritos ?";
                    $params = array($tid);
                    $stmt = sqlsrv_query( $conn, $sql, $params);
                    while ($equipo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='".$equipo["ID_EQUIPO"]."'>".$equipo["NOMBRE"]."</option>";
                    }
					
                 ?>
                  <!--- OPTION ADDED BY DATA BASE -->
                </select>	
                </div>
            </div>
            
            <div class="form-group">
                 <label class="col-sm-2 control-label" style="margin-left:0.8em">Entrenador:</label>
                 <div class="col-sm-8" style="margin-top:0.5em">
                 <select name="id_entrenador" id="entrenador" class="form-control">
                 <?php
                    include("../system/conectInfo.php");
                    $sql = "EXEC get_entrenadores";
                    $params = array();
                    $stmt = sqlsrv_query( $conn, $sql, $params);
                    while ($entrenador = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                        echo "<option value='".$entrenador["ID_ENTRENADOR"]."'>".$entrenador["NOMBRE"]."</option>";
                    }
                 ?>
                  <!--- OPTION ADDED BY DATA BASE -->
                </select>	
                </div>
            </div>
        
            <div class="form-group">
            <br>
            <br>
                <label class="col-sm-3.5 control-label" style="margin-left:2.7em">Fecha de Inscripción</label>
                 <input name="fecha_ins"  type="text" id="datepicker" placeholder="yyyy-mm-dd"/>	
            </div>

            
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="inscribir_jugadores" class="btn btn-default">Añadir</button>
                </div>
              </div>
            </div>    <!--cierra agregar_equipo-->    
          </div> <!-- /Jumbotron -->
          
          <div class="row" style="padding:2em">
          <?php
            $sql = "EXEC get_equipos_inscritos @ID_TORNEO = ?";
            $params = array($tid);
            $stmt = sqlsrv_query( $conn, $sql, $params);
			if (sqlsrv_has_rows($stmt)) {
				$equipo_inscrito = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				$equipos_inscritos_li = "<li data-iid=".$equipo_inscrito["ID_INSCRIPCION_EQUIPO"]." class='list-group-item active equipo_inscrito_li'>".$equipo_inscrito["NOMBRE"]."</li>";
				$contenido = "<div class='equipo_inscrito_contenido active' data-iid=".$equipo_inscrito["ID_INSCRIPCION_EQUIPO"]."><h1 style='display:inline-block'>".$equipo_inscrito["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
            <h3>Torneo</h3>
            <p>".$equipo_inscrito["NOMBRE_TORNEO"]."</p>
            <h3>Fecha de Inscripción</h3>
            <p>".$equipo_inscrito["FECHA_INSCRIPCION"]."</p></div>";
				while ($equipo_inscrito = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
					$equipos_inscritos_li = $equipos_inscritos_li."<li data-iid=".$equipo_inscrito["ID_INSCRIPCION_EQUIPO"]." class='list-group-item equipo_inscrito_li'>".$equipo_inscrito["NOMBRE"]."</li>";
					$contenido = $contenido."<div class='equipo_inscrito_contenido' data-iid=".$equipo_inscrito["ID_INSCRIPCION_EQUIPO"]."><h1 style='display:inline-block'>".$equipo_inscrito["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Torneo</h3>
				<p>".$equipo_inscrito["NOMBRE_TORNEO"]."</p>
				<h3>Fecha de Inscripción</h3>
				<p>".$equipo_inscrito["FECHA_INSCRIPCION"]."</p></div>";
				}
			} else {
				$equipos_inscritos_li = "<li class='list-group-item'>No hay equipos inscritos</li>";
			}
			echo $contenido;
			?>
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
          <h3>Equipos Inscritos</h3>
		 <?php
		 	echo $equipos_inscritos_li;
         ?>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.container-->


 
   <!------------------------------------
  										MODAL WINDOW
  															---------------------------->
 
 	  <div class="modal fade" id="modal_inscripcion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
              <div class="modal-dialog" style="width:75em;margin:auto">
                <div class="modal-content" style="overflow:auto;height:35em">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Inscripción de Jugadores</h4>
                  </div> <!--modal header-->
                  <div class="modal-body">

						
				 	<div id="div_jugadores_disponibles">                  
                      <h3 style="padding-left:1em">Jugadores Disponibles</h3>
                      <div>
                      	<table id="tabla_jugadores_disponibles" class="table table-hover" style="cursor:pointer">
                            <thead>
                            <tr>
                                <th style="padding-left:1em">Jugadores Disponibles</th>
                                <th style="padding-left:1em">Posición</th>
                            </tr>
                            </thead>
                            <tbody>
							 <?php
								include("../system/conectInfo.php");
								$sql = "EXEC get_posiciones";
								$params = array();
								$stmt = sqlsrv_query( $conn, $sql, $params);
								$posiciones = "";
								while ($posicion = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
									$posiciones = $posiciones . "<option value='".$posicion["ID_POSICION"]."'>".$posicion["DESCRIPCION"]."</option>";
								}
                                $sql = "EXEC get_jugadores";
                                $params = array();
                                $stmt = sqlsrv_query( $conn, $sql, $params);
                                while ($jugador = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                                    echo "<tr data-jid=".$jugador["ID_JUGADOR"]." class='selecionable'>
									<td>".$jugador["NOMBRE"]."</td>
									<td>
										<select class='form-control'>".$posiciones."</select>
									</td>
									</tr>";
                                }
                             ?>
                            </tbody>
                            
                        </table>
                      </div>
                  	</div>
                  
                  	<div class="div_buttons_config">
                  	<button id="add_inscripcion" data-ijd="" class="btn btn-default" disabled="disabled" type="button">>></button>
                    <button id="remove_inscripcion" data-ijd="" class="btn btn-default" disabled="disabled" type="button" ><<</button>
                  	</div>
                    <div id="div_inscripcion_jugadores_inscritos">
                      <h3 style="padding-left:1em">Inscripcion</h3>
                      <div>
                      
                      
                          <table id="tabla_inscripcion_jugadores_inscritos" class="table table-hover" style="cursor:pointer">
                            <thead>
                            <tr>
                                <th style="padding-left:1em">Jugadores Inscritos</th>
                                <th style="padding-left:1em">Posición</th>
                            </tr>
                            </thead>
                            
                            <tbody></tbody>

                        </table>

                      </div>
                    </div>
                  
                  
                  
                  </div> <!--model body-->
                  
                  <div class="modal-footer" style="clear:both">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button data-tid="<?php echo $tid; ?>" id="guardar_inscripcion" class="btn btn-primary">Guardar</button>
                  </div><!-- modal footer-->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->  
            
  <!------------------------------------
  										MODAL WINDOW
  															---------------------------->
     
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 	<script src="../../js/jquery-1.10.2.min.js"></script>
  	<script src="../../js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/offcanvas.js"></script>
    <script src="../js/index.js"></script>
    <script>
		$(".equipo_inscrito_li").click(function(){
			var iid = $(this).attr("data-iid");
			$(".equipo_inscrito_li.active").removeClass("active");
			$(".equipo_inscrito_li[data-iid="+iid+"]").addClass("active");
			$(".equipo_inscrito_contenido.active").removeClass("active");
			$(".equipo_inscrito_contenido[data-iid="+iid+"]").addClass("active");
		});
		$("#inscribir_jugadores").click(function(){
			if ($("#equipo").val()!="" && $("#entrenador").val()!="" && $("#datepicker").val()!="" ){
				var eid = $("#equipo").val();
				var entid = $("#entrenador").val();
				$("#guardar_inscripcion").attr("data-eid",eid);
				$("#guardar_inscripcion").attr("data-entid",entid);
				$('#modal_inscripcion').modal('show');
			} else {
				alert("Debe seleccionar los datos de inscripción.");
			}
		});
			$("#partidos_registrados tr").click(function(){
		var partido_seleccionado = $(this).attr("data-pid");
		$('#formacion').removeAttr('disabled');
		$('#incidencia').removeAttr('disabled');
		$("#formacion").attr('data-pid',partido_seleccionado);
		$("#incidencia").attr('data-pid',partido_seleccionado);
		});
	
	$("#formacion").click(function(){
		if($(this).attr('data-pid')==""){
			alert('seleccione un partido');
			}else{$('#Modal_Alineacion').modal('show')}	
		});
	
	$("#incidencia").click(function(){
		if($(this).attr('data-pid')==""){
			alert('seleccione un partido');
			}else{$('#Modal_Incidencia').modal('show')}	
		});
	

	
	$("#tab_partidos_jugados").on('shown.bs.tab',function(){
		
		$('#formacion').attr('disabled',"disabled");
		$('#incidencia').attr('disabled',"disabled");
		});	
		
	$("#tab_partidos_registrados").on('shown.bs.tab',function(){
		
		$('#formacion').attr('disabled',"disabled");
		$('#incidencia').attr('disabled',"disabled");
		});		
	      
/*****************************/	
function actualizar_seleccionables(){
  $( '#tabla_jugadores_disponibles tbody tr.selecionable').click(function(){  
	  $('#tabla_jugadores_disponibles tbody tr.selected').removeClass('selected');
	  $('#tabla_inscripcion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	  $(this).addClass('selected');
	  $('#add_inscripcion').removeAttr('disabled');
	  $('#remove_inscripcion').attr('disabled',"disabled");
	  	});
		
  $( '#tabla_inscripcion_jugadores_inscritos tbody tr.selecionable').click(function(){
	  $('#tabla_jugadores_disponibles tbody tr.selected').removeClass('selected');  
	  $('#tabla_inscripcion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	  $(this).addClass('selected');
	  $('#remove_inscripcion').removeAttr('disabled');
	   $('#add_inscripcion').attr('disabled',"disabled");
	  	});
		
		
/***********/

	$( '#tabla_alineacion_jugadores_inscritos tbody tr.selecionable').click(function(){  
	  $('#tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	  $('#tabla_alineacion tbody tr.selected').removeClass('selected');
	  $(this).addClass('selected');
	  $('#add_alineacion').removeAttr('disabled');
	  $('#remove_alineacion').attr('disabled',"disabled");
	  	});
		
  $( '#tabla_alineacion tbody tr.selecionable').click(function(){  
  	  $('#tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	  $('#tabla_alineacion tbody tr.selected').removeClass('selected');
	  $(this).addClass('selected');
	  $('#remove_alineacion').removeAttr('disabled');
	   $('#add_alineacion').attr('disabled',"disabled");
	  	});		
		
}

actualizar_seleccionables();



   $('#add_inscripcion').click(function(){
	   $('#tabla_jugadores_disponibles tbody tr.selected').appendTo('#tabla_inscripcion_jugadores_inscritos tbody');
	   $('#tabla_inscripcion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	   $('#tabla_inscripcion_jugadores_inscritos  tbody tr td select').attr('disabled',"disabled")
	   $('#add_inscripcion').attr('disabled',"disabled");
	   actualizar_seleccionables();
		});
		
	$('#remove_inscripcion').click(function(){
	   $('#tabla_inscripcion_jugadores_inscritos tbody tr.selected').appendTo('#tabla_jugadores_disponibles tbody');
	   $('#tabla_jugadores_disponibles tbody tr.selected').removeClass('selected');
	   $('#tabla_jugadores_disponibles tbody tr td select').removeAttr('disabled',"disabled");
	   $('#remove_inscripcion').attr('disabled',"disabled");
	   actualizar_seleccionables();
		});
		
		
		/******/
		
   $('#add_alineacion').click(function(){
	   $('#tabla_alineacion_jugadores_inscritos tbody tr.selected').appendTo('#tabla_alineacion tbody');
	   $('#tabla_alineacion tbody tr.selected').removeClass('selected');
	   $('#tabla_alineacion tbody tr td input').attr('disabled',"disabled");
	   $('#add_alineacion').attr('disabled',"disabled");
	   actualizar_seleccionables();
	});
		
	$('#remove_alineacion').click(function(){
	   $('#tabla_alineacion tbody tr.selected').appendTo('#tabla_alineacion_jugadores_inscritos tbody');
	   $('#tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	   $('#tabla_alineacion_jugadores_inscritos tbody tr td input').removeAttr('disabled');
	   $('#remove_alineacion').attr('disabled',"disabled");
	   actualizar_seleccionables();
		});
	$("#guardar_inscripcion").click(function(){
		var xml = "<ids>";
		var jugadores = $("#tabla_inscripcion_jugadores_inscritos tbody tr");
		alert($(jugadores).size());
		if ($(jugadores).size()>3 && $(jugadores).size()<23) {
			$("#tabla_inscripcion_jugadores_inscritos tbody tr").each(function(){
				var id_jug = $(this).attr("data-jid");
				var id_pos = $(this).children("td:last-child").children("select").val();
				xml = xml + "<id><jugador>"+id_jug+"</jugador><posicion>"+id_pos+"</posicion></id>";
			});
			xml = xml + "</ids>";
			var id_tor = $(this).attr("data-tid");
			var id_equ = $(this).attr("data-eid");
			var id_ent = $(this).attr("data-entid");
			$("#capa_protectora").fadeIn();
			/* SE INSCRIBE EL EQUIPO */
			$.ajax({
				type: "POST",
				async: false,
				url: "add_inscripcion_equipo.php",
				data: { id_torneo: id_tor,id_equipo: id_equ,id_entrenador: id_ent,jugadores: xml},
				success: function(e) {
					if (e == "t") {
						$("#capa_protectora").fadeOut();
						alert("todo bien");
//						document.location.reload
					} else {
						alert("todo mal");
					}
				}
			}).done(function(){
				$("#capa_protectora").fadeOut();
			});
		} else {
			alert("Debe registrar al menos 15 jugadores y como máximo 22");
		}
	});
	</script>
  </body>
</html>>>>>>>