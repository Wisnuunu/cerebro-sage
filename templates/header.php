<header id="navigation">
    <!-- <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div><!--  end navbar header -->

        <div id="navbar" class="navbar-collapse collapse">
          <div class="nav-container">
            <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
            endif;
            ?>
            <form class="navbar-form" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
              <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'SEARCH', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
              <!-- <input type="submit" id="submit-btn" class="btn btn-default" value="&nbsp" /> -->

              <button class="btn btn-default btn-search" type="submit" name="button" ><i class="fa fa-search" ></i></button>
            </form>
          </div>
        </div> <!-- end navbar-collapse -->

      </div> <!-- end container -->

    </nav>
</header>


<?php
  $pageID = get_the_ID();
  $title = get_the_title($pageID);
?>

<section id="login-status">
  <div class="container" >
    <?php // TODO: add breadcrumb ?>
    <div class="col-sm-6 logo">
      <b class="sr-only">Cerebrovit Logo</b>
      <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/cb_header-logo.png" alt="cerebrovit logo" />
    </div>

    <?php if($title == 'Login' || $title == 'Signup'): ?>
        <div class="sr-only">Disable Header buttons</div>
    <?php else: ?>

        <?php if(! is_user_logged_in()): ?>

        <div class="col-md-6 buttons-stat">
          <a id="login" class="btn btn-primary" href="<?php echo get_home_url().'/login'; ?>">Login</a>
          <a id="regis" class="btn btn-primary" href="<?php echo get_home_url().'/signup';/*echo wp_registration_url();*/ ?>">Register</a></button>
        </div>

        <?php else: ?>

        <?php $current_user = wp_get_current_user(); ?>
        <div class="col-sm-6 buttons-stat">
          <div class="pull-right">
            <div class="col-xs-6" id="avatar">
              <?php
                if ( function_exists('get_wp_user_avatar') ) {
                  echo get_wp_user_avatar($current_user->ID, 60);
                } //else {
                //  echo '<img src="../images/cb_mystery-man-avatar.jpg/" />';
                //}
              ?>
            </div>
            <div class="col-xs-6" id="right-group">
              <?php
              $profilename = get_user_meta( $current_user->ID, 'profilename', true );
              $cur_username = ($profilename != "") ? $profilename : $current_user->user_login;
              // echo ">> ".$cur_username." | ".$dusername." | ".$cur_user->user_login;
              ?>
              <div id="user">Hello, <span id="username"><a href="<?php echo get_home_url().'/user-dashboard'; ?>"><?php echo $cur_username; ?></a></span></div>
              <div id="btn-logout">
                <a class= "btn btn-primary" href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out</a>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

    <?php endif; ?>
  </div>
</section>

<section id="breadcrumb">
  <div class="container">

  </div>
</section>
