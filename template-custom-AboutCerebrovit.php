<?php
/**
 * Template Name: Custom Template About Cerebrovit page
 */
?>


<div class="container">
  <div class="about-wrapper">
    <?php while (have_posts()) : the_post(); ?>
      <?php //get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <?php endwhile; ?>

  </div>
</div>
