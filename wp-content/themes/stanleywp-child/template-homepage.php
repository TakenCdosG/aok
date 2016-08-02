<?php
/**
 * @package WordPress
 * @subpackage StanleyWP
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>
<script type="text/javascript">
(function ($) {
  "use strict";
  function content_height(){
  	if($(window).width() > 600){
  		var content_height = $(".home-second-col .content").height()+224;
        $(".home-first-col .img").height( content_height );
  	}else{
  		$(".home-first-col .img").height( 414 );
  	}	
  }
    $(document).ready(function() {
    	content_height();
    });
    $(window).resize(function(){
    	content_height();
    });

})(jQuery); 
</script>

<div class="container">
	<div class="border">
		<div class="row">
			<div class="col-lg-12">
				<?php require_once('includes/nav.php'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="home-first-col">
					<div class="img" style="background-image:url('<?php echo get_field('homepage_left_image', $wp_query->post->ID) ?>')"></div>
					<div class="caption">
						<p>Are you an employer looking to share the QSP with your employees or clients?</p>
						<a href="">CLICK HERE FOR MORE INFO</a>
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
						<div class="searchbox">
							<h1>Where are you looking for child care?</h1>
							<form action="find-child-care/" method="GET">
								<input name="zip" class="field" type="text" onfocus="if(this.value == 'Enter Zip Code') { this.value = ''; }" value="Enter Zip Code" >
								<input class="submit" type="submit" value="SEARCH">
							</form>
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
