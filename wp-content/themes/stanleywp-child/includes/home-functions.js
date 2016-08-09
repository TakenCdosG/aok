(function ($) {
  "use strict";

  function content_height(){
    if($(window).width() > 600){
      var content_height = $(".home-second-col .content").height()+224;
    $(".home-first-col .img").height( content_height );
    }else{
      $(".home-first-col .img").height( 414 );
    } 
  }

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
  /*Popup*/
  function deselect(e) {
    $('.pop-r').slideFadeToggle(function() {
      e.removeClass('selected');
        $('.overlay').css("display", "none");
    });    
  }

  $(function() {

    if($(".register_message").length){
      if($('.reg a').hasClass('selected')) {
        deselect($('.reg a'));               
      } else {
        $(this).addClass('selected');
        $('.pop-r').slideFadeToggle();
        $('.overlay').css("display", "block");
      }
      return false;
    }

    $('.reg a').on('click', function() {
    if($(this).hasClass('selected')) {
      deselect($(this));               
    } else {
      $(this).addClass('selected');
      $('.pop-r').slideFadeToggle();
      $('.overlay').css("display", "block");
    }
    return false;
    });

    $('.close-r').on('click', function() {
    deselect($('.reg a'));
    return false;
    });
  });

  $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
  };

  function deselectl(e) {
    $('.pop-l').slideFadeToggle(function() {
      e.removeClass('selected');
        $('.overlay').css("display", "none");
    });    
  }

  $(function() {

    $('#register-click').on('click', function() {
      $('.close-l').trigger("click");
      function explode(){
        
        $('.reg a').trigger("click");
      }
      setTimeout(explode, 320);
    });

    $('.log a').on('click', function() {
    if($(this).hasClass('selected')) {
      deselectl($(this));               
    } else {
      $(this).addClass('selected');
      $('.pop-l').slideFadeToggle();
      $('.overlay').css("display", "block");
    }
    return false;
    });

    $('.close-l').on('click', function() {
    deselectl($('.log a'));
    return false;
    });
    });

    $.fn.slideFadeToggle = function(easing, callback) {
    return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
  };

})(jQuery); 