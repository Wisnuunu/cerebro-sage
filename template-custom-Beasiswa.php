<?php
/**
 * Template Name: Custom Template Page Beasiswa
 */
?>

<section id="beasiswa-page">
  <?php while (have_posts()) : the_post(); ?>
    <!-- <?php get_template_part('templates/page', 'header'); ?> -->
    <!-- <?php get_template_part('templates/content', 'page'); ?> -->
  <?php endwhile; ?>

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
        'posts_per_page' => 3,
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

</section>
