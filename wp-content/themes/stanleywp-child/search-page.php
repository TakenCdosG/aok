<?php
/**
 * Template Name: Search page
 */
?>
<?php get_header(); ?>
<?php
if (!is_user_logged_in()) {

$redirect = home_url() . '/wp-login.php?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
echo 'You need to be <a href="'.$redirect.'">logged in</a> to access this page';


} else {?>
   
<div class="container search">
  <div class="border">
    <div class="row">
      <div class="col-lg-12">
        <?php require_once('includes/nav.php'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <h2>Search</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5">
        
      </div>
      <div class="col-lg-7">
          <form action="<?php echo site_url(); ?>/search-results" method="POST">
            <div class="half field">
              <label for="fname">First Name: </label>
              <input id="fname" type="text" name="fname" label="First Name" ></input>
            </div>
             <div class="half field" style="margin-left:3%;">
              <label for="lname">Last Name: </label>
              <input id="lname" type="text" name="lname" label="Last Name" ></input>
            </div>
            <div class="clearfix"></div>
            <div class="full field">
              <label for="ccname">Child Care Name: </label>
              <input id="ccname" type="text" name="ccname" label="Child Care Name" ></input>
            </div>
            <div class="clearfix"></div>
            <div class="one field">
              <label for="age">Ages Served: </label>
              <select id="age" name="age" label="Age" >
                <option value="">- Select Age Group -</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="11">11</option>
              </select> 
            </div>
            <div class="half field">
              <label for="qsp">QSP Level: </label>
              <select id="qsp" name="qsp" label="QSP Level" >
                <option value="">- Select Level -</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="half field" style="margin-left:3%;">
              <label for="lang">Language Spoken: </label>
              <select id="lang" name="lang" label="Language Spoken" >
                <option value="">- Select Language -</option>
                <option value="English">English</option>
                <option value="Spanish">Spanish</option>
              </select>
            </div>
            <div class="one field">
              <label for="cop">Current Openings: </label>
              <input id="copyes" type="checkbox" name="cop" value="yes" >YES</input> 
              <input id="copno" type="checkbox" name="cop" value="no">NO</input>
            </div>
            <div class="one field">
              <label for="">Check the following that apply: </label>
              <input id="opeve" type="checkbox" value="1">Open on evenings/overnight </input>
              <input style="margin-left:10px;" id="opweek" type="checkbox" value="2">Open on weekends </input>
              <br>
              <input id="cfork" type="checkbox" value="3">Accept Care4Kids </input>
              <input style="margin-left:10px;" id="cam" type="checkbox" value="4">Certified to Administer Medication </input>
              <p></p>
              <input id="submit" class="ajax" type="submit" value="Search">
            </div>
          </form>
      </div>
    </div>

    <div class="count-results"></div>
    <div id="results">
        
    </div>
  </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {

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
    var qsp = $("#qsp").val();
    var lang = $("#lang").val();

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
    
     

   /* $('input[type=checkbox]').each(function () {
           if (this.checked) {
              window[ $(this).attr("id")] = $("#"+$(this).attr("id")).val();

           }
    });
    alert(cfork);*/

    $.ajax({
      type: 'POST',
      url: '<?php echo site_url() ?>/search-results',
      data: {'fname' : fname, 'lname' : lname, 'ccname' : ccname, 'age' : age, 'qsp' : qsp, 'lang' : lang, 'cop' : cop, 'opeve' : opeve, 'opweek' : opweek, 'cfork' : cfork, 'cam' : cam },
      dataType: 'html',
      success: function(data) {
        $('#results').html(data);
        if($('.count_results').text() == ""){var count_results = 0}else{count_results = $('.count_results').text()}
        $('.count-results').html(count_results+" Results found");
        //alert("mostrar");
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
      url: '<?php echo site_url() ?>/search-results',
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


}); 
</script>
<?php
}
?>

<?php get_footer(); ?>
