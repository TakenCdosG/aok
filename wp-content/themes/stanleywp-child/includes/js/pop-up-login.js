(function ($) {
  "use strict";

  /*Popup*/
  $(function() {

    function explodeLogin(){
      if( $('.log a').hasClass('')){
          $('.log a').trigger("click");
      }      
    }
      if($(".log-reg").length){

        setTimeout(explodeLogin, 320);
      }

  });

  function deselectl(e) {
    $('.pop-l').slideFadeToggle(function() {
      e.removeClass('selected');
      $('.overlay').css("display", "none");
    });
  }

  $(function() {


    $('.log a').on('click', function() {
      if($(this).hasClass('selected')) {
        deselectl($(this));
      } else {
        $(this).addClass('selected');
        $('.pop-l').slideFadeToggle();
        $('.overlay').css("display", "block");
        $('#user_login').attr( 'placeholder', 'Insert your username' );
        $('#user_pass').attr( 'placeholder', 'Insert your Password' );
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