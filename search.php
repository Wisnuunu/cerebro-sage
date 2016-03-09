<div class="container">
  <?php get_template_part('templates/page', 'header'); ?>

  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
    <?php get_search_form(); ?>
  <?php endif; ?>

  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'search'); ?>
  <?php endwhile; ?>

  <div class="container">
    <div class="search-nav">
      <?php
        //the_posts_navigation();
        the_posts_pagination( array(
        	'mid_size'  => 6,
        	'prev_text' => __( 'Prev', 'textdomain' ),
        	'next_text' => __( 'Next', 'textdomain' ),
        ) );
      ?>
    </div>
  </div>

</div>
