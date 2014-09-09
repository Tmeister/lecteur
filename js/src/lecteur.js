( function( $ ) {

	$self = this;
	$singleHeader = $('.single .entry-header');
	$singleContent = $('.single .entry-content-holder');
	$container = $('.home .entries');
	$window = $(window);
	$self.isAnimating = false;
	$self.wait;
	$self.isHeaderShowing = true;
	currentMobileItem = false;
    currentMobileSubItem = false;

	$container.imagesLoaded( function() {
		$container.isotope({
			layoutMode: 'fitRows',
			gutter:0
		});
		adjustHeight();
		if( !jQuery.browser.mobile ){
			checkScrollPosition();
		}
		$('.loader').remove();
		$('.site-main .entries').removeClass('hidden');
		$('.site-main .entry').removeClass('hidden');
	});

	$window.resize(function(event) {
		adjustHeight();
	});

	if ($singleHeader.length && !jQuery.browser.mobile ) {
		$('.single').on('mousewheel', function(event, delta) {
			if( delta < 0 && !$self.isAnimating && $window.scrollTop() > 1  && $window.scrollTop() < $singleHeader.height()){
				hideHeader();
			}
			if( delta > 0 && !$self.isAnimating && $window.scrollTop() < $singleHeader.height()){
				showHeader();
			}
		});

	};

	$('.menu-indicator').on('click', function(event) {
		event.preventDefault();
		if( $('body').hasClass('menu-visible') ){
			$('body').removeClass('menu-visible');
		}else{
			$('body').addClass('menu-visible');
		}
		$self.wait = setInterval(function(){
			$container.isotope();
			clearInterval( $self.wait );
		}, 500)
	});


	$('.main-navigation ul ul').slideUp();

	$('.main-navigation > div > ul > li:has(ul)' ).on('click', function(event) {

        var item = $( this );
        if( item[ 0 ] != currentMobileItem[ 0 ] )
        {
            event.preventDefault();
            if( currentMobileItem ){
                currentMobileItem.find('>ul').slideUp('slow')
            }
            currentMobileItem = item;
            $(this).find('>ul').slideDown('slow');
        }
    });

    /*
    * Level Two Submenu
    */
    $('.main-navigation > div > ul ul > li:has(ul)' ).on('click', function(event) {
        var item = $( this );
        if( item[ 0 ] != currentMobileSubItem[ 0 ] )
        {
            event.preventDefault();
            if( currentMobileSubItem ){
                currentMobileSubItem.find('>ul').slideUp('slow')
            }
            currentMobileSubItem = item;
            $(this).find('>ul').slideDown('slow');
        }
    });

	hideHeader = function(){
		$self.isAnimating = true;
		$self.isHeaderShowing  = false
		$singleHeader.addClass('hidden');
		$singleContent.removeClass('hidden');
		$('.post-navigation').removeClass('hidden');

		$('html,body').animate({
				scrollTop: $singleHeader.height()
			},
			750, function() {
				$self.isAnimating = false;
		});
	}

	showHeader = function(){
		$self.isAnimating = true;
		$self.isHeaderShowing  = true
		$singleHeader.removeClass('hidden');
		$singleContent.addClass('hidden');
		$('.post-navigation').addClass('hidden');
		$('html,body').animate({
				scrollTop: 0
			},
			750, function() {
				$self.isAnimating = false;
		});
	}

	adjustHeight = function(){
		if( $singleHeader.length ){
			$singleHeader.css('height', $window.height());
		}
	}

	checkScrollPosition = function(){
		if( $window.scrollTop() >= $singleHeader.height() ){
			$singleHeader.addClass('hidden');
			$singleContent.removeClass('hidden');
			$('.post-navigation').removeClass('hidden');
			$self.isHeaderShowing  = false
		}
		if( $window.scrollTop() < $singleHeader.height() ){
			$singleHeader.removeClass('hidden');
			$singleContent.addClass('hidden');
			$self.isHeaderShowing  = true
		}
	}

} )( jQuery );