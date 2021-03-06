<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: General
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
			<?php 
                        if(!empty(get_field('sidebar_text_block', $wp_query->post->ID)) or !empty(get_field('sidebar_text_block_button_text', $wp_query->post->ID))){ 
                            $cols="col-lg-9 col-md-9";
                            $sidebar = " wsidebar"; 
                        }else{ 
                            $cols="col-lg-12 col-md-12"; 
                            $sidebar = ""; 
                        }  ?>
                        <div class="<?php echo $cols . $sidebar ?>">
                            <div class="general <?php echo $sidebar ?>">	
                                    <div class="content <?php echo $sidebar ?>">
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
                        <?php if(!empty(get_field('sidebar_text_block', $wp_query->post->ID)) or !empty(get_field('sidebar_text_block_button_text', $wp_query->post->ID))){?>
                            <div class="col-lg-3 col-md-3">
                                    <div class="sidebar">
                                            <div class="searchbox-container">
                                                    <div class="searchbox <?php if(!is_user_logged_in()){ echo("log"); } ?>">
                                                            <h2><?php echo get_field('sidebar_text_block', $wp_query->post->ID) ?></h2>
                                                            <a class="button" href="<?php echo get_field('sidebar_text_block_button_url', $wp_query->post->ID) ?>"><?php echo get_field('sidebar_text_block_button_text', $wp_query->post->ID) ?></a>
                                                            <div class="clearfix"></div>
                                                    </div>
                                            </div>
                                            <?php
                                            if(is_active_sidebar('right_sidebar')){
                                                    dynamic_sidebar('right_sidebar');
                                            }
                                            ?>
                                    </div>
                            </div>
                        <?php } ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>