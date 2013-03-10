$(document).ready(function() {
	$('#user_panel_toggle').on('click', function(e) {
		e.preventDefault();
		/* because css3 can't handle height auto / 100% with transition */
		var panel = $('#user_panel_content');
		if(panel.height())
			panel.css('height', 0);
		else
			panel.css('height', $('#user_panel_content_inner').outerHeight());
		/* end damn css3 workaround */
		$('#user_panel_content').toggleClass('opened');
		$('#user_panel_toggle').toggleClass('active');
	});
});