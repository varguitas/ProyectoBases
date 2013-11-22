<?php
	include("../system/verifica_admin.php");
	if (!isset($_GET["tid"])) {
		die("DEBE INGRESAR EL ID DEL TORNEO");
	}
	$tid = $_GET["tid"];
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
    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        
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
  		
        <div style="display:block">
        	<h1>Control de Información</h1>
        </div>
        
          <!-- /Jumbotron -->
          <div class="jumbotron">

			<ul class="nav nav-tabs">
              <li id="tab_partidos_jugados"><a href="#home" data-toggle="tab">Partidos Jugados</a></li>
              <li id="tab_partidos_registrados"><a href="#profile" data-toggle="tab">Partidos Registrados</a></li>
            </ul>
           
            <!-- Tab panes -->
            <div class="tab-content" style="height:10em;overflow:auto;background-color:#FFF">
              <div class="tab-pane fade in active" id="home">
              
              	<table class="table table-hover" style="cursor:pointer">
  					<tr>
                        <th>Equipo Casa</th>
                        <th>Equipo Visita</th>
                        <th>Fecha</th>
                    </tr>
  					 <?php
						include("../system/conectInfo.php");
						$sql = "EXEC get_programacion_torneo_completado @ID_TORNEO = ?";
						$params = array($tid);
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($partido = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							echo "<tr data-pid='".$partido["ID_PARTIDO"]."'><td>".$partido["EQUIPO_CASA"]."</td><td>".$partido["EQUIPO_VISITA"]."</td><td>".$partido["FECHA"]."</td></tr>";
						}
					 ?>
				</table>
              
              </div>
              <div class="tab-pane fade in" id="profile">
              
              
              	 <table id="partidos_registrados" class="table table-hover" style="cursor:pointer">
  					<tr>
                        <th>Equipo Casa</th>
                        <th>Equipo Visita</th>
                        <th>Fecha</th>
                    </tr>
  					 <?php
						include("../system/conectInfo.php");
						$sql = "EXEC get_programacion_torneo_futuro @ID_TORNEO = ?";
						$equipos = array();
						$params = array($tid);
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($partido = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							if (!in_array($partido["ID_EQUIPO_CASA"],$equipos)) {
								array_push($equipos,$partido["ID_EQUIPO_CASA"]);
							}
							if (!in_array($partido["ID_EQUIPO_VISITA"],$equipos)) {
								array_push($equipos,$partido["ID_EQUIPO_VISITA"]);
							}
							$sql = "EXEC contar_jugadores_formacion ? , ?";
							$params = array($partido["ID_PARTIDO"],$partido["ID_EQUIPO_CASA"]);
							$stmt2 = sqlsrv_query( $conn, $sql, $params);
							if ($stmt2 === false) {
								die(print_r(sqlsrv_errors(),true));
							}
							$formacion_casa = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);
							$formacion_casa = $formacion_casa["RESULTADO"];
							
							$sql = "EXEC contar_jugadores_formacion ? , ?";
							$params = array($partido["ID_PARTIDO"],$partido["ID_EQUIPO_VISITA"]);
							$stmt3 = sqlsrv_query( $conn, $sql, $params);
							if ($stmt3 === false) {
								die(print_r(sqlsrv_errors(),true));
							}
							$formacion_visita = sqlsrv_fetch_array( $stmt3, SQLSRV_FETCH_ASSOC);
							$formacion_visita = $formacion_visita["RESULTADO"];
							
							echo "<tr data-pid='".$partido["ID_PARTIDO"]."'><td data-ft='".$formacion_casa."' data-eid='".$partido["ID_EQUIPO_CASA"]."' class='equipo'>".$partido["EQUIPO_CASA"]."</td><td data-ft='".$formacion_visita."' data-eid='".$partido["ID_EQUIPO_VISITA"]."' class='equipo'>".$partido["EQUIPO_VISITA"]."</td><td>".$partido["FECHA"]."</td></tr>";
						}
					 ?>
				</table>
            
              </div>
             
            </div>
            <button type="button" data-ipd="" class="btn btn-success" disabled="disabled" id="formacion" style="float:right;margin-top:0.5em">Formación</button>
            <button type="button" data-ipd="" class="btn btn-primary" disabled="disabled" id="incidencia"   style="float:right;margin-top:0.5em;margin-right:0.5em">Incidencia</button>
            
          </div> <!-- /Jumbotron -->
          
          <div class="row" style="padding:2em">
 
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>
      
      <?php
      	foreach ($equipos as $equipo) {
			include("../system/conectInfo.php");
			$sql = "EXEC get_jugadores_inscritos ?";
			$params = array($equipo);
			$stmt = sqlsrv_query( $conn, $sql, $params);
			if ($stmt === false) {
				die(print_r(sqlsrv_errors()));
			}
			
	  ?>
        <!-- Modal Alineacion -->
            <div class="modal fade modal_alineacion" data-eid="<?php echo $equipo;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
              <div class="modal-dialog" style="width:75em;margin:auto">
                <div class="modal-content" style="overflow:auto;height:35em">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Alineación</h4>
                  </div> <!--modal header-->
                  <div class="modal-body">

						
				 	<div class="div_alineacion_jugadores_inscritos">                  
                      <h3 style="padding-left:1em">Jugadores Inscritos</h3>
                      <div>
                      	<table class="tabla_alineacion_jugadores_inscritos" data-eid="<?php echo $equipo; ?>" class="table table-hover" style="cursor:pointer">
                            <thead>
                            <tr>
                                <th style="padding-left:1em">Jugadores Inscritos</th>
                                <th style="padding-left:1em">Posición</th>
                                <th style="padding-left:1em">Número Camiseta</th>
                                <th style="padding-left:1em">Titular</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($jugador = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							?>
                            <tr class="selecionable">
                                <td data-jid="<?php echo $jugador["ID_INSCRIPCION_JUGADOR"]; ?>"><?php echo $jugador["NOMBRE"]; ?></td>
                               	<td><?php echo $jugador["POSICION"]; ?></td>
                                <td class="camisa">
                                	<input type="number" class="form-control" placeholder="Numero camiseta" name="camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" name="titular">
                                </td>
                            </tr>
                            <?php
							}
							?>
                            </tbody>
                            
                        </table>
                      </div>
                  	</div>
                  
                  	<div class="div_buttons_config">
                  	<button class="add_alineacion" data-ijd="" class="btn btn-default" disabled="disabled" type="button">>></button>
                    <button class="remove_alineacion" data-ijd="" class="btn btn-default" disabled="disabled" type="button" ><<</button>
                  	</div>
                    <div id="div_alineacion">
                      <h3 style="padding-left:1em">Alineación</h3>
                      <div>
                      
                      
                          <table class="tabla_alineacion" data-eid="<?php echo $equipo;?>" class="table table-hover" style="cursor:pointer">
                            <thead>
                            <tr>
                                <th style="padding-left:1em">Jugadores Inscritos</th>
                                <th style="padding-left:1em">Posición</th>
                                <th style="padding-left:1em">Número Camiseta</th>
                                <th style="padding-left:1em">Titular</th>
                            </tr>
                            </thead>
                            
                            <tbody></tbody>

                        </table>

                      </div>
                    </div>
                  
                  
                  
                  </div> <!--model body-->
                  
                  <div class="modal-footer" style="clear:both">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary guardar_alineacion">Guardar</button>
                  </div><!-- modal footer-->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->  
      <!-- /.Modal Alineacion -->
		<?php
		}
		?>
      
       <!-- Modal Incidencia -->
            <div class="modal fade" id="modal_incidencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
              <div class="modal-dialog" style="width:75em;margin:auto">
                <div class="modal-content" style="overflow:auto">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div> <!--modal header-->
                  <div class="modal-body">
                   
                       <div class="container_incidencia" id="boton_tarjeta" style="margin-left:8em">
                            <img src="../img/icons/tarjetas.png" style="height:65%;margin:1em 0em 0em 2.5em">
                            <h3 style="margin-left:2em">Tarjetas</h3>
                       </div>
                       
                       <div class="container_incidencia" id="boton_gol">

                            <img src="../img/icons/gol.png" style="height:60%;margin:1.5em 0em 0em 1em">
                            <h3 style="margin-left:2.5em">Goles</h3>
                       </div>
                       
                       <div class="container_incidencia" id="boton_cambio">
                            <img src="../img/icons/cambio.png" style="height:75%;margin:0.5em 0em 0em 1.5em">
                            <h3 style="margin-left:2em">Cambios</h3>
                       </div>
                   
                  </div> <!--model body-->
                  
                  <div class="modal-footer" style="clear:both">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div><!-- modal footer-->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->  
        <!-- ./Modal Incidencia-->
        
        
        <!-- Modal_Tarjeta-->
        
  <div class="modal fade" id="modal_tarjeta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Registrar Tarjeta</h4>
          </div>
          <div class="modal-body">
            
            <table class="table">
            	<tbody>
                	<tr>
                    	<td>Jugador (Alineación)</td >
                        <td>
                        	<select class="form-control">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                       </td>
                       <td>Minuto</td>
                       <td><input type="number" class="form-control" placeholder="minuto"></td>
                    </tr>
                    <tr>
                    	<td>Color</td>
                       	<td><select class="form-control">
                              <option>Amarilla</option>
                              <option>Roja</option>
                            </select>
                        </td>	
                    </tr>
                </tbody>
            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="incidencia_tarjeta" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        
        
        <!-- ./Modal_Tarjeta-->


	<!--              Modal_Cambio 				-->
    
    
      <div class="modal fade" id="modal_cambio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Registrar Cambio</h4>
          </div>
          <div class="modal-body">
            
            <table class="table">
            	<tbody>
                	<tr>
                    	<td>Jugador Saliente</td >
                        <td>
                        	<select class="form-control">
                              <option>Juana</option>
                              <option>Pepe Aguilar Sanchez</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                       </td>
						<td>Minuto</td>
                       <td><input type="number" class="form-control" placeholder="minuto"></td>
                    </tr>
                    <tr>
                    	<td>Jugador Entrante</td >
                        <td>
                        	<select class="form-control">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                       </td>
                    </tr>
                </tbody>
            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="incidencia_cambio" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        <!-- ./Modal_Cambio-->
        
        
        	<!--              Modal_Gol			-->
    
    
      <div class="modal fade" id="modal_gol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Registrar Gol</h4>
          </div>
          <div class="modal-body">
            
            <table class="table">
            	<tbody>
                	<tr>
                    	<td>Jugador</td >
                        <td>
                        	<select class="form-control">
                              <option>Juana</option>
                              <option>Pepe Aguilar Sanchez</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                       </td>
						<td>Minuto</td>
                       <td><input type="number" class="form-control" placeholder="minuto"></td>
                    </tr>
                    <tr>
                    	<td>Jugador Asistencia</td >
                        <td>
                        	<select class="form-control">
                              <option></option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                            </select>
                       </td>
                        <td>Jugador Sufre Penal</td >
                        <td>
                        	<select class="form-control">
                              <option></option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                            </select>
                       </td>
                    </tr>
                    <tr>
                    	<td>Tipo de Gol</td >
                        <td>
                        	<select class="form-control">
                              <option>Auto Gol</option>
                              <option>Tiro Libre</option>
                              <option>Penal</option>
                              <option>Juego</option>
                            </select>
                       </td>
                    	<td>Distancia</td>
                       <td><input type="number" class="form-control" placeholder="metros"></td>
                    
                    </tr>
                </tbody>
            </table>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="incidencia_gol" type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        <!-- ./Modal_Cambio-->
      
      

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/offcanvas.js"></script>
    <script src="../js/index.js"></script>
    <script>

