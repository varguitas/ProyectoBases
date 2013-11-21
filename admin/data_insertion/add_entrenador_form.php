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
                	if (isset($_COOKIE["add_entrenador"])) {
						if ( $_COOKIE["add_entrenador"] == "t") {
							echo "<div class='add_ok'>Entrenador agregado correctamente</div>";
						} else {
							echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
						}
						unset($_COOKIE['add_entrenador']);
					}
				?>
          <!-- /Jumbotron -->
          <div class="jumbotron">
            <button type="button" class="btn btn-primary btn-lg toggle_button">Agregar Entrenador</button>
            <div class="toggled_container">
                <form class="form-horizontal" role="form" action="add_entrenador.php" method="POST">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" style="margin-top:0.3em;margin-left:0.5em" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" style="margin-left:0.5em">Apellidos</label>
                    <div class="col-sm-9">
                      <input type="text" style="margin-top:0.5em" class="form-control" name="apellidos" placeholder="Apellidos">
                    </div> 
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Fecha de Nacimiento</label>
                     <input type="text" id="datepicker" name="fecha_n" placeholder="yyyy-mm-dd"/>	
                </div>
                <div class="form-group">
                     <label class="col-sm-2 control-label" style="margin-left:-2em">País</label>
                     <div class="col-sm-8" style="margin-top:0.5em;margin-left:2.5em">
                     <select class="form-control" name="id_pais">
                     <?php
					 	include("../system/conectInfo.php");
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
             </div>    <!--cierra agregar_entrenador-->    
          </div> <!-- /Jumbotron -->
          
          <div class="row" style="padding:2em">
            
           	<?php
				$sql = "EXEC get_entrenadores";
				$stmt = sqlsrv_query( $conn, $sql);
				if (sqlsrv_has_rows($stmt)) {
					$entrenador = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
					$entrenador_li = "<li data-entid=".$entrenador["ID_ENTRENADOR"]." class='list-group-item active entrenador_li'>".$entrenador["NOMBRE"]."</li>";
					$contenido = "<div class='entrenador_contenido active' data-entid=".$entrenador["ID_ENTRENADOR"]."><h1 style='display:inline-block'>".$entrenador["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Fecha de Nacimiento</h3>
				<p>".$entrenador["FECHA_NACIMIENTO"]."</p>
				<h3>Pais</h3>
				<p>".$entrenador["PAIS"]."</p></div>";
					while ($entrenador = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
						$entrenador_li = $entrenador_li."<li data-entid=".$entrenador["ID_ENTRENADOR"]." class='list-group-item entrenador_li'>".$entrenador["NOMBRE"]."</li>";
						$contenido = $contenido."<div class='entrenador_contenido' data-entid=".$entrenador["ID_ENTRENADOR"]."><h1 style='display:inline-block'>".$entrenador["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Fecha de Nacimiento</h3>
				<p>".$entrenador["FECHA_NACIMIENTO"]."</p>
				<h3>Pais</h3>
				<p>".$entrenador["PAIS"]."</p></div>";
					}
				} else {
					$entrenador_li ="<li class='list-group-item'>No hay entrenadores inscritos</li>";
				}
				echo $contenido;
			?>
			
            
          
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
			<?php
		 		echo $entrenador_li;
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
	<?php 
	include ("../html/script.php");
	?>
    <script>
	$(document).ready(function(){
		$(".add_ok").delay(4000).fadeOut();
		$(".add_error").delay(6000).fadeOut();
		
		$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
		
		$(".toggle_button").click(function(){
			$( ".toggled_container" ).toggle( "blind");		
		});
		
		$("#sidebar").children(".list-group").children(".list-group-item").click(function(){
			$("#sidebar").children(".list-group").children(".list-group-item.active").removeClass("active");
			$(this).addClass("active");
		});
	
		$(".entrenador_li").click(function(){
			var entid = $(this).attr("data-entid");
			$(".entrenador_li.active").removeClass("active");
			$(".entrenador_li[data-entid="+entid+"]").addClass("active");
			$(".entrenador_contenido.active").removeClass("active");
			$(".entrenador_contenido[data-entid="+entid+"]").addClass("active");
		});
		
	});
	</script>
  </body>
</html>
