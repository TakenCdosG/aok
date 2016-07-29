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

/*no mail activation*/


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

/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */

function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['role']
        );
        
        // sanitize user form input
        global $username, $password, $email, $role;
        $username   =   sanitize_user($_POST['username']);
        $password   =   esc_attr($_POST['password']);
        $email      =   sanitize_email($_POST['email']);
        $role    =   $_POST['role'];

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
        $username,
        $password,
        $email,
        $role
        );
    }

    registration_form(
        $username,
        $password,
        $email,
        $role
        );
}

function registration_form( $username, $password, $email, $role ) {

    echo '
    <div class="register">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        <div>
        <label for="username">Username <strong>*</strong></label>
        <input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
        </div>
        
        <div>
        <label for="password">Password <strong>*</strong></label>
        <input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
        </div>
        
        <div>
        <label for="email">Email <strong>*</strong></label>
        <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
        </div>
        
        <div>
        <label for="role">Provider</label>
        <input type="hidden" value="subscriber" name="role">
        <input type="checkbox" name="role" value="contributor">
        </div>
        
        <input type="submit" class="ajax" name="submit" value="Register"/>
        </form>
    </div>

    ';
}

function registration_validation( $username, $password, $email, $role)  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Username too short. At least 4 characters is required');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'Sorry, that username already exists!');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'Sorry, the username you entered is not valid');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Password length must be greater than 5');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email Already in use');
    }

    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div class="register_message">';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

function complete_registration() {
    global $reg_errors, $username, $password, $email, $role;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'    =>  $username,
        'user_email'    =>  $email,
        'user_pass'     =>  $password,
        'role'      =>  "$role",
        );
        $user = wp_insert_user( $userdata );
        echo '<div clas="register_message">Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.</div>';   
    }
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}
?>