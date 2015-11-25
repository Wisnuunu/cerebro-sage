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
             <form class="navbar-form navbar-right" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
              <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'SEARCH', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
              <input type="submit" id="submit-btn" class="btn btn-default" value="&nbsp" />  
              <i class="glyphicon glyphicon-search"></i>
            </form> 
          </div>
        </div> <!-- end navbar-collapse -->       

      </div> <!-- end container -->
      
    </nav>
</header>


<?php 
  $pageID = get_the_ID();
  $title = get_the_title($pageID);
  //register button is not presented on Login page
  if ($title == 'Login' || $title == 'Signup' ) : ?>

  <div class="sr-only">Disable Header</div>

<?php else: ?>

    <section id="login-status">
      <div class="container" >      
        <div class="col-md-6 logo">
          <b>Cerebrovit Logo</b>
        </div>
        <?php if(! is_user_logged_in()): ?>

        <div class="col-md-6 buttons-stat">
          <a id="login" class="btn btn-primary" href="<?php echo get_home_url().'/login'; ?>">Login</a>
          <a id="regis" class="btn btn-primary" href="<?php echo get_home_url().'/signup';/*echo wp_registration_url();*/ ?>">Register</a></button>
        </div>

        <?php else: ?>

        <?php $current_user = wp_get_current_user(); ?>
        <div class="col-md-6 buttons-stat">
          <div class="row pull-right">
            <div class="col-xs-6" id="avatar">
              <?php
                if ( has_wp_user_avatar($current_user->ID) ) {
                  echo get_wp_user_avatar($current_user->ID, 60);
                } else {
                  echo '<img src="my-alternate-image.jpg" />';
                }
              ?>            
            </div>
            <div class="col-xs-6" id="right-group">
              <div id="user">Hello, <span id="username"><a href="<?php echo get_home_url().'/wp-admin'; ?>"><?php echo $current_user->user_login; ?></a></span></div>
              <div id="btn-logout">
                <a class= "btn btn-primary" href="<?php echo wp_logout_url( get_permalink() ); ?>">Log Out</a>
              </div>
            </div>
          </div>
        </div>

        <?php endif; ?>
      </div>
    </section>

<?php endif; ?>

<section id="breadcrumb">
  <div class="container">

  </div>
</section>