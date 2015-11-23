<header id="navigation">
  <div class="container-fluid">
    <!-- <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div><!--  end navbar header -->

        <div id="navbar" class="navbar-collapse collapse">
          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
          endif;   
          ?>
          <form class="navbar-form" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'SEARCH', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
            <input type="submit" id="submit-btn" class="btn btn-default" value="&nbsp" />  
            <i class="glyphicon glyphicon-search"></i>
          </form>
        </div> <!-- end navbar-collapse -->       

      </div> <!-- end container -->
      
    </nav>

  </div> <!-- end container -->
</header>


<?php 
  $pageID = get_the_ID();
  $title = get_the_title($pageID);
  //register button is not presented on Login page
  if ($title == 'Login' || $title == 'Signup' ) : ?>
  <div class="sr-only">Disable Header</div>
<?php 
  else: ?>

    <section id="login-status">
      <div class="container" >      
        <div class="col-md-6 logo">
          <b>Cerebrovit Logo</b>
        </div>
        <div class="col-md-6 buttons-stat">
          <a id="regis" class="btn btn-primary pull-right" href="<?php echo get_home_url().'/signup';/*echo wp_registration_url();*/ ?>">Register</a></button>
          <a id="login" class="btn btn-primary pull-right" href="<?php echo get_home_url().'/login'; ?>">Login</a>
        </div>
      </div>
    </section>

<?php endif; ?>