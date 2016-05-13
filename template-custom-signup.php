<?php
/**
 * Template Name: Custom Signup Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php //get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<!-- <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" />  -->

<div class="container">
  <div class="login-wrapper">

    <div class="signup-form">

      <h3 id="title">Sign Up</h3>
      <form class="form-signup form-horizontal" method="post">

        <div class="signup-username form-group">
          <label class="control-label col-sm-4">User Name</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" value="" name="username" id="username" placeholder="Username" />
          </div>
        </div>
        <!-- <p class="sr-only"><label>Last Name</label></p>
        <p><input type="text" value="" name="last_name" id="last_name" /></p> -->
        <div class="signup-name form-group">
          <label class="control-label col-sm-4">First Name</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" value="" name="first_name" id="first_name" placeholder="Full Name"/>
          </div>
        </div>

        <div class="signup-email form-group">
          <label class="control-label col-sm-4">Email</label>
          <div class="col-md-8">
            <input class="form-control" type="email" value="" name="email1" id="email1" placeholder="Email" />
          </div>
        </div>

        <div class="signup-password form-group">
          <label class="control-label col-sm-4">Password</label>
          <div class="col-md-8">
            <input class="form-control" type="password" value="" name="pwd1" id="pwd1" placeholder="Password" />
          </div>
        </div>

        <div class="signup-password form-group">
          <label class="control-label col-sm-4">Re-type Password</label>
          <div class="col-md-8">
            <input class="form-control" type="password" value="" name="pwd2" id="pwd2" placeholder="Password" />
          </div>
        </div>

        <!-- <p class="sr-only"><label>Password</label></p>
        <div class="row">
          <div class="col-md-6">
            <p><input class="form-control" type="password" value="" name="pwd1" id="pwd1" placeholder="Password" /></p>
          </div>
          <div class="col-md-6">
            <p><input class="form-control" type="password" value="" name="pwd2" id="pwd2" placeholder="Re-type Password"/></p>
          </div>
        </div> -->

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <label class="radio-inline">
              <input class="gender-m" value="male" type="radio" name="gender">Male
            </label>
            <label class="radio-inline">
              <input class="gender-f" value="female" type="radio" name="gender">Female
            </label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-2" style="line-height:2">
            Birthday
          </div>
          <div class="col-sm-6">
            <div class="input-group datetime datepicker" id="datetimepicker1">
              <input class="form-control make-datepicker" type="text" name="birthday" id="leaving_time">
              <span class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </span>
            </div>
          </div>
        </div>

        <p id="term-police">By hitting submit and registering an acoount, you have read and agree to the <a href="">Network Terms of Sevice</a> & <a href="">Privacy Police</a> </p>

        <div id="button">
          <button class="btn btn-primary" type="submit" name="btnregister" class="button" >Sign Up</button>
          <input type="hidden" name="task" value="register" />
        </div>

        <div class="divider">
          <p><span>OR</span></p>
        </div>
        <div class="signup-fb">
          <a class="btn btn-fb col-sm-12" href="http://www.cerebro.dev/wp-login.php?loginFacebook=1&redirect=http://www.cerebro.dev" onclick="window.location = 'http://www.cerebro.dev/wp-login.php?loginFacebook=1&redirect='+window.location.href; return false;">
            <!-- Click here to login or register with Facebook -->
            <img src="<?php bloginfo('template_url'); ?>/assets/images/cb_fb-logo.png" alt="fb" /> Sign In With Facebook
          </a>
        </div>

      </form>

    </div> <!-- end signup form -->
  </div> <!-- end wrapper -->
</div> <!-- end container -->
	<?php
		$err = '';
		$success = '';

		global $wpdb, $PasswordHash, $current_user, $user_ID;

		if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
			$pwd1 = $wpdb->escape(trim($_POST['pwd1']));
	        $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
	        $first_name = $wpdb->escape(trim($_POST['first_name']));
	        // $last_name = $wpdb->escape(trim($_POST['last_name']));
	        $email = $wpdb->escape(trim($_POST['email1']));
	        $username = $wpdb->escape(trim($_POST['username']));
	        $genderBod = $wpdb->escape(trim($_POST['gender']))." ".$wpdb->escape(trim($_POST['birthday']));

	        //echo $email."1 ".$pwd1."2 ".$pwd2."3 ".$username."4 ".$first_name."5 ".$genderBod;

	        if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $genderBod == ""/*|| $last_name == ""*/) {
	            $err = 'Please don\'t leave the required fields.';
	        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	            $err = 'Invalid email address.';
	        } else if(email_exists($email) ) {
	            $err = 'Email already exist.';
	        } else if($pwd1 <> $pwd2 ){
	            $err = 'Password doesn\'t match.';
	        // } else if ($email1 <> $email2 ){
	        // 	$err = 'Email doesn\'t match';
	        } else {

	            $user_id = wp_insert_user(
	            	array (
	            		'first_name' => apply_filters('pre_user_first_name', $first_name),
	            		//'last_name' => apply_filters('pre_user_last_name', $last_name),
	            		'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
	            		'user_login' => apply_filters('pre_user_user_login', $username),
	            		'user_email' => apply_filters('pre_user_user_email', $email),
	            		'description' => apply_filters('pre_user_description', $genderBod),
	            		'role' => get_option('default_role') ) );

	            if( is_wp_error($user_id) ) {
	                $err = 'Error on user creation.';
	            } else {
	                do_action('user_register', $user_id);

	                $success = 'You\'re successfully register';
	            }

	        }

		}
	?>

	<!--display error/success message-->
  <div id="message">

      <?php
          if(!empty($err) ) :
          	echo'<div class="alert alert-danger">';
              echo '<p class="error"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">&nbsp</span>'.$err.'</p>';
              echo '</div>';
          endif;
      ?>

      <?php
          if(! empty($success) ) : ?>
          	<div class="alert alert-success">
              	<p class="error"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true">&nbsp</span> You're successfully registered</p>
              	<p>page will be automatically redirect in <span id="timer">10</span> sec</p>
              </div>
              <script type="text/javascript">
      					var url ='<?php echo get_home_url()."/login"; ?>';
      					var delay = 10;
      					var d = delay * 1000;
      					window.setTimeout ('parent.location.replace(url)', d);
      				</script>
      <?php endif; ?>

  </div>  <!-- end error message -->

</div><!-- end container -->

<?php //get_footer(); ?>

<script type="text/javascript">

	$(function () {
        $('#datetimepicker1').datetimepicker({
        	format: 'DD/MM/YYYY'
        });
    });
</script>
