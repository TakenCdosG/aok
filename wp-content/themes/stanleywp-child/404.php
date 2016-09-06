<?php
/**
 * Error 404 Template
 * @package WordPress
 * @subpackage StanleyWP
 */
?>
<?php get_header(); ?>
<div class="container">
<?php get_template_part('includes/pop-up-login'); ?>
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
			<div class="col-lg-12">
				<div class="general">
					<div class="content">
						    <div id="w1">
						        <div class="container">
						            <br>
						            <div class="col-lg-10 col-lg-offset-1 centered">
						                <br>
						                <img src="<?php echo get_template_directory_uri();?>/images/404.png" alt="">
						                <br>
						                <h1><b><?php _e('404', 'gents'); ?></b></h1>
						                <h2><?php _e('OOOPS!<br/> you are not in the right place.', 'gents'); ?>
						                </h2>
						                <br>
						                <hr>
						                <br>
						                <h4><?php _e('WE CAN HELP YOU FIND YOUR PATH.', 'gents'); ?></h4>
						                <br>
						                <p><b><a href="<?php echo home_url(); ?>/">Back to Home</a></b></p>
						            </div>
						        </div><!-- /container -->
						    </div> <!-- /White Wrap 1 / Error -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>