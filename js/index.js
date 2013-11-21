$(document).ready(function(e) {
	/* FUNCIONALIDADES GENERALES */
	$("#back-button").click(function(e) {
        window.history.back();
    });
	// TRIGGER ACTUALIZAR URL
	window.onpopstate = function(event) {
		cargarContenido();
	};
	function cargarContenido() {
		$(".contenido-principal").hide("slide", { direction: "left" }, 500).promise().done(function(){
			var $_GET = {};
			document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
					function decode(s) {
							return decodeURIComponent(s.split("+").join(" "));
					}
					$_GET[decode(arguments[1])] = decode(arguments[2]);
			});
			if (typeof($_GET["page_ref"]) !== 'undefined') {
				if ($.isNumeric($_GET["page_ref"])) {
					var page_ref = parseInt($_GET["page_ref"]);
					// TORNEO
					if (page_ref == 1){
						if (!typeof($_GET["tid"]) !== 'undefined' && $.isNumeric($_GET["tid"])) {
							var $tid = parseInt($_GET["tid"]);
							/* CARGAR TORNEO */
							$(".contenido-principal").load("html/torneo.php?tid="+$tid,function(){
								/* FUNCIONALIDADES TORNEO.PHP */
								$("#torneo_to_programacion").click(function(e) {
									var torneo_id = $(this).parent().attr("data-tid");
									window.history.pushState("", "Programación Torneo", "?page_ref=2&tid="+torneo_id+"");
									cargarContenido();
								});
								$("#torneo_to_posiciones").click(function(e) {
									var torneo_id = $(this).parent().attr("data-tid");
									window.history.pushState("", "Tabla de Posiciones", "?page_ref=4&tid="+torneo_id+"");
									cargarContenido();
								});
								$("#torneo_to_goleadores").click(function(e) {
									var torneo_id = $(this).parent().attr("data-tid");
									window.history.pushState("", "Tabla de Goleadores", "?page_ref=5&tid="+torneo_id+"");
									cargarContenido();
								});
								/* CIERRA FUNCIONALIDADES TORNEO.PHP */
							}).promise().done(function(){
								$(".contenido-principal").show("slide", { direction: "right" }, 500);
							});
						} else {
							$(".contenido-principal").load("html/error.php");
						}
					}
					// PROGRAMACION PARTIDO
					else if (page_ref == 2) {
						if (!typeof($_GET["tid"]) !== 'undefined' && $.isNumeric($_GET["tid"])) {
							var $tid = $_GET["tid"];
							$(".contenido-principal").load("html/programacion.php?tid="+$tid+"",function(){
								/* FUNCIONALIDADES DE PROGRAMACION PARTIDO */
								$(".programacion_partido.partido_completado").click(function(){
									var partido_id = $(this).attr("data-pid");
									window.history.pushState("", "Partido", "?page_ref=3&pid="+partido_id+"");
									cargarContenido();
								});
								$(".barra_opcion").click(function(e) {
									$(".barra_opcion.active").removeClass("active");
									$(this).addClass("active");
									var opcion_mostrar = $(this).attr("data-section");
                                    $(".contenedor_partido_opciones").hide("slide", { direction: "right" }, 500).promise().done(function(){
										$("#"+opcion_mostrar+"").show("slide", { direction: "right" }, 500);
									});
                                });
								/* CIERRA FUNCIONALIDADES DE PROGRAMACION PARTIDO */
							}).promise().done(function(){
								$(".contenido-principal").show("slide", { direction: "right" }, 500);
							});
						} else {
							$(".contenido-principal").load("html/error.php");
						}
					}
					// PARTIDO
					else if (page_ref == 3) {
						if (!typeof($_GET["pid"]) !== 'undefined' && $.isNumeric($_GET["pid"])) {
							var $pid = $_GET["pid"];
							$(".contenido-principal").load("html/partido.php?pid="+$pid+"",function(){
								/* FUNCIONALIDADES DE PARTIDO */
								
								/* CIERRA FUNCIONALIDADES DE PARTIDO */
							}).promise().done(function(){
								$(".contenido-principal").show("slide", { direction: "right" }, 500);
							});
						} else {
							$(".contenido-principal").load("html/error.php");
						}
					}
					// TABLA POSICIONES
					else if (page_ref == 4){
						if (!typeof($_GET["tid"]) !== 'undefined' && $.isNumeric($_GET["tid"])) {
							var $tid = parseInt($_GET["tid"]);
							/* CARGAR TORNEO */
							$(".contenido-principal").load("html/posiciones.php?tid="+$tid,function(){

							}).promise().done(function(){
								$(".contenido-principal").show("slide", { direction: "right" }, 500);
							});
						} else {
							$(".contenido-principal").load("html/error.php");
						}
					}
					// TABLA GOLEADORES
					else if (page_ref == 5){
						if (!typeof($_GET["tid"]) !== 'undefined' && $.isNumeric($_GET["tid"])) {
							var $tid = parseInt($_GET["tid"]);
							/* CARGAR TORNEO */
							$(".contenido-principal").load("html/goleadores.php?tid="+$tid,function(){

							}).promise().done(function(){
								$(".contenido-principal").show("slide", { direction: "right" }, 500);
							});
						} else {
							$(".contenido-principal").load("html/error.php");
						}
					}
				}
			} else {
				/* CARGAR CONTENIDO-PRINCIPAL */
				$(".contenido-principal").load("html/home.php",function(){
					/* FUNCIONALIDADES HOME */
					$(".main_container_torneo").click(function(e) {
						var torneo_id = $(this).attr("data-tid");
						window.history.pushState("", "Torneo", "?page_ref=1&tid="+torneo_id);
						cargarContenido();
					});
					/* CIERRA FUNCIONALIDADES HOME */
				}).promise().done(function(){
					$(".contenido-principal").show("slide", { direction: "right" }, 500);
				});;
			}
		});
	}
    $("#menu-left").click(function(e) {
		var ancho = $("#menu-left-content").width();
		if (ancho ==0) {
			$(this).css("background-position","right center");
			$(this).css("width","95%");
			$("#menu-left-content").css("width","100%");
		} else {
			$(this).css("width","8%").promise().done(function(){
				$(this).css("background-position","left center");
			});
			$("#menu-left-content").css("width","0");
		}
    });
	$("#menu-left-free").click(function(e) {
        $("#menu-left").trigger("click");
    });
	/* SE CREA PRIMER VALOR EN HISTORIAL */
	cargarContenido();
});