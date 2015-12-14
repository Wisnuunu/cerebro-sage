<?php
/**
 * Template Name: Custom Login Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php //get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>


<div class="container login-form">
<div class="login-wrapper">

	<div class="login-form-container">

		<h3 id="title">Sign In</h3>
		<?php //echo wp_login_url(); ?>
		<div>
		    <form class="form-signin form-horizontal" method="post" action="<?php echo wp_login_url(); ?>">

            <div class="login-username form-group">
		            <label class="control-label col-sm-2" for="user_login"><?php _e( 'Email', 'personalize-login' ); ?></label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="log" id="user_login" placeholder="Enter Username">
                </div>
		        </div>

            <div class="login-remember form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="forever" name="rememberme"> Remember me
                  </label>
                </div>
              </div>
            </div>

		        <div class="login-password form-group">
		            <label class="control-label col-sm-2" for="user_pass"><?php _e( 'Password', 'personalize-login' ); ?></label>
                <div class="col-sm-10">
                  <input class="form-control" type="password" name="pwd" id="user_pass" placeholder="Enter password">
                </div>
		        </div>

            <div class="login-forgot form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <p>
                  <a href="<?php echo wp_lostpassword_url(); ?>">Forgot Password?</a>
                </p>
              </div>
            </div>

		        <!-- <p class="checkbox login-remember">
		        	<label>
		        		<input class="checkbox" id="rememberme" type="checkbox" value="forever" name="rememberme"></input>
		        		Remember Me
		        	</label>
		        </p> -->
		        <div class="login-submit form-group">
		            <input class="btn btn-default col-sm-12" type="submit" value="<?php _e( 'Sign In', 'personalize-login' ); ?>">
		        </div>

            <div class="divider">
              <p><span>OR</span></p>
            </div>
            <div class="login-submit form-group">
		            <a href="#" class="btn btn-fb col-sm-12">
                  <img src="<?php bloginfo('template_url'); ?>/assets/images/cb_fb-logo.png" alt="fb" /> Sign in With Facebook
                </a>
		        </div>
		    </form>
	    </div>

	    <!-- <div id="more-info">
    		<p class="forgot-password col-xs-6">Forgot password? <a href="<?php echo wp_lostpassword_url(); ?>">Click Here</a></p>
    		<p class="sign-up col-xs-6">Dont have account? <a href="<?php echo get_home_url().'/signup'; ?>">Sign up here</a> </p>
    	</div> -->

	 </div> <!--end login-form-container -->

</div> <!-- end login-wrapper -->

	<div class="login-form-error">

			<?php
				// $args = array(
				// 	'redirect' => home_url()
				// 	get_permalink( get_page( $page_id_of_member_area ) ),
				// 	'id_username' => 'user',
				// 	'id_password' => 'pass',

				// 	);

				// wp_login_form( $args );

				$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

				if ($login != '') {
					echo '<div class="alert alert-danger" role="alert">';
					echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
				}

				if ( $login === "failed" ) {
			    	echo '<span class="login-submitg"><strong>ERROR:</strong> Invalid username and/or password.</span>';
				} elseif ( $login === "empty" ) {
				    echo '<span class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</span>';
				} elseif ( $login === "false" ) {
				    echo '<span class="login-msg"><strong>ERROR:</strong> You are logged out.</span>';
				}

				if ($login != 0) {
					echo "</div>";
				}
			?>
	</div>

</div>

<?php //get_footer(); ?>
