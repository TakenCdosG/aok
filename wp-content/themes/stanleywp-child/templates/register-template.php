<?php
ob_start();
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: Register
 */
get_header();
?>
<div class="container">
    <?php get_template_part('includes/email-pop-up-login'); ?>
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
                        <?php
                        custom_registration_function();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
