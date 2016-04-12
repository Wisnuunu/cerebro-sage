<?php
/**
 * Template Name: Custom Template Contact Us
 */
?>

<div class="contact-us">

  <?php while (have_posts()) : the_post(); ?>
    <?php //get_template_part('templates/page', 'header'); ?>


  <div class="container content">
    <div class="address">
      <div class="col-md-4">
        <div class="head-office">
          <h4>Head Office:</h4>
          <ul>
            <li>Kawasan Industri Delta Silicon</li>
            <li>Jl. MH Thamrin Blok A3-I</li>
            <li>Lippo-Cikarang, Bekasi 17550</li>
            <li>Indonesia</li>
            <li>P.O.Box 370, Bekasi 17037</li>
            <li>Phone <span style="padding-left:10px;">:6221-89907333-37</span></li>
            <li>Fax <span style="padding-left:28px;">:6221-89907360</span></li>
          </ul>
        </div>
        <div class="marketing-office">
          <h4>Marketing Office:</h4>
          <ul>
            <li>Gedung KALBE</li>
            <li>Jl. Let. Jend. Suprapto Kav 4</li>
            <li>Jakarta 105010</li>
            <li>Indonesia</li>
            <li>P.O.Box 3105 JAK.</li>
            <li>Phone <span style="padding-left:10px;">:6221-42873888-89</span></li>
            <li>Fax <span style="padding-left:28px;">:6221-42873680</span></li>
          </ul>
        </div>
      </div>

      <div class="col-md-offset-1 col-md-7">
        <div class="map embed-responsive embed-responsive-4by3">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7196072956094!2d106.87029011436996!3d-6.168288962165546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5ab772db83d%3A0xbb31d7ca191c4680!2sKalbe+Farma!5e0!3m2!1sen!2sid!4v1450257308531"
            width="450" height="450" frameborder="0" style="border:0" allowfullscreen>
          </iframe>
        </div>
      </div>

    </div><!-- end row -->

   </div> <!--end container -->

   <!-- the content -->
   <div class="container">
     <div class="contact-form">
       <?php get_template_part('templates/content', 'page'); ?>
     </div>
   </div>

    <?php endwhile; ?>

</div>


<!-- page scripts -->
<script type="text/javascript">
$(document).ready(function(){

    //disabled submit button to prevent spam
    var message = $('.message').val();
    if (message == '') {
      $('#submit').addClass('disabled');
    }
    //enabled submit button when there is a message,
    //if textarea content is deleted then disable submit buton
    $('.message').on('input', function(e){
      if(e.target.value.length != 0) {
        $('#submit').removeClass('disabled');
      }
      else {
        $('#submit').addClass('disabled');
      }
    });

    $("#reset").click(function(e){
      e.preventDefault();
      $(".message").val("");
      $(".subject").val("");
    });

    /* call submit function */
    // $("#submit").click(function(e){
    //   e.preventDefault();
    //
    //   //submit data
    //   $("#contact-us").submit();
    // });

});

</script>
