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
						<div class="searchbox-container">
                                                    <?php if (!is_user_logged_in()) { $logged = "log"; } ?>
                                                        <div class="searchbox <?php echo $logged; ?>">

                                                                <h1> <?php echo get_field("homepage_search_heading", $wp_query->post->ID); ?></h1>

                                                                <form action="find-child-care/" method="POST">
                                                                                                                                
                                                                    <a href="#"><input name="zip_code" class="field zip" type="text" value="<?php echo get_field("homepage_zipcode_text", $wp_query->post->ID); ?>"></a>
                                                                
                                                                <input name="from_home" value="from_home" hidden>

                                                                <a href="#"><input class="submit" type="submit" value="<?php echo get_field("homepage_search_button", $wp_query->post->ID); ?>"></a>

                                                                </form>
                                                                <div class="clearfix"></div>
                                                        </div>
						</div>
						<div class="image-container">
							<div class="img" style="background-image:url('<?php echo get_field('homepage_right_image', $wp_query->post->ID) ?>')"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>