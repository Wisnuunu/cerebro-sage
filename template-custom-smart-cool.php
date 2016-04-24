<?php
/**
 * Template Name: Custom Template Smart & Cool
 */
 $url_forum = get_site_url()."/forum";
 $url_ask   = get_site_url()."/ask-an-expert";
 $url_moviegames = get_site_url()."/games-and-movie";
?>

<section id="smart-cool">

  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
      <!-- <?php get_template_part('templates/page', 'header'); ?> -->
      <!-- <?php get_template_part('templates/content', 'page'); ?> -->
    <?php endwhile; ?>

    <section id="highlight">

      <div class="menu-forum-ask">
        <div class="btn-forum">
          <a href="<?php echo $url_forum; ?>">
            <img src="<?= bloginfo('template_url')?>/assets/images/home/cb-the_forum-1.png" alt="the forum" />
          </a>
        </div>
        <div class="btn-ask">
          <a href="<?php echo $url_ask; ?>">
            <img src="<?= bloginfo('template_url')?>/assets/images/home/cb-ask-1.png" alt="ask" />
          </a>
        </div>
      </div>

      <div class="container-fluid">
        <?php
        // get post id for highlight section
        $content = get_the_content('Smart & Cool');
        $posts = explode('#', $content);
        $pots = [];

        for ($i=1; $i <= count($posts) -1 ; $i++) {
          $the_slug = $posts[$i];
          $args = array(
          	'name'           => $the_slug,
          	'post_type'      => 'post',
          	'post_status'    => 'publish',
          	'posts_per_page' => 1
          );
          $my_posts = get_posts( $args );
          $pots[$i] = get_posts($args);
          //echo "string ".$pots[$i][0]->ID."<br>";
          //print_r($pots[$i][0]);
          //echo "<br>";
          if( $my_posts ) {
          	//echo $i.' ID:' . $my_posts[0]->ID;
            // echo "<br>";
          }
        }
        ?>

        <div class="col-md-8">
          <?php
          // all variables that large highlight need
          $post_id = $pots[1][0]->ID;
          $img_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
          $post_title = $pots[1][0]->post_title;
          $post_excerpt =wp_trim_words($pots[1][0]->post_content, 30, '...');
          ?>
          <div class="img img-responsive img-highlight" style="background-image:url(<?php echo $img_url;?>)">
            <!-- <img src="<?php echo $img_url; ?>" alt="image-<?php echo $post_id;?>" /> -->
            <div class="description">
              <h3 class="title"><?php echo $post_title; ?></h3>
              <p class="excerpt"><?php echo $post_excerpt; ?></p>
            </div>
          </div>

        </div>
        <div class="col-md-4">
          <div class="col-md-12">
            <?php
            // all variables that small-1 highlight need
            $post_id = $pots[2][0]->ID;
            $img_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
              $post_title = $pots[2][0]->post_title;
            $post_excerpt =wp_trim_words($pots[2][0]->post_content, 15, '...');
            ?>
            <div class="img img-responsive img-highlight-small" style="background-image:url(<?php echo $img_url; ?>)" >
              <div class="description">
                <!-- <h3 class="title"><?php echo $post_title; ?></h3> -->
                <p class="excerpt"><?php echo $post_excerpt; ?></p>
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <?php
            // all variables that small-2 highlight need
            $post_id = $pots[3][0]->ID;
            $img_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
            $post_title = $pots[3][0]->post_title;
            $post_excerpt =wp_trim_words($pots[3][0]->post_content, 15, '...');
            ?>
            <div class="img img-responsive img-highlight-small" style="background-image:url(<?php echo $img_url; ?>)" >
              <div class="description">
                <!-- <h3 class="title"><?php echo $post_title; ?></h3> -->
                <p class="excerpt"><?php echo $post_excerpt; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

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
    <div class="container-fluid read-more">
      <p>
        <a href="#">read more</a>
      </p>
    </div>
  </section>

  <section id="event-calendar">
    <div class="container">
      <a href="<?php get_home_url()?>/event-calendar">
        <img class="img img-responsive img-title" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-event_calendar.png" alt="Event Calendar" />
      </a>
      <div class="event-wrapper">
        <?php
        $curPostCount = 1;
        $maxPosts = 4;

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
            <div class="col-md-6 ">
              <div class="event-summary ">
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
            </div>
          <?php endwhile; ?>
        <?php endif; ?>

      </div>
      <div class="show-more container-fuid">
        <div class="btn">
          Show More
        </div>
      </div>
    </div>
  </section>

  <div class="container-full">
    <!-- <h2>[advertise-space]</h2> -->
    <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ad_space.png" alt="ads" />
  </div>

  <section id="games-and-movie">
    <div class="container">
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
            <div class="news-summary">
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
                    <h4><?php echo wp_trim_words(get_the_title(), 12, '...'); ?></h4>
                  </a>
                </div>
                <!-- <div class="description">
                  <?php echo get_the_excerpt(); ?>
                </div> -->
              </div>
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
    </div>

    <div class="container">
      <a class="show-more" id="url-moviegame" href="<?php echo $url_moviegames; ?>">
          Show More
      </a>
    </div>
  </section>

</section>
