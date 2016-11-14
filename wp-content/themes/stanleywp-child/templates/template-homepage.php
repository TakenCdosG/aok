<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>
	<div class="container">
		<?php get_template_part('includes/email-pop-up-login'); ?>
		<div class="border">
			<div class="row">
				<div class="col-lg-12 nav-head">
					<?php get_template_part('includes/nav'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="home-first-col">
						<div class="img" style="background-image:url('<?php echo get_field('homepage_left_image', $wp_query->post->ID) ?>')"></div>
						<div class="caption">
							<?php
							echo get_field("homepage_caption_text", $wp_query->post->ID);
                                                        echo '<p></p>';
							echo '<a href="'.get_field("homepage_caption_button_link", $wp_query->post->ID).'">'.get_field("homepage_caption_button", $wp_query->post->ID).'</a>';
							?>
						</div>
					</div>
					<div class="home-second-col">
						<div class="content">
							<?php
							if (have_posts()) :
								while (have_posts()) :
									the_post();
									the_content();
								endwhile;
							endif;
							?>
						</div>
						<?php get_template_part('includes/search-zip-code-widget'); ?>

						<div class="image-container">
							<div class="img" style="background-image:url('<?php echo get_field('homepage_right_image', $wp_query->post->ID) ?>')"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>