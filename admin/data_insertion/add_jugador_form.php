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
                	if (isset($_COOKIE["add_jugador"])) {
						if ( $_COOKIE["add_jugador"] == "t") {
							echo "<div class='add_ok'>Jugador agregado correctamente</div>";
						} else {
							echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
						}
						unset($_COOKIE['add_jugador']);
					}
				?>
          <!-- /Jumbotron -->
          <div class="jumbotron">
            <button type="button" class="btn btn-primary btn-lg toggle_button">Agregar Jugador</button>
            <div class="toggled_container">
                <form class="form-horizontal" role="form" action="add_jugador.php" method="POST">
                  <div class="form-group">
                    <label class="col-sm-2 control-label" style="margin-left:-0.6em">Nombre</label>
                    <div class="col-sm-10">
                      <input name="nombre" type="text" style="margin-top:0.5em" class="form-control" placeholder="Nombre">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10">
                      <input name="apellidos" type="text" style="margin-top:0.5em" class="form-control"  placeholder="Apellidos">
                    </div> 
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" style="margin-left:-0.6em">Fecha de Nacimiento</label>
                     <input name="fecha_n" type="text" id="datepicker" placeholder="yyyy-mm-dd"/>	
                </div>
                <div class="form-group">
                     <label class="col-sm-1 control-label" style="margin-right:0.5em">Posición</label>
                     <div class="col-sm-5" style="margin-top:0.5em;margin-left:1em">
                     <select name="posicion" class="form-control" >
                     <?php
						include("../system/conectInfo.php");
						$sql = "EXEC get_posiciones";
						$params = array();
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($posicion = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							echo "<option value='".$posicion["ID_POSICION"]."'>".$posicion["DESCRIPCION"]."</option>";
						}
					 ?>
                    </select>	
                    </div>
                </div>
                <div class="form-group">
                     <label class="col-sm-1 control-label" style="margin-right:0.5em">País</label>
                     <div class="col-sm-5" style="margin-top:0.5em;margin-left:1em">
                     <select name="pais" class="form-control" >
                     <?php
						$sql = "EXEC get_paises";
						$params = array();
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($ubicacion = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							echo "<option value='".$ubicacion["ID_PAIS"]."'>".$ubicacion["NOMBRE"]."</option>";
						}
					 ?>
                    </select>	
                    </div>
                </div>		            
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Añadir</button>
                    </div>
                  </div>          
                 </form> 
             </div>    <!--cierra agregar_arbitro-->    
          </div> <!-- /Jumbotron -->
          
          <div class="row" style="padding:2em">
            
            <h1 style="display:inline-block">Nombre del Jugador</h1>
            <button type="button" class="btn btn-danger" style="margin-left:1em;margin-bottom:1em">Eliminar</button>
            <button type="button" class="btn btn-success" style="margin-bottom:1em">Editar</button>
                     
            <h3>Edad</h3>
            <p>00 años</p>
            <h3>Fecha de nacimiento</h3>
            <p>yyyy/mm/dd</p>
            <h3>Posición</h3>
            <p>Default</p>
            <h3>País</h3>
            <p>Default</p>
            
			
            
          
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

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.container-->

    <?php 
	include ("../html/script.php");
	?>
    <script>
	$(document).ready(function(){
		$(".add_ok").delay(4000).fadeOut();
		$(".add_error").delay(6000).fadeOut();
	});
	</script>
  </body>
</html>
