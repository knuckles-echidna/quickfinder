(function( $ ) {
	'use strict';
	$(document).ready(function(){
		$('a.quickfinder-block').on('click', function(e){
			e.preventDefault();
			let activeSection = $(this).attr('href');
			tabEnabler(activeSection)
		});
		$('#quickfinder-home').on('click', function(){
			tabEnabler($('#quickfinder-section-1'));
		});
	});
	function tabEnabler(tab){
		$.each($('.quickfinder-section'), function(){
			$(this).removeClass('active');
		});
		$(tab).addClass('active');

	}
})( jQuery );