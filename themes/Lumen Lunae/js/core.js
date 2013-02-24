$(document).ready(function() {
	// Prepare user panel
	$('#user_panel_content').slideUp(0);
	$('#user_panel_content').css('height', '100%');

	// Click action
	$('#user_panel_toggle').click(function(e) {
		$('#user_panel_content').slideToggle(500);
	});
});