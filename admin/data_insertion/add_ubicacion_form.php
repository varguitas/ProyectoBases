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
          
          <!-- /Jumbotron -->
          <div class="jumbotron">
			<?php
                if (isset($_COOKIE["add_ubicacion"])) {
                    if ( $_COOKIE["add_ubicacion"] == "t") {
                        echo "<div class='add_ok'>Ubicación agregada correctamente</div>";
                    } else {
                        echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
                    }
                    unset($_COOKIE['add_pais']);
                }
            ?>
            <button type="button" class="btn btn-primary btn-lg toggle_button">Agregar Ubicación</button>
            <div class="toggled_container">
                <form class="form-horizontal" role="form" action="add_ubicacion.php" method="POST">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input name="nombre" type="text" style="margin-top:0.5em" class="form-control" placeholder="Nombre">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Dirección</label>
                    <div class="col-sm-10">
                      <input name="direccion" type="text" style="margin-top:0.5em" class="form-control" placeholder="Dirección">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Contacto</label>
                    <div class="col-sm-10">
                      <input name="contacto" type="text" style="margin-top:0.5em" class="form-control" placeholder="Contacto">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10">
                      <input name="telefono" type="text" style="margin-top:0.5em" class="form-control" placeholder="Número de Teléfono">
                    </div>
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
            
            <h1 style="display:inline-block">Nombre de la Ubicación</h1>
            <button type="button" class="btn btn-danger">Eliminar</button>
            <button type="button" class="btn btn-success">Editar</button>
            
           
           	 <h3>Dirección</h3>
            <p>Dirección</p>
            <h3>Contacto</h3>
            <p>Default</p>
            <h3>Número de Teléfono</h3>
            <p>00-00-0000</p>
            
			
            
          
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



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
 	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/offcanvas.js"></script>
    <script src="../js/index.js"></script>
    <script>
	$(document).ready(function(){
		$(".add_ok").delay(4000).fadeOut();
		$(".add_error").delay(6000).fadeOut();
	});
	</script>
  </body>
</html>
