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

    global $wpdb;

    /*
     * Define variables
     */

    $range       = 5; // Range within x miles, default is 10
    $search_lat  = $_POST['zipCodeLatLng']['lat']; // Latitude
    $search_lng  = $_POST['zipCodeLatLng']['lng']; // Longitude
    $table_name = $wpdb->prefix . 'my_geodata';

    /*
     * Construct basic SQL query
     * Query will return all posts sorted by post title
     */
    $sql_query  = "SELECT u.ID, u.user_login, g.lat, g.lng FROM";
    $sql_join   = " wp_users u INNER JOIN wp_usermeta m ON m.user_id = u.ID INNER JOIN ".$table_name." g ON u.ID = g.user_id";
    $sql_where  = " WHERE 1=1 AND (m.meta_key = 'wp_capabilities' AND m.meta_value LIKE '%Contributor%')";

    if(!empty($form_data['first_name'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m1 ON m1.user_id = u.ID";
        $sql_where .= " AND (m1.meta_key = 'first_name' AND m1.meta_value LIKE '%".$form_data['first_name']."%')";
    }

    if(!empty($form_data['last_name'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m2 ON m2.user_id = u.ID";
        $sql_where .= " AND (m2.meta_key = 'last_name' AND m2.meta_value LIKE '%".$form_data['last_name']."%')";
    }

        if(!empty($form_data['child_care_name'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m3 ON m3.user_id = u.ID";
        $sql_where .= " AND (m3.meta_key = 'child_care_name' AND m3.meta_value LIKE '%".$form_data['child_care_name']."%')";
    }

    if(!empty($form_data['p_ages_served'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m4 ON m4.user_id = u.ID";
        $sql_where .= " AND (m4.meta_key = 'p_ages_served' AND m4.meta_value = '".$form_data['p_ages_served']."')";
    }

    if(!empty($form_data['p_language_spoken'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m5 ON m5.user_id = u.ID";
        $sql_where .= " AND (m5.meta_key = 'p_language_spoken' AND";

        $sql_where .= " (";
        foreach ($form_data['p_language_spoken'] as $key => $value){
            $sql_where .= "m5.meta_value LIKE '%".$value."%'";
            if(count($form_data['p_language_spoken']) >$key+1){
                $sql_where .= " OR ";
            }
        }
        $sql_where .= "))";

        //$sql_where .= " AND (m5.meta_key = 'p_language_spoken' AND m5.meta_value = '".$form_data['p_language_spoken']."')";
    }

    if(!empty($form_data['current_openings'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m6 ON m6.user_id = u.ID";
        $sql_where .= " AND (m6.meta_key = 'current_openings' AND m6.meta_value = '".$form_data['current_openings']."')";
    }

    if(!empty($form_data['open_on_evenings'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m7 ON m7.user_id = u.ID";
        $sql_where .= " AND (m7.meta_key = 'open_on_evenings' AND m7.meta_value = '".$form_data['open_on_evenings']."')";
    }

    if(!empty($form_data['open_on_weekends'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m8 ON m8.user_id = u.ID";
        $sql_where .= " AND (m8.meta_key = 'open_on_weekends' AND m8.meta_value = '".$form_data['open_on_weekends']."')";
    }

    if(!empty($form_data['accept_care4kids'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m9 ON m9.user_id = u.ID";
        $sql_where .= " AND (m9.meta_key = 'accept_care4kids' AND m9.meta_value = '".$form_data['accept_care4kids']."')";
    }

    if(!empty($form_data['certified_to_administer_medication'])){
        $sql_join .= " INNER JOIN wp_usermeta AS m10 ON m10.user_id = u.ID";
        $sql_where .= " AND (m10.meta_key = 'certified_to_administer_medication' AND m10.meta_value = '".$form_data['certified_to_administer_medication']."')";
    }

     /*
     * If latitude and longitude are defined expand the SQL query
     */
    if( $search_lat && $search_lng ) {
        /*
         * Calculate range
             * Function will return minimum and maximum latitude and longitude
         */
        $minmax = bar_get_nearby( $search_lat, $search_lng, 0, $range );

        /*
         * Update SQL query
         */
        $sql_where .= " AND ( (g.lat BETWEEN '$minmax[min_latitude]' AND '$minmax[max_latitude]') AND (g.lng BETWEEN '$minmax[min_longitude]' AND '$minmax[max_longitude]') ) ";
    }

    /*
     * Construct SQL query and get results
     */
    $sql   = $sql_query . $sql_join . $sql_where;

    $user_query = $wpdb->get_results($sql, OBJECT);
   //var_dump($sql );
$response['sql'] = $sql;

    // If we don't have posts matching this query return status as false
    if ($user_query) {
        $response['status'] = true;
        // We will return the whole query to allow any customization on the front end
        //$response['query'] = $user_query;
        $response['mockup'] = build_html_response($user_query);
        $response['map_marker_information'] = build_map_marker_information($user_query);
        $response['message'] = count($user_query).' results found';

    } else {

        $response['status'] = false;
        // remember to send an information about why it failed, always.
        $response['message'] = esc_attr__('No posts were found');
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
function build_html_response($user_query) {

    $mockUp = '';

    if( ! empty( $user_query ) ) {

        foreach ($user_query as $user) {

            $mockUp .= '<div class="col-lg-4">';
            $mockUp .= '<div class="result-item">';
            $mockUp .= '<a href="'.get_author_posts_url( $user->ID ).'">';
            $mockUp .= '<div style="width:100%; height:250px; background-size:cover; background-position:center; background-image:url(' . get_field("p_gallery","user_".$user->ID)[0]['url'] . ')"></div>';
            $mockUp .= '<div class="result-title">';
            $mockUp .= get_field('child_care_name','user_'.$user->ID).$user->ID;
            $mockUp .= '</div>';
            $mockUp .= '</a>';
            $mockUp .= '</div>';
            $mockUp .= '</div>';

        }

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

    if( ! empty( $user_query ) ) {

        foreach ($user_query as $user) {
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

    include(dirname(__FILE__) . '/../search-child-care-form.php');
}

add_shortcode('search_child_care', 'search_child_care_shortcode');




