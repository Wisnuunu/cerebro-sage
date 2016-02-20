<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',  // Scripts and stylesheets
  'lib/extras.php',  // Custom functions
  'lib/setup.php',   // Theme setup
  'lib/titles.php',  // Page titles
  'lib/wrapper.php'  // Theme wrapper class
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// JETPACK function for share buttons
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'loop_start', 'jptweak_remove_share' );
add_filter( 'jetpack_development_mode', '__return_true' );

// CUSTOM LOGIN PAGE - make wp login page can be acessed by admin only
function restrict_admin()
{
  if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
                wp_redirect( site_url() );
  }
}
//add_action( 'admin_init', 'restrict_admin', 1 );

function login_failed() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
    $login_page  = home_url( '/login/' );
    wp_redirect( $login_page . "?login=false" );
    exit;
}
add_action('wp_logout','logout_page');

function signup_redirect() {
    global $pagenow;
    $signup_page = home_url('/signup/');
    if ((strtolower($pagenow) == 'wp-login.php') && (strtolower($_GET['action']) == 'register')) {
        wp_redirect($signup_page);
    }
}
add_filter('init', 'signup_redirect');


// PAGINATION FUNCTION
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   *
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /**
   * We construct the pagination arguments to enter into our paginate_links
   * function.
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo; prev'),
    'next_text'       => __('next &raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}

// EXCERPT FUNCTION: manage maximum length
function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//CUSTOM ADMIN HEAD
function my_admin_head() {
  //<!-- custom date time picker  -->
  echo '<link href="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/build/css/bootstrap-datetimepicker.css" rel="stylesheet" />';
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>';
  echo '<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>';
  echo '<script src="http://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/v4.0.0/src/js/bootstrap-datetimepicker.js"></script>';
}
add_action('admin_head', 'my_admin_head');

// ADD EXTRE FIELD ON USER INFORMATION
add_action('show_user_profile', 'extra_user_profile_fields');
add_action('edit_user_profile', 'extra_user_profile_fields');
function extra_user_profile_fields($user)
{ ?>
  <hr>
  <h3><?php _e("Extra profile information", "blank"); ?></h3>
  <table class="form-table">
    <!-- gender -->
    <tr>
      <th><label for="gender"><?php _e("Gender"); ?></label></th>
      <td>
        <?php
        $cur_gender = esc_attr( get_the_author_meta( 'gender', $user->ID ) );
        if (!isset($cur_gender)) {
          echo '<input type="radio" name="gender" value="male">Male';
          echo '<input type="radio" name="gender" value="female">Female';
        }

        if ($cur_gender === 'male'):
        ?>
          <input type="radio" name="gender" value="male" checked="true" >Male
          <input type="radio" name="gender" value="female">Female
        <?php else : ?>
          <input type="radio" name="gender" value="male"  >Male
          <input type="radio" name="gender" value="female" checked="true">Female
        <?php endif; ?>
        <br><span class="description"><?php _e("Select provided gender"); ?></span>
      </td>
    </tr>
    <!-- date of birth -->
    <tr>
      <th><label for="birthday"><?php _e('Birthday'); ?></label></th>
      <td>
        <div class="input-group datetime datepicker" id="datetimepicker1">
          <input class="form-control make-datepicker" type="text" name="birthday" id="leaving_time" placeholder="dd/mm/yyyy" value="<?php echo esc_attr( get_the_author_meta( 'birthday', $user->ID ) ); ?>" class="regular-text">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-calendar"></i>
          </span>
        </div>
        <span class="description"><?php _e("Input date of birth") ?></span>
      </td>
    </tr>
    <!-- address -->
    <tr>
      <th><label for="address"><?php _e('Address') ?></label></th>
      <td>
        <textarea name="address" rows="3" cols="40"><?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?></textarea>
        <br><span class="description">Insert address</span>
      </td>
    </tr>
    <!-- phone -->
    <tr>
      <th><label for="phone"><?php _e('Phone') ?></label></th>
      <td>
        <input type="text" name="phone" placeholder="+62xxxxxxxx" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text">
        <br><span class="description">Insert phone numbers</span>
      </td>
    </tr>
    <!-- facebook(url) -->
    <tr>
      <th><label for="facebook"><?php _e('Facebook (URL)') ?></label></th>
      <td>
        <input type="url" name="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text">
        <br><span class="description">Link to facebook profile</span>
      </td>
    </tr>
    <!-- twitter url -->
    <tr>
      <th><label for="twitter"><?php _e('Twitter') ?></label></th>
      <td>
        <input type="url" name="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text">
        <br><span class="description">Link to twitter profile</span>
      </td>
    </tr>
    <!--  google+ -->
    <tr>
      <th><label for="googlep"><?php _e('Google+') ?></label></th>
      <td>
        <input type="text" name="googlep" value="<?php echo esc_attr( get_the_author_meta( 'googlep', $user->ID ) ); ?>" class="regular-text">
        <br><span class="description">Link to Google+ profile</span>
      </td>
    </tr>
  </table>

  <hr>

<?php }

add_action('personal_options_update', 'save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields($user_id)
{
  if (!current_user_can('edit_user', $user_id)) {return false;}

  update_usermeta($user_id, 'gender', $_POST['gender']);
  update_usermeta($user_id, 'birthday', $_POST['birthday']);
  update_usermeta($user_id, 'address', $_POST['address']);
  update_usermeta($user_id, 'phone', $_POST['phone']);
  update_usermeta($user_id, 'facebook', $_POST['facebook']);
  update_usermeta($user_id, 'twitter', $_POST['twitter']);
  update_usermeta($user_id, 'googlep', $_POST['googlep']);
}

/**
 * Get excerpt from string
 *
 * @param String $str String to get an excerpt from
 * @param Integer $startPos Position int string to start excerpt from
 * @param Integer $maxLength Maximum length the excerpt may be
 * @return String excerpt
 */
function getExcerpt($str, $startPos=0, $maxLength=60) {
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength-3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}

	return $excerpt;
}

// limiting wp admin to certain role
add_action( 'init', 'blockusers_init' );
function blockusers_init() {
  if ( is_admin() && ! current_user_can( 'administrator' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
    wp_redirect( home_url() );
    exit;
  }
}

//remmove admin bar except administrator
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}

function get_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}
?>
