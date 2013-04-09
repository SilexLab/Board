$(document).ready(function() {
	/* Style */
	$('#user_panel_toggle').on('click', function(e) {
		e.preventDefault();
		/* because css3 can't handle height auto / 100% with transition */
		var panel = $('#user_panel_content');
		if(panel.height())
			panel.css('height', 0);
		else
			panel.css('height', $('#user_panel_content_inner').outerHeight());
		/* end damn css3 workaround */
		$('#user_panel_content').closest('.user_panel').toggleClass('opened');
		$('#user_panel_toggle').toggleClass('active');
	});

	$('.input input').on('focus', function(e) {
		$(this).closest('.input').addClass('focus');
	}).on('blur', function(e) {
		$(this).closest('.input').removeClass('focus');
	});


	/* Functions */
	// Passwordswitch behavior
	$('.switch').on('mousedown', function(e) {
		$(this).prev('[type="password"]').attr('type', 'text');
	}).on('mouseup mouseleave', function(e) {
		$(this).prev('[type="text"]').attr('type', 'password').focus();
	});
	// Searchbar behavior
	$('#main_search').children('input[type="submit"]').on('mousedown', function(e) {
		var search = $(this).prev('input[type="search"]');
	 	if(search.val().length > 0 && parseInt(search.css('width')) > 200)
	 		search.addClass('focus');
	}).on('mouseup mouseleave', function(e) {
		$(this).prev('input[type="search"]').removeClass('focus');
	});
});
