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
		$( "form" ).submit(function( event ) {
		  if ( $( ".zip" ).val().indexOf("e") <= 0 ) {
		    return;
		  }
		 
		  $( ".zip" ).val("");
		  return;
		  event.preventDefault();
		});
	});

	$(window).resize(function(){
		content_height();
	});

	$(function(){
	    /* Hide form input values on focus*/ 
	    $('.field.zip').each(function(){
	        var txtval = $(this).val();
	        $(this).focus(function(){
	            if($(this).val() == txtval){
	                $(this).val('')
	            }
	        });
	        $(this).blur(function(){
	            if($(this).val() == ""){
	                $(this).val(txtval);
	            }
	        });
	    });
	});

})(jQuery); 
</script>

<div class="container">
	<div class="border">
		<div class="row">
			<div class="col-lg-12 nav-head">
				<?php require_once('includes/nav.php'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="home-first-col">
					<div class="img" style="background-image:url('<?php echo get_field('homepage_left_image', $wp_query->post->ID) ?>')"></div>
					<div class="caption">
						<?php
							if($current_lang == 'en'){
								echo '
								<p>Are you an employer looking to share the QSP with your employees or clients?</p>
								<a href="">CLICK HERE FOR MORE INFO</a>';
							}elseif ($current_lang == 'es') {
								echo '
								<p>¿Eres un empleador buscando compartir el QSP con tus empleados o clientes?</p>
								<a href="">CLICK PARA INFORMACIÓN</a>';
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
									if($current_lang == 'en'){
										echo '
											<input name="zip" class="field zip" type="text" value="Enter Zip Code" >
											<input class="submit" type="submit" value="SEARCH">';
									}elseif ($current_lang == 'es') {
										echo '
											<input name="zip" class="field zip" type="text" value="Ingresa Código Postal">
											<input class="submit" type="submit" value="BUSCAR">';
									}
								?>
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
