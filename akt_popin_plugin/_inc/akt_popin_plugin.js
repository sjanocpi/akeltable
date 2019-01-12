
jQuery(function( $ ) {
  $('.home #page').prepend('<div class="akt_overflow"><span>×</span></div>');
  $( ".akt_overflow span, .akt_overflow" ).click(function() {
    $( ".akt_overflow" ).fadeOut( 300, function() {
      $( ".akt_overflow" ).remove();
    });
  });
});
