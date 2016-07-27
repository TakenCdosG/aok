<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: FAQ
 */
?>
<?php get_header('faq'); ?>

<div class="container faq">
	<div class="border">
		<div class="row">
			<div class="big-logo">
	        	<img src="<?php echo get_stylesheet_directory_uri() ?>/images/big-logo.png" alt="">
	      	</div>
			<div class="col-lg-12">
				<div class="back"><a href="<?php echo get_site_url(); ?>">< All Our Kin Main Site</a> </div>
				<img src="<?php echo get_field('header_image', $wp_query->post->ID) ?>" alt="">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="general">	
					
					<?php
						if (have_posts()) :
						   while (have_posts()) :
						      the_post();
						         the_content();
						   endwhile;
						endif;
					?>						
					
				</div>
				
			</div>
		</div>	
	</div>
</div>


<?php get_footer('faq'); ?>