$(document).ready(function() {
// Login Form
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
	
	// Inputs
		var LoginFocus1 = false;
		var LoginFocus2 = false;
		$(".Wrap input[type=text]").focusin(function() {
			$(this).stop().animate({'border-color': '#1d3139'}, 500);
			LoginFocus1 = true;
		}).focusout(function() {
			$(this).stop().animate({'border-color': '#ffffff'}, 500);
			LoginFocus1 = false;
		}).hover(function() {
			if(!LoginFocus1) $(this).stop().animate({'border-color': '#558fa4'}, 500);
		}, function() {
			if(!LoginFocus1) $(this).stop().animate({'border-color': '#ffffff'}, 500);
		});
		$(".Wrap input[type=password]").focusin(function() {
			$(this).stop().animate({'border-color': '#1d3139'}, 500);
			LoginFocus2 = true;
		}).focusout(function() {
			$(this).stop().animate({'border-color': '#ffffff'}, 500);
			LoginFocus2 = false;
		}).hover(function() {
			if(!LoginFocus2) $(this).stop().animate({'border-color': '#558fa4'}, 500);
		}, function() {
			if(!LoginFocus2) $(this).stop().animate({'border-color': '#ffffff'}, 500);
		});
	// Submit
		$(".Wrap input[type=submit]").hover(function() {
			$(this).stop().animate({'border-color': '#558fa4'}, 300);
		}, function() {
			$(this).stop().animate({'border-color': '#ffffff'}, 300);
		}).mousedown(function(){
			$(this).stop().animate({'border-color': '#1d3139'}, 300);
		});

// Search Form
	var SearchFocus = false;
	$("#Search").focusin(function() {
		$("#SearchForm").stop().animate({'border-color': '#ffffff', 'background-color': 'rgba(0,0,0,0.2)'}, 500)
			.css({'box-shadow': 'inset 0 2px 3px rgba(0,0,0,0.3), 0 0 6px #000000'});
		SearchFocus = true;
	}).focusout(function() {
		$("#SearchForm").stop().animate({'border-color': '#ffffff', 'background-color': 'rgba(0,0,0,0)', 'opacity': '0.5'}, 500)
			.css({'box-shadow': 'inset 0 2px 3px rgba(0,0,0,0.3)'});
		SearchFocus = false;
	}); $("#SearchForm").hover(function() {
		if(!SearchFocus)
			$(this).stop().animate({'border-color': '#97d8f0', 'opacity': '1'}, 500);
	}, function() {
		if(!SearchFocus)
			$(this).stop().animate({'border-color': '#ffffff', 'opacity': '0.5'}, 500);
	});
});