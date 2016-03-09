<article <?php post_class(); ?>>

  <section id="search-result">
    <div class="col-md-2">
      <?php
      //get thumbnail picture
      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
      $thumb_url = $thumb_url_array[0];
      ?>
      <a href="<?php the_permalink(); ?>">
        <div class="img img-responsive search-thumbnail" style="background-image:url(<?php echo $thumb_url; ?>)"></div>
      </a>
    </div>
    <div class="col-md-10">
      <div class="search-summary">
        <header>
          <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <!-- <?php
          if (get_post_type() === 'post') {
            get_template_part('templates/entry-meta');
          }
          ?> -->
        </header>
        <div class="entry-summary">
          <?php the_excerpt(); ?>
        </div>
        <div class="category">
          <?php
            $categories = get_the_category();
            if ($categories) {
              foreach ($categories as $i => $category) {
                $cat_url = esc_url( get_category_link( $category->term_id ) );
                $cat_name = $category->name;
                echo '<a class="btn btn-default btn-cat" href="'.$cat_url.'">'.$cat_name.'</a>';
              }
            }
          ?>
        </div>
      </div>
    </div>

  </section>

</article>
