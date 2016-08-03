jQuery(document).ready(function($) {

  window.current_lang = $("#current_lang").val();
  if(current_lang == "en"){
    var lang_string = " Results found";
  }else if(current_lang == "es") {
    var lang_string = " Resultados";
  };

  $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null){
         return null;
      }
      else{
         return results[1] || 0;
      }
  }

  window.zipcode = $.urlParam('zip');

  $("#zip").val(zipcode);

  window.baseUrl = document.location.origin;

  $('#copyes').on('change', function() {
      $('#copno').not(this).prop('checked', false);  
  }); 
  $('#copno').on('change', function() {
      $('#copyes').not(this).prop('checked', false);  
  }); 

  $('.ajax').click(function(event) {
    event.preventDefault();

    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var ccname = $("#ccname").val();
    var age = $("#age").val();
    var zip = $("#zip").val();
    var lang = $("#lang").val();
    var argstart = 2;

    if($("#copyes").prop('checked')){
      var cop = "yes"
    }else if($("#copno").prop('checked')){
      var cop = "no"
    }else{
      var cop = "";
    }
    if($("#opeve").prop('checked')){
      var opeve = "yes"
    }else{
      var opeve = "nox"
    }
    if($("#opweek").prop('checked')){
      var opweek = "yes"
    }else{
      var opweek = "nox"
    }
    if($("#cfork").prop('checked')){
      var cfork = "yes"
    }else{
      var cfork = "nox"
    }
    if($("#cam").prop('checked')){
      var cam = "yes"
    }else{
      var cam = "nox"
    }    

    $.ajax({
      type: 'POST',
      url: baseUrl+'/search-results',
      data: {'argstart' : argstart, 'fname' : fname, 'lname' : lname, 'ccname' : ccname, 'age' : age, 'zip' : zip, 'lang' : lang, 'cop' : cop, 'opeve' : opeve, 'opweek' : opweek, 'cfork' : cfork, 'cam' : cam },
      dataType: 'html',
      success: function(data) {
        $('#results').html(data);
        if($('.count_results').text() == ""){var count_results = 0}else{count_results = $('.count_results').text()}
        $('.count-results').html(count_results+lang_string);
      },
      error: function(data) {
        $('#results').html("error");
      }
    });     

    return false;
  });

    if(zipcode != null){
      $(".ajax").trigger( "click" );
    }

  function explode(){
   var argstart = 1;
   $.ajax({
      type: 'POST',
      url: baseUrl+'/search-results',
      data: {'argstart' : argstart },
      dataType: 'html',
      success: function(data) {
        $('#results').html(data);
        $('.count-results').html($('.count_results').text()+lang_string);
      },
      error: function(data) {
        $('#results').html("error");
      }
    });     
  }
  if(zipcode == null){
    setTimeout(explode, 50);
  }
  

  /*Multiple select*/
  $(function() {
      $('#lang').change(function() {
          console.log($(this).val());
      }).multipleSelect({
          width: '100%'
      });
  });

}); 