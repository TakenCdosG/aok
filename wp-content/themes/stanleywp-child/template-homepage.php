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
	/*Popup*/
	function deselect(e) {
	  $('.pop-r').slideFadeToggle(function() {
	    e.removeClass('selected');
	      $('.overlay').css("display", "none");
	  });    
	}

	$(function() {

		if($(".register_message").length){
			if($('.reg a').hasClass('selected')) {
			  deselect($('.reg a'));               
			} else {
			  $(this).addClass('selected');
			  $('.pop-r').slideFadeToggle();
			  $('.overlay').css("display", "block");
			}
			return false;
		}

		$('.reg a').on('click', function() {
		if($(this).hasClass('selected')) {
		  deselect($(this));               
		} else {
		  $(this).addClass('selected');
		  $('.pop-r').slideFadeToggle();
		  $('.overlay').css("display", "block");
		}
		return false;
		});



		$('.close-r').on('click', function() {
		deselect($('.reg a'));
		return false;
		});
	});

	$.fn.slideFadeToggle = function(easing, callback) {
	  return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
	};

	function deselectl(e) {
	  $('.pop-l').slideFadeToggle(function() {
	    e.removeClass('selected');
	      $('.overlay').css("display", "none");
	  });    
	}

	$(function() {

		$('#register-click').on('click', function() {
			$('.close-l').trigger("click");
			function explode(){
				
				$('.reg a').trigger("click");
			}
			setTimeout(explode, 320);
		});

		$('.log a').on('click', function() {
		if($(this).hasClass('selected')) {
		  deselectl($(this));               
		} else {
		  $(this).addClass('selected');
		  $('.pop-l').slideFadeToggle();
		  $('.overlay').css("display", "block");
		}
		return false;
		});

		$('.close-l').on('click', function() {
		deselectl($('.log a'));
		return false;
		});
		});

		$.fn.slideFadeToggle = function(easing, callback) {
		return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
	};

	

})(jQuery); 
</script>

<div class="container">
	<div class="messagepop pop-r">
	    <div class="row border-bottom">
	    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h2>Register</h2></div>
	    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a class="close-r" href="/">(close)</a></div>
	    </div>
	    
	    <?php echo do_shortcode('[cr_custom_registration]'); ?>
	    
	</div>
	<div class="messagepop pop-l">
	    <div class="row border-bottom">
	    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h2>Login</h2></div>
	    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a class="close-l" href="/">(close)</a></div>
	    </div>
	    <?php 
	    $args = array(
			'echo'           => true,
			'remember'       => false,
			'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
			'form_id'        => 'loginform',
			'id_username'    => 'user_login',
			'id_password'    => 'user_pass',
			'id_remember'    => 'rememberme',
			'id_submit'      => 'wp-submit',
			'label_username' => __( 'Username' ),
			'label_password' => __( 'Password' ),
			'label_remember' => __( 'Remember Me' ),
			'label_log_in'   => __( 'Log In' ),
			'value_username' => '',
			'value_remember' => false
		);
		echo "<div class='register-switch'><a id ='register-click' href='#'>Don't have an account, sign up!</a></div>"; 
	    wp_login_form( $args ); 
	    echo '<a href="'.wp_lostpassword_url( $redirect ).'">Forgot Password?</a>'; 
	    ?> 
	    
	</div>
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
						<?php if (!is_user_logged_in()) { ?>
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
								<br>
								<p><?php echo get_field("homepage_register_text", $wp_query->post->ID); ?></p>
							</div>
							<div class="half log">
								<h1><?php echo get_field("homepage_login_heading", $wp_query->post->ID); ?></h1>
								<br>
								<p><?php echo get_field("homepage_login_text", $wp_query->post->ID); ?></p>
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
