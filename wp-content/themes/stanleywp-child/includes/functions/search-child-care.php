<?php
function adding_search_resources() {

    if(is_page_template( 'templates/template-search-child-care.php' ) ){
        wp_enqueue_script( 'multiples-selec-js', get_stylesheet_directory_uri() .'/includes/js/multiple-select/multiple-select.js');
        wp_enqueue_style( 'multiples-selec-css', get_stylesheet_directory_uri() .'/includes/js/multiple-select/multiple-select.css');
        wp_enqueue_script( 'search-child-care', get_stylesheet_directory_uri() .'/includes/js/search-child-care.js',array(), false, true );
        wp_enqueue_script( 'pop-up-login', get_stylesheet_directory_uri() .'/includes/js/pop-up-login.js');

        wp_localize_script( 'search-child-care', 'search_child_care', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ));
    }

}
add_action( 'wp_enqueue_scripts', 'adding_search_resources' );

add_action('wp_ajax_search_child_care','search_child_care_callback');

function search_child_care_callback(){

    parse_str($_POST['formData'],$form_data);
    $response = array();


    $args = array(
        'post_type' => 'child_care',
        'meta_query' => array(
            'relation' => 'AND',
        )
    );

    if(!empty($form_data['f-name'])){
        $args['meta_query'][] = array(
            'key'   => 'fname',
            'value'   => $form_data['f-name'],
            'compare' => '='
        );
    }

    if(!empty($form_data['l-name'])){
        $args['meta_query'][] = array(
            'key'   => 'lname',
            'value'   => $form_data['l-name'],
            'compare' => '='
        );
    }

    if(!empty($form_data['cc-name'])){
        $args['meta_query'][] = array(
            'key'   => 'ccname',
            'value'   => $form_data['cc-name'],
            'compare' => '='
        );
    }

    if(!empty($form_data['age'])){
        $args['meta_query'][] = array(
            'key'   => 'age',
            'value'   => $form_data['age'],
            'compare' => '='
        );
    }

    if(!empty($form_data['zip'])){
        $args['meta_query'][] = array(
            'key'   => 'zip',
            'value'   => $form_data['zip'],
            'compare' => '='
        );
    }

/*    if(!empty($form_data['lang'])){
        $args['meta_query'][] = array(
            'key'   => 'lang',
            'value'   => $form_data['lang'],
            'compare' => '='
        );
    }*/

    if(!empty($form_data['cop'])){
        $args['meta_query'][] = array(
            'key'   => 'cop',
            'value'   => $form_data['cop'],
            'compare' => '='
        );
    }

    if(!empty($form_data['op-eve'])){
        $args['meta_query'][] = array(
            'key'   => 'opeve',
            'value'   => $form_data['op-eve'],
            'compare' => '='
        );
    }

    if(!empty($form_data['op-week'])){
        $args['meta_query'][] = array(
            'key'   => 'opweek',
            'value'   => $form_data['op-week'],
            'compare' => '='
        );
    }

    if(!empty($form_data['c-fork'])){
        $args['meta_query'][] = array(
            'key'   => 'cfork',
            'value'   => $form_data['c-fork'],
            'compare' => '='
        );
    }

    if(!empty($form_data['cam'])){
        $args['meta_query'][] = array(
            'key'   => 'cam',
            'value'   => $form_data['cam'],
            'compare' => '='
        );
    }

   //svar_dump($_POST['formChild']['fname']);
    $query = new WP_Query($args);

    // If we don't have posts matching this query return status as false
    if (!$query->have_posts()) {
        $response['status'] = false;
        // remember to send an information about why it failed, always.
        $response['message'] = esc_attr__('No posts were found');

    } else {
        $response['status'] = true;
        // We will return the whole query to allow any customization on the front end
        $response['query'] = $query;
        $response->mockup = build_html_response($query->get_posts());
        //$response->coordinates_array = build_coordinates_response($query);
    }

    // Never forget to exit or die on the end of a WordPress AJAX action!
    exit(json_encode($response));
   // exit(json_encode($form_data));
}



















/***************/



// Actions

add_action('wp_ajax_bordoni_query_posts', 'custom_query_search_callback');
add_action('wp_ajax_nopriv_bordoni_query_posts', 'custom_query_search_callback');

/**
 * Load needed js and Css scripts.
 *
 * @since 1.0.0
 *
 */


/**
 * Custom Ajax CallBack.
 *
 * @since 1.0.0
 *
 * @return Json Response
 */
function custom_query_search_callback() {
    $response = array();
    // Never Use $_POST or $_GET variables without proper care Sanatization
    $query = new WP_Query(array(
        'posts_per_page' => absint($_POST['param1']),
        'post_type' => wp_kses($_POST['param2'], array()),
        'OTHER QUERY VAR HERE' => wp_kses($_POST['param3'], array()),
    ));

    // If we don't have posts matching this query return status as false
    if (!$query->have_posts()) {
        $response->status = false;
        // remember to send an information about why it failed, always.
        $response->message = esc_attr__('No posts were found');

    } else {
        $response->status = true;
        // We will return the whole query to allow any customization on the front end
        $response->query = $query;
        $response->mockup = build_html_response($query);
        $response->coordinates_array = build_coordinates_response($query);
    }

    // Never forget to exit or die on the end of a WordPress AJAX action!
    exit(json_encode($response));
}

/**
 * Build html response from the result query.
 *
 * @since 1.0.0
 *
 * @param $query_result WP_Query result to build the html response.
 * @return Html Output
 */
function build_html_response($query_result) {
    $mockup = "";
    // Your code here to build html response..
    return $mockup;
}

/**
 * Build coordinates array response from the result query.
 *
 * @since 1.0.0
 *
 * @param $query_result WP_Query result to build the coordinates array.
 * @return array
 */
function build_coordinates_response($query_result) {
    $coordinates = array();
    // Your code here to build coordinates array response..
    return $coordinates;
}

/*
* Shortcode
*/
function search_directory_shortcode($atts) {


    $data = array('custom_query_search_callback' => get_site_url() . '/custom_query_search_callback');
    wp_localize_script('search-directory', 'search_directory', $data);

    $data_needed = array(); // Do Something for get infomation needed for the template.

    // Return output
    include(dirname(__FILE__) . '/../search-child-care-form.php');
}

add_shortcode('search_directory', 'search_directory_shortcode');