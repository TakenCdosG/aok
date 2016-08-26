<?php
// This theme uses post thumbnails
require_once('includes/functions/wp_bootstrap_navwalker.php');
require_once('includes/functions/register-form.php');
require_once('includes/functions/my_mce.php');
require_once('includes/functions/search-child-care.php');

add_theme_support('post-thumbnails');
add_post_type_support( 'child_care', 'thumbnail' );

/*Sidebars*/
if ( function_exists('register_sidebar') )
	register_sidebar( array(
		'name' => 'Right sidebar',
		'id' => 'right_sidebar',
		'description' => 'Right Sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
register_sidebar( array(
	'name' => 'Header sidebar',
	'id' => 'header_sidebar',
	'description' => 'Header Sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );


/*Remove editor for profile*/
function remove_editor_profile() {
	remove_post_type_support( 'profile', 'editor' );
}
add_action( 'init', 'remove_editor_profile' );
/*limit profile creation*/
add_action( 'admin_head-post-new.php', 'check_post_limit' );
function check_post_limit() {
	global $userdata;
	global $post_type;
	global $wpdb;
	if( $post_type === 'profile' ) {
		$item_count = $wpdb->get_var( "SELECT count(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'profile' AND post_author = $userdata->ID" );
		if( $item_count >= 1 ) { wp_die( "error" ); }
	} 
	return;
}
add_action( 'init', 'check_post_limit' );
/*favorites page*/
if (is_admin())
{
	add_action('admin_menu', 'my_menu');
}
function my_menu()
{
	add_menu_page('My Page Title', 'My Search List', 'read', 'my-search-results', 'my_function');
}
function my_function()
{
	echo do_shortcode('[show_gd_mylist_list share_list="no" show_count="no"]');
}




function adding_custom_resources() {

	if(is_page_template( 'templates/template-homepage.php' ) ){
		wp_enqueue_script( 'home-js', get_stylesheet_directory_uri() .'/includes/js/home-functions.js');
		wp_enqueue_script( 'pop-up-login', get_stylesheet_directory_uri() .'/includes/js/pop-up-login.js');
	}
	
	if(is_page_template( 'author.php' ) ){
		wp_enqueue_script( 'author-js', get_stylesheet_directory_uri() .'/includes/js/profile-read-more.js');
	}

	if(is_page( 'register' ) ){
		wp_enqueue_script( 'fancybox-js', get_stylesheet_directory_uri() .'/includes/js/libraries/fancybox/jquery.fancybox.js');
		wp_enqueue_style( 'fancybox-css', get_stylesheet_directory_uri() .'/includes/js/libraries/fancybox/jquery.fancybox.css');
		wp_enqueue_script( 'fancybox-register', get_stylesheet_directory_uri() .'/includes/js/fancybox-register.js');
	}
}
add_action( 'wp_enqueue_scripts', 'adding_custom_resources' );


//redirect after logout

add_action('wp_logout','go_home');
function go_home(){
	wp_redirect( home_url() );
	exit();
}