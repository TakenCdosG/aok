<?php
/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */

function registration_form( $username, $password, $email, $role ) {
    echo '
    <div class="register">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
        </div>
        <div>
        <label for="password">Password</label>
        <input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
        </div>
        <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '" required>
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
        $user_data = array(
            'user_login'    =>  $username,
            'user_email'    =>  $email,
            'user_pass'     =>  $password,
            'role'      =>  "$role",
        );
        $user = wp_insert_user( $user_data );
        if(!is_wp_error($user)){
            wp_set_current_user($user); // set the current wp user
            wp_set_auth_cookie($user); // start the cookie for the current registered user
        }
        $redirect_to = $_GET['redirect_to'];
        echo '<div class="register_message">Registration complete.</div>';
    }
}

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

// Register a new shortcode: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');
// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}