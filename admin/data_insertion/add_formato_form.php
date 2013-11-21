<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/icons/favicon.png">

    <title>Off Canvas Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/offcanvas.css" rel="stylesheet">
    
    <!-- Custom style -->
    <link href="../css/style.css" rel="stylesheet">

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
          <div class="row">
            
            <div class="col-12 col-sm-12 col-lg-12">
            <p class="pull-right visible-xs">
            	<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          	</p>
            	<?php
                	if (isset($_COOKIE["add_formato"])) {
						if ( $_COOKIE["add_formato"] == "t") {
							echo "<div class='add_ok'>Formato agregado correctamente</div>";
						} else {
							echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
						}
						unset($_COOKIE['add_formato']);
					}
				?>
            	<form action="add_formato.php" method="POST">
                	<input type="text" class="col-sm-6" name="descripcion" placeholder="Descripcion del Formato">
                    <br>
                    <br>
                    <input class="btn btn-primary btn-lg" type="submit" value="Ingresar Formato">
                </form>
            </div>
          
          </div><!--/row-->
        </div><!--/span-->
        
                  <div class="row" style="padding:2em">
          
          
            <?php
            $sql = "EXEC get_formatos";
			$params = array();
            $stmt = sqlsrv_query( $conn, $sql,$params);
			if ($stmt === false ) {
				
			}
			if (sqlsrv_has_rows($stmt)) {
				$formato = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				$formato_li = "<li data-fid=".$formato["ID_FORMATO"]." class='list-group-item active formato_li'>".$formato["ID_FORMATO"]."</li>";
				$contenido = "<div class='formato_contenido active' data-fid=".$formato["ID_FORMATO"]."><h1 style='display:inline-block'>".$formato["ID_FORMATO"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
            <h3>Descripcion</h3>
            <p>".$formato["DESCRIPCION"]."</p>";
				while ($formato = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
					$formato_li = $formato_li."<li data-fid=".$formato["ID_FORMATO"]." class='list-group-item formato_li'>".$formato["ID_FORMATO"]."</li>";
					$contenido = $contenido."<div class='formato_contenido' data-fid=".$formato["ID_FORMATO"]."><h1 style='display:inline-block'>".$formato["ID_FORMATO"]."</h1><button type='button' class='btn btn-danger pull-right'>Eliminar</button>
				<h3>Descripcion</h3>
				<p>".$formato["DESCRIPCION"]."</p>";
				}
			} else {
				$formato_li ="<li class='list-group-item'>No hay formatos inscritos</li>";
			}
			echo $contenido;
			?>
            
            
          
          </div><!--/row-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
			<?php
		 		echo $formato_li;
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
			
		$("#sidebar").children(".list-group").children(".list-group-item").click(function(){
			$("#sidebar").children(".list-group").children(".list-group-item.active").removeClass("active");
			$(this).addClass("active");
		});
		
		$(".formato_li").click(function(){
			var fid = $(this).attr("data-fid");
			$(".formato_li.active").removeClass("active");
			$(".formato_li[data-fid="+fid+"]").addClass("active");
			$(".formato_contenido.active").removeClass("active");
			$(".formato_contenido[data-fid="+fid+"]").addClass("active");
		});
	});
	</script>
  </body>
</html>
