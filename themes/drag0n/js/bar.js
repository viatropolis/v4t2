// Bar-control

var bar = {
	clear:function(){
		$(".home").hide();
		$(".DIuser").hide();
		$(".characters").hide();
		$('.manage').hide();
		$('.essay').hide();
	},
	home:function(){
		this.clear();
		$(".home").show();
	},
	chars:function(){
		this.clear();
		$(".characters").show();
	},
	essay:function(){
		this.clear();
		$(".essay").show();
	},
	user:function(){
		this.clear();
		$(".DIuser").show();
	},
	shoutbox:function(){
		$("#shoutbox").load('/mall/shoutbox',"",function(){ // d,rp,xhr
			//$('#shoutbox').html(d);
			//ajaxChat.initialize();
		});
		$('#shoutbox').show();
	},
	shoutboxClose:function(){
		$('#shoutbox').hide();		
	},
	manage:function(){
		this.clear();
		$('.manage').show();
	}
}
	