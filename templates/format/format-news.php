<article <?php post_class(); ?>>

	<div class="container-fluid">
		<section id="prev-next">
			<div class="row">
				<?php if (strlen(get_previous_post(TRUE)->post_title) > 0) : ?>
				<div class="col-md-6" id="prev-link">
					<span class="">
						<?php
						$trimmed_word = wp_trim_words(get_previous_post(TRUE)->post_title, 8);
						//echo $trimmed_word;
						previous_post_link('&laquo; %link', /*'%title'*/$trimmed_word, TRUE); ?>&nbsp
					</span>
				</div>
				<?php else: ?>
					<div class="col-md-6">&nbsp</div>
				<?php endif; ?>

				<!-- <div class="col-md-2">&nbsp</div> -->

				<?php if (strlen(get_next_post(TRUE)->post_title) > 0) : ?>
					<div class="col-md-6 pull-right" id="next-link">
						<span class="">
							<?php
							$trimmed_word = wp_trim_words(get_next_post(TRUE)->post_title, 8);
							next_post_link('%link &raquo;', /*'%title'*/$trimmed_word, TRUE); ?>&nbsp
						</span>
					</div>
				<?php else: ?>
					<div class="col-md-6">&nbsp</div>
				<?php endif; ?>
			</div>
		</section>
	</div>

	<header>
		<div class="container-fluid" id="post-title">
		  <h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>

	<section class="featured-image">
		<div class="container-fluid">
			<?php
				if (function_exists('sharing_display')) {
					sharing_display('',true);
				}

				if (class_exists('Jetpack_Likes')) {
					$custom_likes = new Jetpack_Likes;
					echo $custom_likes->post_likes('');
				}
			?>
		</div>
		<div class="container-fluid">
			<?php
				if( has_post_thumbnail( $post->ID )) {
					$thumb_id = get_post_thumbnail_id();
					$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
					$thumb_url = $thumb_url_array[0];
					//echo $thumb_url;
					// echo '<img src="'.$thumb_url.'" alt="featured image">';

					echo '<div class="bg-image" style="background-image:url('.$thumb_url.')"></div>';
				}
			?>
		</div>
	</section>

	<div class="entry-content container-fluid">
		<div class="col-md-1" id="post-meta">
			<i><b><?php the_date('d M Y'); ?></b></i> <br />
			<i><b>Author:&nbsp</b></i>
			<?php echo get_the_author(); ?> <br />
			<i><b>Posted under:</b></i>
			<?php
				$format = get_post_format();
				if (false === $format) {
					$format = 'News';
				}
				echo $format;
			?><br />
			<i><b>Shortlink:&nbsp</b></i>
			<?php echo wp_get_shortlink(); ?>
		</div>
		<div class="col-md-8" id="main">
			<div id="content">
	  			<?php the_content(); ?>
			</div>
			<div id="tags">
				<b>Tags:</b>
				<?php
					$posttags = get_the_tags();

					$count = 0;

					if ($posttags) {
						echo '<ul>';
					  	foreach($posttags as $tag) {
					  		if ($count%2 == 0)
					  			$style_color = '#cc1111';
					  		else
					  			$style_color = 'rgba(250,156,42,1)';

					    	echo '<li style="background-color:'.$style_color.';"><a href="'.get_tag_link($tag->term_id).'">'. $tag->name.'</a></li>';

					    	$count++;
					  	}
					  	echo '</ul>';
					}
				?>
			</div>
  		</div>
  		<div class="col-md-3" id="rel-post">
  			<h5 id="title">Related Post</h5>
  			<div id="rel-content">
  				<?php view_related_post(); ?>
  			</div>
  		</div>
	</div>

	<section id="comment">
		<?php comments_template('/templates/comments-news.php'); ?>
	</section>

	<section id="popular-post">
		<?php
		    if (function_exists('wpp_get_mostpopular'))
		        wpp_get_mostpopular( "
		        	header='Popular Posts'&
		        	limit=4&
		        	range=all&
		        	post_type=post&
		        	wpp_start='<div class=\"row\">'&
		        	wpp_end='</div>'&
		        	title_by_words=1&
		        	thumbnail_width=200&
		        	thumbnail_height=130&
		        	post_html='<div class=\"col-md-3 pp-content\">{thumb}<div class=\"pp-title\"><b>{title}</b></div></div>'
		        	" );
		?>
	</section>

	<footer>
	  	<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
	</footer>

</article>


<?php
	function view_related_post(){
		$max_articles = 3;
		$cnt = 0;

		echo "<ul>";

		$article_tags = get_the_tags();
		$tags_string = '';
		if($article_tags) {
			foreach ($article_tags as $article_tag) {
				$tags_string .= $article_tag->slug.',';
			}
		}

		    $tag_related_posts = get_posts('exclude=' . $post->ID . '&numberposts=' . $max_articles . '&tag=' . $tags_string);

		    if ($tag_related_posts) {
		    	foreach ($tag_related_posts as $related_post) {
		    		$cnt++;
		    		echo '<li class="child-' . $cnt . '">';
		    		$img_url = wp_get_attachment_url( get_post_thumbnail_id($related_post->ID) );
		    		echo '<img class="img-responsive" alt="thumbnail" src="'.$img_url.'">';
            		echo '<a href="' . get_permalink($related_post->ID) . '">';
            		echo $related_post->post_title . '</a></li>';
		    	}
		    }

		    // Only if there's not enough tag related articles,
    		// we add some from the same category
    		if ($cnt < $max_articles) {

		        $article_categories = get_the_category($post->ID);
		        $category_string = '';
		        foreach($article_categories as $category) {
		            $category_string .= $category->cat_ID . ',';
		        }

		        $cat_related_posts = get_posts('exclude=' . $post->ID . '&numberposts=' . $max_articles . '&category=' . $category_string);

		        if ($cat_related_posts) {
		            foreach ($cat_related_posts as $related_post) {
		                $cnt++;
		                if ($cnt > $max_articles) break;
		                echo '<li class="child-' . $cnt . '">';
		                echo '<a href="' . get_permalink($related_post->ID) . '">';
		                echo $related_post->post_title . '</a></li>';
		            }
		        }
		    }

		    echo '</ul>';

	}
?>
