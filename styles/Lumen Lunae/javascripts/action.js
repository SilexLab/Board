var State = new Object();

function hFade(Element, Duration, Distance, Method) {
	if(!Duration) Duration = 300;
	if(!Distance) Distance = '10px';

	switch(Method) {
		case 'position':
			if(State[Element]) { // Ausblenden
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
			if(State[Element]) { // Ausblenden
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

$(document).ready(function() {
	// Login Form
	 // Initialize
	$('#login_form').css({'display': 'block'});
	var FormHeight = $('#login_form').css('height');
	$('#login_form').css({'display': 'none', 'height': '0px'});

	$('#login_bar_toggle').click(function() {
		if(State['login_bar']) {
			hFade('#login_form', null, '20px');
			$('#login_form').animate({'height': '0px', 'box-shadow': '0 0 0px #000000'},
				{ duration: 400, complete: function() { $('#login_form').css({'display': 'none'}); },
				easing: 'easeOutBounce', queue: false });
			$('.user_bar').animate({'box-shadow': '0 0 0px #000000'});
		} else {
			$('#login_form').css({'display': 'block'});
			$('#login_form').animate({'height': FormHeight},
				{ duration: 400, complete: function() { hFade('#login_form', null, '20px'); },
				easing: 'easeOutBack', queue: false });
			$('.user_bar').animate({'box-shadow': '0 0 100px #000000'});
		}
		State['login_bar'] ^= 1;
	});
});