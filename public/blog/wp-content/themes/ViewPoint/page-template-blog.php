<?php 
/* 
Template name: Blog page template
*/
get_header();
global $viewpoint;
the_post(); 
$options = get_post_meta($post->ID, 'vp_ptemplate_settings', true);
?>
 <div class="bg">
    <div class="container">
        <div class="sixteen columns">
            <div class="heading" style="margin-bottom: 30px">
                <img src="<?php echo get_template_directory_uri();?>/images/star.png" alt="" />
                <h2><?php the_title();?></h2>
                <img src="<?php echo get_template_directory_uri();?>/images/star.png" alt="" />
            </div>
            <?php
            $args['posts_per_page'] = $options['blog_posts'];
            if($options['categories'] != '')
                 $args['category__in'] = $options['categories'];
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
            $i = 1;
            if(have_posts()) : while(have_posts()) : the_post(); ?>
                <div <?php post_class('article'); ?>>
                    <h3 style="margin-bottom: 5px"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <p class="line2nd meta">
                        <?php _e('Posted on', 'ViewPoint');?> <?php the_time("d M Y");?> 
                        in <?php the_category(', ') ?> | 
                        <?php comments_popup_link(esc_html__('0 comments','ViewPoint'), esc_html__('1 comment','ViewPoint'), '% '.esc_html__('comments','ViewPoint')); ?>
                    </p>
                    <?php the_excerpt(); ?>
                    <a class="readmore" href="<?php the_permalink();?>">Read More</a>
                </div>
            <?php endwhile; 
            get_template_part('includes/pagination');
            endif; wp_reset_query();?>
        </div> <!-- end sixteen columns -->
    </div>
</div>