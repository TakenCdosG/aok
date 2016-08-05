<?php
/**
 * Single Posts Template
 *
 *
 * @file           single.php
 * @package        StanleyWP
 * @author         Brad Williams & Carlos Alvarez
 * @copyright      2011 - 2014 Gents Themes
 * @license        license.txt
 * @version        Release: 3.0.3
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>

<div class="container">
	<div class="border">
    <div class="row">
      <div class="col-lg-12 nav-head">
        <?php require_once('includes/nav.php'); ?>
      </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="general">	
				
				<?php
					if (have_posts()) :
					   while (have_posts()) :
					      	the_post();
					      	//the_author_posts_link();
					        the_content();
					   endwhile;
					endif;
				?>						
				
			</div>
			
		</div>
	</div>	
	</div>
</div>

 <?php get_footer(); ?>
