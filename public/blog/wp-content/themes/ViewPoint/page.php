<?php 
get_header();
the_post(); 
?>
 <div class="bg">
    <div class="container">
            <div class="heading" style="margin-bottom: 10px">
                <img src="<?php echo get_template_directory_uri();?>/images/star.png" alt="" />
                <h2><?php the_title();?></h2>
                <img src="<?php echo get_template_directory_uri();?>/images/star.png" alt="" />
            </div>
            <p class="headline singlemeta">
                <?php _e('Posted on', 'ViewPoint');?> 
                <?php the_time("d M Y");?> 
                | 
                <?php comments_popup_link(esc_html__('0 comments','ViewPoint'), esc_html__('1 comment','ViewPoint'), '% '.esc_html__('comments','ViewPoint')); ?>
            </p>
            <div class="single">
                  <?php the_content();?>
                  <?php 
                  edit_post_link(); 
                  comments_template('', true);?>
             </div>
    </div>
</div>
<?php get_footer();?>