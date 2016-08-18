<?php
// Adding custom Styles TinyMCE

// Callback function to insert 'styleselect' into the $buttons array
function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {
    // Define the style_formats array
    $style_formats = array(
        // Each array child is a format with it's own settings
        array(
            'title' => 'Green Text',
            'inline' => 'span',
            'classes' => 'green-text',
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );

    return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

//adding editor-style.css to the backend editor

function my_mce_add_editor_styles() {
    add_editor_style( '/includes/css/editor-style.css' );
}
add_action( 'admin_init', 'my_mce_add_editor_styles' );

//adding editor-style.css to the whole site

function my_mce_editor_style() {
    wp_enqueue_style( 'style-name', get_stylesheet_directory_uri() .'/includes/css/editor-style.css');
}
add_action( 'wp_enqueue_scripts', 'my_mce_editor_style' );
