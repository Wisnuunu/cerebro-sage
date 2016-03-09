<!--
this is the type of single page, details of each post we are used to see
-->

<?php while (have_posts()) : the_post(); ?>

  <?php
  $post_format = get_post_format();
  if ($post_format === false) {
  	$post_format = 'standard'; //for news format
  }

  if ($post_format == 'standard') {
    // post format - standard
    include 'format/format-news.php';
  }else if ($post_format == 'video') {
  	include 'format/format-video.php';
  }

   ?>

<?php endwhile; ?>
