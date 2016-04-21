<?php
/**
 * Template Name: Custom Template Ask The Expert
 */
?>

<div class="about-wrapper">
  
  <?php while (have_posts()) : the_post(); ?>
    <?php //get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
  <?php endwhile; ?>
  
  <?php disqus_embed('cerebro1'); ?>

</div>
