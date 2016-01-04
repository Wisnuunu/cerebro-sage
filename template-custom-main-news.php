<?php
/**
 * Template Name: Custom Template Smart News
 */
?>

<div class="container-fluid" id="smart-news">

<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>

  <section class="news-highlight">
    <div id="news-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#news-carousel" data-slide-to="1"></li>
        <li data-target="#news-carousel" data-slide-to="2"></li>
        <li data-target="#news-carousel" data-slide-to="3"></li>
      </ol>

      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <div class="col-sm-4" id="description">
            <div class="headerfiller">&nbsp;</div>
            <div class="title">
              <h1>Kenapa hatiku cenat cenut tiap ada kamu</h1>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              </p>
            </div>
          </div>
          <div class="col-sm-8" id="image">
            <img class="img-responsive" src="http://placehold.it/600x325" alt="img01">
          </div>
        </div>

        <!-- <div class="item">
          <div class="col-sm-4" id="description">
            <h1>Title title 02</h1>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
          </div>
          <div class="col-sm-8" id="image">
            <img class="img-responsive"  src="http://placehold.it/600x300" alt="img02">
          </div>
        </div>

        <div class="item">
          <div class="col-sm-4" id="description">
            <h1>Title title 03</h1>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
          </div>
          <div class="col-sm-8" id="image">
            <img class="img-responsive"  src="http://placehold.it/600x300" alt="img03">
          </div>
        </div>

        <div class="item">
          <div class="col-sm-4" id="description">
            <h1>Title title 04</h1>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
          </div>
          <div class="col-sm-8" id="image">
            <img class="img-responsive"  src="http://placehold.it/600x300" alt="img03">
          </div>
        </div>
      </div> -->

    </div>
  </section>

  <section class="news-thumbnails">

    <div class="smart-news-title">
      <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/smart-news/cb_news-smartnews.png" alt="smart-news" />
    </div>

    <!-- Post with pagination -->
    <?php
      $curPostCount = 1;
      $maxPosts = 12;

      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
          'post_type' => 'post',
          'category_name' => 'news',
          'posts_per_page' => $maxPosts,
          'paged' => $paged,
      );

      $the_query = new WP_Query($args); //initiate the wp query
    ?>

    <div class="col-md-9">

    <?php if($the_query->have_posts()): ?>
      <!-- pagination here -->
      <div class="firts-news-group row">
      <!-- the loop -->
      <?php while( $the_query->have_posts()) : $the_query->the_post(); ?>

        <!-- first row news thumbnails -->
        <article class="">
          <div class="news-thumbnail col-sm-4" id="news-<?php echo $post->ID; ?>">
            <?php //get post thumbnail
              //$imgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
              $thumb_url = $thumb_url_array[0];
              $curPostCount++;
            ?>
            <div class="thumbnail-preview">
              <a href="<?php the_permalink(); ?>">
                <img class="img img-responsive" src="<?php echo $thumb_url; ?>" alt="thumb-<?php echo $post->ID; ?>" />
              </a>
            </div>
            <div class="title">
              <a href="<?php the_permalink(); ?>">
                <h4><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></h4>
              </a>
            </div>
            <div class="description">
              <?php echo get_the_excerpt(); ?>
            </div>
          </div>
        </article>
        <?php if ($curPostCount === 7): ?>
          <div class="advertise-space col-md-12">
            <!-- <div class="row"> -->
              <img class="img img-responsive" src="<?php bloginfo('template_url')?>/assets/images/smart-news/cb_news-ads.png" alt="" />
            <!-- </div> -->
          </div>
        <?php endif; ?>

      <?php endwhile; ?>
      <!-- end the loop -->
      </div>

      <?php wp_reset_postdata(); ?>
    <?php else: ?>
      <p>
        <?php _e('Sorry, no posts matched your criteria.'); ?>
      </p>
    <?php endif; ?><!--  end post with pagination -->

    <!-- Or pagination here -->
    <div class="row">
      <?php
        if (function_exists(custom_pagination)) {
          custom_pagination($the_query->max_num_pages,"",$paged);
        }
        else {
          echo "function pagination not found";
        }
      ?>
    </div>

    </div>

    <div class="sidemenu col-md-3">
      <div class="news-popular">
        <div class="title-image">
          <img src="<?php bloginfo('template_url')?>/assets/images/smart-news/cb_news-popularpost.png" alt="" />
        </div>
        <div class="main-popular-title">
          <?php
            if (function_exists("wpp_get_mostpopular")) {
                wpp_get_mostpopular( "
                post_type=post&
                range=all&
                limit=6&
                cat=3&
                stats_date=1&
                stats_date_format='j M Y'&
                stats_views=0&
                post_html='<li>{title}<br><span class=\"date\">{date}</span></li>' " );
            }
          ?>
        </div>
      </div>
      <div class="news-topics">
        <div class="title-image">
          <img src="<?php bloginfo('template_url')?>/assets/images/smart-news/cb_news-topics.png" alt="" />
        </div>
        <div class="main-topics">
          <p>
            <?php

            //TODO: wordpress doesn't support tags based on category
            if (function_exists('wp_tag_cloud')) {

              $args = array(
                'smallest'  => 10,
                'largest'   => 10,
                'separator' => " | ",
                'exclude' => '24',
                'number' => 20
              );
              wp_tag_cloud( $args );
            }
            ?>
          </p>
        </div>
      </div>
    </div>
  </section>

</div>

<?php endwhile; ?>
<br><br>
