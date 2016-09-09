(function ($) {
  "use strict";

  function content_height(){
    if($(window).width() > 600){
      var total = $(".caption").height() - 145; 
      
      var content_height = ($(".home-second-col .content").height() + 224)-total;
    $(".home-first-col .img").height( content_height );
    }else{
      $(".home-first-col .img").height( 414 );
    } 
  }
  $(window).load(function() {
    content_height();
     $('#google_translate_element').bind("DOMSubtreeModified",function(){
      content_height();
    }); 
  });
  $(document).ready(function() {
    content_height();
    $( "form" ).submit(function( event ) {
      if ( $( ".zip" ).val().indexOf("e") <= 0 ) {
        return;
      }
      $( ".zip" ).val("");
      return;
      event.preventDefault();
    });
  });

  $(window).resize(function(){
    content_height();
  });

  $(function(){
      /* Hide form input values on focus*/ 
      $('.field.zip').each(function(){
          var txtval = $(this).val();
          $(this).focus(function(){
              if($(this).val() == txtval){
                  $(this).val('')
              }
          });
          $(this).blur(function(){
              if($(this).val() == ""){
                  $(this).val(txtval);
              }
          });
      });
  });
  
})(jQuery);