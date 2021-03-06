<?php
/*
* Template Name: Search Child Care
*/
?>
<?php get_header(); ?>


<div class="container search">
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
                <h2>Search </h2>
            </div>
            
            <?php if(!empty(get_field('note', $wp_query->post->ID))){?>
                <div class="col-lg-12">
                    <p class="note"> <?php echo(get_field('note', $wp_query->post->ID));?> </p>
                
                </div>
            <?php } ?>
            
        </div>
        <?php
        if (!is_user_logged_in()) {
            $redirect = home_url() . '/wp-login.php?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
            $register =  home_url() . '/register?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
            echo('<div class="row log-reg">
				<div class="col-lg-12 log">Already registered?  <a href="#">Log in here</a> </div></div>');
        } else {
        ?>
        <div class="row">
           <div class="col-lg-5" id="search-page-left">
               <div id="map"></div>
            </div>
            <div class="col-lg-12" id="search-page-right">
               <script>var $_POST = <?php echo json_encode($_POST); ?>;</script>
                <?php echo do_shortcode('[search_child_care]'); ?>
            </div>
        </div>
        <div class="row" id="count-results">
            <div class="col-lg-12"></div>
        </div>
        <div class="search-child-care-results row" id="search-child-care-results">
            <!-- HERE DYNAMIC CONTENT FROM SEARCH RESULTS -->
        </div>
    </div>
</div>
<?php
}
?>
<?php get_footer(); ?>
