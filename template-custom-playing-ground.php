<?php
/**
 * Template Name: Custom Template SANDBOX
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<form action="" method="post">
  <p>Your Name: <input type="text" name="yourname" /><br />
  E-mail: <input type="text" name="email" /></p>

  <p>Do you like this website?
  <input type="radio" name="likeit" value="Yes" checked="checked" /> Yes
  <input type="radio" name="likeit" value="No" /> No
  <input type="radio" name="likeit" value="Not sure" /> Not sure</p>

  <p>Your comments:<br />
  <textarea name="comments" rows="10" cols="40"></textarea></p>

  <p><input type="submit" name="submit" value="Send it!"></p>
</form>

<?php if (isset($_POST['submit'])): ?>
  Your name is: <?php echo $_POST['yourname']; ?><br />
  Your e-mail: <?php echo $_POST['email']; ?><br />
  <br />

  Do you like this website? <?php echo $_POST['likeit']; ?><br />
  <br />

  Comments:<br />
  <?php echo $_POST['comments']; ?>

<?php endif; ?>
