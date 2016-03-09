<!--
  use this page for 'other' content type,
  such as view all post by category, or other tags

  it was smallest part of main content,
  eg: in blog style, it has 9 post per page. this is 1 of displayed post.
-->

<div class="container">
  <article <?php post_class(); ?>>

    <header>
      <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  </article>
</div>
