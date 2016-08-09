(function ($) {
  /*Popup*/
  function deselect(e) {
    $('.pop-r').slideFadeToggle(function() {
      e.removeClass('selected');
        $('.overlay').css("display", "none");
    });    
  }

  $(function() {

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

    if($(".log-reg").length){
      function explodelr(){
        $('.log a').trigger("click");
      }
      setTimeout(explodelr, 320);
    }

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