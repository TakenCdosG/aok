<?php

/*custom*/
// This theme uses post thumbnails
require_once('includes/wp_bootstrap_navwalker.php');

add_theme_support('post-thumbnails');
add_post_type_support( 'child_care', 'thumbnail' );

/*Sidebars*/
if ( function_exists('register_sidebar') )
register_sidebar( array(
'name' => 'right_sidebar',
'id' => 'right_sidebar',
'description' => 'Right Sidebar',
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

//Child Care Custom Post Type

function create_posttype() {

register_post_type( 'child_care',
// CPT Options
array(
'labels' => array(
'name' => __( 'Child Care' ),
'singular_name' => __( 'Child Care' ),
'menu_name'           => __( 'Child Care', 'AOK' ),
'parent_item_colon'   => __( 'Parent Child Care', 'AOK' ),
'all_items'           => __( 'All Child Care', 'AOK' ),
'view_item'           => __( 'View Child Care', 'AOK' ),
'add_new_item'        => __( 'Add New Child Care',  'AOK' ),
'add_new'             => __( 'Add New Child Care', 'AOK' ),
'edit_item'           => __( 'Edit Child Care', 'AOK' ),
'update_item'         => __( 'Update Child Care', 'AOK' ),
'search_items'        => __( 'Search Child Care', 'AOK' ),
'not_found'           => __( 'Not Child Care Found', 'AOK' ),
'not_found_in_trash'  => __( 'Not Child Care Found in Trash', 'AOK' )

),
'public' => true,
'has_archive' => true,
'rewrite' => array('slug' => 'child_care'),
'menu_position' => 5,
'menu_icon' =>  "https://cdn1.iconfinder.com/data/icons/seo-flat-buttons/512/home-16.png", //get_stylesheet_directory_uri() .
)
);
/*
register_post_type( 'profile',
// CPT Options
array(
'labels' => array(
'name' => __( 'Public Profile' ),
'singular_name' => __( 'Public Profile' ),
'menu_name'           => __( 'Public Profile', 'AOK' ),
'parent_item_colon'   => __( 'Parent Public Profile', 'AOK' ),
'all_items'           => __( 'All Public Profile', 'AOK' ),
'view_item'           => __( 'View Public Profile', 'AOK' ),
'add_new_item'        => __( 'Add New Public Profile',  'AOK' ),
'add_new'             => __( 'Add New Public Profile', 'AOK' ),
'edit_item'           => __( 'Edit Public Profile', 'AOK' ),
'update_item'         => __( 'Update Public Profile', 'AOK' ),
'search_items'        => __( 'Search Public Profile', 'AOK' ),
'not_found'           => __( 'Not Public Profile Found', 'AOK' ),
'not_found_in_trash'  => __( 'Not Public Profile Found in Trash', 'AOK' )

),
'public' => true,
'has_archive' => true,
'rewrite' => array('slug' => 'profile'),
'menu_position' => 3,
'menu_icon' =>  "https://cdn2.iconfinder.com/data/icons/circle-icons-1/64/profle-16.png", //get_stylesheet_directory_uri() .
)
);
*/
}
// Hooking up function to theme setup
add_action( 'init', 'create_posttype' );


/*
* Creating a function to create the Custom Post Type
*/

function custom_post_type() {

// Set other options for Custom Post Type

$args = array(
'label'               => __( 'Child Care', 'AOK' ),
'description'         => __( 'Child Care', 'AOK' ),
'labels'              => $labels,
// Features in Post Editor
'supports'            => array( 'title', 'author', 'comments'  ),
// Taxonomies or custom taxonomy.
//'taxonomies'          => array( 'categories' ),
/* A hierarchical CPT is like Pages and can have
* Parent and child items. A non-hierarchical CPT
* is like Posts.
*/
'hierarchical'        => false,
'public'              => true,
'show_ui'             => true,
'show_in_menu'        => true,
'show_in_nav_menus'   => true,
'show_in_admin_bar'   => true,
'menu_position'       => 5,
'can_export'          => true,
'has_archive'         => true,
'exclude_from_search' => false,
'publicly_queryable'  => true,
'capability_type'     => 'post',
);
/*
$args2 = array(
'label'               => __( 'Public Profile', 'AOK' ),
'description'         => __( 'Public Profile', 'AOK' ),
'labels'              => $labels,
// Features in Post Editor
'supports'            => false,
// Taxonomies or custom taxonomy.
//'taxonomies'          => array( 'categories' ),
// A hierarchical CPT is like Pages and can have
// Parent and child items. A non-hierarchical CPT
// is like Posts.

'hierarchical'        => false,
'public'              => true,
'show_ui'             => true,
'show_in_menu'        => true,
'show_in_nav_menus'   => true,
'show_in_admin_bar'   => true,
'menu_position'       => 3,
'can_export'          => true,
'has_archive'         => true,
'exclude_from_search' => false,
'publicly_queryable'  => true,
'capability_type'     => 'post',
);
*/
// Registering Custom Post Type
register_post_type( 'child_care', $args );
//register_post_type( 'profile', $args2 );

}

/* Hook into the 'init' action so that the function
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );

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
?>

