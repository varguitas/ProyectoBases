<?php
	include("../system/conectInfo.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

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
          
			<?php
                if (isset($_COOKIE["add_arbitro"])) {
                    if ( $_COOKIE["add_arbitro"] == "t") {
                        echo "<div class='add_ok'>Árbitro agregado correctamente</div>";
                    } else {
                        echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
                    }
                    unset($_COOKIE['add_arbitro']);
                }
            ?>
          
          <!-- /Jumbotron -->
          <div class="jumbotron">
            <button type="button" class="btn btn-primary btn-lg toggle_button">Agregar Arbitro</button>
            <div class="toggled_container">
                <form class="form-horizontal" role="form" action="add_arbitro.php" method="POST">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" style="margin-top:0.5em" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10">
                      <input type="text" style="margin-top:0.5em" class="form-control" name="apellido" placeholder="Apellidos">
                    </div> 
                  </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Fecha de Nacimiento</label>
                     <input type="text" id="datepicker" name="fecha_n" placeholder="yyyy-mm-dd"/>	
                </div>
                <div class="form-group">
                     <label class="col-sm-1 control-label">Tipo</label>
                     <div class="col-sm-10" style="margin-top:0.5em">
                     <select class="form-control" name="tipo">
                      <option value="L">Línea</option>
                      <option value="P">Principal</option>
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
          
          
            <?php
            $sql = "EXEC get_arbitros";
			$params = array();
            $stmt = sqlsrv_query( $conn, $sql,$params);
			if ($stmt === false ) {
				
			}
			if (sqlsrv_has_rows($stmt)) {
				$arbitro = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				$arbitro_li = "<li data-aid=".$arbitro["ID_ARBITRO"]." class='list-group-item active arbitro_li'>".$arbitro["NOMBRE"]."</li>";
				$contenido = "<div class='arbitro_contenido active' data-aid=".$arbitro["ID_ARBITRO"]."><h1 style='display:inline-block'>".$arbitro["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
            <h3>Fecha de Nacimiento</h3>
            <p>".$arbitro["FECHA_NACIMIENTO"]."</p>
			<h3>Tipo</h3>
            <p>".$arbitro["TIPO_ARBITRO"]."</p></div>";
				while ($arbitro = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
					$arbitro_li = $arbitro_li."<li data-aid=".$arbitro["ID_ARBITRO"]." class='list-group-item arbitro_li'>".$arbitro["NOMBRE"]."</li>";
					$contenido = $contenido."<div class='arbitro_contenido' data-aid=".$arbitro["ID_ARBITRO"]."><h1 style='display:inline-block'>".$arbitro["NOMBRE"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Fecha de Nacimiento</h3>
				<p>".$arbitro["FECHA_NACIMIENTO"]."</p>
				<h3>Tipo</h3>
				<p>".$arbitro["TIPO_ARBITRO"]."</p></div>";
				}
			} else {
				$arbitro_li ="<li class='list-group-item'>No hay arbitros inscritos</li>";
			}
			echo $contenido;
			?>
            
            
          
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
			<?php
		 		echo $arbitro_li;
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
	});
	
	$("#sidebar").children(".list-group").children(".list-group-item").click(function(){
	$("#sidebar").children(".list-group").children(".list-group-item.active").removeClass("active");
	$(this).addClass("active");
		});
	</script>
  </body>
</html>
