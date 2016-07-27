<?php get_header(); ?>

<?php
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
//Variables
$ide = $curauth->ID; 
$p_child_care_name = get_field('p_child_care_name', 'user_'.$ide);
$p_contact_information = get_field('p_contact_information', 'user_'.$ide);
$p_ages_served = get_field('p_ages_served', 'user_'.$ide);
$p_about_me = get_field('p_about_me', 'user_'.$ide);
$p_infant_toddler = get_field('p_infant_toddler', 'user_'.$ide);
$p_pre_school = get_field('p_pre_school', 'user_'.$ide);
$p_before_after_school = get_field('p_before_after_school', 'user_'.$ide);

$p_license_number = get_field('p_license_number', 'user_'.$ide);
$p_issue_date = get_field('p_issue_date', 'user_'.$ide);
$p_expiration_date = get_field('p_expiration_date', 'user_'.$ide);
$p_length_of_time_as_provider = get_field('p_length_of_time_as_provider', 'user_'.$ide);
$regular_capacity = get_field('regular_capacity', 'user_'.$ide);
$p_school_age_capacity = get_field('p_school_age_capacity', 'user_'.$ide);
$p_qsp_level = get_field('p_qsp_level', 'user_'.$ide);
$p_date_issued = get_field('p_date_issued', 'user_'.$ide);
$p_expiration_date_qsp = get_field('p_expiration_date_qsp', 'user_'.$ide);

$p_hours_of_operation = get_field('p_hours_of_operation', 'user_'.$ide);
$p_infant_toddler = get_field('p_infant_toddler', 'user_'.$ide);
$p_preschool = get_field('p_preschool', 'user_'.$ide);
$p_school_age = get_field('p_school_age', 'user_'.$ide);
$p_language_spoken = get_field('p_language_spoken', 'user_'.$ide);
$p_assistant_name = get_field('p_assistant_name', 'user_'.$ide);
$p_extra_details = get_field('p_extra_details', 'user_'.$ide);
$p_training_and_experience = get_field('p_training_and_experience', 'user_'.$ide);
$p_date_issued = get_field('p_date_issued', 'user_'.$ide);
$p_expiration_date = get_field('p_expiration_date', 'user_'.$ide);

?>

<script type="text/javascript">
(function ($) {
  "use strict";
  $(document).ready(function() {
      $(".p_col").height($(".p_col").parent().height());


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

})(jQuery); 
</script>



<div class="container">
  <div class="border">
    <div class="row">
      <div class="col-lg-12">
        <?php require_once('includes/nav.php'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-5 col-md-5">
        <?php echo get_field('p_gallery', 'user_'.$ide); ?>
      </div>
      <div class="col-lg-7 col-md-7">
        <div class="basic-information">
          <h3><?php echo $p_child_care_name; ?></h3>
          <div class="col-lg-6"><?php echo $p_contact_information; ?></div>
          <div class="col-lg-6">
            <p><strong>Ages Served</strong></p>
            <p><?php echo $p_ages_served; ?></p>
            <p><br><strong>Current Openings</strong></p>
            <p>Infant/Toddler: <?php echo $p_infant_toddler; ?></p>
            <p>Pre-school: <?php echo $p_pre_school; ?></p>
            <p>Before & After School: <?php echo $p_before_after_school; ?></p>
          </div>
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-lg-12">
        <div class="profile">
          <h5>ABOUT ME</h5>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="profile grey about-me">
          <p><?php echo $p_about_me; ?></p>
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-lg-12">
        <div class="profile">
          <h5>LICENSING INFORMATION</h5>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="profile grey list">
          <ul>
            <li><strong>License number</strong><br><?php echo $p_license_number; ?></li>
            <li><strong>Issue date</strong><br><?php echo $p_issue_date; ?></li>
            <li><strong>Expiration date</strong><br><?php echo $p_expiration_date; ?></li>
            <li><strong>Length of time as provider</strong><br><?php echo $p_length_of_time_as_provider; ?></li>
            <li><strong>Regular capacity</strong><br><?php echo $regular_capacity ?></li>
            <li><strong>School age capacity</strong><br><?php echo $p_school_age_capacity; ?></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="profile">
            <p class="small">For up to date licensing information, please visit the <a href="#">Connecticut Office of Early Childhood website.</a></p>
          </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-lg-12">
        <div class="profile">
          <h5>ACCREDITATION INFORMATION</h5>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="profile grey list">
          <ul>
            <li><strong>QSP Level</strong><br><?php echo $p_qsp_level; ?></li>
            <li><strong>Date Issued</strong><br><?php echo $p_date_issued; ?></li>
            <li><strong>Expiration date</strong><br><?php echo $p_expiration_date_qsp; ?></li>
          </ul>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-lg-7">
        <div class="profile">
          <h5>ABOUT MY CHILD CARE</h5>
        </div>
        <div class="about-childcare">
          <div class="first">
            <div class="profile grey p_col">
              <p><strong>Hours of Operation</strong></p>
              <p><?php echo $p_hours_of_operation; ?></p>
              <p><strong>Fees by Age Group</strong></p>
              <p>Infant/Toddler: <?php echo $p_infant_toddler; ?></p>
              <p>Preschool: <?php echo $p_preschool; ?></p>
              <p>School Age: <?php echo $p_school_age; ?></p>
            </div>
          </div>
          <div class="second">
            <div class="profile grey p_col">
              <p><?php echo $p_extra_details; ?></p>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>

      <div class="col-lg-5">
        <div class="profile">
          <h5>ABOUT MY TRAINING AND EXPERIENCE</h5>
        </div>
        <div class="profile grey p_col">
          <p><strong>Education</strong></p>
          <p><?php echo $p_training_and_experience; ?></p>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  </div>
</div>



    

<?php get_footer(); ?>

