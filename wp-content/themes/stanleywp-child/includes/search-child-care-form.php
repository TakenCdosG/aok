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
    <form id="search-child-care-form">
      <input type="hidden" id="current_lang" name="current_lang" value="<?php echo $current_lang; ?>">
      <div class="half field">
        <label for="f-name">Provider First Name: </label>
        <input type="text" name="first_name" label="First Name" >
      </div>
      <div class="half field" style="margin-left:3%;">
        <label for="l-name">Provider Last Name: </label>
        <input type="text" name="last_name" label="Last Name" >
      </div>
      <div class="clearfix"></div>
      <div class="full field">
        <label for="cc-name">Child Care Name: </label>
        <input type="text" name="child_care_name" label="Child Care Name" >
      </div>
      <div class="clearfix"></div>
      <div class="ages field">
        <label for="age">Ages Served: </label>
        <select id="age" name="p_ages_served[]" multiple>
          <option value="">- Select Age Group -</option>
          <?php
          $field_key = "field_579622ab4a37c";
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
        <input type="text" id="zip_code" name="zip_code" label="ZIP Code" value="<?php echo $_POST['zip_code'];  ?>" >
      </div>
      <div class="one field">
        <label for="lang">Language Spoken: </label>
        <select id="lang" name="p_language_spoken[]" multiple>
          <option value="english">English</option>
            <option value="spanish">Spanish</option>
        </select>
      </div>
      <div class="one field">
        <label for="cops">Current Openings: </label>
        <input type="checkbox" name="current_openings" value="yes" >YES</input>
        <input type="checkbox" name="current_openings" value="no" class="checkbox-right" >NO</input>
      </div>
      <div class="one field">
        <label for="check-option">Check the following that apply: </label>
        <input name="open_on_evenings"type="checkbox" value="yes">Open on evenings/overnight </input>
        <input name="open_on_weekends" type="checkbox" class="checkbox-right" value="yes">Open on weekends </input>
        <br>
        <input name="accept_care4kids" type="checkbox" value="yes">Accept Care4Kids </input>
        <input name="certified_to_administer_medication" type="checkbox" class="checkbox-right" value="yes">Certified to Administer Medication </input>
        <p></p>
        <input id="submit" class="ajax-button" type="submit" value="Search">
      </div>
    </form>

</section>

