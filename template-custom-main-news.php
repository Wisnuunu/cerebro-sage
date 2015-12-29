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
    <div class="col-md-10">
      <div class="first-news-group">
        news group 00
      </div>
      <div class="advertise-spave">
        ads
      </div>
      <div class="second-news-group">
        news group 01
      </div>
    </div>
    <div class="col-md-2">
      <div class="news-popular">
        popular post list
      </div>
      <div class="news-topics">
        topics
      </div>
    </div>
  </section>

  <section class="page-numbers">
    <nav>
      <ul class="pagination">
        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <li class="active"><a href="#">1 </a></li>
        <li class=""><a href="#">2 </a></li>
        <li class=""><a href="#">3 </a></li>
        <li class=""><a href="#">4 </a></li>
        <li class=""><a href="#">5 </a></li>
        <li class=""><a href="#">6 </a></li>
        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
      </ul>
    </nav>
  </section>
<?php endwhile; ?>

</div>
