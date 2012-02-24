$(document).ready(function() {
	// Login Form
	{
		var Toogle = 0;
		
		$("#LoginForm").css("display", "block");
		$("#LoginForm").slideToggle(0);
		
		$("#LoginBarToogle").click(function() {
			
			if(Toogle == 0) {
				$("#LoginForm").slideToggle("slow", function(){
					$(this).fadeTo(500, 1);
				});
			} else {
				$("#LoginForm").fadeTo(200, 0, null, function(){
					$(this).slideToggle("slow");
				});
			}
			
			Toogle ^= 1;
		});
		
		var Focus = 0;
		$(".Wrap input[type=text], .Wrap input[type=password]").focusin(function(e) {
			$(this).stop().animate({boxShadow: '0 0 10px #59caf7'}, 200);
			Focus = 1;
		});
		$(".Wrap input[type=text], .Wrap input[type=password]").focusout(function(e) {
			$(this).stop().animate({boxShadow: 'none'});
			Focus = 0;
		});
		$(".Wrap input[type=text], .Wrap input[type=password]").hover(function(e) {
			if(!Focus) {
				$(this).stop().animate({boxShadow: '0 0 6px #59caf7'}, 200);
			}
		}, function(e) {
			if(!Focus) {
				$(this).stop().animate({boxShadow: 'none'}, 500);
			}
		});
	}
	
	// Search Form
	{
		var Focus = 0;
		$("#Search").focusin(function() {
			$("#SearchForm").stop().animate({'border-color': '#ffffff'}, 500)
				.css({'box-shadow': '0 3px 3px rgba(0,0,0,0.3) inset, 0 0 6px #000000'});
			Focus = 1;
		});
		
		$("#Search").focusout(function() {
			$("#SearchForm").stop().animate({'border-color': '#97d8f0'}, 500)
				.css({'box-shadow': '0 3px 3px rgba(0,0,0,0.3) inset'});
			Focus = 0;
		});
		
		$('#Search').hover(function() {
			if(!Focus)
				$("#SearchForm").css({'box-shadow': '0 3px 3px rgba(0,0,0,0.3) inset, 0 0 3px #d7ffff'});
		}, function() {
			if(!Focus)
				$("#SearchForm").css({'box-shadow': '0 3px 3px rgba(0,0,0,0.3) inset'});
		});
	}
});