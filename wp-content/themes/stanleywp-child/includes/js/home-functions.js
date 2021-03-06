(function ($) {
  "use strict";
  // Height Calculator
  function content_height(){
    if($(window).width() > 600){
      var total = $(".caption").height() - 145;
      
      if($(window).width() < 992 & $(window).width() > 967 ){
          var content_height = ($(".home-second-col").height()); // + 224)-total;
      }else{
          var content_height = ($(".home-second-col .content").height() + 224)-total;
      }
      
    $(".home-first-col .img").height( content_height );
    }else{
      $(".home-first-col .img").height( 414 );
    } 
  }
  //Responsive Re-Order divs
  function reorder_divs(){
    if($(window).width() < 992){
      $(".home-first-col .caption").insertAfter(".home-second-col .content");
    }else{
      $(".home-second-col .caption").insertAfter(".home-first-col .img");  
    } 
  }  
  
  $(window).load(function() {
    reorder_divs();
    content_height();
     $('#google_translate_element').bind("DOMSubtreeModified",function(){
      content_height();
    }); 
  });
  $(document).ready(function() {
    reorder_divs();
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
    reorder_divs();
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