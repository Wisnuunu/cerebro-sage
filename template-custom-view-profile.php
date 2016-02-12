<?php
/**
 * Template Name: Custom Template User Profile
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
        <?php
        if (function_exists("get_wp_user_avatar")) {
          echo get_wp_user_avatar($cur_user->ID, 120);
        }
        ?>
      </div>
      <div class="col-md-10 user-meta">
        <h4 class="user-login"><?php echo "".$cur_user->user_login; ?></h4>
        <div class="info-group">
            Member since: <?php echo date("d-m-Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?><br>
          <?php
            global $wpdb;
            $user_id = $post->post_author;
            $where = 'WHERE comment_approved = 1 AND user_id = ' . $cur_user->ID ;
            $comment_count = $wpdb->get_var(
                "SELECT COUNT( * ) AS total
                  FROM {$wpdb->comments}
                  {$where}"
            );
            echo 'Total comments: ' . $comment_count;
          ?>
        </div>
        <br>
        <a class="btn btn-default" href="<?php echo get_site_url();?>/user-dashboard-edit/">Edit Profile</a>
      </div>
     </div><!-- end user info header -->

     <div class="row main-profile">
       <div class="col-md-9 ">
         <div class="container-fluid profile-detail">

           <h4 class="title">Profile Detail</h4>
           <dl class="dl-horizontal">
             <div class="detail-group">
               <dt>Name:</dt>          <dd><?php echo $cur_user->first_name.' '.$cur_user->last_name; ?></dd>
             </div>
             <div class="detail-group">
               <dt>Gender:</dt>        <dd><?php echo get_user_meta( $cur_user->ID, 'gender', true ); ?></dd>
             </div>
             <div class="detail-group">
               <dt>Birthday:</dt>      <dd><?php echo get_user_meta( $cur_user->ID, 'birthday', true ); ?></dd>
             </div>
             <div class="detail-group">
               <dt>Address:</dt>       <dd><?php echo nl2br(get_user_meta( $cur_user->ID, 'address', true )); ?></dd>
             </div>
             <div class="detail-group">
               <dt>Phone:</dt>         <dd><?php echo get_user_meta( $cur_user->ID, 'phone', true ); ?></dd>
             </div>
             <div class="detail-group">
               <dt>Email:</dt>         <dd><?php echo $cur_user->user_email; ?></dd>
             </div>
             <div class="detail-group">
               <dt>Facebook (url):</dt><dd><?php echo get_user_meta( $cur_user->ID, 'facebook', true ); ?></dd>
             </div>
             <div class="detail-group">
               <dt>Twitter (url):</dt> <dd><?php echo get_user_meta( $cur_user->ID, 'twitter', true ); ?></dd>
             </div>
             <div class="detail-group">
               <dt>Google+:</dt>       <dd><?php echo get_user_meta( $cur_user->ID, 'googlep', true ); ?></dd>
             </div>
           </dl>

          </div>
       </div>

       <div class="col-md-3">
         <div class="container-fluid last-comment">
           <img class="img img-responsive" src="<?php bloginfo('template_url')?>/assets/images/user-dashboard/cb_user-lastcomment.png" alt="last comment" />
           <?php
            $args = array(
            	'user_id' => $cur_user->ID, // use user_id
              'number' => 6, // max comment to display
            );
            $comments = get_comments($args);
            echo "<ul>";
            if ($comments == 0) {
              echo "";
            }else {
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

            }
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
