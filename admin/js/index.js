  $(document).ready(function() {
    
	var $id_partido = null;
	
	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$(".toggle_button").click(function(){
	
		$( ".toggled_container" ).toggle( "blind");		
	});
	
	$("#partidos_registrados tr td.equipo").click(function(){
		var partido_seleccionado = $(this).parent().attr("data-pid");
		$('#formacion').removeAttr('disabled');
		$('#incidencia').removeAttr('disabled');
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
});
 
  