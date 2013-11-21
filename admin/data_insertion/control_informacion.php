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
    


    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    

    
    
  </head>

  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Proyecto</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Configurar Datos</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

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
                        <th>Partido</th>
                        <th>Fecha</th>
                    </tr>
  					 <?php
						include("../system/conectInfo.php");
						$sql = "EXEC get_programacion_torneo_completado @ID_TORNEO = ?";
						$params = array($tid);
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($partido = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							echo "<tr data-pid='".$partido["ID_PARTIDO"]."'><td>".$partido["EQUIPO_CASA"]." vs ".$partido["EQUIPO_VISITA"]."</td><td>".$partido["FECHA"]."</td></tr>";
						}
					 ?>
				</table>
              
              </div>
              <div class="tab-pane fade in" id="profile">
              
              
              	 <table id="partidos_registrados" class="table table-hover" style="cursor:pointer">
  					<tr>
                        <th>Partido</th>
                        <th>Fecha</th>
                    </tr>
  					 <?php
						include("../system/conectInfo.php");
						$sql = "EXEC get_programacion_torneo_futuro @ID_TORNEO = ?";
						$params = array($tid);
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($partido = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							echo "<tr data-pid='".$partido["ID_PARTIDO"]."'><td>".$partido["EQUIPO_CASA"]." vs ".$partido["EQUIPO_VISITA"]."</td><td>".$partido["FECHA"]."</td></tr>";
						}
					 ?>
				</table>
            
              </div>
             
            </div>
			
            <button type="button" data-ipd="" class="btn btn-success" disabled="disabled" id="formacion_casa" style="float:right;margin-top:0.5em">Formación Casa</button>
            <button type="button" data-ipd="" class="btn btn-primary" disabled="disabled" id="incidencia_casa"   style="float:right;margin-top:0.5em;margin-right:0.5em">Incidencia Casa</button>
            <button type="button" data-ipd="" class="btn btn-success" disabled="disabled" id="formacion_visita" style="float:right;margin-top:0.5em">Formación Visita</button>
            <button type="button" data-ipd="" class="btn btn-primary" disabled="disabled" id="incidencia_visita"   style="float:right;margin-top:0.5em;margin-right:0.5em">Incidencia Visita</button>
            
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
      
      
        <!-- Modal Alineacion -->
            <div class="modal fade" id="Modal_Alineacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
              <div class="modal-dialog" style="width:75em;margin:auto">
                <div class="modal-content" style="overflow:auto;height:35em">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Alineación</h4>
                  </div> <!--modal header-->
                  <div class="modal-body">

						
				 	<div id="div_alineacion_jugadores_inscritos">                  
                      <h3 style="padding-left:1em">Jugadores Inscritos</h3>
                      <div>
                      	<table id="tabla_alineacion_jugadores_inscritos" class="table table-hover" style="cursor:pointer">
                            <thead>
                            <tr>
                                <th style="padding-left:1em">Jugadores Inscritos</th>
                                <th style="padding-left:1em">Posición</th>
                                <th style="padding-left:1em">Número Camiseta</th>
                                <th style="padding-left:1em">Titular</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="selecionable">
                                <td>Lionel Messi</td>
                               	<td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                             <tr class="selecionable">
                                <td>Eddie Gómez</td>
                                <td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                             <tr class="selecionable">
                                <td>Juan José Gómez</td>
                                <td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                             <tr class="selecionable">
                                <td>Juanita Ramírez</td>
                                <td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                              <tr class="selecionable">
                                <td>Pepe Aguilar</td>
                                <td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                             <tr class="selecionable">
                                <td>El Tiburoncín</td>
                                <td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                             <tr class="selecionable">
                                <td>EL Juanchis</td >
                                <td>Default</td>
                                <td>
                                	<input type="number" class="form-control" placeholder="Numero camiseta">
                                </td>
                                <td>
                                	<input type="checkbox" value="">
                                </td>
                            </tr>
                            </tbody>
                            
                        </table>
                      </div>
                  	</div>
                  
                  	<div class="div_buttons_config">
                  	<button id="add_alineacion" data-ijd="" class="btn btn-default" disabled="disabled" type="button">>></button>
                    <button id="remove_alineacion" data-ijd="" class="btn btn-default" disabled="disabled" type="button" ><<</button>
                  	</div>
                    <div id="div_alineacion">
                      <h3 style="padding-left:1em">Alineación</h3>
                      <div>
                      
                      
                          <table id="tabla_alineacion" class="table table-hover" style="cursor:pointer">
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div><!-- modal footer-->
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->  
      <!-- /.Modal Alineacion -->
		
      
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
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
            <button type="button" class="btn btn-primary">Save changes</button>
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
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
            <button type="button" class="btn btn-primary">Save changes</button>
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
            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
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
            <button type="button" class="btn btn-primary">Save changes</button>
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
  </body>
</html>
