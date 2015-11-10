<article <?php post_class(); ?>>

	<!-- <div class="container-fluid">		 -->
		<section id="prev-next">
			<div class="row">			
				<div class="col-xs-6" id="prev-link">
					<span class="pull-left"><?php previous_post_link('&laquo; %link', '%title', TRUE); ?>&nbsp</span>
				</div>
				<div class="col-xs-6" id="next-link">
					<span class="pull-right"><?php next_post_link('%link &raquo;', '%title', TRUE); ?>&nbsp</span>
				</div>
			</div>
		</section>
	<!-- </div> -->

	<header>
		<div class="container-fluid">
		  <h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<section class="featured-image">
		<div class="container-fluid">
			<?php
				$thumb_id = get_post_thumbnail_id();
				$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
				$thumb_url = $thumb_url_array[0];
				//echo $thumb_url;
				// echo '<img src="'.$thumb_url.'" alt="featured image">';

				echo '<div class="bg-image" style="background-image:url('.$thumb_url.')"> &nbsp </div>';
			?>
		</div> 		
	</section>

	<div class="entry-content">
	  <?php the_content(); ?>
	</div>

	<footer>
	  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
	</footer>
	<?php comments_template('/templates/comments.php'); ?> 

</article>
