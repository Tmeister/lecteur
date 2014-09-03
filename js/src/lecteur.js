( function( $ ) {

	$container = $('.home .entries');

	$container.imagesLoaded( function() {

		$container.isotope({
			layoutMode: 'fitRows',
			gutter:0
		});

		adjustHeight();

	});

	$(window).resize(function(event) {
		adjustHeight();
	});

	adjustHeight = function(){
		$singleHeader = $('.single-post .entry-header');
		if( $singleHeader.length ){
			$singleHeader.css('height', $(window).height());
		}
	}

} )( jQuery );