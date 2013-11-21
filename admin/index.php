<?php
	include("system/conectInfo.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/icons/favicon.png">

    <title>Administrador de Torneos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
    
    <!-- Custom style -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  	<?php
    	include("html/header.php");
	?>

    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          
          <!-- /Jumbotron -->
          <div class="jumbotron">
          	<div style="display:inline-block">
            	<div style="float:left;background-color:green;height:4.5em;width:4.5em;margin:0.5em"></div>
            	<h1 style="float:right">Nombre de Equipo</h1>
            </div>
            
            <p style="display:inline-block">This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          
          </div>
          <!-- /Jumbotron -->
          
          <div class="row">
            
            <div class="col-6 col-sm-6 col-lg-4">
                   	<div class="admin_container_shade">
                        <img src="img/icons/programacion_admin_icon.png" style="margin:0.5em 20% 0em 20%">
                        <h3 style="margin:0em 20% 0.5em 20%">Programacion</h3>
                    </div>
            </div><!--/span-->
            
            <div class="col-6 col-sm-6 col-lg-4">         
            	<div class="admin_container_shade">
                	<img src="img/icons/tabla_posiciones_admin_icon.png" class="img_tabla_posiciones">
                    <h3 style="margin:0em 0em 0.5em 0.8em ">Tabla de Posiciones</h3>
                </div>
            </div><!--/span-->
            
            <div class="col-6 col-sm-6 col-lg-4">
            	<div class="admin_container_shade">
                	<img src="img/icons/goleadores_admin_icon.png" class="img_goleadores">
                    <h3 style="margin:0em 0em 0.5em 2.7em">Goleadores</h3>
                </div>
            </div><!--/span-->
            
            <div class="col-6 col-sm-6 col-lg-4">
				<div class="admin_container_shade">
                	<img src="img/icons/multimedia_admin_icon.png" class="img_calendario">
                    <h3 style="margin:0em 0em 0.5em 2.8em">Multimedia</h3>
                </div>
            </div><!--/span-->
            
            <div class="col-6 col-sm-6 col-lg-4">
				<div class="admin_container_shade">
                	<img src="img/icons/ingresar_datos.png" id="control_informacion" class="img_control_info">
                    <h3 style="margin:0.3em 0em 0.5em 0.2em">Control de Información</h3>
                </div>
            </div><!--/span-->
            
            <div class="col-6 col-sm-6 col-lg-4">
				<div class="admin_container_shade" id="admin_configuraciones">
                	<img src="img/icons/configuraciones_admin_icon.png" class="img_config">
                    <h3 style="margin:0.5em 0em 0.5em 1.8em">Configuraciones</h3>
                </div>
            </div><!--/span-->
          
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
			<?php
                $sql = "EXEC get_act_torneo";
                $params = array();
                $stmt = sqlsrv_query( $conn, $sql, $params);
                if( $stmt === false ) {
                    include("html/error.php");
                } else {
                    if (sqlsrv_has_rows($stmt)) {
						$torneo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
						echo "<a href='#' class='list-group-item active' data-tid=".$torneo["ID_TORNEO"].">".$torneo["NOMBRE"]."</a>";
                        while ($torneo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
                            echo "<a href='#' class='list-group-item' data-tid=".$torneo["ID_TORNEO"].">".$torneo["NOMBRE"]."</a>";
                        }
                    }
                    else {?>
						<a href="#" class="list-group-item active">No hay torneos</a>
                    <?php
                    }
                }
            ?>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/offcanvas.js"></script>
	  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
      <link rel="stylesheet" href="/resources/demos/style.css" />    
    <script>
	$(document).ready(function(e) {
		$("#admin_configuraciones").click(function(e) {
			var tid = $("#sidebar").children(".list-group").children("a.active").attr("data-tid");
			window.location.href = "/ProyectoBases/admin/data_insertion/configuraciones.php?tid="+tid;
		});
		
		$("#control_informacion").click(function(e) {
			var tid = $("#sidebar").children(".list-group").children("a.active").attr("data-tid");
			window.location.href = "/ProyectoBases/admin/data_insertion/control_informacion.php?tid="+tid;
		});
		$("#sidebar").children(".list-group").children(".list-group-item").click(function(){
			$("#sidebar").children(".list-group").children(".list-group-item.active").removeClass("active");
			$(this).addClass("active");
		});
	});
    </script>
  </body>
</html>
