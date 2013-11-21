<?php
	if (!isset($_GET["tid"])) {
		include("../html/error.php");
		die();
	}
	// SE VERIFICA SI ES ADMIN
	include("../system/verifica_admin.php");
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
	<?php
        if (isset($_COOKIE["iniciar_torneo"])) {
            if ( $_COOKIE["iniciar_torneo"] == "t") {
                echo "<div class='add_ok'>Torneo iniciado correctamente</div>";
            } else {
                echo "<div class='add_error'>Ha ocurrido un error al procesar su consulta. Por favor verifique que sus datos son correctos e intentelo de nuevo.</div>";
            }
            unset($_COOKIE['iniciar_torneo']);
        }
    ?>
      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">          
          <div class="row">
            <?php
            	include("../system/conectInfo.php");
				$sql = "EXEC get_torneo_info ?";
				$params = array($tid);
				$stmt = sqlsrv_query($conn,$sql,$params);
				if ($stmt===false){
					die(print_r(sqlsrv_errors(),true));
				}
				$torneo = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
				if ($torneo["ESTADO_TORNEO"] == "F") {
					echo "<h1>El torneo seleccionado ya ha finalizado, por lo que no puede modificar los datos.</h1>";
				} else if ($torneo["ESTADO_TORNEO"] == "R") {
			?>
            
            <div class="col-12 col-sm-12 col-lg-12">
            	<a href="add_inscripcion_equipo_form.php?tid=<?php echo $tid; ?>"><div class="configuraciones_option btn-default">Inscribir equipos</div></a>
            </div>
            <div class="col-12 col-sm-12 col-lg-12">
            	<a href="iniciar_torneo.php?tid=<?php echo $tid; ?>"><div class="configuraciones_option btn-success">Iniciar Torneo</div></a>
            </div>
            <hr>
            <?php
				}
				if ($torneo["ESTADO_TORNEO"] == "E") {
			?>
            <div class="col-12 col-sm-12 col-lg-12">
            	<div class="configuraciones_option btn-default">Modificar programación</div>
            </div>
          		<?php } ?>
          </div><!--/row-->
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
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/offcanvas.js"></script>
    <script>
	$(document).ready(function(){
		$(".add_ok").delay(4000).fadeOut();
		$(".add_error").delay(6000).fadeOut();
	});
	</script>
  </body>
</html>
