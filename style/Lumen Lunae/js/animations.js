/*$(document).ready(function() {
// Login Form
	var Toggle = 0;
	
	$("#login_form").css("display", "block");
	$("#login_form").slideToggle(0);
	
	$("#login_bar_toggle").click(function() {
		if(Toggle == 0) {
			$('#login_form').stop().slideToggle({ duration: 400, queue: false});
				$(".user_bar").css({"box-shadow": "0 0 100px #000000"});
				$('#login_form').fadeTo(1000, 1);
				$("#username").focus();
		} else {
			$("#login_form").fadeTo(200, 0, null, function(){
				$(this).slideToggle("slow");
			});
		}
		Toggle ^= 1;
	});
	
	// Inputs
		var LoginFocus1 = false;
		var LoginFocus2 = false;
		$(".wrap input[type=text]").focusin(function() {
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
		$(".wrap input[type=password]").focusin(function() {
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
		$(".wrap input[type=submit]").hover(function() {
			$(this).stop().animate({'border-color': '#558fa4'}, 300);
		}, function() {
			$(this).stop().animate({'border-color': '#ffffff'}, 300);
		}).mousedown(function(){
			$(this).stop().animate({'border-color': '#1d3139'}, 300);
		});

// Search Form
	var SearchFocus = false;
	$("#Search").focusin(function() { // Focus in
		$("#SearchForm").stop().animate({'border-color': '#ffffff', 'background-color': 'rgba(0, 0, 0, 0.2)'}, 500);
		SearchFocus = true;
	}).focusout(function() { // Focus out
		$("#SearchForm").stop().animate({'border-color': 'rgba(255, 255, 255, 0.005)', 'background-color': 'rgba(0, 0, 0, 0.1)'}, 500);
		SearchFocus = false;
	}); $("#SearchForm").hover(function() { // Hover
		if(!SearchFocus)
			$(this).stop().animate({'border-color': '#97d8f0'}, 500);
	}, function() { // Default
		if(!SearchFocus)
			$(this).stop().animate({'border-color': 'rgba(255, 255, 255, 0.005)', 'background-color': 'rgba(0, 0, 0, 0.1)'}, 500);
	});
});*/