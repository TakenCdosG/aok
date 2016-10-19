<?php get_header(); ?>

<?php

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
//Variables
$ide = $curauth->ID;
$p_child_care_name = get_field('child_care_name', 'user_'.$ide);
$p_owner_name = get_field('owner_name', 'user_'.$ide);
$p_contact_information = get_field('p_contact_information', 'user_'.$ide);

$p_about_me = get_field('p_about_me', 'user_'.$ide);
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
$p_preschool = get_field('p_preschool', 'user_'.$ide);
$p_school_age = get_field('p_school_age', 'user_'.$ide);
$p_extra_details = get_field('p_extra_details', 'user_'.$ide);
$p_training_and_experience = get_field('p_training_and_experience', 'user_'.$ide);
$p_date_issued = get_field('p_date_issued', 'user_'.$ide);
$p_expiration_date = get_field('p_expiration_date', 'user_'.$ide);
$p_accreditation_information_link = get_field('p_accreditation_information_link', 'user_'.$ide);



$ages_served = get_field_object('p_ages_served', 'user_'.$ide);
$value_ages_served = $ages_served['value'];
$label_ages_served = $ages_served['choices'][ $value_ages_served ];

$infant_toddler = get_field_object('infant_toddler', 'user_'.$ide);
$value_infant_toddler = $infant_toddler['value'];
$label_infant_toddler = $infant_toddler['choices'][ $value_infant_toddler ];

$pre_school = get_field_object('pre_school', 'user_'.$ide);
$value_pre_school = $pre_school['value'];
$label_pre_school = $pre_school['choices'][ $value_pre_school ];

$before_after_school = get_field_object('before_after_school', 'user_'.$ide);
$value_before_after_school = $before_after_school['value'];
$label_before_after_school = $before_after_school['choices'][ $value_before_after_school ];

?>
<div class="container">
	<?php get_template_part('includes/pop-up-login'); ?>
	<div class="border">
		<?php
if (!is_user_logged_in()) {
	$redirect = home_url() . '/wp-login.php?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
	$register =  home_url() . '/register?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
	echo('<div class="row log-reg"><div class="col-lg-12 reg">Are you looking for child care? If so, <a href="/register">Register here </a> </div>
				<div class="col-lg-12 log">Already registered?  <a href="#">Log in here</a> </div></div>');
} else { ?>
		<div class="row">
			<div class="col-lg-12">
				<?php get_template_part('includes/nav'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-md-5">
				<div class="fotorama" data-nav="thumbs" data-width="100%"
					 data-height="350">
				<?php
				$images = get_field('p_gallery');
				if( $images ){ ?>
						<?php foreach( $images as $image ){ ?>
								<a href="<?php echo $image['url']; ?>">
									<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
								</a>
				<?php }} ?>
				</div>
			</div>
			<div class="col-lg-7 col-md-7">
				<div class="basic-information profile">
					<h3><?php echo $p_child_care_name; ?></h3>
                                        <h5><?php echo $p_owner_name; ?></h5>
					<div class="col-lg-6"><?php echo $p_contact_information; ?></div>
					<div class="col-lg-6">
						<h5>Ages Served</h5>
						<ul><li><?php echo $label_ages_served; ?></li></ul>
						<h5>Current Openings</h5>
						<ul>
							<li>Infant/Toddler: <?php echo $label_infant_toddler; ?></li>
							<li>Pre-school: <?php echo $label_pre_school; ?></li>
							<li>Before & After School: <?php echo $label_before_after_school; ?></li>
						</ul>

					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="profile about_me">
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
				<div class="profile green">
					<h5>LICENSING INFORMATION</h5>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="profile grey list">
					<ul>
						<li><h5>License number</h5><br><?php echo $p_license_number; ?></li>
						<li><h5>Issue date</h5><br><?php echo $p_issue_date; ?></li>
						<li><h5>Expiration date</h5><br><?php echo $p_expiration_date; ?></li>
						<li><h5>Length of time as provider</h5><br><?php echo $p_length_of_time_as_provider; ?></li>
						<li><h5>Regular capacity</h5><br><?php echo $regular_capacity ?></li>
						<li><h5>School age capacity</h5><br><?php echo $p_school_age_capacity; ?></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div>
					<p class="small">For up to date licensing information, please visit the <a href="http://www.ct.gov/oec/site/default.asp" target="_blank">Connecticut Office of Early Childhood website.</a></p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="profile green">
					<h5>ACCREDITATION INFORMATION</h5>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="profile grey list">
					<ul>
						<li><h5>PSP Level</h5><br><?php echo $p_qsp_level; ?></li>
						<li><h5>Date Issued</h5><br><?php echo $p_date_issued; ?></li>
						<li><h5>Expiration date</h5><br><?php echo $p_expiration_date_qsp; ?></li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div>
					<p class="small"><a href="<?php echo $p_accreditation_information_link ; ?>">Click here</a> to learn more about accreditation information</p>
				</div>
			</div>
		</div>  
		<div class="row">
			<div class="col-lg-7">
				<div class="profile green">
					<h5>ABOUT MY CHILD CARE</h5>
				</div>
				<div class="about-childcare">
					<div class="first">
						<div class="profile grey p_col">
							<h5>Hours of Operation</h5>
								<ul><li><?php echo $p_hours_of_operation; ?></li></ul>
							<h5>Fees by Age Group</h5>
								<ul>
									<li>Infant/Toddler: <?php echo $infant_toddler; ?></li>
									<li>Preschool: <?php echo $p_preschool; ?></li>
									<li>School Age: <?php echo $p_school_age; ?></li>
								</ul>
							<h5>Languages Spoken</h5>
							<ul>
								<?php
								$languae = get_field('p_language_spoken', 'user_'.$ide);
								if(!empty($languae)){
									foreach ($languae as $key => $value) {
										echo "<li>" . $value . "</li>";
									}
								}
									?>
							</ul>
							<h5>Assistant Name</h5>
							<ul>
								<li><?php echo get_field('p_assistant_name', 'user_'.$ide); ?></li>
							</ul>
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
				<div class="profile green">
					<h5>ABOUT MY TRAINING AND EXPERIENCE</h5>
				</div>
				<div class="profile grey p_col">
					<p><strong>Education</strong></p>
					<p><?php echo $p_training_and_experience; ?></p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
<?php }?>
	</div>
</div>
<?php get_footer(); ?>