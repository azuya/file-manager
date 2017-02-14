(function($) {
	$(function() {

		$('.button-collapse').sideNav();
		$('.dropdown-button').dropdown({
			inDuration: 300,
			outDuration: 225,
			constrainWidth: false, // Does not change width of dropdown to that of the activator
			hover: false, // Activate on hover
			gutter: 0, // Spacing from edge
			belowOrigin: true, // Displays dropdown below the button
			alignment: 'left', // Displays dropdown with edge aligned to the left of button
			stopPropagation: false // Stops event propagation
		});
		$('#profile_dropdown_btn.dropdown-button').dropdown({
			inDuration: 300,
			outDuration: 225,
			constrain_width: false, // Does not change width of dropdown to that of the activator
			hover: true, // Activate on hover
			gutter: 0, // Spacing from edge
			belowOrigin: true, // Displays dropdown below the button
			alignment: 'right' // Displays dropdown with edge aligned to the left of button
		});
		$(window).resize(function() {
			if ($(window).width() < 991) {
				$('#slide-out').hide();
			} else {
				$('#slide-out').show();
			}
		});
		$('.modal').modal();
	}); // end of document ready
})(jQuery); // end of jQuery name space