<?php

function registration_form($first_name, $last_name, $email, $agree ) {
    echo '<div class="register-content-block">';
    if (have_posts()) :
            while (have_posts()) :
                    the_post();
                    the_content();
            endwhile;
    endif;
    echo '</div>';
    echo '
    <div class="register">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">

        <input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '" required hidden> 
        <div class="block">
            <div class="block">
                <div class="block">
                    How did you hear about the Provider Showcase (optional)?
                </div>
                <div class="block">
                    <select name="referrer[]" id="referrer" multiple> 
                    <option>All Our Kin Staff Member</option> 
                    <option>Online Search</option> 
                    <option>Word of Mouth</option>
                    <option>Employer</option>
                    <option>Non-profit Organization/Community Organization</option> 
                    </select>
                </div>
                <div class="block">
                    Other:
                    <input name="other-referrer" id="other-referrer" type="text"/>
                </div>
            </div class="block">    
            <div class="block">
                <div class="block">
                    Please check the description that most accurately represents you (optional)?
                </div>
                <div class="block">
                    Select 1 Option: 
                </div>
                <div class="block">
                    <select name="subscriber-description" id="subscriber-description">
                    <option></option>
                    <option>Parent or Guardian</option>
                    <option>Family Child Care Provider</option>
                    <option>Employer</option>
                    <option>Non-profit Organization/Community Organization</option>
                    </select>
                </div>
                <div class="block">
                    Other:
                    <input name="other-subscriber-description" id="subscriber-other-description" type="text"/>
                </div>
            </div>
        </div>          
        <div>        
        <label for="agree" class="agree">Accept <a class="fancybox" href="#termsAndConditions">Terms & Conditions</a></label> <input type="checkbox" name="agree" value="agree">      
        </div>
        
        <div id="termsAndConditions" style="display:none;">
        <h2>Terms & Conditions</h2>
        By clicking the acceptance button below, you acknowledge that you understand that this site provides child care resource information only. The information contained on this site has been provided by the listed providers and is not independently verified by All Our Kin.  The information is submitted and reviewed by All Our Kin periodically.  Accordingly, information contained on this site may not be current.  All Our Kin or its subcontractors do not warrant any information concerning any child care provider, nor do they inspect, investigate, endorse, or recommend, any particular provider. The inclusion of any care provider’s name does not constitute endorsement or certification by All Our Kin as to their qualifications to provide child care, the rates charged for services, or any other aspect of individual program’s quality of care. You are solely responsible for reviewing and selecting a provider that is right for your family.  Any complaints or problems regarding a provider should be directed to the caregiver and/or the State of Connecticut Office of Early Childhood.
        </div>
        
        <input type="submit" class="ajax" name="submit" value="Submit"/>
        <div>
        <p class="form-note">By registering, you represent that you have read, understood and agree to these terms.</p>
        </div>
        </form>
    </div>
    ';
}

function registration_validation($first_name, $last_name, $email, $agree )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

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

    global $reg_errors,$first_name, $last_name, $email,$user;

    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $date = new DateTime();

        $user_data = array(
            'user_login'    =>  $email,
            'user_email'    =>  $email,
            'user_pass'     =>  $date->getTimestamp(),
            'first_name'    =>  $first_name,
            'last_name'     =>  $last_name,
            'role'      =>  "subscriber",
        );

        $user = wp_insert_user( $user_data );

        if(!is_wp_error($user)){
            wp_set_current_user($user); // set the current wp user
            wp_set_auth_cookie($user); // start the cookie for the current registered user
        }
        
        $post_referrer = $_POST['referrer'];
        $other_referrer = $_POST['other-referrer'];
        $other_description = $_POST['other-subscriber-description'];
        $referrer ="";
        
        foreach ($post_referrer as $value) {
            $referrer .= $value."\n";
        }
        $referrer .= $other_referrer;
        $description = $_POST['subscriber-description']."\n".$other_description;
       
        update_user_meta($user, 'referrer', $referrer);
        update_user_meta($user, 'subscriber-description', $description);

        //echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';

        //$redirect_to = $_GET['redirect_to'];
        //echo '<div class="register_message">Registration complete.</div>';
    }
}

function custom_registration_function() {

    //var_dump($_POST['submit']);
    if (true) {


        registration_validation(
            $_POST['fname'],
            $_POST['lname'],
            $_POST['email'],
            $_POST['agree']
        );

        // sanitize user form input
        global $first_name, $last_name, $email;
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
        $email      =   sanitize_email($_POST['email']);
        $agree      =   $_POST['agree'];
        

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
            $first_name,
            $last_name,
            $email,
            $agree
        );
    }

    registration_form(
        $first_name,
        $last_name,
        $email,
        $agree
    );

}

function custom_login_message() {
    //login message;
    set_transient( 'temporary_message',  '<h4>You have successfully signed in.</h4>' , 60*60*12 );
}

add_filter( 'wp_authenticate', 'custom_login_message' );

function custom_registration_redirect() {
    //session_start();
    set_transient( 'temporary_message',  '<h4>You have successfully signed in.</h4>' , 60*60*12 );
    wp_redirect(home_url('/find-child-care'));
}

add_filter( 'user_register', 'custom_registration_redirect' );