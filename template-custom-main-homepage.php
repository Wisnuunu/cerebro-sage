<?php
/**
 * Template Name: Custom Template Main Homepage
 */
?>

<div class="container" id="smart-news">

<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php //get_template_part('templates/content', 'page'); ?>

  <?php
  // get post id for highlight section
  $content = get_the_content('Read more');
  $posts = explode('#', $content);
  $pots = [];

  for ($i=1; $i <= count($posts) -1 ; $i++) {
    $the_slug = $posts[$i];
    $args=array(
    	'name'           => $the_slug,
    	'post_type'      => 'post',
    	'post_status'    => 'publish',
    	'posts_per_page' => 1
    );
    $my_posts = get_posts( $args );
    $pots[$i] = get_posts($args);
    if( $my_posts ) {
    	// echo $i.' ID:' . $my_posts[0]->ID;
      // echo "<br>";
    }
  }
  ?>

  <section class="news-highlight">
    <div id="news-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php
          for ($i=0; $i < count($pots) ; $i++) {
            if ($i == 0) {
              echo '<li data-target="#news-carousel" data-slide-to="'.$i.'" class="active"></li>';
            }
            else {
              echo '<li data-target="#news-carousel" data-slide-to="'.$i.'"></li>';
            }
          }
        ?>
      </ol>

      <div class="carousel-inner" role="listbox">

        <?php foreach ($pots as $i => $cur_post): ?>
          <div class="item <?php echo ($i == 1 ? 'active' : ''); ?>">
            <div class="col-sm-4" id="description">
              <div class="headerfiller">&nbsp;</div>
              <div class="title">
                <a href="<?php echo get_permalink($cur_post[0]->ID);?>">
                  <?php if (str_word_count($cur_post[0]->post_title) < 10): ?>
                    <h1><?php echo $cur_post[0]->post_title; ?></h1>
                  <?php else: ?>
                    <h2><?php echo $cur_post[0]->post_title; ?></h2>
                  <?php endif; ?>
                  <p>
                    <?php echo wp_trim_words($cur_post[0]->post_content, 30, '...'); ?>
                  </p>
                </a>
              </div>
            </div>
            <div class="col-sm-8" id="image">
              <?php
              $img_url = wp_get_attachment_url( get_post_thumbnail_id($cur_post[0]->ID) );
              ?>
              <div class="img img-responsive" style="background-image:url(<?php echo $img_url; ?>)" src="http://placehold.it/600x325" alt="img01"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section id="running-text">
    <div class="container-fluid">      
      <div class="marquee-wrapper">
        <div class="marquee">
          <p>
            <?php
            $rtext = get_post_meta(get_the_ID(), 'running_text', true);
            echo "".$rtext;
            ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="news-thumbnails">

    <!-- SMART NEWS THUMBS -->
    <div class="smart-news-title">
      <a href="<?php get_home_url()?>/smart-news">
        <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/smart-news/cb_news-smartnews.png" alt="smart-news" />
      </a>
    </div>

    <!-- Post with pagination -->
    <?php
      $curPostCount = 1;
      $maxPosts = 4;

      //$category = get_post_field('post_content', $post->ID);
      //$cat = get_the_content();

      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
          'post_type' => 'post',
          'category_name' => 'news',
          'posts_per_page' => $maxPosts,
          'paged' => $paged,
      );

      $the_query = new WP_Query($args); //initiate the wp query
    ?>

    <div class="container-fluid">

    <?php if($the_query->have_posts()): ?>
      <!-- pagination here -->
      <div class="firts-news-group">
      <!-- the loop -->
      <?php while( $the_query->have_posts()) : $the_query->the_post(); ?>

        <!-- first row news thumbnails -->
        <article class="">
          <div class="news-thumbnail col-sm-3" id="news-<?php echo $post->ID; ?>">
            <?php //get post thumbnail
              //$imgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
              $thumb_url = $thumb_url_array[0];
              $curPostCount++;
            ?>
            <a href="<?php the_permalink(); ?>">
              <div class="img img-responsive thumbnail-preview" style="background-image:url(<?php echo $thumb_url; ?>)"></div>
            </a>
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

    </div>
    <!-- END OF SMART NEWS THUMBS -->

  </section>

  <section class="games-and-movie-thumbnails">
    <!-- Games and Movies THUMBS -->
    <div class="smart-news-title">
      <a href="<?php get_home_url()?>/games-and-movies">
        <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-games_movie.png" alt="Games and Movie" />
      </a>
    </div>

    <!-- Post with pagination -->
    <?php
      $curPostCount = 1;
      $maxPosts = 6;

      //$category = get_post_field('post_content', $post->ID);
      //$cat = get_the_content();

      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
          'post_type' => 'post',
          'category_name' => 'game-movie',
          'posts_per_page' => $maxPosts,
          'paged' => $paged,
      );

      $the_query = new WP_Query($args); //initiate the wp query
    ?>

    <div class="container-fluid">

    <?php if($the_query->have_posts()): ?>
      <!-- pagination here -->
      <div class="firts-news-group">
      <!-- the loop -->
      <?php while( $the_query->have_posts()) : $the_query->the_post(); ?>

        <!-- first row news thumbnails -->
        <div class="col-sm-4" id="news-<?php echo $post->ID; ?>">
          <div class="news-thumbnail">

            <?php //get post thumbnail
              //$imgURL = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
              $thumb_url = $thumb_url_array[0];
              $curPostCount++;
            ?>
            <a href="<?php the_permalink(); ?>">
              <div class="img img-responsive thumbnail-preview" style="background-image:url(<?php echo $thumb_url; ?>)"></div>
            </a>
            <div class="title">
              <a href="<?php the_permalink(); ?>">
                <h4><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></h4>
              </a>
            </div>
            <!-- <div class="description">
              <?php echo get_the_excerpt(); ?>
            </div> -->
          </div>
        </div>

        <?php if ($curPostCount === 7): ?>
          <!-- <div class="advertise-space col-md-12"> -->
            <!-- <div class="row"> -->
              <!-- <img class="img img-responsive" src="<?php bloginfo('template_url')?>/assets/images/smart-news/cb_news-ads.png" alt="" /> -->
            <!-- </div> -->
          <!-- </div> -->
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


    </div>
    <!-- END OF Games and Movies THUMBS -->

  </section>
