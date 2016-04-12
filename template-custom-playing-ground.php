<?php
/**
 * Template Name: Custom Template SANDBOX
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<div class="container">
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

  <!-- embed googlemaps test -->
  <div class="sr-only">
    google maps should be showed here
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d63359.062954391826!2d110.4464927!3d-7.0161702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1460428659173"
      width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>

</div>


<?php if (isset($_POST['submit'])): ?>
  Your name is: <?php echo $_POST['yourname']; ?><br />
  Your e-mail: <?php echo $_POST['email']; ?><br />
  <br />

  Do you like this website? <?php echo $_POST['likeit']; ?><br />
  <br />

  Comments:<br />
  <?php echo $_POST['comments']; ?>

<?php endif; ?>
