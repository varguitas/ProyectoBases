  $(document).ready(function() {
    
	var $id_partido = null;
	
	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$(".toggle_button").click(function(){
	
		$( ".toggled_container" ).toggle( "blind");		
	});
	
	$("#partidos_registrados tr").click(function(){
		var partido_seleccionado = $(this).attr("data-pid");
		$('#formacion').attr('disabled',null);
		$('#incidencia').attr('disabled',null);
		$("#formacion").attr('data-pid',partido_seleccionado);
		$("#incidencia").attr('data-pid',partido_seleccionado);
		});
	
	$("#formacion").click(function(){
		if($(this).attr('data-pid')==""){
			alert('seleccione un partido');
			}else{$('#myModal').modal('show')}
		
		});
	

	
	$("#tab_partidos_jugados").on('shown.bs.tab',function(){
		
		$('#formacion').attr('disabled',"disabled");
		$('#incidencia').attr('disabled',"disabled");
		});	
		
	$("#tab_partidos_registrados").on('shown.bs.tab',function(){
		
		$('#formacion').attr('disabled',"disabled");
		$('#incidencia').attr('disabled',"disabled");
		});		
	      
	$( "#sortable1, #sortable2" ).sortable({
          connectWith: ".connectedSortable"
    }).disableSelection();

	
	$("#admin_configuraciones").click(function(e) {
		var tid = $("#sidebar").children(".list-group").children("a.active").attr("data-tid");
        window.location.href = "/ProyectoBases/admin/data_insertion/configuraciones.php?tid="+tid;
    });
	
	$("#control_informacion").click(function(e) {
		var tid = $("#sidebar").children(".list-group").children("a.active").attr("data-tid");
        window.location.href = "/ProyectoBases/admin/data_insertion/control_informacion.php?tid="+tid;
    });
$('#add_alineacion').click(function(){
	   $('#tabla_alineacion_jugadores_inscritos tbody tr.selected').appendTo('#tabla_alineacion tbody');
	   $('#tabla_alineacion tbody tr.selected').removeClass('selected');
	   $('#tabla_alineacion tbody tr td input').attr('disabled',"disabled");
	   $('#add_alineacion').attr('disabled',"disabled");
	   actualizar_seleccionables();
		});
		
	$('#remove_alineacion').click(function(){
	   $('#tabla_alineacion tbody tr.selected').appendTo('#tabla_alineacion_jugadores_inscritos tbody');
	   $('#tabla_alineacion_jugadores_inscritos tbody tr.selected').removeClass('selected');
	   $('#tabla_alineacion_jugadores_inscritos tbody tr td input').removeAttr('disabled');
	   $('#remove_alineacion').attr('disabled',"disabled");
	   actualizar_seleccionables();
		});		
		
/***************************/
	
	$("#formacion").click(function(){
		if($(this).attr('data-pid')==""){
			alert('seleccione un partido');
			}else{$('#Modal_Alineacion').modal('show')}	
		});
	
	$("#incidencia").click(function(){
		if($(this).attr('data-pid')==""){
			alert('seleccione un partido');
			}else{$('#modal_incidencia').modal('show')}	
		});
	$('#boton_tarjeta').click(function(){		
		$('#modal_incidencia').modal('hide');
		$('#modal_tarjeta').modal('show');
		});		
	
	
	$('#boton_cambio').click(function(){	
		$('#modal_incidencia').modal('hide');
		$('#modal_cambio').modal('show');
		});	
		
	
	$('#boton_gol').click(function(){	
		$('#modal_incidencia').modal('hide');
		$('#modal_gol').modal('show');
		});	
		
	$('#modal_tarjeta').on('hidden',function(){
		$(this).data('modal', null);
		});
	
	$('#modal_cambio').on('hidden',function(){
		$(this).data('modal', null);
		});

	$('#modal_gol').on('hidden',function(){
		$(this).data('modal', null);
		});
	
	$('#modal_incidencia').on('hidden',function(){
		 $(this).data('modal', null);
		});
});
 
  