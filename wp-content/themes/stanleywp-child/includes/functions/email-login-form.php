<?php


add_action('wp_ajax_email_login_form','email_login_form_callback');
add_action('wp_ajax_nopriv_email_login_form','email_login_form_callback');

function email_login_form_callback(){

    $response = array();
    parse_str($_POST['formData'], $form_data);
    $response['user_exists'] = false;

    if(!empty($form_data['email'])){

        $user_query = new WP_User_Query( array( 'role' => 'Subscriber','search' => $form_data['email']) );
        $user = $user_query->get_results();
        $user_total = $user_query->get_total();
        //$user_total = 0;
        if($user_total > 0){
            wp_set_current_user($user[0]->data->ID); // set the current wp user
            wp_set_auth_cookie($user[0]->data->ID); // start the cookie for the current registered user
            $response['user_exists'] = true;
        }else{
            $response['user_exists'] = false;
        }


        //TESTING
        $response['email'] = $form_data['email'];
        //$response['user'] = var_dump($user[0]->data->ID);

    }

    exit(json_encode($response));
}