</div>

<div class="container-full">
  <!-- <h2>[advertise-space]</h2> -->
  <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ad_space.png" alt="ads" />
</div>

<section class="event-tips">

  <div class="container">

      <div class="col-md-6">
        <div class="event-calendar">
          <a href="<?php get_home_url()?>/event-calendar">
          <img class="img img-responsive img-title" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-event_calendar.png" alt="Event Calendar" />
          <div class="content">
            <!-- display thumbnails  -->
            <div class="row">
              <div class="col-sm-6">
                <img class="img img-responsive img-thumbn" src="http://placehold.it/200x150" alt="" />
              </div>
              <div class="col-sm-6">
                <h3 class="title">Title</h3>
                <h5 class="location">event location</h5>
                <p class="description">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <img class="img img-responsive img-thumbn" src="http://placehold.it/200x150" alt="" />
              </div>
              <div class="col-sm-6">
                <h3 class="title">Title</h3>
                <h5 class="location">event location</h5>
                <p class="description">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                </p>
              </div>
            </div>

          </div>
          <div class="show-more">
            <div class="btn">
              Show More
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="tips-asik">
          <a href="<?php get_home_url()?>/tips-asik">
          <img class="img img-responsive img-title" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-tips_asik.png" alt="" />
          <div class="content">
            <div class="row">
              <div class="col-sm-5">
                <img class="img img-responsive img-thumbn" src="http://placehold.it/140x100" alt="" />
              </div>
              <div class="col-sm-7">
                <h4 class="title">Title</h4>
                <p class="description">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-5">
                <img class="img img-responsive img-thumbn" src="http://placehold.it/140x100" alt="" />
              </div>
              <div class="col-sm-7">
                <h4 class="title">Title</h4>
                <p class="description">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-5">
                <img class="img img-responsive img-thumbn" src="http://placehold.it/140x100" alt="" />
              </div>
              <div class="col-sm-7">
                <h4 class="title">Title</h4>
                <p class="description">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
              </div>
            </div>
          </div>
          <div class="show-more">
            <div class="btn">
              Show More
            </div>
          </div>
        </div>
      </div>

  </div>
</section>

<section class="photo-video">
  <div class="container">
    <div class="title">
      <h3>Photo and Video Contribute</h3>
    </div>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <div class="col-md-4">
            <img class="img img-responsive center-block" src="http://lorempixel.com/240/200/animals/1" alt="Chania">
          </div>

          <div class="col-md-4">
            <img class="img img-responsive center-block" src="http://lorempixel.com/240/200/animals/2" alt="Chania">
          </div>

          <div class="col-md-4">
            <img class="img img-responsive center-block" src="http://lorempixel.com/240/200/animals/3" alt="Chania">
          </div>

        </div>
        <div class="item">
          <div class="col-md-4">
            <img class="img img-responsive center-block" src="http://lorempixel.com/240/200/animals/4" alt="Chania">
          </div>

          <div class="col-md-4">
            <img class="img img-responsive center-block" src="http://lorempixel.com/240/200/animals/5" alt="Chania">
          </div>

          <div class="col-md-4">
            <img class="img img-responsive center-block" src="http://lorempixel.com/240/200/animals/6" alt="Chania">
          </div>
        </div>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="container read-more">
    <p>
      <a href="#">read more</a>
    </p>
  </div>
</section>

<section class="social-feed">
  <div class="container">
    <h3 class="title">Social Media Feed</h3>

    <div class="feeds">
      <div class="row">
        <p class="center-block">
          [social media feed here]
        </p>
      </div>
    </div>

    <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-show_more.png" alt="show more" />
  </div>
</section>


<?php endwhile; ?>
<br><br>
