  $(document).ready(function() {
    
	var $id_partido = null;
	
	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd'});
	
	$(".toggle_button").click(function(){
	
		$( ".toggled_container" ).toggle( "blind");		
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
	
		
/***************************/

});
 
  