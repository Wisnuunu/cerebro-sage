<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <div class="wrap container" role="document">
      <div class="content row">


      <div class="container">
        <div class="row">
          <?php 
          // manage layout if post format is standard (for news usage)
          if (!get_post_format()) { ?> 
            <main>
              <?php include Wrapper\template_path(); ?>
            </main><!-- /.main -->
          <?php }


          else { ?>


            <div class="col-md-8"> <!-- main post -->
               <main>
                <?php include Wrapper\template_path(); ?>
              </main><!-- /.main -->
            </div>
            <div class="col-md-4"> <!-- side bar -->
              <?php if (Setup\display_sidebar()) { ?>
                <aside>
                  <?php include Wrapper\sidebar_path(); ?>
                </aside>
              <?php  } ?>  
            </div>     
          <?php } ?>      


        </div>
      </div>
      
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
