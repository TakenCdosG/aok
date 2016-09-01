<?php
function adding_search_resources() {

    if(is_page_template( 'templates/template-search-child-care.php' ) ){
        wp_enqueue_script( 'multiples-selec-js', get_stylesheet_directory_uri() .'/includes/js/multiple-select/multiple-select.js');
        wp_enqueue_style( 'multiples-selec-css', get_stylesheet_directory_uri() .'/includes/js/multiple-select/multiple-select.css');
        wp_enqueue_script( 'search-child-care', get_stylesheet_directory_uri() .'/includes/js/search-child-care.js',array(), false, true );
        wp_enqueue_script( 'pop-up-login', get_stylesheet_directory_uri() .'/includes/js/pop-up-login.js');
        wp_enqueue_script( 'mapgooglema', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyD8gQGcG1dHoyC_99gy-Vvus4XAXHCN2oE&',array(),false,true);

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
        'role' => 'Contributor',
        'meta_query' => array(
            'relation' => 'AND',
        )
    );

    if(!empty($form_data['first_name'])){
        $args['meta_query'][] = array(
            'key'   => 'first_name',
            'value'   => $form_data['first_name'],
            'compare' => 'LIKE'
        );
    }

    if(!empty($form_data['last_name'])){
        $args['meta_query'][] = array(
            'key'   => 'last_name',
            'value'   => $form_data['last_name'],
            'compare' => 'LIKE'
        );
    }

    if(!empty($form_data['child_care_name'])){
        $args['meta_query'][] = array(
            'key'   => 'child_care_name',
            'value'   => $form_data['child_care_name'],
            'compare' => 'LIKE'
        );
    }

    if(!empty($form_data['p_ages_served'])){
        $args['meta_query'][] = array(
            'key'   => 'p_ages_served',
            'value'   => $form_data['p_ages_served'],
            'compare' => '='
        );
    }

    if(!empty($form_data['zip_code'])){
        $args['meta_query'][] = array(
            'key'   => 'zip_code',
            'value'   => $form_data['zip_code'],
            'compare' => '='
        );
    }


    $args['meta_query'][100] = array(
        'relation' => 'OR',

    );
        foreach ($form_data['p_language_spoken'] as $key => $value){
            $args['meta_query'][100][] = array(
                'key'   => 'p_language_spoken',
                'value'   => $value,
                'compare' => 'LIKE'
            );
        }

    if(!empty($form_data['current_openings'])){
        $args['meta_query'][] = array(
            'key'   => 'current_openings',
            'value'   => $form_data['current_openings'],
            'compare' => '='
        );
    }

    if(!empty($form_data['open_on_evenings'])){
        $args['meta_query'][] = array(
            'key'   => 'open_on_evenings',
            'value'   => $form_data['open_on_evenings'],
            'compare' => '='
        );
    }

    if(!empty($form_data['open_on_weekends'])){
        $args['meta_query'][] = array(
            'key'   => 'open_on_weekends',
            'value'   => $form_data['open_on_weekends'],
            'compare' => '='
        );
    }

    if(!empty($form_data['accept_care4kids'])){
        $args['meta_query'][] = array(
            'key'   => 'accept_care4kids',
            'value'   => $form_data['accept_care4kids'],
            'compare' => '='
        );
    }

    if(!empty($form_data['certified_to_administer_medication'])){
        $args['meta_query'][] = array(
            'key'   => 'certified_to_administer_medication',
            'value'   => $form_data['certified_to_administer_medication'],
            'compare' => '='
        );
    }


    $user_query = new WP_User_Query($args);

    // If we don't have posts matching this query return status as false
    if ($user_query->get_total() == 0) {
        $response['status'] = false;
        // remember to send an information about why it failed, always.
        $response['mockup'] = esc_attr__('No posts were found');

    } else {
        $response['status'] = true;
        // We will return the whole query to allow any customization on the front end
        $response['query'] = $user_query;
        $response['mockup'] = build_html_response($user_query);
        $response['map_marker_information'] = build_map_marker_information($user_query);
    }

    // Never forget to exit or die on the end of a WordPress AJAX action!
   exit(json_encode($response));
   //exit(json_encode($form_data));
    //print_r($args);
}


/**
 * Build html response from the result query.
 *
 * @since 1.0.0
 *
 * @param $query_result WP_Query result to build the html response.
 * @return Html Output
 */
function build_html_response($user_query) {
    $mockUp = '';
    $count_results = 0;

    if( ! empty( $user_query->results ) ) {
        $mockUp .= '<div class="row">';
        $mockUp .= '<div class="count-results col-xs-12">';
        $mockUp .= $user_query->get_total().' results found';
        $mockUp .= '</div>';

        foreach ($user_query->results as $user) {

            $mockUp .= '<div class="col-lg-4">';
            $mockUp .= '<div class="result-item">';
            $mockUp .= '<a href="'.get_author_posts_url( $user->ID ).'">';
            $mockUp .= '<div style="width:100%; height:250px; background-size:cover; background-position:center; background-image:url(' . get_field("p_gallery","user_".$user->ID) . ')"></div>';
            $mockUp .= '<div class="result-title">';
            $mockUp .= get_field('child_care_name','user_'.$user->ID).$user->ID;
            $mockUp .= '</div>';
            $mockUp .= '</a>';



            $mockUp .= '</div>';
            $mockUp .= '</div>';

            $count_results++;
        }



        $mockUp .= '</div>';
    }

    return $mockUp;
}

/**
 * Build coordinates array response from the result query.
 *
 * @since 1.0.0
 *
 * @param $query_result WP_Query result to build the coordinates array.
 * @return array
 */
function build_map_marker_information($user_query) {
    $map_marker_information = array();

    if( ! empty( $user_query->results ) ) {


        foreach ($user_query->results as $user) {
            $map_marker_information[$user->ID]['latLng'] = get_field('location','user_'.$user->ID);
            $map_marker_information[$user->ID]['markerInformation'] = "<div class='content-information'><h3>".get_field('child_care_name','user_'.$user->ID)."</h3>";
            $map_marker_information[$user->ID]['markerInformation'] .= "<p><b>Direction: </b>". $map_marker_information[$user->ID]['latLng']['address']."</p>";
            $map_marker_information[$user->ID]['markerInformation'] .= "</div>";

        }


    }
    return $map_marker_information;
}

/*
* Shortcode
*/
function search_child_care_shortcode($atts) {


    $data = array('custom_query_search_callback' => get_site_url() . '/custom_query_search_callback');
    wp_localize_script('search-directory', 'search_directory', $data);

    $data_needed = array(); // Do Something for get infomation needed for the template.

    // Return output
    include(dirname(__FILE__) . '/../search-child-care-form.php');
}

add_shortcode('search_child_care', 'search_child_care_shortcode');

















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
        //$response->coordinates_array = build_coordinates_response($query);
    }

    // Never forget to exit or die on the end of a WordPress AJAX action!
    exit(json_encode($response));
}

