jQuery(document).ready(function($) {

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
        $('.count-results').html(count_results+" Results found");
      },
      error: function(data) {
        $('#results').html("error");
      }
    });     

    return false;
  });
}); 

jQuery(document).ready(function($) {
  function explode(){
    var argstart = 1;
   $.ajax({
      type: 'POST',
      url: baseUrl+'/search-results',
      data: {'argstart' : argstart },
      dataType: 'html',
      success: function(data) {
        $('#results').html(data);
        $('.count-results').html($('.count_results').text()+" Results found");
      },
      error: function(data) {
        $('#results').html("error");
      }
    });     
  }
  setTimeout(explode, 50);

  /*Multiple select*/
  $(function() {
      $('#lang').change(function() {
          console.log($(this).val());
      }).multipleSelect({
          width: '100%'
      });
  });

}); 