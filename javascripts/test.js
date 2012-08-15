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
				}, { duration: Duration, queue: true })
				.animate({'left': '-' + Distance}, 0);
			} else { // Einblenden
				$(Element).stop().animate({
					'left': '0px',
					'opacity': '1'
				}, { duration: Duration });
			}
			State[Element] ^= 1;
			break;
		default:
			if(State[Element]) { // Ausblenden
				$(Element).stop().animate({
					'margin-left': Distance,
					'opacity': '0'
				}, { duration: Duration, queue: true })
				.animate({'margin-left': '-' + Distance}, 0);
			} else { // Einblenden
				$(Element).stop().animate({
					'margin-left': '0px',
					'opacity': '1'
				}, { duration: Duration });
			}
			State[Element] ^= 1;
			break;
	}
}

$(document).ready(function() {
	//$('#content').css({'margin-left': '-10px', 'opacity': '0'});
	$('#content').css({'left': '-10px', 'opacity': '0', 'position': 'relative'})

	$('#animate').click(function() { hFade('#content', null, null, 'position'); });
});