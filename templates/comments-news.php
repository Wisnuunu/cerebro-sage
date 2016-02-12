<?php
if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments">

  <div id="comment-counter">
    <span>
      <?php
        if(have_comments()) {
          echo get_comments_number()." comments";
        }
        else {
          echo "0 comments";
        }
      ?>
    </span>
  </div>

  <?php
  $comment_args = array(
    'label_submit'=>'Send',
    'title_reply'=>'',
    'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true" placeholder="Write your comment here...">' .
    '</textarea></p>'
  );
  comment_form($comment_args);

  ?>

  <div class="container-fluid" id="comment-main">
    <?php if (have_comments()) : ?>
      <!-- <h2><?php printf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'); ?></h2> -->

      <ol class="comment-list">
        <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
      </ol>

      <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav>
          <ul class="pager">
            <?php if (get_previous_comments_link()) : ?>
              <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
            <?php endif; ?>
            <?php if (get_next_comments_link()) : ?>
              <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
            <?php endif; ?>
          </ul>
        </nav>
      <?php endif; ?>
    <?php endif; // have_comments() ?>
  </div>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'sage'); ?>
    </div>
  <?php endif; ?>

</section>
