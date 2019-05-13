( function( $ ) {

  $(document).ready(function($){

  	// Carousel.
  	$('.magazine-power-carousel').slick();

  	// Tabbed.
  	$('.tabbed-container').easytabs({
  		updateHash: false,
  		animationSpeed: 'fast'
  	});

    // Search in Header.
    if( $('.search-icon').length > 0 ) {
        $('.search-icon').click(function(e){
            e.preventDefault();
            $('.search-box-wrap').slideToggle();
        });
    }

    // Trigger mobile menu.
    $('#mobile-trigger').sidr({
		timing: 'ease-in-out',
		speed: 500,
		source: '#mob-menu',
		renaming: false,
		name: 'sidr-main'
    });

    $('#sidr-main').find( '.sub-menu' ).before( '<span class="dropdown-toggle"><strong class="dropdown-icon"></strong>' );

    $('#sidr-main').find( '.dropdown-toggle').on('click',function(e){
    	e.preventDefault();
    	$(this).next('.sub-menu').slideToggle();
    	$(this).toggleClass( 'toggle-on' );
    });

    // Trigger top mobile menu.
    var $mobile_trigger2 = $('#mobile-trigger2');
    if ( $mobile_trigger2.length > 0 ) {
	    $mobile_trigger2.sidr({
			timing: 'ease-in-out',
			side: 'right',
			speed: 500,
			source: '#mob-menu2',
			renaming: false,
			name: 'sidr2'
	    });
    }

    $('#sidr2').find( '.sub-menu' ).before( '<span class="dropdown-toggle"><strong class="dropdown-icon"></strong>' );

    $('#sidr2').find( '.dropdown-toggle').on('click',function(e){
    	e.preventDefault();
    	$(this).next('.sub-menu').slideToggle();
    	$(this).toggleClass( 'toggle-on' );
    });

    // Notice ticker.
    var $news_ticker = $('#news-ticker');
    if ( $news_ticker.length > 0 ) {
    	$news_ticker.easyTicker({
    		direction: 'up',
    		easing: 'swing',
    		speed: 'slow',
    		interval: 3000,
    		height: 'auto',
    		visible: 1,
    		mousePause: 1
    	});
    }

    // Fixed header.
    $(window).scroll(function () {
    	if( $(window).scrollTop() > $('#main-nav,.site-header').offset().top && !($('#main-nav,.site-header').hasClass('fixed'))){
    		$('#main-nav,.site-header').addClass('fixed');
    	}

    	else if ( 0 === $(window).scrollTop() ){
    		$('#main-nav,.site-header').removeClass('fixed');
    	}
    });

    // Implement go to top.
    if ( 1 === parseInt( magazinePowerCustomOptions.go_to_top_status, 10 ) ) {
		var $scroll_obj = $( '#btn-scrollup' );
		$( window ).scroll(function(){
			if ( $( this ).scrollTop() > 100 ) {
				$scroll_obj.fadeIn();
			} else {
				$scroll_obj.fadeOut();
			}
		});

		$scroll_obj.click(function(){
			$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
			return false;
		});
    }

  });

} )( jQuery );
