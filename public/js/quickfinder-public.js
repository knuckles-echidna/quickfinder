(function( $ ) {
	'use strict';
	$(document).ready(function(){


	});
	function tabEnabler(tab){
		$('a.quickfinder-block').on('click', function(e){
			e.preventDefault();
			let activeSection = $(this).attr('href');
			$.each($('.quickfinder-section'), function(){
				$(this).removeClass('active');
			});
			$(activeSection).addClass('active');
		});
	}
})( jQuery );