function col_same_hight(){
    var max = 0;
    jQuery(".profile.p_col").each(function(){
        jQuery(this).height("");
    });
    jQuery(".profile.p_col").each(function(){
        //console.log(jQuery(this).height());
        if(jQuery(this).height() > max)
            max = jQuery(this).height();
    });




        jQuery(".profile.p_col").height(max);


}


(function ($) {
  "use strict";
  $(document).ready(function() {


      col_same_hight();

      // Configure/customize these variables.
      var showChar = 380; // How many characters are shown by default
      var ellipsestext = "...";
      var moretext = "Read more";
      var lesstext = "Read less";
      

      $('.about-me p').each(function() {
          var content = $(this).html();
   
          if(content.length > showChar) {
   
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);
   
              var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
   
              $(this).html(html);             
          }
          
      });
   
      $(".morelink").click(function(){
          if($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext);
          }
          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
      });
    
  });

    jQuery( window ).resize(function() {
        col_same_hight();
    });

})(jQuery);

