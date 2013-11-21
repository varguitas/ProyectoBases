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
                	if (isset($_COOKIE["add_equipo"])) {
						if ( $_COOKIE["add_equipo"] == "t") {
							echo "<div class='add_ok'>Equipo agregado correctamente</div>";
						} else {
							echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
						}
						unset($_COOKIE['add_equipo']);
					}
				?>
          <!-- /Jumbotron -->
          <div class="jumbotron">
            <button type="button" class="btn btn-primary btn-lg toggle_button">Agregar Equipo</button>
            <div class="toggled_container">
                <form class="form-horizontal" role="form" action="add_equipo.php" method="POST">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input name="nombre" type="text" style="margin-top:0.5em" class="form-control" placeholder="Nombre">
                    </div>
                  </div>
                <div class="form-group">
                     <label class="col-sm-2 control-label" style="margin-left:0.8em">Ubicación</label>
                     <div class="col-sm-8" style="margin-top:0.5em">
                     <select name="ubicacion" class="form-control">
                     <?php
					 	include("../system/conectInfo.php");
						$sql = "EXEC get_ubicaciones";
						$params = array();
						$stmt = sqlsrv_query( $conn, $sql, $params);
						while ($ubicacion = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
							echo "<option value='".$ubicacion["ID_UBICACION"]."'>".$ubicacion["NOMBRE"]."</option>";
						}
					 ?>
                      <!--- OPTION ADDED BY DATA BASE -->
                    </select>	
                    </div>
                </div>	
                <div class="form-group">
                    <label class="col-sm-3.5 control-label" style="margin-left:1.7em">Fecha de Fundación</label>
                     <input name="fecha_fund"  type="text" id="datepicker" placeholder="yyyy-mm-dd"/>	
                </div>
                
                <div class="form-group">
                <label class="col-sm-2 control-label">Historia</label>
                <textarea name="historia" class="form-control" rows="3"></textarea>
              	</div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Añadir</button>
                    </div>
                  </div>          
                 </form> 
             </div>    <!--cierra agregar_equipo-->    
          </div> <!-- /Jumbotron -->
          
          <div class="row" style="padding:2em">
            
			<?php
				$sql = "EXEC get_equipos";
				$stmt = sqlsrv_query( $conn, $sql);
				if (sqlsrv_has_rows($stmt)) {
					$equipo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
					$equipo_li = "<li data-eid=".$equipo["ID_EQUIPO"]." class='list-group-item active equipo_li'>".$equipo["NOMBRE"]."</li>";
					$contenido = "<div class='equipo_contenido active' data-eid=".$equipo["ID_EQUIPO"]."><h1 style='display:inline-block'>".$equipo["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Historia</h3>
				<div class=".$equipo["HISTORIA"].">Descripcion</div>
				<h3>Ubicación</h3>
				<p>".$equipo["UBICACION"]."</p>
				<h3>Fecha Fundación</h3>
				<p>".$equipo["FECHA_FUNDACION"]."</p>
				</div>";
					while ($equipo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
						$equipo_li = $equipo_li."<li data-eid=".$equipo["ID_EQUIPO"]." class='list-group-item equipo_li'>".$equipo["NOMBRE"]."</li>";
						$contenido = $contenido."<div class='equipo_contenido' data-eid=".$equipo["ID_EQUIPO"]."><h1 style='display:inline-block'>".$equipo["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Historia</h3>
				<div class=".$equipo["HISTORIA"].">Descripcion</div>
				<h3>Ubicación</h3>
				<p>".$equipo["UBICACION"]."</p>
				<h3>Fecha Fundación</h3>
				<p>".$equipo["FECHA_FUNDACION"]."</p>
				</div>";
					}
				} else {
					$equipo_li = "<li class='list-group-item'>No hay equipos inscritos</li>";
				}
				echo $contenido;
			?>
			
            
          
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
			<?php
		 		echo $equipo_li;
         	?>
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
		
		$(".toggle_button").click(function(){
			$( ".toggled_container" ).toggle( "blind");		
		});
		
		$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});	
	
		$("#sidebar").children(".list-group").children(".list-group-item").click(function(){
		$("#sidebar").children(".list-group").children(".list-group-item.active").removeClass("active");
		$(this).addClass("active");
			});
	
		$(".arbitro_li").click(function(){
		var eid = $(this).attr("data-eid");
		$(".arbitro_li.active").removeClass("active");
		$(".arbitro_li[data-eid="+eid+"]").addClass("active");
		$(".arbitro_contenido.active").removeClass("active");
		$(".arbitro_contenido[data-eid="+eid+"]").addClass("active");
			});
		
	});
	</script>
  </body>
</html>
