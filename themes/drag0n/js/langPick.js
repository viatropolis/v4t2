jQuery(function(){
	$.ajax({
		url:'/language/get',
		dataType:"JSON",
		type:"GET",
		success:function(data){
			$.each(data,function(i,v){
				console.log("i:"+i+" v:"+v);
				$("#langPick").append(
					$("<option/>")
						.val(i)
						.html(v)
				);
			});
		}
	});
	
	$.get(
		'/language/default',
		function(d){ $('#langPick').val(d); }
	);
	
	$("#langPick").change(function(){
		$.ajax({
			url:'/language/set',
			data:{lc:$("#langPick").val()},
			type:"GET",
			success:function(d){ location.reload(); }
		});
	});
});