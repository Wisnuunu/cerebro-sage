<?php while (have_posts()) : the_post(); ?>
  <?php if (has_post_format('quote')){
    
    } else {

    // post format - standard
    include 'format/format-news.php';

   } ?>
   
<?php endwhile; ?>
