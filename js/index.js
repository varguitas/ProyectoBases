// JavaScript Document
$(document).ready(function(e) {
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
});