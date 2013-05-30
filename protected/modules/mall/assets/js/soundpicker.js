// fillSoundSelection
function soundPickInit(){
	$.getJSON(
		"/mall/sound/all",
		function(data){
			console.log("soundpacks:",data);
			ajaxChat.soundFiles = null;
			ajaxChat.soundFiles = new Object();
			$.each(data, function(name,files) {
				$.each(files,function(pname,file) {
					ajaxChat.soundFiles[file]= "/"+name+"/"+file+".mp3";				
				});
				console.log("sounds: ",ajaxChat.sounds);
				$("#soundPick").append(
					$("<option/>")
						.val(name)
						.html(name)
				);
			});
		}
	);
}
jQuery(function(){
	$("#soundPick").append( $("<option/>").val("x").html("Soundpack...") );
	$("#soundPick").change(function(){
		var pname = $("#soundPick").val();
		$.ajax({
			url:"/mail/sound/pack",
			dataType:"JSON",
			type:"GET",
			data:{pname:pname},
			success:function(data){
				console.log("soundpack: ",data);
				ajaxChat.setSetting('soundSend', data.send);
				ajaxChat.setSetting('soundRecive', data.recive);
				ajaxChat.setSetting('soundEnter', data.enter);
				ajaxChat.setSetting('soundLeave', data.leave);
				ajaxChat.setSetting('soundChatBot', data.chatbot);
				ajaxChat.setSetting('soundError', data.error);
			
				$.ajax({
					url:"/mall/sound/save",
					type:"GET",
					data: {pname:pname},
					success:function(d){console.log("Sound Pack saved",d);}
				});	
			}
		});
	});
	$.get(
		"/mall/sound/load",
		function(d){ $("#soundPick").val(d); }
	);
});