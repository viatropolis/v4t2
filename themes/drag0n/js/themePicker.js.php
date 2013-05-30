<?php 
	header("Content-type: text/javascript");
	$for = $_GET['for'];
?>
jQuery(function($){
	$("#themePicker").change(function(){pickTheme( $('#themePicker').val() ); } );
	$("#logoutChannelContainer #themePicker").change(function(){pickTheme( $('#logoutChannelContainer #themePicker').val() ); } );
	$("#themePicker, #logoutChannelContainer #themePicker").append(
	   	$('<option/>').val("X").html("Select...")
    );
	
	$.getJSON("/themepicker/get", function(jsonData){ 
 	   $.each(jsonData, function(i,j){
			$("#themePicker, #logoutChannelContainer #themePicker").append(
    	    	$('<option/>').val(i).html(j)
    		);
		});
	});
	$.get("/themepicker/default",function(d){ $("#themePicker, #logoutChannelContainer #themePicker").val(d); });

});
function pickTheme(val){
	$.ajax({
		url: "/themepicker/set",
		type: "GET",
		data: {id:val,for:"<?=$for?>"},
		success: function(string) {
			console.log(string);
			extLoader(string,"css");
			//location.reload();
		}
	});
}