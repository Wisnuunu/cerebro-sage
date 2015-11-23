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

	<div class="login-form-container">

		<h3 id="title">Sign In</h3>
		<?php //echo wp_login_url(); ?>
		<div>
		    <form class="form-signin" method="post" action="<?php echo wp_login_url(); ?>">
		        <p class="login-username">
		            <label class="sr-only" for="user_login"><?php _e( 'Email', 'personalize-login' ); ?></label>
		            <input class="form-control" type="text" name="log" id="user_login" placeholder="Enter Username">
		        </p>
		        <p class="login-password">
		            <label class="sr-only" for="user_pass"><?php _e( 'Password', 'personalize-login' ); ?></label>
		            <input class="form-control" type="password" name="pwd" id="user_pass" placeholder="Enter password">
		        </p>
		        <p class="checkbox login-remember">
		        	<label>
		        		<input class="checkbox" id="rememberme" type="checkbox" value="forever" name="rememberme"></input>
		        		Remember Me		        		
		        	</label>
		        </p>
		        <p class="login-submit">
		            <input class="btn btn-primary" type="submit" value="<?php _e( 'Sign In', 'personalize-login' ); ?>">
		        </p>
		    </form>
	    </div>

	    <div id="more-info">
    		<p class="forgot-password col-xs-6">Forgot password? <a href="#">Click Here</a></p>
    		<p class="sign-up col-xs-6">Dont have account? <a href="<?php echo get_home_url().'/signup'; ?>">Sign up here</a> </p>
    	</div>
	   
	</div>

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