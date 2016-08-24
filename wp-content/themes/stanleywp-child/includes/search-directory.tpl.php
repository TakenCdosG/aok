<?php
/**
 * @file
 * Default theme implementation to display the basic search directory structure page.
 *
 * Variables:
 * - $data_needed: An array of data needed for print on this template.
 */
?>

<section class="search-directory-wrapper">
  <div class="container">
    <form role="form" id="search-child-care">
      <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="FIELD-1-NAME-HERE">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" name="FIELD-2-NAME-HERE">
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="FIELD-3-NAME-HERE"> Remember me</label>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <div class="SEARCH-RESULT-DIV-CLASS-HERE" id="SEARCH-RESULT-DIV-ID-HERE">
      <!-- HERE DYNAMIC CONTENT FROM SEARCH RESULTS -->
    </div>
  </div>
</section>