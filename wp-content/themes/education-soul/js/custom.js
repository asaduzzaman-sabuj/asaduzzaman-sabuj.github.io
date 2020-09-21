( function( $ ) {

  $(document).ready(function($){

    // Carousel.
    $('.education-soul-carousel').slick();

    // Search in Header.
    if( $('.search-icon').length > 0 ) {
      $('.search-icon').click(function(e){
        e.preventDefault();
        $(this).parent().toggleClass( 'toggled-on' );
        $('.search-icon').hide();
        $('.search-box-wrap').show();
        $('.search-close-icon').show();
        $('.search-icon').next().focus();
      });
      $('.search-close-icon').click(function(e){
        e.preventDefault();
        $(this).parent().toggleClass( 'toggled-on' );
        $('.search-box-wrap').hide();
        $('.search-close-icon').hide();
        $('.search-icon').show();
        $('.search-close-icon').prev().focus();
      });
    }

    // News ticker.
    var $news_ticker = $('#news-ticker');
    if ( $news_ticker.length > 0 ) {
      $news_ticker.easyTicker({
        direction: 'up',
        easing: 'swing',
        speed: 'slow',
        interval: 3000,
        height: 'auto',
        visible: 1,
        mousePause: 1,
        controls: {
          up: '.btn-up',
          down: '.btn-down'
        }
      });
    }

    // Implement go to top.
    if ( 1 === parseInt( educationSoulCustomOptions.go_to_top_status, 10 ) ) {
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
    } // End if go to top.

  });

} )( jQuery );
