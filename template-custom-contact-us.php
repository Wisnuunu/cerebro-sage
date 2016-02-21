<?php
/**
 * Template Name: Custom Template Contact Us
 */
?>

<div class="contact-us">

  <?php while (have_posts()) : the_post(); ?>
    <?php //get_template_part('templates/page', 'header'); ?>


  <div class="container content">
    <div class="row" style="background-color:rgba(255,255,255,.9)">
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

<!--
     <form class="contact-us" id="contact-us" action="<?php the_permalink();?>" method="post">
       <div class="container-fluid content" style="margin:20px 0; background-color:rgba(255,255,255,.9);">

         <p>
           Silahkan lengkapi form di bawah ini, tim Support kami akan melakukan verivikasi email Anda dan menghubungi Anda dalam waktu 3x24 jam. <br>
           <i>Note: Jika dalam 3x24 jam Anda belum mendapatkan balasan dair kami di email, periksa bagian SPAN dari email Anda.</i>
         </p>


         <?php //get user data
          // $current_user = wp_get_current_user();
          // $email = $current_user->user_email;
          // $username = $current_user->user_login;
         ?>
         <div class="row">
           <div class="form-group col-sm-5">
             <input id="email" class="form-control" type="email" name="email" value="<?php if(isset($email)) { echo $email; } ?>" placeholder="Email">
           </div>
         </div>

         <div class="row">
           <div class="form-group col-sm-6">
             <div class="col-sm-6 form-username">
               <input id="username" class="form-control" type="text" name="username" value="<?php if(isset($username)) {echo $username;}?>" placeholder="Username">
             </div>
             <div class="col-sm-6">
               <?php //if ($username == ""): ?>
                 <a class="login-link" href="<?php //echo get_home_url()."/login"; ?>">click here to log in</a>
               <?php //endif; ?>
             </div>
           </div>
         </div>

         <div class="row">
           <div class="form-group col-sm-3">
             <select class="category form-control" name="category">
               <option value="c1">cat 1</option>
               <option value="c2">cat 2</option>
               <option value="c3">cat 3</option>
               <option value="c4">cat 4</option>
             </select>
           </div>
         </div>

         <div class="row">
           <div class="form-group col-sm-5">
             <input class="subject form-control" type="text" name="subject" value="" placeholder="Subject">
           </div>
         </div>

         <div class="row">
           <div class="form-group col-sm-7">
             <textarea class="message form-control" name="message" rows="8" cols="40" placeholder="Message"></textarea>
           </div>
         </div>

         <div class="recaptcha">
           <div class="g-recaptcha" data-sitekey="6LdFSBMTAAAAAF0aQYGs1TcGyR7eifkpoUxg9aD5"></div>
         </div>


       </div> <!-- end container --><!---->

       <!-- <input type="hidden" name="submitted" id="submitted" value="true">
     </form>

      <div class="container-fluid buttons">
        <a type="submit" id="submit" class="btn btn-default" href="#">Submit</a>
        <a id="reset" class="btn btn-default" href="#">Reset</a>
      </div> -->

      <?php get_template_part('templates/content', 'page'); ?>
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


<!-- PHP scripts -->
<?php
/*  if (isset($_POST['submitted'])) {

    $error;

    $emailRegex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    //check email
    if (trim($_POST['email']) === ''){
      $error['email'] = 'Please enter email address';
      $hasError = true;
    }
    else if (!preg_match($emailRegex, trim($_POST['email']))) {
      $error['email'] = 'Your email is invalid';
      $hasError = true;
    }
    else {
      $email = trim($_POST['email']);
    }

    //check username
    if (trim($_POST['username']) === ''){
      $error['username'] = 'Username is invalid';
      $hasError = true;
    }
    else {
      $name = trim($_POST['username']);
    }

    //check category
    // if (trim($_POST['category']) === '') {
    //
    // }

    //check subject
    if (trim($_POST['subject']) === '') {
      $error['subject'] = 'Subject is invalid';
      $hasError = true;
    }
    else {
      $subject = trim($_POST['subject']);
    }

    //check message
    if (trim($_POST['message']) === '') {
      $error['message'] = 'Please enter message';
      $hasError = true;
    }
    else {
      $message = trim($_POST['message']);
    }

    //check chaptcha
    if (!isset($_POST['g-recaptcha-response'])) {
      $error['cap'] = 'Authentication failed';
      $hasError = true;
    }
    else {
      $cap = $_POST['g-recaptcha-response'];
    }

    $category = $_POST['category'];

    //send message to email
    if (!isset($hasError)) {
      $emailTo =  get_option('admin_email');
      $emailSubject = '[Cerebrovit Contact-Us] From '.$name.' Subject: '.$subject;
      $body = "Name: $name \n\nEmail: $email \n\nComments: $message";
      $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

      debug_to_console($emailSubject);
      debug_to_console($body);
      debug_to_console($headers);
      wp_mail('dr.dits@gmail.com', 'test wp_mail', 'do something');
      // wp_mail($emailTo, $subject, $body, $header);
      // $emailSent = true;
      // echo "".$emailTo;
      // echo "<br>".$emailSubject;
      // echo "<br>".$body;
      // echo "<br>".$header;
      // echo "<br>".wp_mail($emailTo, $subject, $body, $header);

      echo "<div class='alert alert-success' role='alert'>";
      echo "<p><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> <b>Message Sent</b><br>";
      echo "Thank you for contacting us </p>";
      echo "</div>";
    }
    else {
      //echo "error ".count($error)." <br>";
      //var_dump($error);
      echo "<div class='alert alert-danger' role='alert'>";
      echo "<ul class='error-notif'>";
      echo "<lh><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> <b>Error</b></lh>";
      if (isset($error['email']))
        echo "<li>".$error['email']."</li>";
      if (isset($error['username']))
        echo "<li>".$error['username']."</li>";
      if (isset($error['subject']))
        echo "<li>".$error['subject']."</li>";
      if (isset($error['message']))
        echo "<li>".$error['message']."</li>";
      echo "</ul>";
      echo "</div>";
    }
    //echo "Email:".$email." \nUsername:".$name;
    //echo "<br>Has Error:".$hasError." Email error:".$emailError." Username Error:".$nameError;


    //send notification
  }

  function debug_to_console($data) {
    if(is_array($data) || is_object($data))
  	{
  		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
  	} else {
  		echo("<script>console.log('PHP: ".$data."');</script>");
  	}
  }
*/
?>
