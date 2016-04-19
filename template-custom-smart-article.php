<?php
/**
 * Template Name: Custom Template Smart Articles
 */

 $url_forum = get_site_url()."/#";
 $url_ask   = get_site_url()."/#";
?>

<section id="smart-articles">
  <?php while (have_posts()) : the_post(); ?>
    <!-- <?php get_template_part('templates/page', 'header'); ?> -->
    <!-- <?php get_template_part('templates/content', 'page'); ?> -->
  <?php endwhile; ?>

  <div class="container">
    <section id="highlight">

      <div class="menu-forum-ask">
        <div class="btn-forum">
          <a href="/forum">
            <img src="<?= bloginfo('template_url')?>/assets/images/home/cb-the_forum-1.png" alt="the forum" />
          </a>
        </div>
        <div class="btn-ask">
          <a href="/ask-an-expert">
            <img src="<?= bloginfo('template_url')?>/assets/images/home/cb-ask-1.png" alt="ask" />
          </a>
        </div>
      </div>

      <div class="container-fluid">
        <?php
        // get post id for highlight section
        $content = get_the_content('Smart Articles');
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
          else {
              echo "[ highlight ]";
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
          $post_url = $pots[1][0]->guid;
          // print_r($pots[1][0]);
          ?>
          <div class="img img-responsive img-highlight" style="background-image:url(<?php echo $img_url;?>)">
            <!-- <img src="<?php echo $img_url; ?>" alt="image-<?php echo $post_id;?>" /> -->
            <a href="<?php echo $post_url; ?>">
              <div class="description">
                <h3 class="title"><?php echo $post_title; ?></h3>
                <p class="excerpt"><?php echo $post_excerpt; ?></p>
              </div>
            </a>
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
            $post_url = $pots[2][0]->guid;
            ?>
            <div class="img img-responsive img-highlight-small" style="background-image:url(<?php echo $img_url; ?>)" >
              <a href="<?php echo $post_url; ?>">
                <div class="description">
                  <!-- <h3 class="title"><?php echo $post_title; ?></h3> -->
                  <p class="excerpt"><?php echo $post_excerpt; ?></p>
                </div>
              </a>
            </div>

          </div>
          <div class="col-md-12">
            <?php
            // all variables that small-2 highlight need
            $post_id = $pots[3][0]->ID;
            $img_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
            $post_title = $pots[3][0]->post_title;
            $post_excerpt =wp_trim_words($pots[3][0]->post_content, 15, '...');
            $post_url = $pots[3][0]->guid;
            ?>
            <div class="img img-responsive img-highlight-small" style="background-image:url(<?php echo $img_url; ?>)" >
              <a href="<?php echo $post_url; ?>">
                <div class="description">
                  <!-- <h3 class="title"><?php echo $post_title; ?></h3> -->
                  <p class="excerpt"><?php echo $post_excerpt; ?></p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="container" id="img-beasiswa">
    <img src="<?php echo bloginfo('template_url'); ?>/assets/images/smart-articles/cb_smart-beasiswa.png" alt="" />
  </div>
  <section id="sort-by">
    <div class="container">
      <div class="title col-md-4">
        <h4>Cari Beasiswa</h4>
      </div>
    </div>
    <div class="options">
      <?php
      // get all options value
      $negara = [];
      $jenjang = [];
      $jurusan = [];

      $args = array(
        'post_type' => 'post',
        'category_name' => 'beasiswa',

      );

      $the_query = new WP_Query( $args );
      ?>


      <?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php
          // insert array value
          $negara[] = CFS()->get( 'negara' );
          $jenjang[] = CFS()->get( 'jenjang' );
          $jurusan[] = CFS()->get( 'jurusan' );
         ?>
        <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_postdata(); ?>
<!--
      <?php
        //test view variables
        print_r($negara);echo " negara ".count($negara)."<br>";
        print_r($jenjang);echo " jenjang ".count($jenjang)."<br>";
        print_r($jurusan);echo " jurusan ".count($jurusan)."<br>";
      ?>
  -->
      <form class="sort-page" action="" method="post">
        <div class="container">
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="negara">
                <option value="0" disabled selected><i>Pilih Negara</i></option>
                <option value="all" <?php echo $selected = ($_POST['jenjang'] == 'all') ? 'selected' : '' ; ?>>-- All --</option>
                <?php foreach (array_unique($negara) as $i => $ngr): ?>
                  <?php $selected = ($_POST['negara'] == $ngr) ? 'selected' : ''; ?>
                  <option value="<?php echo $ngr; ?>" <?php echo $selected; ?>><?php echo $ngr ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="jenjang">
                <option value="0" disabled="true" selected="true"><i>Pilih Jenjang Pendidikan</i></option>
                <option value="all" <?php echo $selected = ($_POST['jenjang'] == 'all') ? 'selected' : '' ; ?>>-- All --</option>
                <?php foreach (array_unique($jenjang) as $i => $jnj): ?>
                  <?php $selected = ($_POST['jenjang'] == $jnj) ? 'selected' : ''; ?>
                  <option value="<?php echo $jnj; ?>" <?php echo $selected; ?>><?php echo $jnj ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" name="jurusan">
                <option value="0" disabled="true" selected="true"><i>Pilih Jurusan</i></option>
                <option value="all" <?php echo $selected = ($_POST['jenjang'] == 'all') ? 'selected' : '' ; ?>>-- All --</option>
                <?php foreach (array_unique($jurusan) as $i => $jrs): ?>
                  <?php $selected = ($_POST['jurusan'] == $jrs) ? 'selected' : ''; ?>
                  <option value="<?php echo $jrs; ?>" <?php echo $selected; ?>><?php echo $jrs ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <input class="btn btn-default btn-search" type="submit" name="search" value="SEARCH">
          </div>
        </div>
      </form>

      <?php  // get select value
        if (isset($_POST['search'])) {
          $cur_negara = (isset($_POST['negara'])) ? $_POST['negara'] : "all" ;
          $cur_jenjang = (isset($_POST['jenjang'])) ? $_POST['jenjang'] : "all" ;
          $cur_jurusan = (isset($_POST['jurusan'])) ? $_POST['jurusan'] : "all" ;
        }
      ?>
    </div>
  </section>

  <section id="main-content">
    <div class="container">
      <?php
      $args = array(
        'post_type' => 'post',
        'category_name' => 'beasiswa',
        'posts_per_page' => 7,
        'paged' => $paged,

        'meta_query' => array(
          'relation' => 'AND',
          array(
            'key' => 'negara',
            'value' => $mValue = ($cur_negara != 'all') ? $cur_negara : '',
            'compare' => 'LIKE'
          ),
          array(
            'key' => 'jenjang',
            'value' => $mValue = ($cur_jenjang != 'all') ? $cur_jenjang : '',
            'compare' => 'LIKE'
          ),
          array(
            'key' => 'jurusan',
            'value' => $mValue = ($cur_jurusan != 'all') ? $cur_jurusan : '',
            'compare' => 'LIKE'
          ),

        ),

      );

      // the query
      $the_query = new WP_Query( $args );

      ?>

      <?php if ( $the_query->have_posts() ) : ?>

        	<!-- pagination here -->

        	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="col-md-2">
              <div class="image">
                <?php

                //get thumbnail picture
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'medium', true);
                $thumb_url = $thumb_url_array[0];
                ?>
                <a href="<?php the_permalink(); ?>">
                  <div class="img img-responsive beasiswa-thumbnail" style="background-image:url(<?php echo $thumb_url; ?>)"></div>
                </a>
              </div>
            </div>
            <div class="col-md-10">
              <div class="beasiswa-info">
                <div class="col-md-6">
                  <!-- <h4><?php the_title(); ?></h4> -->
                  <h4>
                    <a href="<?php the_permalink(); ?>">
                      <b><?php echo CFS()->get( 'university' ); ?></b>
                    </a>
                  </h4>
                  <p>
                    <?php echo CFS()->get( 'jurusan' ); ?> <br>
                    <?php echo CFS()->get( 'jenjang' ); ?> <br>
                    <?php echo CFS()->get( 'beasiswa' ); ?>
                  </p>
                </div>
                <div class="col-md-4">
                  <div class="deadline-share">
                    <h5><b>Deadline Submit:</b></h5>
                    <p>
                      <?php echo date( 'j F Y', strtotime( CFS()->get('deadline_submit') ) ); ?>
                    </p>
                    <?php
                    // ------------  share-buttons -----------------
                    if (shortcode_exists( 'shareaholic' )) {
                      echo do_shortcode('[shareaholic app="share_buttons" id="23875665"]');
                    } else {
                      echo "[share buttons]";
                    }
                    // ------------ end share-buttons ----------------
                    ?>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="beasiswa-buttons">
                    <a class="btn btn-primary bs-btn" href="<?php echo CFS()->get( 'go_to_link' ); ?>">Go To Link</a>
                    <a class="btn btn-primary bs-btn" href="<?php echo CFS()->get( 'download_link' ); ?>">Download PDF</a>
                  </div>
                </div>
              </div>
            </div>
        	<?php endwhile; ?>
        	<!-- end of the loop -->
        </div>

        	<!-- pagination here -->
          <div class="container">
            <div class="beasiswa-pagination">
              <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                if (function_exists(custom_pagination)) {
                  custom_pagination($the_query->max_num_pages,"",$paged);
                }
                else {
                  echo "function pagination not found";
                }

              ?>
            </div>
          </div>

      	   <?php wp_reset_postdata(); ?>

      <?php else : ?>
      	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
  </section>

  <section id="advertise-space">
    <img class="img img-responsive" src="<?php echo bloginfo('template_url')?>/assets/images/smart-articles/cb_smart-ads-space.png" alt="[ Advertise Space ]" />
  </section>

  <section id="tips-asik">

    <div class="container">
      <div class="">
        <a href="<?php get_home_url()?>/tips-asik">
          <img class="img img-responsive img-title" src="<?php bloginfo('template_url'); ?>/assets/images/smart-articles/cb_smart-tips-asik.png" alt="Tips Asik" />
        </a>
      </div>

      <div class="container-fluid">
        <div class="tips-wrapper">
          <?php
          $curPostCount = 1;
          $maxPosts = 4;

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
              <!-- display thumbnails  -->
              <div class="col-md-6 ">
                <div class="tips-summary ">
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
                </div> <!-- end tips-summary -->
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div> <!-- end tips-wrapper -->
      </div>

      <div class="show-more container-fluid">
        <a href="<?php get_home_url()?>/tips-asik" class="btn">
          Show More
        </a>
      </div>
    </div> <!-- end container -->
  </section>

  <section id="rumus-cepat">
    <div class="container-fluid" id="rumus-wrapper">
      <div class="container">
        <div class="title">
          <h3>Rumus Cepat</h3>
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
                'category_name' => 'rumus',
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
                        // print_r($cats[1]['name']);
                        ?>
                        <?php if (strtolower($cats[1]['name']) == 'photo' || strtolower($cats[0]['name']) == 'photo'): ?>
                          <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_photo.png" alt="" />
                        <?php elseif (strtolower($cats[1]['name']) == 'video' || strtolower($cats[0]['name']) == 'video'): ?>
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
                        <?php if (strtolower($cats[1]['name']) == 'photo'  || strtolower($cats[0]['name']) == 'photo'): ?>
                          <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_photo.png" alt="" />
                        <?php elseif (strtolower($cats[1]['name']) == 'video'  || strtolower($cats[0]['name']) == 'video'): ?>
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
                        <?php if (strtolower($cats[1]['name']) == 'photo'  || strtolower($cats[0]['name']) == 'photo'): ?>
                          <img class="pv-category" src="<?php bloginfo('template_url'); ?>/assets/images/home/cb-ico_photo.png" alt="" />
                        <?php elseif (strtolower($cats[1]['name']) == 'video'  || strtolower($cats[0]['name']) == 'video'): ?>
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
    </div>
  </section>

</section>
