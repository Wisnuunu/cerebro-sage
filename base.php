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

          <!-- define current post format that will have single page without sidebar widget -->
          <?php if ( !get_post_format() || get_post_format() === 'video'): ?> 
            <main>
              <?php include Wrapper\template_path(); ?>
            </main><!-- /.main -->
         
          <?php else : ?> 
            <!-- for other article -->

            <div class="col-md-8"> <!-- main post -->
              
               <main>
                <?php include Wrapper\template_path(); ?>
              </main><!-- /.main -->
            </div>

            <div class="col-md-4"> <!-- side bar -->
              <?php if (Setup\display_sidebar()):  ?>
                <aside>
                  <?php include Wrapper\sidebar_path(); ?>
                </aside>
              <?php  endif; ?>  
            </div>     

          <?php endif; ?>      

        </div>
      </div>
      
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>

    <section id="visit-menu">
      <ul>
        <li>anu</li>
        <li>facebook</li>
        <li>twitter</li>
        <li>youtube</li>
        <li>smartforum</li>
        <li>ask an expert</li>
      </ul>
    </section>

  </body>
</html>
