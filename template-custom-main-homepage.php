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
    $pots[$i] = get_posts( $args );
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
          </a>
          <div class="content">
            <?php
            $curPostCount = 1;
            $maxPosts = 2;

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'category_name' => 'event',
                'posts_per_page' => $maxPosts,
                'paged' => $paged,
            );

            $the_query = new WP_Query($args); //initiate the wp query
            ?>

            <?php if ($the_query->have_posts()): ?>
              <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                <!-- display thumbnails  -->
                <div class="row">
                  <div class="col-sm-6">
                    <?php
                      $thumb_id = get_post_thumbnail_id();
                      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
                      $thumb_url = $thumb_url_array[0];
                    ?>
                    <a href="<?php the_permalink(); ?>">
                      <div class="img img-responsive img-thumbn" style="background-image:url(<?php echo $thumb_url; ?>)">
                        <!-- <img class="img img-responsive img-thumbn" src="<?php echo $thumb_url; ?>" alt="" /> -->
                      </div>
                    </a>
                  </div>
                  <div class="col-sm-6">
                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php echo "".get_the_title(); ?></a></h4>
                      <h5 class="location"><?php echo get_post_meta(get_the_ID(), 'event_location', true); ?></h5>
                    <p class="description">
                      <?php echo "".get_the_excerpt(); ?>
                    </p>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>

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
          </a>
          <div class="content">
            <?php
            $curPostCount = 1;
            $maxPosts = 3;

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'category_name' => 'tips',
                'posts_per_page' => $maxPosts,
                'paged' => $paged,
            );

            $the_query = new WP_Query($args); //initiate the wp query
            ?>
            <?php if ($the_query->have_posts()): ?>
              <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="row">
                  <div class="col-sm-5">
                    <?php
                      $thumb_id = get_post_thumbnail_id();
                      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
                      $thumb_url = $thumb_url_array[0];
                    ?>
                    <a href="<?php the_permalink(); ?>">
                      <div class="img img-responsive img-thumbn" style="background-image:url(<?php echo $thumb_url; ?>)">
                      </div>
                    </a>
                    <!-- <img class="img img-responsive img-thumbn" src="http://placehold.it/140x100" alt="" /> -->
                  </div>
                  <div class="col-sm-7">
                    <h4 class="title"><a href="<?php the_permalink();?>"><?php echo "".get_the_title(); ?></a></h4>
                    <p class="description">
                      <?php echo "".get_the_excerpt(); ?>
                    </p>
                  </div>
                </div>
              <?php endwhile;?>
            <?php endif; ?>
        </div>
        <div class="show-more">
          <div class="btn">
            Show More
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
        <?php
        $curPostCount = 0;
        $maxPosts = 9;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'category_name' => 'foto-video',
            'posts_per_page' => $maxPosts,
            'paged' => $paged,
        );

        $the_query = new WP_Query($args); //initiate the wp query
        $pv_post_id = [];
        $pv_post_thumb_url = [];
        ?>

        <?php if ($the_query->have_posts()): ?>
          <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
            <?php
              //add every photo and video post id to array
              $pv_post_id[$curPostCount] = get_the_ID();
              //add every photo and video post url to array
              $thumb_id = get_post_thumbnail_id();
              $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
              $thumb_url = $thumb_url_array[0];
              $pv_post_thumb_url[$curPostCount] = $thumb_url;

              $curPostCount++;
            ?>
          <?php endwhile; ?>
        <?php endif;
          //echo ">>".count($pv_post_thumb_url);
        ?>

        <?php if (count($pv_post_thumb_url) > 0): ?>
          <div class="item active"> <!-- 1st image slider group -->
            <?php for ($i = 0; $i < 3; $i++): ?>
              <div class="col-md-4">
                <a data-toggle="tooltip" title="<?php echo get_the_title($pv_post_id[$i]); ?>" href="<?php echo get_post_permalink($pv_post_id[$i]); ?>">
                  <div class="img img-responsive img-tmb" style="background-image:url(<?php echo $pv_post_thumb_url[$i]; ?>)">
                    <!-- image badge photo or video  -->
                    <?php
                    $post_categories = wp_get_post_categories( $pv_post_id[$i] );
                    $cats = array();

                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }
                    //print_r($cats[1]['name']);
                    ?>
                    <?php if (strtolower($cats[1]['name']) == 'photo'): ?>
                      <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_photo.png" alt="" />
                    <?php elseif (strtolower($cats[1]['name']) == 'video'): ?>
                      <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_video.png" alt="" />
                    <?php endif; ?>
                  </div>
                </a>
                <!-- <img class="img img-responsive center-block" src="<?php echo $pv_post_thumb_url[0]; ?>" alt="Chania"> -->
              </div>
            <?php endfor; ?>
         </div>
        <?php endif; ?>

        <?php if (count($pv_post_thumb_url) > 3): ?>
          <div class="item">  <!-- 2nd image slider group -->
            <?php for ($i = 3; $i < 6; $i++): ?>
              <div class="col-md-4">
                <a data-toggle="tooltip" title="<?php echo get_the_title($pv_post_id[$i]); ?>" href="<?php echo get_post_permalink($pv_post_id[$i]); ?>">
                  <div class="img img-responsive img-tmb" style="background-image:url(<?php echo $pv_post_thumb_url[$i]; ?>)">
                    <!-- image badge photo or video  -->
                    <?php
                    $post_categories = wp_get_post_categories( $pv_post_id[$i] );
                    $cats = array();

                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }
                    //print_r($cats[1]['name']);
                    ?>
                    <?php if (strtolower($cats[1]['name']) == 'photo'): ?>
                      <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_photo.png" alt="" />
                    <?php elseif (strtolower($cats[1]['name']) == 'video'): ?>
                      <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_video.png" alt="" />
                    <?php endif; ?>
                  </div>
                </a>
              </div>
            <?php endfor; ?>
          </div>
        <?php endif; ?>

        <?php if (count($pv_post_thumb_url) > 6): ?>
          <div class="item">  <!-- 3rd image slider group -->
            <?php for ($i = 6; $i < 9; $i++): ?>
              <div class="col-md-4">
                <a data-toggle="tooltip" title="<?php echo get_the_title($pv_post_id[$i]); ?>" href="<?php echo get_post_permalink($pv_post_id[$i]); ?>">
                  <div class="img img-responsive img-tmb" style="background-image:url(<?php echo $pv_post_thumb_url[$i]; ?>)">
                    <!-- image badge photo or video  -->
                    <?php
                    $post_categories = wp_get_post_categories( $pv_post_id[$i] );
                    $cats = array();

                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }
                    //print_r($cats[1]['name']);
                    ?>
                    <?php if (strtolower($cats[1]['name']) == 'photo'): ?>
                      <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_photo.png" alt="" />
                    <?php elseif (strtolower($cats[1]['name']) == 'video'): ?>
                      <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_video.png" alt="" />
                    <?php endif; ?>
                  </div>
                </a>
              </div>
            <?php endfor; ?>
          </div>
        <?php endif; ?>

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        <!-- <img src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-btn_left.png" alt="<" /> -->
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
