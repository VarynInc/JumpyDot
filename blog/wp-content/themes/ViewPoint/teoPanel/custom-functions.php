<?php 
add_filter('wp_title', 'vp_filter_wp_title', 9, 3);
function vp_filter_wp_title( $old_title, $sep, $sep_location ) {
	$ssep = ' ' . $sep . ' ';
	if (is_home() ) {
		return get_bloginfo('name');
	}
	elseif(is_single() || is_page() )
	{
		return get_the_title();
	}
	elseif( is_category() ) $output = $ssep . 'Category';
	elseif( is_tag() ) $output = $ssep . 'Tag';
	elseif( is_author() ) $output = $ssep . 'Author';
	elseif( is_year() || is_month() || is_day() ) $output = $ssep . 'Archives';
	else $output = NULL;
	 
	// get the page number we're on (index)
	if( get_query_var( 'paged' ) )
	$num = $ssep . 'page ' . get_query_var( 'paged' );
	 
	// get the page number we're on (multipage post)
	elseif( get_query_var( 'page' ) )
	$num = $ssep . 'page ' . get_query_var( 'page' );
		 
	// else
	else $num = NULL;
		 
	// concoct and return new title
	return get_bloginfo( 'name' ) . $output . $old_title . $num;
}

//This function shows the top menu if the user didn't create the menu in Appearance -> Menus.
if( !function_exists( 'show_top_menu') )
{
	function show_top_menu($option) {
		global $viewpoint;
		echo '<ul>';
		if(isset($viewpoint['pages_topmenu']) && $viewpoint['pages_topmenu'] != '' )
			$pages = get_pages( array('include' => $viewpoint['pages_topmenu'], 'sort_column' => 'menu_order', 'sort_order' => 'ASC') );
		else
			$pages = get_pages('number=4');
		if(isset($viewpoint['blog_page']) && $viewpoint['blog_page'] != '')
			$pages[] = $viewpoint['blog_page'];
		$count = count($pages);
		for($i = 0; $i < $count / 2; $i++)
		{
			echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		if($option == 1) echo '<li style="border: 0"><a href="/"><span class="logo"><span class="logotext">' . $viewpoint['logo_text'] . '</span></span></a></li>' . PHP_EOL;
		for($i = round($count / 2); $i < $count; $i++)
		{
			if($i == $count-1 && isset($viewpoint['blog_page']) && $viewpoint['blog_page'] != '')
				echo '<li><a href="' . get_permalink($viewpoint['blog_page'][0]) . '">Blog</a></li>';
			else
			{
				echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
			}
		}
		echo '<li><a href="' . get_home_url() . '/#contact">Contact</a></li>' . PHP_EOL;
		echo '</ul>';
	}
}

add_action('wp_head', 'vp_customization');
//This function handles the Colorization tab of the theme options
if(! function_exists('vp_customization'))
{
	function vp_customization() {
		//favicon
		global $viewpoint;

		//Loading the google web fonts on the page.
		$loaded[] = 'Open+Sans';
		if(!in_array($viewpoint['pagetitle_font'], $loaded))
		{
			echo '<link id="' . $viewpoint['pagetitle_font'] . '" href="http://fonts.googleapis.com/css?family=' . $viewpoint['pagetitle_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $viewpoint['pagetitle_font'];
		}

		if(!in_array($viewpoint['headline_font'], $loaded))
		{
			echo '<link id="' . $viewpoint['headline_font'] . '" href="http://fonts.googleapis.com/css?family=' . $viewpoint['headline_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $viewpoint['headline_font'];
		}

		if(!in_array($viewpoint['h3_font'], $loaded))
		{
			echo '<link id="' . $viewpoint['h3_font'] . '" href="http://fonts.googleapis.com/css?family=' . $viewpoint['h3_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $viewpoint['h3_font'];
		}

		if(!in_array($viewpoint['h4_font'], $loaded))
		{
			echo '<link id="' . $viewpoint['h4_font'] . '" href="http://fonts.googleapis.com/css?family=' . $viewpoint['h4_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $viewpoint['h4_font'];
		}

		if(!in_array($viewpoint['testimonial_font'], $loaded))
		{
			echo '<link id="' . $viewpoint['testimonial_font'] . '" href="http://fonts.googleapis.com/css?family=' . $viewpoint['testimonial_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;	
			$loaded[] = $viewpoint['testimonial_font'];
		}

		if(!in_array($viewpoint['footer_font'], $loaded))
		{
			echo '<link id="' . $viewpoint['footer_font'] . '" href="http://fonts.googleapis.com/css?family=' . $viewpoint['footer_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $viewpoint['footer_font'];
		}	

		if($viewpoint['favicon'] != '')
			echo '<link rel="shortcut icon" href="' . $viewpoint['favicon'] . '" />';
		//add custom CSS as per the theme options only if custom colorization was enabled.
		if($viewpoint['enable_colorization'] == 1)
		{
			$loaded = array();
			echo "\n<style type='text/css'> \n";
			if($viewpoint['bg_image'] != '')
			{ 
				echo "#intro .bg1, #contact .bg2 { background-image: url('" . $viewpoint['bg_image'] . "'); } \n";
			}
			if($viewpoint['bg_color'] != '') 
			{
				echo "#intro .bg1, #contact .bg2 { background-image: none; background-color: " . $viewpoint['bg_color'] . "; } \n";
			}
			echo '
			p { font-size: ' . $viewpoint['body_size'] . 'px; color: ' . $viewpoint['body_color'] . '; font-family: \'' . str_replace('+', ' ', $viewpoint['body_font']) . '\',sans-serif; }
			h1 { font-size: ' . $viewpoint['top_headertext_size'] . 'px; color: ' . $viewpoint['top_headertext_color'] . '; }
			h1.smallh1 { font-size: ' . $viewpoint['top_smalltext_size'] . 'px; color: ' . $viewpoint['top_smalltext_color'] . '; }
			h1.smallerh1 { font-size: ' . $viewpoint['top_smallertext_size'] . 'px; color: ' . $viewpoint['top_smallertext_color'] . '; }
			nav a { font-size: ' . $viewpoint['nav_size'] . 'px; color: ' . $viewpoint['nav_color'] . ' !important; }
			nav a:hover { color: ' . $viewpoint['nav_hovercolor'] . ' !important; }
			span.logotext { font-size: ' . $viewpoint['logo_size'] . 'px; color: ' . $viewpoint['logo_color'] . '; }
			h2 { font-size: ' . $viewpoint['pagetitle_size'] . 'px; color: ' . $viewpoint['pagetitle_color'] . '; font-family: \'' . str_replace('+', ' ', $viewpoint['pagetitle_font']) . '\',sans-serif; }
			p.headline { font-size: ' . $viewpoint['headline_size'] . 'px; color: ' . $viewpoint['headline_color'] . '; font-family: \'' . str_replace('+', ' ', $viewpoint['headline_font']) . '\',sans-serif; }
			h3 { font-size: ' . $viewpoint['h3_size'] . 'px; font-family: \'' . str_replace('+', ' ', $viewpoint['h3_font']) . '\',sans-serif; }
			h4 { font-size: ' . $viewpoint['h4_size'] . 'px; font-family: \'' . str_replace('+', ' ', $viewpoint['h4_font']) . '\',sans-serif; }
			.testimonial p { font-size: ' . $viewpoint['testimonial_size'] . 'px; color: ' . $viewpoint['testimonial_color'] . '; font-family: \'' . str_replace('+', ' ', $viewpoint['testimonial_font']) . '\',sans-serif; }
			.copyright { font-size: ' . $viewpoint['footer_size'] . 'px; color: ' . $viewpoint['footer_color'] . '; font-family: \'' . str_replace('+', ' ', $viewpoint['footer_font']) . '\',sans-serif; }
			';
			echo '</style>';
		}
	}
}
?>