<?php
/**
 * Template Name: Custom Template User Profile - edit
 */
?>

<div class="user-dashboard">
  <div class="container">

  <?php while (have_posts()) : the_post(); ?>
    <?php //get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
  <?php endwhile; ?>

  <?php if(is_user_logged_in()): ?>
    <?php $cur_user = wp_get_current_user(); ?>
    <div class="row user-info-header">
      <div class="col-md-2 user-photo">
        <?php echo get_avatar(get_the_author_meta('ID'), 'large'); ?>
      </div>
      <div class="col-md-10 user-meta">
        <h4 class="user-login"><?php echo "".$cur_user->user_login; ?></h4>
        <div class="info-group">
            Member since: <?php echo date("d-m-Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?><br>
          <?php
            global $wpdb;
            $user_id = $post->post_author;
            $where = 'WHERE comment_approved = 1 AND user_id = ' . $user_id ;
            $comment_count = $wpdb->get_var(
                "SELECT COUNT( * ) AS total
                  FROM {$wpdb->comments}
                  {$where}"
            );
            echo 'Total comments: ' . $comment_count;
          ?>
        </div>
        <br>
        <a class="btn btn-default" href="<?php echo get_site_url();?>/user-dashboard/">Back to Profile</a>
      </div>
     </div><!-- end user info header -->

     <div class="row main-profile">
       <div class="col-md-9 ">
         <div class="container-fluid profile-detail">

           <!-- <div class="profile-group"> -->
             <h4 class="title">Profile Detail</h4>

             <div class="form-group">
               <label for="profilepicture" class="col-sm-3 control-label">Profile Picture:</label>
               <div class="col-sm-9">
                 <?php echo "".do_shortcode('[avatar_upload]'); ?>
               </div>
             </div>

             <form class="form-horizontal" action="<?php the_permalink();?>" method="post">

                 <div class="form-group">
                   <label for="profilename" class="col-sm-3 control-label">Profile Name:</label>
                   <div class="col-sm-9">
                     <input class="form-control" type="text" name="profilename" value="<?php echo $userdata->display_name; ?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="fname" class="col-sm-3 control-label">Name:</label>
                   <div class="col-sm-9">
                     <input class="form-control" type="text" name="fname" value="<?php echo $userdata->first_name; ?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="gender" class="col-sm-3 control-label">Gender:</label>
                   <div class="col-sm-9">
                     <?php
                      $cur_gender = $userdata->gender;
                      if (isset($cur_gender)){
                        if ($cur_gender === 'male') {
                          echo '<label class="radio-inline">';
                            echo '<input type="radio" name="gender" value="male" checked="true"> Male ';
                          echo '</label>';
                          echo '<label class="radio-inline">';
                            echo '<input type="radio" name="gender" value="female" > Female ';
                          echo '</label>';

                        }
                        elseif ($cur_gender === 'female') {
                          echo '<label class="radio-inline">';
                            echo '<input type="radio" name="gender" value="male"> Male ';
                          echo '</label>';
                          echo '<label class="radio-inline">';
                            echo '<input type="radio" name="gender" value="female" checked="true"> Female ';
                          echo '</label>';
                        }
                      }
                      else {
                        echo '<label class="radio-inline">';
                          echo '<input type="radio" name="gender" value="male"> Male ';
                        echo '</label>';
                        echo '<label class="radio-inline">';
                          echo '<input type="radio" name="gender" value="female"> Female ';
                        echo '</label>';
                      }
                     ?>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="birthday" class="col-sm-3 control-label">Birthday:</label>
                   <div class="col-sm-9">
                     <div class="input-group datetime datepicker" id="datetimepicker1">
                       <?php $bd = get_the_author_meta( 'birthday' );?>
                       <input class="form-control make-datepicker" type="text" name="birthday" id="leaving_time" placeholder="<?php echo get_the_author_meta( 'birthday' ); ?>">
                       <span class="input-group-addon">
                         <i class="glyphicon glyphicon-calendar"></i>
                       </span>
                     </div>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="address" class="col-sm-3 control-label">Address:</label>
                   <div class="col-sm-9">
                     <textarea class="form-control" name="address" rows="3" cols="40"><?php echo esc_attr( get_the_author_meta( 'address', $userdata->ID ) ); ?>
                     </textarea>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="phone" class="col-sm-3 control-label">Phone:</label>
                   <div class="col-sm-9">
                     <input class="form-control" type="text" name="phone" value="<?php echo get_the_author_meta( 'phone' ); ?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="facebook" class="col-sm-3 control-label">Facebook (url):</label>
                   <div class="col-sm-9">
                     <input class="form-control" type="text" name="facebook" value="<?php echo get_the_author_meta( 'facebook' ); ?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="twitter" class="col-sm-3 control-label">Twitter (url):</label>
                   <div class="col-sm-9">
                     <input class="form-control" type="text" name="twitter" value="<?php echo get_the_author_meta( 'twitter' ); ?>">
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="googlep" class="col-sm-3 control-label">Google+:</label>
                   <div class="col-sm-9">
                     <input class="form-control" type="text" name="googlep" value="<?php echo get_the_author_meta( 'googlep' ); ?>">
                   </div>
                 </div>

                <!-- </div> -->
                <hr><br>
                <div class="profile-group">
                   <h4 class="title">Profile Detail</h4>

                   <div class="form-group">
                     <label for="curpass" class="col-sm-3 control-label">Current Password:</label>
                     <div class="col-sm-9">
                       <input class="form-control" type="password" name="curpass" value="">
                       <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-pass">Forgot Password?</a>
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="newpass" class="col-sm-3 control-label">New Password:</label>
                     <div class="col-sm-9">
                       <input class="form-control" type="password" name="newpass" value="">
                     </div>
                   </div>

                   <div class="form-group">
                     <label for="re-newpass" class="col-sm-3 control-label">Re-type New Password:</label>
                     <div class="col-sm-9">
                       <input class="form-control" type="password" name="re-newpass" value="">
                     </div>
                   </div>
                 </div><!--  end profile group -->

                 <hr><br>
                <div class="form-group buttons">
                  <input class="btn btn-primary" type="submit" name="save" value="Save">
                  <button class="btn btn-primary" type="button" name="reset">Reset</button>
                </div>

           </form>

           <?php

           $err = "";
           $suc = "";

            if (isset($_POST['save'])) {
              $userdatas = array();
              //save initial variables
              // --- update user
              $userdatas['display_name']  = (isset($_POST['profilename'])) ? esc_attr($_POST['profilename']) : $userdata->display_name ;
              $userdatas['first_name']    = (isset($_POST['fname'])) ? esc_attr($_POST['fname']) : $userdata->first_name ;
              // --- update user meta
              $userdatas['gender']        = (isset($_POST['gender'])) ? esc_attr($_POST['gender']) : $userdata->gender ;
              $userdatas['birthday']      = (isset($_POST['birthday'])) ? esc_attr($_POST['birthday']) : get_the_author_meta( 'birthday' ) ;
              $userdatas['address']       = (isset($_POST['address'])) ? esc_attr($_POST['address']) : get_the_author_meta( 'address') ;
              $userdatas['phone']         = (isset($_POST['phone'])) ? esc_attr($_POST['phone']) : get_the_author_meta( 'phone' ) ;
              $userdatas['facebook']      = (isset($_POST['facebook'])) ? esc_attr($_POST['facebook']) : get_the_author_meta( 'facebook' ) ;
              $userdatas['twitter']       = (isset($_POST['twitter'])) ? esc_attr($_POST['twitter']) : get_the_author_meta( 'twitter' ) ;
              $userdatas['googlep']       = (isset($_POST['googlep'])) ? esc_attr($_POST['googlep']) : get_the_author_meta( 'googlep' ) ;

              //echo "arr length: ".count($userdatas)."<br>";
              //print_r( array_values( $userdatas ));
              //get updated variables & save everything
              $args_user = array(
                'ID' => $userdata->ID,
                'display_name'  => $userdatas['display_name'],
                'first_name'    => $userdatas['first_name'],
              );
              wp_update_user($args_user);

              update_user_meta($userdata->ID, 'gender', $userdatas['gender']);
              update_user_meta($userdata->ID, 'birthday', $userdatas['birthday']);
              update_user_meta($userdata->ID, 'address', $userdatas['address']);
              update_user_meta($userdata->ID, 'phone', $userdatas['phone']);
              update_user_meta($userdata->ID, 'facebook', $userdatas['facebook']);
              update_user_meta($userdata->ID, 'twitter', $userdatas['twitter']);
              update_user_meta($userdata->ID, 'googlep', $userdatas['googlep']);

              // pasword handle
              if (isset($_POST['curpass']) && isset($_POST['newpass'])) {
                //check if cur password is correct with the one which is saved in database
                if(!wp_check_password($_POST['curpass'], $userdata->data->user_pass, $userdata->ID)) {
                  $err .= " Current password is not match";
                }
                else {
                  //check if new password and retype new pasword is session_name
                  if ($_POST['newpass'] != $_POST['re-newpass']) {
                    $err .= " New passwords are not match";
                  }
                  else {
                    //save password
                    wp_set_password(esc_attr($_POST['newpass']), $userdata->ID);
                  }

                }
                //notify if the save is success
                if ($err === "") {
                  echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbspPassword is updated</div>';
                }
                else {
                  echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp'.$err.'</div>';
                }
              }

              echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbspNew user information is updated</div>';

            }
           ?>

          </div>
       </div>

       <div class="col-md-3">
         <div class="container-fluid last-comment">
           <img class="img img-responsive" src="<?php bloginfo('template_url')?>/assets/images/user-dashboard/cb_user-lastcomment.png" alt="last comment" />
           <?php
            $args = array(
            	'user_id' => 1, // use user_id
              'number' => 6, // max comment to display
            );
            $comments = get_comments($args);
            echo "<ul>";
           foreach($comments as $comment) : ?>
           <li>
              <div class="comment">
                <?php
                  $postID = $comment->comment_post_ID;
                  $postURL = get_post_permalink($postID);

                  if (function_exists('getExcerpt'))
                    echo "<a href=".$postURL.">".getExcerpt($comment->comment_content)."</a>";
                ?>
              </div>
              <div class="date">
                  <?php echo comment_date('d M Y', $comment->comment_ID)  ?>
              </div>
            	<!-- echo($comment->comment_author . '<br />' . ); -->
           </li>
           <?php endforeach;
            echo "</ul>";
           ?>
       </div>
       </div>
     </div><!--  end main profile -->
     <br>
     <div class="row popular-post">
       <div class="container-fluid">
         <section id="popular-post">
           <div class="popular-post-header">
             <img class="img img-responsive" src="<?php bloginfo('template_url')?>/assets/images/smart-news/cb_news-popularpost.png" alt="" />
           </div>

       		<?php
       		    if (function_exists('wpp_get_mostpopular'))
       		        wpp_get_mostpopular( "
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
       </div>
     </div>
  <?php else:
    auth_redirect(); ?>
  <?php endif; ?>

 </div><!-- end container -->
</div><!-- end user dashboard -->


<!-- birthday script -->
<script type="text/javascript">

	$(function () {
        $('#datetimepicker1').datetimepicker({
        	format: 'DD/MM/YYYY',
          defaultDate:  '<?php echo get_the_author_meta( 'birthday' );?>'
        });
    });
</script>
