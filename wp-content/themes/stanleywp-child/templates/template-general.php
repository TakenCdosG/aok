<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: General
 */
?>
<?php get_header(); ?>
<div class="container">
	<div class="border">
		<div class="row">
			<div class="col-lg-12 nav-head">
				<?php get_template_part('includes/nav'); ?>
				<img src="<?php echo get_field('header_image', $wp_query->post->ID) ?>" alt="">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
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
		</div>
	</div>
</div>
<?php get_footer(); ?>