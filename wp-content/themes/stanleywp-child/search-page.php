<?php
/**
 * Template Name: Search page
 */
?>
<?php get_header(); ?> 
<div class="container search">
  <div class="border">
    <div class="row">
      <div class="col-lg-12 nav-head">
        <?php require_once('includes/nav.php'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <h2>Search</h2>
      </div>
    </div>
    <?php
    if (!is_user_logged_in()) {
      $redirect = home_url() . '/wp-login.php?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
      $register =  home_url() . '/register?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );

      echo('<div class="row"><div class="col-lg-12">Are you looking for child care? If so, <a href="'.$register.'">Register here </a> <br> Already registered?  <a href="'.$redirect.'">Log in here</a> </div></div>');
    } else {?>
    <div class="row">
      <div class="col-lg-5">
        
      </div>
      <div class="col-lg-7">
          <form action="<?php echo site_url(); ?>/search-results" method="POST">
            <input type="hidden" id="current_lang" name="current_lang" value="<?php echo $current_lang; ?>">
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
                <?php
                $field_key = "field_577d22859ee8c";
                $field = get_field_object($field_key);

                if( $field )
                {
                  foreach( $field['choices'] as $k => $v )
                  {
                      echo '<option value="' . $k . '">' . $v . '</option>';
                  }  
                }
                ?>
              </select> 
            </div>
            <div class="one field">
              <label for="zip">ZIP Code: </label>
              <input type="text" id="zip" name="zip" label="ZIP Code" ></input>
            </div>
            <div class="one field">
              <label for="lang">Language Spoken: </label>
              <select id="lang" name="lang" label="Language Spoken" multiple="multiple">
                <option value="English">English</option>
                <option value="Spanish">Spanish</option>
              </select>
            </div>
            <div class="one field">
              <label for="cop">Current Openings: </label>
              <input id="copyes" type="checkbox" name="cop" value="yes" >YES</input> 
              <input style="margin-left:10px;" id="copno" type="checkbox" name="cop" value="no">NO</input>
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
<script src="<?php echo get_stylesheet_directory_uri(); ?>/includes/multiple-select.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/includes/ajax-search.js"></script>

<?php
}
?>

<?php get_footer(); ?>