$(document).ready(function() {

    $('#boton_tarjeta').click(function(){		
		$('#modal_incidencia').modal('hide');
		$('#modal_tarjeta').modal('show');
	});		
	
	
	$('#boton_cambio').click(function(){	
		$('#modal_incidencia').modal('hide');
		$('#modal_cambio').modal('show');
	});	
		
	
	$('#boton_gol').click(function(){	
		$('#modal_incidencia').modal('hide');
		$('#modal_gol').modal('show');
	});	
		
	$('#modal_tarjeta').on('hidden',function(){
		$(this).data('modal', null);
	});
	
	$('#modal_cambio').on('hidden',function(){
		$(this).data('modal', null);
	});

	$('#modal_gol').on('hidden',function(){
		$(this).data('modal', null);
	});
	
	$('#modal_incidencia').on('hidden',function(){
		 $(this).data('modal', null);
	});
  	$("#partidos_registrados tr td.equipo").click(function(){
		var partido_seleccionado = $(this).parent().attr("data-pid");
		var equipo_seleccionado = $(this).attr("data-eid");
		var ft = $(this).attr("data-ft");
		$('#formacion').removeAttr('disabled');
		$('#incidencia').removeAttr('disabled');
		$("#formacion").attr('data-pid',partido_seleccionado);
		$("#incidencia").attr('data-pid',partido_seleccionado);
		$("#formacion").attr('data-eid',equipo_seleccionado);
		$("#incidencia").attr('data-eid',equipo_seleccionado);
		$("#incidencia").attr('data-ft',ft);
		var equipo_opuesto_id = $(this).parent().children(".equipo").not($(this)).attr("data-eid");
		$("#incidencia").attr('data-eoid',equipo_opuesto_id);
	});
	
	$("#formacion").click(function(){
		if($(this).attr('data-pid')=="" || $(this).attr('data-eid')=="" ){
			alert('seleccione un partido');
		}else{
			var eid = $(this).attr('data-eid');
			var pid = $(this).attr('data-pid');
			$('.add_alineacion').attr("data-eid",eid);
			$('.remove_alineacion').attr("data-eid",eid);
			$('.guardar_alineacion').attr("data-eid",eid);
			$('.guardar_alineacion').attr("data-pid",pid);
			$('.modal_alineacion[data-eid='+eid+']').modal('show')
		}	
	});
	
	$("#incidencia").click(function(){
		if($(this).attr('data-pid')=="" || $(this).attr('data-eid')==""){
			alert('seleccione un partido');
		}else{
			if ($(this).attr("data-ft")=="0") {
				alert("Debe registrar una formación de al menos 15 jugadores para poder registrar una incidencia en este partido para este equipo.");
			}
			if ($(this).attr("data-ft")=="1") {
				$('#modal_incidencia').modal('show');
			}
		}	
	});
	$('.add_alineacion').click(function(){
		var eid = $(this).attr("data-eid");
		if (!$.isNumeric($('.tabla_alineacion_jugadores_inscritos[data-eid='+eid+']').children('tbody').children('tr.selected').children("td.camisa").children("input").val())) {
			alert("Número de camisa debe ser numérico Camisa debe");
		} else {
		   $('.tabla_alineacion_jugadores_inscritos[data-eid='+eid+']').children('tbody').children('tr.selected').appendTo('.tabla_alineacion[data-eid='+eid+']').children('tbody');
		   $('.tabla_alineacion tbody tr.selected').removeClass('selected');
		   $('.tabla_alineacion tbody tr td input').attr('disabled',"disabled");
		   $('#add_alineacion').attr('disabled',"disabled");
		   actualizar_seleccionables();
		}
	});
		
	$('.remove_alineacion').click(function(){
		var eid = $(this).attr("data-eid");
	   $('.tabla_alineacion[data-eid='+eid+']').children('tbody').children('tr.selected').appendTo('.tabla_alineacion_jugadores_inscritos[data-eid='+eid+']').children('tbody');
	   $('.tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	   $('.tabla_alineacion_jugadores_inscritos tbody tr td input').removeAttr('disabled');
	   $('.remove_alineacion').attr('disabled',"disabled");
	   actualizar_seleccionables();
	});
	function actualizar_seleccionables(){
	  $( '.tabla_jugadores_disponibles tbody tr.selecionable').click(function(){  
		  $('.tabla_jugadores_disponibles tbody tr.selected').removeClass('selected');
		  $('.tabla_inscripcion_jugadores_inscritos tbody tr.selected').removeClass('selected');
		  $(this).addClass('selected');
		  $('.add_inscripcion').removeAttr('disabled');
		  $('.remove_inscripcion').attr('disabled',"disabled");
			});
			
	  $( '#tabla_inscripcion_jugadores_inscritos tbody tr.selecionable').click(function(){
		  $('.tabla_jugadores_disponibles tbody tr.selected').removeClass('selected');  
		  $('.tabla_inscripcion_jugadores_inscritos tbody tr.selected').removeClass('selected');
		  $(this).addClass('selected');
		  $('.remove_inscripcion').removeAttr('disabled');
		   $('.add_inscripcion').attr('disabled',"disabled");
		});
			
			
	/***********/
	
		$( '.tabla_alineacion_jugadores_inscritos tbody tr.selecionable').click(function(){  
		  $('.tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
		  $('.tabla_alineacion tbody tr.selected').removeClass('selected');
		  $(this).addClass('selected');
		  $('.add_alineacion').removeAttr('disabled');
		  $('.remove_alineacion').attr('disabled',"disabled");
			});
			
	  $( '.tabla_alineacion tbody tr.selecionable').click(function(){  
		  $('.tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
		  $('.tabla_alineacion tbody tr.selected').removeClass('selected');
		  $(this).addClass('selected');
		  $('.remove_alineacion').removeAttr('disabled');
		   $('.add_alineacion').attr('disabled',"disabled");
		});	
			
	}
	actualizar_seleccionables();
	$('.guardar_alineacion').click(function(){
		var eid = $(this).attr("data-eid");
		var pid = $(this).attr("data-pid");
		var alineaciones = $( '.tabla_alineacion[data-eid='+eid+']').children('tbody').children('tr');
		if ($(alineaciones).size()>14 && $(alineaciones).size()<23) {
			var xml = "<ids>";
			$( alineaciones).each(function(){
				var jid = $(this).children("td:first").attr("data-jid");
				var camisa = $(this).children("td.camisa").children("input").val();
				var titular = $(this).children("td:last").children("input").is(":checked");
				if (titular) {
					titular = 1;
				} else {
					titular = 0;
				}
				xml += "<id><jugador>"+jid+"</jugador><titular>"+titular+"</titular><numero_camiseta>"+camisa+"</numero_camiseta></id>";
			});
			xml += "</ids>";
			$.ajax({
				method: "POST",
				url: "add_alineacion.php",
				data: {id_partido: pid,ids: xml},
				success: function(e) {
					if (e=="t") {
						alert("Formación agregada con éxito.");
						location.reload(true);
					} else {
						alert("Error al agregar la formación. Por favor intentelo de nuevo.");
					}
				}
			});
		} else {
			alert("Debe agregar al menos 15 jugadores y 22 como máximo");
		}	
	});
});
    </script>
  </body>
</html>
