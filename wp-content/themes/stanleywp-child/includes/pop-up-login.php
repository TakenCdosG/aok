<div class="messagepop pop-l">
    <div class="row border-bottom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h2>Login</h2></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a class="close-l" href="/">(close)</a></div>
    </div>
    <?php
    $args = array(
        'echo'           => true,
        'remember'       => false,
        /*'redirect'       => site_url( '/find-child-care' ),*/
        'form_id'        => 'loginform',
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Login' ),
        'value_username' => '',
        'value_remember' => false
    );
    echo "<div class='register-switch'><a id ='register-click' href='/register'>Don't have an account?, Sign up!</a></div>";
    wp_login_form( $args );
    echo '<a href="'.wp_lostpassword_url( $redirect ).'">Forgot Password?</a>';
    ?>
</div>