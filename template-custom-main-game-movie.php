<?php
/**
 * Template Name: Custom Template Games and Movies
 */

 $url_forum = get_site_url()."/#";
 $url_ask   = get_site_url()."/#";
?>

<div class="container" id="smart-news">

<?php while (have_posts()) : the_post(); ?>
  <?php //get_template_part('templates/page', 'header'); ?>
  <?php //get_template_part('templates/content', 'page'); ?>

  <?php
  // get post id for highlight section
  $content = get_the_content('Read more');
  $posts = explode('#', $content);
  // $pots = [];

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
  <section class="movie-highlight">

    <div class="menu-forum-ask">
      <div class="btn-forum">
        <a href="<?php echo $url_forum; ?>">
          <img src="<?= bloginfo('template_url')?>/assets/images/home/cb-the_forum1-1.png" alt="the forum" />
        </a>
      </div>
      <div class="btn-ask">
        <a href="<?php echo $url_ask; ?>">
          <img src="<?= bloginfo('template_url')?>/assets/images/home/cb-ask1-1.png" alt="ask" />
        </a>
      </div>
    </div>

    <div id="news-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators sr-only">
        <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#news-carousel" data-slide-to="1"></li>
        <li data-target="#news-carousel" data-slide-to="2"></li>
        <li data-target="#news-carousel" data-slide-to="3"></li>
      </ol>

      <div class="carousel-inner" role="listbox">
        <?php foreach ($pots as $i => $cur_post): ?>
          <?php
          //echo $i."/".$cur_post[0]->ID;
          //echo "/".$cur_post[0]->post_title;
          //echo "/".wp_trim_words($cur_post[0]->post_content, 20, '...');
          //echo "<br>";
          $img_url = wp_get_attachment_url( get_post_thumbnail_id($cur_post[0]->ID) );
          ?>
          <div class="item <?php echo ($i == 1 ? 'active' : ''); ?>">
            <div class="" id="image">
              <div class="img img-responsive bg-image" style="background-image:url(<?php echo $img_url; ?>)" alt="img01"></div>
              <div class="carousel-caption">
               <!-- <h4>Metal Gear Solid V: Phantom Pain</h4> -->
               <h4><?php echo $cur_post[0]->post_title; ?></h4>
               <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p> -->
               <p><?php echo wp_trim_words($cur_post[0]->post_content, 20, '...'); ?></p>
             </div>
            </div>
          </div>

        <?php endforeach; ?>

  </section>

  <section class="news-thumbnails">

    <!-- <div class="smart-news-title">
      <img class="img img-responsive" src="<?php bloginfo('template_url'); ?>/assets/images/smart-news/cb_news-smartnews.png" alt="smart-news" />
    </div> -->
    <br>
    <div class="row">
      <!-- <div class="container-fluid"> -->
        <div class="col-sm-2">
          <form class="sort-by" method="post">
            <div class="form-group">
              <select class="form-control" name="sort" placeholder="sort-by" onchange="this.form.submit()">
                <option value="0" disabled selected>Sort by:</option>
                <option value="1" <?php selected( $_POST['sort'],'1', 1 ); ?> >Title: A - Z</option>
                <option value="2" <?php selected( $_POST['sort'],'2', 1 ); ?> >Title: Z - A</option>
                <option value="3" <?php selected( $_POST['sort'],'3', 1 ); ?> >Date: Newer - Older</option>
                <option value="4" <?php selected( $_POST['sort'],'4', 1 ); ?> >Date: Older - Newer</option>
                <option value="5" <?php selected( $_POST['sort'],'5', 1 ); ?> >Most Popular</option>
                <!-- <option value="6" <?php selected( $_POST['sort'],'6', 1 ); ?> >Most View</option> -->
              </select>
            </div>
          </form>
        </div>

      <!-- </div> -->
    </div>


    <!-- Post with pagination -->
    <?php
      $curPostCount = 1;
      $maxPosts = 12;

      //$category = get_post_field('post_content', $post->ID);
      $sort_opt = null;
      $args = array(
          'post_type' => 'post',
          'category_name' => 'game-movie',
          'posts_per_page' => $maxPosts,
          'paged' => $paged,
      );

      if (isset($_POST['sort'])) {
        $sort_opt = $_POST['sort'];

        switch ($sort_opt) {
          case '1':
            $args['orderby'] = 'title';
            $args['order'] ='ASC';
            break;

          case '2':
            $args['orderby'] = 'title';
            $args['order'] ='DESC';
            break;

          case '3':
            $args['orderby'] = 'date';
            $args['order'] ='DESC';
            break;

          case '4':
            $args['orderby'] = 'date';
            $args['order'] ='ASC';
            break;

          case '5':
            $args['orderby'] = 'comment_count';
            break;

          // case '6':
          //   $args['orderby'] ='meta_value_num';
          //   $args['meta_key'] = 'wpb_post_views_count';
          //   break;

          default:

            break;
        }
      }

      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

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
            <!-- <div class="thumbnail-preview"> -->
            <a href="<?php the_permalink(); ?>">
              <div class="img img-responsive thumbnail-preview" style="background-image:url(<?php echo $thumb_url; ?>)">
              </div>
            </a>
            <!-- </div> -->
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
          <img class="img img-responsive" src="<?php bloginfo('template_url')?>/assets/images/smart-news/cb_news-popularpost.png" alt="" />
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
