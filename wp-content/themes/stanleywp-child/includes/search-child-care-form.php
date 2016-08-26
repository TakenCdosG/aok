<?php
/**
 * @file
 * Default theme implementation to display the basic search directory structure page.
 *
 * Variables:
 * - $data_needed: An array of data needed for print on this template.
 */
?>

<section class="search-child-care-wrapper">
  <div class="container">
    <form id="search-child-care-form">
      <input type="hidden" id="current_lang" name="current_lang" value="<?php echo $current_lang; ?>">
      <div class="half field">
        <label for="f-name">First Name: </label>
        <input type="text" name="f-name" label="First Name" >
      </div>
      <div class="half field" style="margin-left:3%;">
        <label for="l-name">Last Name: </label>
        <input type="text" name="l-name" label="Last Name" >
      </div>
      <div class="clearfix"></div>
      <div class="full field">
        <label for="cc-name">Child Care Name: </label>
        <input type="text" name="cc-name" label="Child Care Name" >
      </div>
      <div class="clearfix"></div>
      <div class="half field">
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
        <input type="text" name="zip" label="ZIP Code" >
      </div>
      <div class="one field">
        <label for="lang">Language Spoken: </label>
        <select id="lang" name="lang[]" multiple>
          <option value="english">English</option>
          <option value="spanish">Spanish</option>
        </select>
      </div>
      <div class="one field">
        <label for="cops">Current Openings: </label>
        <input type="checkbox" name="cop" value="yes" >YES</input>
        <input type="checkbox" name="cop" value="no" class="checkbox-right" >NO</input>
      </div>
      <div class="one field">
        <label for="check-option">Check the following that apply: </label>
        <input name="op-eve"type="checkbox" value="yes">Open on evenings/overnight </input>
        <input name="op-week" type="checkbox" class="checkbox-right" value="yes">Open on weekends </input>
        <br>
        <input name="c-fork" type="checkbox" value="yes">Accept Care4Kids </input>
        <input name="cam" type="checkbox" class="checkbox-right" value="yes">Certified to Administer Medication </input>
        <p></p>
        <input id="submit" class="ajax-button" type="submit" value="Search">
      </div>
    </form>

  </div>
</section>