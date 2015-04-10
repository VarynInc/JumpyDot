<?php
global $viewpoint;
if(isset($_POST['submit']))
{
    $info = 'Info: ' . $_POST['name'] . '; ' . $_POST['email'] . '; ' . $_POST['comment'];

    // user submitted the contact form
    if( ! $_POST['name'] || ! $_POST['email'] || ! $_POST['comment'] || $_POST['name'] == '' || $_POST['email'] == '' || $_POST['comment'] == '')
    {
        $error = 'Please fill in all the required fields';
    }
    else
    {
        require('../../../wp-load.php');
        require('../../../../procs/EnginesisMailer.php');
        $viewpoint = get_option('viewpoint');
        $name = esc_html($_POST['name']);
        $email = esc_html($_POST['email']);
        $comment = esc_html($_POST['comment']);
        $msg = esc_attr('Name: ', 'ViewPoint') . $name . PHP_EOL;
        $msg .= esc_attr('E-mail: ', 'ViewPoint') . $email . PHP_EOL;
        $msg .= esc_attr('Message: ', 'ViewPoint') . $comment;
        $to = $viewpoint['email'];
        $sitename = get_bloginfo('name');
        $subject = '[' . $sitename . ']' . ' New Message';
        $headers = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
        wp_mail($to, $subject, $msg, $headers);
        $error = "<b>Thank you!</b> Your message has been sent. Please allow 24 hours for a response if one is required.";
    }
}
get_header(); ?>

    <div class="nav2">
       <?php show_top_menu(2);?>
    </div> <!-- end nav2 -->

    <?php
    if($viewpoint['pages_topmenu'] != '') {
        query_posts(array( 'post_type' => 'page', 'post__in' => $viewpoint['pages_topmenu'], 'posts_per_page' => count($viewpoint['pages_topmenu']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
    } else {
        query_posts(array( 'post_type' => 'page', 'posts_per_page' => 4) );
    }
    $i = 1;
    while(have_posts() ) : the_post(); ?>
        <div class="bg" id="<?php echo $post->post_name;?>" <?php if($i == count($viewpoint['pages_topmenu'])) echo ' style="padding-bottom: 20px"';?>>
            <div class="container">
                <div class="sixteen columns">
                     <div class="heading">
                    <img src="<?php echo get_template_directory_uri();?>/images/star.png" alt="" />
                    <h2><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></h2>
                    <img src="<?php echo get_template_directory_uri();?>/images/star.png" alt="" />
                </div>
                    <p class="headline"><?php echo get_post_meta($post->ID, 'headline', true);?></p>
                 </div> <!-- end sixteen columns -->
                 <div class="clear"></div>

            <?php global $more; $more = 0; the_content('');?>

            </div> <!-- end container -->
        </div> <!-- end bg -->
         <?php if($i != count($viewpoint['pages_topmenu'])) { ?>
         <div class="dotted-bar2">
            <a href="#intro"><span class="top"></span></a>
        </div>
        <?php } ?>
    <?php $i++; endwhile; wp_reset_query(); ?>


    <div id="contact">

        <div class="bg2"></div>

        <div class="dotted-bar3">
            <a href="#intro"><span class="top2"></span></a>
        </div>

        <div class="container">

            <div class="sixteen columns">
                <h2><span class="line"></span><img src="<?php echo get_template_directory_uri();?>/images/star-white.png" alt="" /> Contact <img src="<?php echo get_template_directory_uri();?>/images/star-white.png" alt="" /><span class="line2"></span></h2>
            </div> <!-- end sixteen columns -->

            <div class="clear"></div>

            <div class="eight columns">
                <div class="contact-form">

                    <div class="done">
                        <?php _e('<b>Thank you!</b> Your message has been sent. Please allow 24 hours for a response if one is required.', 'ViewPoint');?>
                    </div>

                    <form method="post" action="/index.php">
                        <p><?php _e('Name', 'ViewPoint');?></p>
                        <input type="text" name="name" class="text" />

                        <p><?php _e('Email', 'ViewPoint');?></p>
                        <input type="text" name="email" class="text" id="email" />

                       <p><?php _e('Message', 'ViewPoint');?></p>
                        <textarea name="comment" class="text"></textarea>

                        <input type="submit" name="submit" id="submit" value="<?php _e('Send', 'ViewPoint');?>" class="submit-button" />
                    </form>

                    <div class="loading" style="display: none;">
                        <img src="<?php echo get_template_directory_uri();?>/images/loading.gif" boarder="0" width="30" height="30" />
                    </div>
                </div> <!-- end contact-form -->
            </div> <!-- end eight columns -->

            <div class="eight columns">

                <?php if(isset($viewpoint['googlemaps']) && $viewpoint['googlemaps'] != '') { ?>
                    <iframe class="map" width="460" height="180" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $viewpoint['googlemaps'];?>"></iframe>
                <?php } ?>
                <div class="contact-info">
                    <div class="four columns alpha">
                        <?php if(isset($viewpoint['email']) && $viewpoint['email'] != '') { ?>
                        <p><a href="mailto:<?php echo encEmail(esc_attr($viewpoint['email'])); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icn-email.png" alt="" /></a>
                            <?php echo encEmail(esc_attr($viewpoint['email'])); ?>
                        </p>
                        <?php } ?>
                       <?php if(isset($viewpoint['phone']) && $viewpoint['phone'] != '') { ?>
                           <p>
                                <img src="<?php echo get_template_directory_uri();?>/images/icn-phone.png" alt="" />
                                <?php echo esc_attr($viewpoint['phone']);?>
                            </p>
                        <?php } ?>
                    </div>

                    <div class="four columns omega">
                        <?php if(isset($viewpoint['location']) && $viewpoint['location'] != '') { ?>
                        <p>
                            <img src="<?php echo get_template_directory_uri();?>/images/icn-address.png" alt="" />
                            <?php echo esc_attr($viewpoint['location']);?>
                        </p>
                        <?php } ?>
                    </div>
                </div> <!-- end contact-info -->

            </div> <!-- end eight columns -->

        </div> <!-- end container -->

        <div class="copyright">
            <p>Copyright &copy; 2015 <?php echo bloginfo('name');?> <?php _e('All rights reserved', 'ViewPoint');?>. </p>
        </div> <!-- end copyright -->

    </div> <!-- end contact -->
<?php get_footer();?>