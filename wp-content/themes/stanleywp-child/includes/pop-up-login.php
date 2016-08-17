
<div class="messagepop pop-r">
		<div class="row border-bottom">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h2>Register</h2></div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a class="close-r" href="/">(close)</a></div>
		</div>
		<?php echo do_shortcode('[cr_custom_registration]'); ?>
</div>
<div class="messagepop pop-l">
    <div class="row border-bottom">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><h2>Login</h2></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a class="close-l" href="/">(close)</a></div>
    </div>
    <?php
    $args = array(
        'echo'           => true,
        'remember'       => false,
        'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
        'form_id'        => 'loginform',
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Login' ),
        'value_username' => 'Insert your username',
        'value_remember' => false
    );
    echo "<div class='register-switch'><a id ='register-click' href='#'>Don't have an account?, Sign up!</a></div>";
    wp_login_form( $args );
    echo '<a href="'.wp_lostpassword_url( $redirect ).'">Forgot Password?</a>';
    ?>
</div>