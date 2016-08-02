<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: General with Sidebar
 */
?>
<?php get_header(); ?>

<div class="container">
	<div class="border">
		<div class="row">
			<div class="col-lg-12">
				<?php require_once('includes/nav.php'); ?>
				<img src="<?php echo get_field('header_image', $wp_query->post->ID) ?>" alt="">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-9 col-md-9">
				<div class="general">	
					<div class="content">
						<?php
							if (have_posts()) :
							   while (have_posts()) :
							   	echo '<h3>'.get_the_title().'</h3>';
							      the_post();
							         the_content();
							   endwhile;
							endif;
						?>						
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="sidebar">
					<?php
			            if(is_active_sidebar('right_sidebar')){
			                dynamic_sidebar('right_sidebar');
			            }
		            ?>
		            <div class="searchbox-container">
						<div class="searchbox">
							<h2>Where are you looking for child care?</h2>
							<form action="find-child-care/" method="GET">
								<input name="zip" class="field" type="text" onfocus="if(this.value == 'Enter Zip Code') { this.value = ''; }" value="Enter Zip Code" >
								<input class="submit" type="submit" value="SEARCH">
							</form>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>


<?php get_footer(); ?>
