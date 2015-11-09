<article <?php post_class(); ?>>

	<section id="prev-next">
		<div class="col-xs-6">
			<?php previous_post_link('&laquo; %link', '%title', TRUE, '', 'post_format'); ?>
		</div>
		<div class="col-xs-6">
			<?php next_post_link('%link &raquo;', '%title', TRUE, '', 'post_format'); ?>
		</div>
	</section>

	<header>
	  <h1 class="entry-title"><?php the_title(); ?></h1>
	  <?php get_template_part('templates/entry-meta'); ?>
	</header>

	<div class="entry-content">
	  <?php the_content(); ?>
	</div>

	<footer>
	  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
	</footer>
	<?php comments_template('/templates/comments.php'); ?> 
</article>
