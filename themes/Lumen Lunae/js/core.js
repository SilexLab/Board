





$(document).ready(function() {
	// Prepare user panel
	$('#user_panel_content').slideUp(0);
	$('#user_panel_content').css('height', '100%');

	// Click action
	$('#user_panel_toggle').click(function(e) {
		$('#user_panel_content').slideToggle(500);
	});
});


















/* Old Stuff */

/*
var State = new Object();

function hFade(Element, Duration, Distance, Force, Method) {
	if(!Duration) Duration = 300;
	if(!Distance) Distance = '10px';

	switch(Method) {
		case 'position':
			if((Force === 0 && Force !== 1) || (Force !== 1 && State[Element])) { // Ausblenden
				$(Element).stop().animate({
					'left': Distance,
					'opacity': '0'
				}, { duration: Duration, queue: true });
			} else { // Einblenden
				$(Element).css({'left': '-' + Distance});
				$(Element).stop().animate({
					'left': '0px',
					'opacity': '1'
				}, { duration: Duration });
			}
			break;
		default:
			if((Force === 0 && Force !== 1) || (Force !== 1 && State[Element])) { // Ausblenden
				$(Element).stop().animate({
					'margin-left': Distance,
					'opacity': '0'
				}, { duration: Duration, queue: true });
			} else { // Einblenden
				$(Element).css({'margin-left': '-' + Distance});
				$(Element).stop().animate({
					'margin-left': '0px',
					'opacity': '1'
				}, { duration: Duration });
			}
			break;
	}
	State[Element] ^= 1;
}

function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

$(document).ready(function() {
	// Login Form
	 // Initialize
	var FormHeight = $('#login_form').css('height');
	$('#login_form').css({'display': 'none', 'height': '0px'});

	$('#login_bar_toggle').click(function(e) {
		e.preventDefault();
		if(State['login_bar']) {
			// close
			hFade('#login_form', null, '12px', 0);
			$('#login_form').animate({'height': '0px', 'box-shadow': '0 0 0px #000000'},
				{ duration: 400, complete: function() { $('#login_form').css({'display': 'none'}); },
				easing: 'easeOutBounce', queue: false });
			$('.user_bar').animate({'box-shadow': '0 0 0px #000000'});
		} else {
			// open
			$('#login_form').css({'display': 'block'});
			$('#login_form').animate({'height': FormHeight},
				{ duration: 250, complete: function() {
					hFade('#login_form', null, '12px', 1);
					$('#login_form').css({'height': '100%'});
				}, easing: 'easeOutBack', queue: false });
			$('.user_bar').animate({'box-shadow': '0 0 100px #000000'});
		}
		State['login_bar'] ^= 1;
	});

	// animation (test)
	if($('.folded_text').length > 0) {
		setInterval(function() {
			var pos = ($('.folded_text').css('background-position')).split(' ');
			$('.folded_text').css('background-position', (parseInt(pos[0]) - 1) + 'px ' + pos[1]);
		}, 80);
	}

	if($('header').length > 0 && getUrlVar('asdf')) {
		$('header').css('background-position', '0 0');
		setInterval(function() {
			var pos = ($('header').css('background-position')).split(' ');
			$('header').css('background-position', (parseInt(pos[0]) - 1) + 'px ' + pos[1]);
		}, 50);
	}
});
*/
