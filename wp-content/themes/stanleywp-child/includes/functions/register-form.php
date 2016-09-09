<?php
/*
  Plugin Name: Custom Registration
  Plugin URI: http://code.tutsplus.com
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */

function registration_form( $username, $password, $first_name, $last_name, $email, $agree ) {
    echo '
    <div class="register">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        
        <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '" required>
        </div>
        
        <div>
        <label for="password">Password</label>
        <input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '" required>
        </div>
        
        <div>
        <label for="firstname">First Name</label>
        <input type="text" name="fname" value="' . ( isset( $_POST['fname']) ? $first_name : null ) . '" required>
        </div>
         
        <div>
        <label for="lastname">Last Name</label>
        <input type="text" name="lname" value="' . ( isset( $_POST['lname']) ? $last_name : null ) . '" required>
        </div>
        
        <div>
        <label for="email">Email</label>
        <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '" required>
        </div>
        
        <div>        
        <label for="agree" class="agree">Accept <a class="fancybox" href="#termsAndConditions">Terms & Conditions</a></label> <input type="checkbox" name="agree" value="agree">      
        </div>
        
        <div id="termsAndConditions" style="display:none;">
        <h2>Terms & Conditions</h2>
        By clicking the acceptance button below, you acknowledge that you understand that this site provides child care resource information only. The information contained on this site has been provided by the listed providers and is not independently verified by All Our Kin.  The information is submitted and reviewed by All Our Kin periodically.  Accordingly, information contained on this site may not be current.  All Our Kin or its subcontractors do not warrant any information concerning any child care provider, nor do they inspect, investigate, endorse, or recommend, any particular provider. The inclusion of any care provider’s name does not constitute endorsement or certification by All Our Kin as to their qualifications to provide child care, the rates charged for services, or any other aspect of individual program’s quality of care. You are solely responsible for reviewing and selecting a provider that is right for your family.  Any complaints or problems regarding a provider should be directed to the caregiver and/or the State of Connecticut Office of Early Childhood.
        </div>
        
        <input type="submit" class="ajax" name="submit" value="Register"/>
        <div>
        <p class="form-note">By registering, you represent that you have read, understood and agree to these terms.</p>
        </div>
        </form>
    </div>
    ';
}
function registration_validation( $username, $password, $first_name, $last_name, $email, $agree )  {
    global $reg_errors;
    $reg_errors = new WP_Error;
    if ( empty( $username ) || empty( $password ) || empty( $first_name ) || empty( $last_name ) || empty( $email ) ) {
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

    if ( $agree != 'agree') {
        $reg_errors->add('agree', 'You have to check "Accept Terms & Conditions');
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
    global $reg_errors, $username, $password, $first_name, $last_name, $email,$user;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $user_data = array(
            'user_login'    =>  $username,
            'user_email'    =>  $email,
            'user_pass'     =>  $password,
            'first_name'    =>  $first_name,
            'last_name'     =>  $last_name,
            'role'      =>  "subscriber",
        );

        $user = wp_insert_user( $user_data );

        if(!is_wp_error($user)){
            wp_set_current_user($user); // set the current wp user
            wp_set_auth_cookie($user); // start the cookie for the current registered user
        }

        //echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';

        //$redirect_to = $_GET['redirect_to'];
        //echo '<div class="register_message">Registration complete.</div>';
    }
}

function custom_registration_function() {


    if (isset($_POST['submit'])) {

        registration_validation(
            $_POST['username'],
            $_POST['password'],
            $_POST['fname'],
            $_POST['lname'],
            $_POST['email'],
            $_POST['agree']
        );

        // sanitize user form input
        global $username, $password, $first_name, $last_name, $email;
        $username   =   sanitize_user($_POST['username']);
        $password   =   esc_attr($_POST['password']);
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
        $email      =   sanitize_email($_POST['email']);
        $agree      =   $_POST['agree'];


        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
            $username,
            $password,
            $first_name,
            $last_name,
            $email,
            $agree
        );
    }
    registration_form(
        $username,
        $password,
        $first_name,
        $last_name,
        $email,
        $agree
    );

}

function custom_login_message() {
    //login message;
    set_transient( 'temporary_message',  '<h4>You have successfully signed in.</h4>' , 60*60*12 );
    wp_redirect(home_url('/find-child-care'));
}

add_filter( 'wp_authenticate', 'custom_login_message' );

function custom_registration_redirect() {
    //session_start();
    set_transient( 'temporary_message',  '<h4>You have successfully signed in.</h4>' , 60*60*12 );
    wp_redirect(home_url('/find-child-care'));
}

add_filter( 'user_register', 'custom_registration_redirect' );