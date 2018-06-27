$( 'body' ).prepend( '<div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div> sdasdsdsdsd   <div class="loader-section section-right"></div></div>' );
$(window).on('load', function() { // makes sure the whole site is loaded
  $('#loader-wrapper').delay(350).fadeOut('slow'); // will first fade out the loading animation
  $('#loader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
  $('body').delay(350).css({'overflow':'visible'});
})
