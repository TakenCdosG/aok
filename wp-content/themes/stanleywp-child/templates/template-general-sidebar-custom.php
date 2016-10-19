<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: General with Custom Sidebar
 */
?>
<?php get_header(); ?>

<div class="container">
	<div class="border">
		<div class="row">
			<div class="col-lg-12 nav-head">
				<?php get_template_part('includes/nav'); ?>
				<?php $header = array(get_field('first_header_image', $wp_query->post->ID), get_field('second_header_image', $wp_query->post->ID));
				if(!empty($header[0]) and !empty($header[1])){ ?>
				<div class="header-image">
					<div class="image-one" style="background-image: url(<?php echo $header[0] ?>)"></div>
					<div class="image-two" style="background-image: url(<?php echo $header[1] ?>)"></div>
				</div>
				<?php } elseif(!empty($header[0])){ ?>
				<div class="header-image" style="background-image: url(<?php echo $header[0] ?>)"></div>
				<?php }elseif(!empty($header[1])){ ?>
				<div class="header-image" style="background-image: url(<?php echo $header[1] ?>)"></div>
				<?php }?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-9 col-md-9 wsidebar">
				<div class="general wsidebar">	
					<div class="content wsidebar">
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
					<div class="searchbox-container">
						<div class="searchbox">
							<h2><?php get_field('sidebar_text_block', $wp_query->post->ID) ?></h2>
                                                        <a href="<?php get_field('sidebar_text_block_button_url', $wp_query->post->ID) ?>"><?php get_field('sidebar_text_block_button_text', $wp_query->post->ID) ?></>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>