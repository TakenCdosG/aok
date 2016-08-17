<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>

<div class="container">
	<?php get_template_part('includes/pop-up-login'); ?>
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
							echo '<p>'.get_field("homepage_caption_text", $wp_query->post->ID).'</p>';
							if($current_lang == 'en'){
								echo '<a href="">CLICK HERE FOR MORE INFO</a>';
							}elseif ($current_lang == 'es') {
								echo '<a href="">CLICK PARA INFORMACIÓN</a>';
							}
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
						<?php if (is_user_logged_in()) { ?>
						<div class="searchbox">
							<?php
								if($current_lang == 'en'){
									echo '<h1>Where are you looking for child care?</h1>';
								}elseif ($current_lang == 'es') {
									echo '<h1>¿Dónde estas buscando cuidado infantil?</h1>';
								}
							?>
							<?php
								if($current_lang == 'en'){
									echo '<form action="find-child-care/" method="GET">';
								}elseif ($current_lang == 'es') {
									echo '<form action="encontrar-cuidado-infantil/" method="GET">';
								}
							?>
								<?php
									echo
									'<input name="zip" class="field zip" type="text" value="'.get_field("homepage_zipcode_text", $wp_query->post->ID).'">
									<input class="submit" type="submit" value="'.get_field("homepage_search_button", $wp_query->post->ID).'">'
								?>
							</form>
							<div class="clearfix"></div>
						</div>
						<?php } else{?>
						<div class="searchbox no-padding">
							<div class="half reg">
								<h1><?php echo get_field("homepage_register_heading", $wp_query->post->ID); ?></h1>
								<?php echo get_field("homepage_register_text", $wp_query->post->ID); ?>
							</div>
							<div class="half log">
								<h1><?php echo get_field("homepage_login_heading", $wp_query->post->ID); ?></h1>
								<?php echo get_field("homepage_login_text", $wp_query->post->ID); ?>
							</div>
						</div>
						<?php } ?>
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
