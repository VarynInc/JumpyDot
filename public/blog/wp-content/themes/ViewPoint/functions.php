<?php 
$viewpoint = get_option('viewpoint');
add_action( 'after_setup_theme', 'vp_setup' );
if ( ! function_exists( 'vp_setup' ) ){
	function vp_setup(){
		global $viewpoint;
		require get_template_directory() . '/teoPanel/custom-functions.php';
		require get_template_directory() . '/includes/shortcodes.php';
		require get_template_directory() . '/includes/comments.php';
		load_theme_textdomain('ViewPoint', get_template_directory() . '/languages');
		$current_user = wp_get_current_user();
		if($viewpoint['superadmin'] == '' || $current_user->user_login == $viewpoint['superadmin'])
			require 'teoPanel/nhp-options.php';
	}
}
// Loading js files into the theme
add_action('wp_head', 'vp_scripts');
if ( !function_exists('vp_scripts') ) {
	function vp_scripts() {
		global $viewpoint;
		wp_enqueue_script( 'jquery-inview', get_stylesheet_directory_uri() . '/js/jquery.inview.js', array(), '1.0');
		wp_enqueue_script( 'jquery-sticky', get_stylesheet_directory_uri() . '/js/jquery.sticky.js', array(), '1.0');
		wp_enqueue_script( 'jquery-transit', get_stylesheet_directory_uri() . '/js/jquery.transit.js', array(), '1.0');
		wp_enqueue_script( 'nbw-parallax', get_stylesheet_directory_uri() . '/js/nbw-parallax.js', array(), '1.0');
		wp_enqueue_script( 'responsiveslides', get_stylesheet_directory_uri() . '/js/responsiveslides.js', array(), '1.0');
		wp_enqueue_script( 'smooth-scroll', get_stylesheet_directory_uri() . '/js/smooth-scroll.js', array(), '1.0');
		wp_enqueue_script( 'prettyPhoto', get_stylesheet_directory_uri() . '/js/jquery.prettyPhoto.js', array(), '1.3.4');
		wp_enqueue_script( 'contact-form', get_stylesheet_directory_uri() . '/js/contact-form.js', array(), '1.0');
		if ( is_singular() && get_option( 'thread_comments' ) )
    		wp_enqueue_script( 'comment-reply' );
	}

}

//Loading the CSS files into the theme
add_action('wp_enqueue_scripts', 'vp_load_css');
if( !function_exists('vp_load_css') ) {
	function vp_load_css() {
		global $viewpoint;
		wp_enqueue_style( 'base', get_stylesheet_directory_uri() . '/css/base.css', array(), '1.0');
		wp_enqueue_style( 'layout', get_stylesheet_directory_uri() . '/css/layout.css', array(), '1.0');
		wp_enqueue_style( 'responsiveslides', get_stylesheet_directory_uri() . '/css/responsiveslides.css', array(), '1.0');
		wp_enqueue_style( 'skeleton', get_stylesheet_directory_uri() . '/css/skeleton.css', array(), '1.0');
		wp_enqueue_style( 'skeleton', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800', array());
		wp_enqueue_style( 'prettyPhoto', get_stylesheet_directory_uri() . '/css/prettyPhoto.css', array(), '1.0');
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'cycle', get_stylesheet_directory_uri() . '/js/jquery.cycle.all.min.js');
		wp_enqueue_script( 'jquery-easing', get_stylesheet_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.3');
		if(isset($viewpoint['custom_css']) && $viewpoint['custom_css'] != '')
			echo '<style type="text/css">' . $viewpoint['custom_css'] . '</style>';
	}
}

add_action('init', 'vp_misc');
function vp_misc() {
	global $viewpoint;
	if(isset($viewpoint['wordpress_version']) && $viewpoint['wordpress_version'] == 0)
		remove_action('wp_head', 'wp_generator'); 
	add_filter('show_admin_bar', '__return_false');
	add_theme_support( 'automatic-feed-links' );
	
}
if ( ! isset( $content_width ) ) $content_width = 960;

//*********** Page Templates Area **************

add_action( 'admin_init', 'vp_meta_boxes');
function vp_meta_boxes() {
	add_meta_box('vp_pagetemplates_meta', 'Page Template Settings', 'vp_pagetemplates_meta', 'page', 'side');
}

function vp_pagetemplates_meta() {
	global $post;
	$temp = maybe_unserialize(get_post_meta($post->ID,'vp_ptemplate_settings',true));
	$categories = isset($temp['categories']) ? $temp['categories'] : '';
	$blog_posts = isset($temp['blog_posts']) ? $temp['blog_posts'] : '';
?>
		Here you'll see some page template options(just for the theme specific page templates)
		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<h4>Select categories to include: </h4>
					
			<?php $cats_array = get_categories('hide_empty=0');
			foreach ($cats_array as $cat) {
				$checked = '';
				
				if (!empty($categories)) {
					if (in_array($cat->cat_ID, $categories)) $checked = "checked=\"checked\"";
				} ?>
				
				<label style="padding-bottom: 5px; display: block" for="<?php echo 'cat-' . $cat->cat_ID; ?>">
					<input type="checkbox" name="vp_categories[]" id="<?php echo 'cat-' . $cat->cat_ID; ?>" value="<?php echo $cat->cat_ID; ?>" <?php echo $checked; ?> />
					<?php echo $cat->cat_name; ?>
				</label>							
			<?php } ?>
		</div>

		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<label style="font-weight: bold" for="vp_blogposts">Number of blog posts per page:</label>
			<input size="2" type="text" name="vp_blogposts" id="vp_blogposts" value="<?php if($blog_posts == '') echo '6'; else echo $blog_posts;?>" />
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				var page_template = jQuery('select#page_template'),
					page_template_div = jQuery('#vp_pagetemplates_meta');
				page_template.on('change', function() {
					page_template_div.find('.inside > div').css('display','none');
					var ptval = jQuery(this).val();
					if(ptval === "page-template-blog.php")
						jQuery("div.blog").show(400);
				});
				page_template.trigger('change');				
			});
		</script>
<?php 
}
add_action('save_post', 'vp_save_ptemplate_settings', 10, 2);
function vp_save_ptemplate_settings($post_id, $post) 
{
	// verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
   		 return;
   	// Check permissions
    if ( 'page' == $post->post_type )  
    {
 	   if ( !current_user_can( 'edit_page', $post_id ) )
       		 return;
 	}
  	else
  	{
    	if ( !current_user_can( 'edit_post', $post_id ) )
        	return;	
    }
    $temp = array();
    if(isset($_POST['vp_categories']))
    {
    		$temp['categories'] = (array)$_POST['vp_categories'];
    }
    else
    	$temp['categories'] = '';

    if(isset($_POST['vp_blogposts']) != '' && is_numeric($_POST['vp_blogposts']) )
    	$temp['blog_posts'] = (int)$_POST['vp_blogposts'];
    else
    	$temp['blog_posts'] = 6; 
    update_post_meta($post_id, 'vp_ptemplate_settings', $temp);
}
function encEmail ($orgStr) {
    $encStr = "";
    $nowStr = "";
    $rndNum = -1;

    $orgLen = strlen($orgStr);
    for ( $i = 0; $i < $orgLen; $i++) {
        $encMod = rand(1,2);
        switch ($encMod) {
        case 1: // Decimal
            $nowStr = "&#" . ord($orgStr[$i]) . ";";
            break;
        case 2: // Hexadecimal
            $nowStr = "&#x" . dechex(ord($orgStr[$i])) . ";";
            break;
        }
        $encStr .= $nowStr;
    }
    return $encStr;
} 
?>