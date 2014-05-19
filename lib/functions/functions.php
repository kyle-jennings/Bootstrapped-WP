<?php 


// gets options function
if(is_admin()){
	include(dirname(dirname(__FILE__)).'/admin/init.php' );
	include(dirname(dirname(__FILE__)).'/update/update.php');
}

 require_once('kjd_bootstrap_menus.php');
 require_once('kjd-gallery.php');
 require_once('kjd-shortcodes.php');
 require_once('kjd-widgets.php');
 require_once('kjd-adminbar-menu.php');

 require_once('kjd_layout_functions.php');


/* ------------------------------------------------
 kjd add js and css 
 -------------------------------------------------- */
function kjd_add_assets(){
	
	//set tempplate root
	$root = get_bloginfo('template_directory'); 
	$wpcontent = dirname( ( dirname($root) ) );
	$root = $root.'/lib';

	// set variables
	$mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
	$mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
	
	$override_nav = $mobileNavSettings['override_nav'];
	if( $override_nav == 'true') {
		$mobilenav_style = $mobileNavSettings['mobilenav_style'];
	}


	$generalSettings = get_option('kjd_theme_settings');
	$responsive = $generalSettings['kjd_responsive_design'];

	

	wp_enqueue_script("script", $root."/scripts/application.js", false, "1.0", true);  
	wp_enqueue_script("jquery", $root."/scripts/jquery.js", false, "1.0", false);  
	wp_enqueue_script("bootstrap", $root."/scripts/bootstrap.min.js", false, "1.0", true);  

	if( $mobilenav_style == 'sidr' ){
		wp_enqueue_script("sidr", $root."/scripts/sidr.min.js", false, "1.0", true);  
		wp_enqueue_style("sidr", $root."/styles/sidr.css");
	}

	

	wp_enqueue_style("bootstrap", $root."/styles/bootstrap/bootstrap.min.css");

	if($responsive == 'true'){
		wp_enqueue_style("bootstrap-responsive", $root."/styles/bootstrap/bootstrap-responsive.min.css");
	}

	// wp_enqueue_style("custom", $wpcontent."/styles/custom.css");
	wp_enqueue_style("base", $root."/styles/common.css");	
	wp_enqueue_style("custom", $root."/styles/custom.css");
	wp_enqueue_style("mobile", $root."/styles/mobile.css");	

	// Add slider scripts if on front page
	if( is_front_page() ){
		 include( 'add_slider_scripts.php');
	}

}
add_action( 'wp_enqueue_scripts', 'kjd_add_assets' );


/* -------------------------------------------------
 get page template layout settings 
------------------------------------------------------ */
function kjd_get_layout_settings($template = NULL) {

			//	if the page is a post type

			$layoutOptions = get_option('kjd_post_layout_settings');
			$layoutSettings = $layoutOptions['kjd_post_layouts'];
			
			if( is_single() ){
			
				$template = 'single';

			}elseif( is_attachment() ){

				$template = 'attachment';

			}elseif( is_404() ){
			
				$template = '404';
			
			}elseif( is_category() ){
			
				$template = 'category';

			}elseif( is_archive() ){
			
				$template = 'archive';
			
			}elseif( is_tag() ){

				$template = 'tag';

			}elseif( is_author() ){

				$template = 'author';

			}elseif( is_date() ){

				$template = 'date';

			}elseif( is_search() ){

				$template = 'search';

			}elseif( is_front_page() ){

				$template = 'front_page';

			}elseif( is_page() ){


				// if current page is page template
				if( is_page_template() ){
					
					$options = get_option('kjd_page_layout_settings');
					$layoutSettings = $options['kjd_page_layouts'];
				$is_page_template = true;
					
						if ( is_page_template('pageTemplate1.php') ){

							$template = 'template_1';
						
						}elseif( is_page_template('pageTemplate2.php') ){

							$template = 'template_2';
						
						}elseif( is_page_template('pageTemplate3.php') ){

							$template = 'template_3';
						
						}elseif( is_page_template('pageTemplate4.php') ){

							$template = 'template_4';
						
						}elseif( is_page_template('pageTemplate5.php') ){

							$template = 'template_5';
						
						}elseif( is_page_template('pageTemplate6.php') ){

							$template = 'template_6';
						
						}else{
							
							$template = 'page';							
						}
		

				// if current page is a page but not a template
				}else{
					$template = 'page';
				
				}

			//fallback - if not a post template OR a page
			}else{

				$template = 'default';
			}
			
	if( !empty($layoutSettings[$template]) && ($layoutSettings[$template]['toggled'] == 'true' || $is_page_template == true) ){
		
		$layoutSettings = $layoutSettings[$template];

	}else{

		$layoutSettings = $layoutSettings['default'];
	}


	// echo $template; die();
	return $layoutSettings;
}


/* ----------------------------------------------------
 Set featured image and User Image Sizes 
 ----------------------------------------------------- */
function kjd_set_featured_image_size(){
// kjd_component_settings[featured_image][height]
	$image_size_settings = get_option('kjd_component_settings');
	$featured_size = $image_size_settings['featured_image'];
	$w = $featured_size['width'] ? $featured_size['width'] : 300 ;
	$h = $featured_size['height'] ? $featured_size['height'] : 300 ;
	$c = $featured_size['crop'] ? $featured_size['crop'] : false ;
	if( function_exists ('add_theme_support') ){
		add_theme_support('post_tumbnails');
		add_image_size(
			'featured-image', $w, $h, $c
		);
	}
}
add_action( 'init', 'kjd_set_featured_image_size' );


function kjd_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'featured-image' => __('Featured Image'),
    ) );
}

add_filter( 'image_size_names_choose', 'kjd_custom_sizes' );

/* -----------------------------------------------
gets featured image meta info
------------------------------------------------- */
function kjd_the_post_thumbnail_description($args) {
  $thumbnail_id    = get_post_thumbnail_id($args->ID);
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo '<span>'.$thumbnail_image[0]->post_content.'</span>';
  }
}


// add excerpts to pages
function kjd_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'kjd_add_excerpts_to_pages' );


//////////////////
// get images
//////////////////

// old image grabber
function kjd_get_post_images($postID, $size = NULL) {

$attachments = get_children( array( 
	'post_parent' => $postID, 
	'post_type' => 'attachment', 
	'post_mime_type' => 'image', 
	'orderby' => 'menu_order', 
	'order' => 'ASC', 
	'numberposts' => 999 ) 
); 
	$images = array();
/* $images is now a object that contains all images (related to post id 1) and their information ordered like the gallery interface. */
    $attributes = array();
	if ( $attachments){
	    //looping through the images
	    foreach ( $attachments as $attachment => $att ) {

	    	$url = wp_get_attachment_image_src($attachment, 'thumbnail');
			$attributes['thumbnail']= $url[0];
			$url = wp_get_attachment_image_src($attachment, 'medium');
			$attributes['medium'] = $url[0];
			$url = wp_get_attachment_image_src($attachment, 'large');
			$attributes['large'] = $url[0];
			$url = wp_get_attachment_image_src($attachment, 'full');
			$attributes['full'] = $url[0];
			
			$attributes['image_id'] = $att->ID;
			$attributes['title'] = $att->post_title;
			$attributes['description'] = $att->post_content;
			$attributes['caption'] = $att->post_excerpt;
			$attributes['alt'] = $att->_wp_attachment_image_alt;
			array_push($images, $attributes);
	    }
	}	
	return $images;

}


/* ------------------------------------------------------
device views 
--------------------------------------------------------- */

function kjd_deviceViewSettings($deviceView){
		if(isset($deviceView) && $deviceView !="all"){
			echo $deviceView;
		}
}

////////////////////////
// login screen styling


function kjd_login_css() {
	require_once(dirname(dirname(__FILE__)).'/styles/login.php');
}
add_action('login_head', 'kjd_login_css');




/* --------------------------------------------
 read more link 
 ---------------------------------------------*/
function kjd_excerpt_more_link($more) {
       global $post;
	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
add_filter('excerpt_more', 'kjd_excerpt_more_link');


/* --------------------------------------------
 pagination  
 ------------------------------------------- */
function kjd_get_posts_pagination(){
	
	$pagination_markup ='';

	global $wp_query;  
	  
	$total_pages = $wp_query->max_num_pages;  
	  
	if ($total_pages > 1){  
	  
	  $current_page = max(1, get_query_var('paged'));  
	  $pagination_markup .= '<div class="row">';

		  $pagination_markup .= '<div class="pagination">';
		  $pagination_markup .=  paginate_links(array(  
		      'base' => get_pagenum_link(1) . '%_%',  
		      'format' => 'page/%#%',  
		      'current' => $current_page,  
		      'total' => $total_pages,  
		      'type' => 'list',
		      'prev_text' => 'Prev',  
		      'next_text' => 'Next',
		      'mid_size' => 1,
		      'end_size' => 1
		    ));  
		  $pagination_markup .= '</div>';
	  $pagination_markup .= '</div>';  
	    
	}  
	return $pagination_markup;
}



/* ----------------------------------------------------
 single image nav links for gallery images 
 ----------------------------------------------------- */
function kjd_gallery_image_links(){

	global $post;

	$navigation_markup = '<div class="image-pagination cf">';
	$parent_id = $post->post_parent;

	if ( strpos(get_post($parent_id)->post_content,'[gallery ') === false ){
		// $navigation_markup .= 'no gallery';
	}else{

		$images = kjd_get_post_images($parent_id);
		foreach($images as $k=>$image)
		{
			

			if($image['image_id'] == $post->ID){
				// $next_url = '<a href="'.get_attachment_link( $id ).'"><img src="'.$url[0].'" /></a>';
				$prev =  $images[$k-1]['image_id'];
				if(isset($prev)){
					$navigation_markup .= '<a class="image-nav prev" href="'.get_attachment_link($prev).'">Previous Image</a>';
				}

				$next =  $images[$k+1]['image_id'];
				if(isset($next)){
					$navigation_markup .= '<a class="image-nav next" href="'.get_attachment_link($next).'">Next Image</a>';
				}
			}
		}
	}

	$navigation_markup .= '</div>';
	return $navigation_markup;
}

/* --------------------------------------------
 the 404 
------------------------------------------------ */

function kjd_the_404(){

	$page404 = get_option('kjd_theme_settings');
	$page404 = do_shortcode($page404['kjd_404_page']);
	return $page404;
}
 
/* -----------------------------------------------
 set featured image size 
 ------------------------------------------------- */
function kjd_get_featured_image($position = null, $wrapper = 'div'){
	
	if($position == 'left_of_post'){
	
		$wrapper = 'span';
	
		$wrapper_class = 'pull-left';
	
	}elseif($position == 'right_of_post'){
	
		$wrapper = 'span';
	
		$wrapper_class = 'pull-right';
	
	}else{

		$wrapper = 'div';
	
	}

	$featured_image_markup = '';

	if ( has_post_thumbnail() ) {
		$featured_image_markup .= '<'.$wrapper.' class="media-object '.$wrapper_class.'">';
		$featured_image_markup .= get_the_post_thumbnail(null, 'featured-image', array(
			'alt'	=> trim(strip_tags( $attachment->post_excerpt )),
			'title'	=> trim(strip_tags( $attachment->post_title )),
			)
		);
		$featured_image_markup .= '</'.$wrapper.'>';
	} 


	return $featured_image_markup;
}

/* -----------------------------------------------------
	Add widget styling classes to front end
--------------------------------------------------------*/
function kjd_add_widget_style( $params ){

	global $wp_registered_widgets, $widget_number;



	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
	$this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
	$widget_id              = $params[0]['widget_id'];
	$widget_obj             = $wp_registered_widgets[$widget_id];
	$widget_num             = $widget_obj['params'][0]['number'];
	$widget_opt             = null;
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );


			$widget_opt = get_option( $widget_obj['callback'][0]->option_name );

	if ( isset( $widget_opt[$widget_num]['widget_style'] ) && !empty( $widget_opt[$widget_num]['widget_style'] ) ){
		// $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['widget_style']} ", $params[0]['before_widget'], 1 );
		$params[0]['before_widget'] = $params[0]['before_widget'].' <div class="' . $widget_opt[$widget_num]['widget_style'] . '"> ';
		$params[0]['after_widget'] = ' </div> '.$params[0]['after_widget'];
		
		// $params[0]['after_widget'] = str_replace('</div>', '</div></div>', $params[0]['after_widget']);

	}


	return $params;
}

add_filter( 'dynamic_sidebar_params', 'kjd_add_widget_style' );

function kjd_add_device_visibility( $params ){

	global $wp_registered_widgets, $widget_number;



	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
	$this_id                = $params[0]['id']; // Get the id for the current sidebar we're processing
	$widget_id              = $params[0]['widget_id'];
	$widget_obj             = $wp_registered_widgets[$widget_id];
	$widget_num             = $widget_obj['params'][0]['number'];
	$widget_opt             = null;
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );


	// if Widget Logic plugin is enabled, use it's callback
	if ( in_array( 'widget-logic/widget_logic.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$widget_logic_options = get_option( 'widget_logic' );
		if ( isset( $widget_logic_options['widget_logic-options-filter'] ) && 'checked' == $widget_logic_options['widget_logic-options-filter'] ) {
			$widget_opt = get_option( $widget_obj['callback_wl_redirect'][0]->option_name );
		} else {
			$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		}

	// if Widget Context plugin is enabled, use it's callback
	} elseif ( in_array( 'widget-context/widget-context.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		$callback = isset($widget_obj['callback_original_wc']) ? $widget_obj['callback_original_wc'] : null;
		$callback = !$callback && isset($widget_obj['callback']) ? $widget_obj['callback'] : null;

		if ($callback && is_array($widget_obj['callback'])) {
			$widget_opt = get_option( $callback[0]->option_name );
		}
	}
	
	// Default callback
	else {
		// Check if WP Page Widget is in use
		$custom_sidebarcheck = get_post_meta( get_the_ID(), '_customize_sidebars' );
		if ( isset( $custom_sidebarcheck[0] ) && ( $custom_sidebarcheck[0] == 'yes' ) ) {
			$widget_opt = get_option( 'widget_'.get_the_id().'_'.substr($widget_obj['callback'][0]->option_name, 7) );
		}
		else {
			$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
		}
	}



	if ( isset( $widget_opt[$widget_num]['device_visibility'] ) && !empty( $widget_opt[$widget_num]['device_visibility'] ) ){
		$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['device_visibility']} ", $params[0]['before_widget'], 1 );
	}


	return $params;
}

add_filter( 'dynamic_sidebar_params', 'kjd_add_device_visibility' );

/* --------------------------------------------------
 Site logo
 ----------------------------------------------------*/
function kjd_header_content($header_contents, $logo_toggle, $logo, $custom_header){
	
	$heading = is_front_page() ? 'h1' : 'h2' ;
	$header_output = '';
	
	if($header_contents == 'widgets'){ 

		dynamic_sidebar('header_widgets');
	
	}else{ 

		if($logo_toggle == 'text'){
		
			$header_output .= '<div class="header-wrapper">';
				$header_output .= $custom_header;
			$header_output .= '</div>';
		
		}elseif($logo_toggle == 'logo' ){
			
			$header_output .= '<'.$heading.' class="span logo-wrapper">';
				$header_output .= '<a href="'.get_bloginfo('url').' ">';
					$header_output .= '<img src="'.$logo.'" alt=""/>';
				$header_output .= '</a>';
			$header_output .= '</'.$heading.'>';
		
		}else{
			
			$header_output .= '<div class="jumbotron no-background">';
			$header_output .= '<'.$heading.' class="logo-wrapper" >';
				$header_output .= '<a href="'.get_bloginfo('url').' ">';
					$header_output .= get_bloginfo( 'name');
				$header_output .= '</a>';
			$header_output .= '</'.$heading.'>';
				$header_output .= '<div class="logo-wrapper">'.get_bloginfo('description').'</div>';
			$header_output .= '</div>';

		}

		echo $header_output;
	 }

}

/* --------------------------------------------------
 Navbar functions 
 --------------------------------------------------------*/
function kjd_empty_nav_fallback_callback( $args ) {
	if ( ! isset( $args['show_home'] ) )
					 
		$args['show_home'] = true;

	return $args;
}

//							menu id,  nav style,   link style, sidr/dropdown/ect,     devise visibility,  position, logo, menu id again for some reason, button type
function kjd_build_navbar( $menu_id, $navbar_width, $link_type, $mobilenav_style, $visibility = null, $position, $logo = '', $use_mobile_menu = 'false', $button_type ='default', $walker = 'drop_down' ){

		$navbar_style = 'navbar ';

		// sets the navbar type
		switch( $position ){
			// navbar in default position
			case 'default':
				$navbar_style .= 'navbar-static-top';
				break ;
			// we want to STICK the navbar to the top of the page - it will scroll WITH the page
			case 'fixed-top':
				$navbar_style .= 'navbar-fixed-top';
				break ;
			// we want to STICK the navbar to the bottom of the page - it will scroll WITH the page
			case 'fixed-bottom':
				$navbar_style .= 'navbar-fixed-bottom';
				break ;
			// navbar is just placed at the top of the page
			case 'static-top':
				$navbar_style .= 'navbar-static-top';
				break ;
		
			default:
				$navbar_style .= 'navbar-static-top';
		}

		if( $navbar_width == 'contained' ){
			// $navbar_style = str_replace( 'navbar-static-top', '', $navbar_style );
			$navbar_style .= ' container' ;
		}

		$navbar_open = '<div id="navbar" class=" '. $visibility .' '. $menu_id .' '. $navbar_style . '">';


			$navbar_open .= $nav_wrapper;

				$navbar_inner = '';

				
				$navbar_inner .= '<div class="navbar-inner">';
					
					// if the navbar type is not set to contained then we need to put the container inside the inn=er
					if( $navbar_width != 'contained' ){
						$navbar_inner .= '<div class="container">';
							$navbar_inner .= '<div class="navbar">';
					}

					if( ($logo != 'none' && $logo != '') ){
						
						if( $logo == 'logo' ){
							
							$options = get_option('kjd_mobileNav_misc_settings');
							$options = $options['kjd_mobileNav_misc'];
							$url = $options['mobile_site_logo'];
							
							$navbar_inner .= '<a class="hidden-desktop brand '.$logo.'" href="'.home_url().'"><img src="'.$url.'" /></a>';
				
						}else{
							$navbar_inner .= '<a class="hidden-desktop brand '.$logo.'" href="'.home_url().'">'.get_bloginfo( 'name' ).'</a>';
						}

					}

						$navbar_inner .= kjd_mobile_nav_button_type( $button_type, $mobilenav_style );

					// The nav-collapse - it holds the menu

						
						$navbar_inner .='<div class="nav-collapse collapse navbar-responsive-collapse">';

						$navbar_inner .= kjd_build_menu( $menu_id, $link_type, $use_mobile_menu, $walker );

						$navbar_inner .= $navbar_contents;
						$navbar_inner .= '</div>'; // en nav collapse
						

					// if the navbar type is not set to contained then we need to put the container inside the inner
					if( $navbar_width != 'contained' ){
							$navbar_inner .='</div>'; // end navbar -->

						$navbar_inner .='</div>'; // end container -->
					}


				$navbar_inner .='</div>'; // end navbar-inner-->
	

			$navbar_close = '</div>'; // end #navbar
		return $navbar_open . $navbar_inner . $navbar_close;
}

function kjd_build_menu( $menu_id = 'primary-menu', $navbar_link_style = 'none', $use_mobile_menu, $walker = 'drop_down'){
	
	if($walker == 'drop_down'){

		$walker_type = new dropdown_menu();
	}elseif( $walker = 'sidr_menu'){
		$walker_type = new sidr_menu();
	}else {
		$walker_type = '';
	}


	$menu_class = 'nav';
	
	switch($navbar_link_style){
		case 'none':

			$menu_class .= ' nav-noBG';
			break;
		case 'dividers':

			$menu_class .= ' nav-dividers';
			break;
		case 'pills':

			$menu_class .= ' nav-pills';
			break;
		case 'tabs':

			$menu_class .= ' nav-tabs';
			break;
		case 'tabs-below':

			$menu_class .= ' nav-tabs tabs-below';	
			break;
		case 'sidr-style':
		
			$menu_class .= ' nav-tabs nav-stacked';
			break;
		default:
			$menu_class .= ' nav-noBG';
	}


	/*
		if the mobile nav is activated and set we use that. if its not set but its activated, then we use the primary nav,
		otherwise, we display the default menu
	*/
	if ( $menu_id == 'mobile-menu' ){

		if ( $use_mobile_menu == 'true' && has_nav_menu( 'mobile-menu' ) ){
			ob_start();
			wp_nav_menu(array('theme_location' => 'mobile-menu', 
				'menu_class' =>$menu_class,
				'container'=> '',
				'walker'=> $walker_type
			 ) );
			$menu = ob_get_contents();
			ob_end_clean();
			return $menu;
		}elseif( has_nav_menu( 'primary-menu' ) ){


			ob_start();
			wp_nav_menu(array('theme_location' => 'primary-menu', 
				'menu_class' =>$menu_class,
				'container'=> '',
				'walker'=> $walker_type
			 ) );
			$menu = ob_get_contents();
			ob_end_clean();
			return $menu;

		}else {
		    $menu = '';

		    $menu .= '<ul class="nav nav-pills hidden-desktop">';
			$menu .= '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
			if( is_user_logged_in() ){
				$menu .= '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

			}else{

				$menu .= '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
			}
		    $menu .= '</ul>';

		    return $menu;
		} 

	}else{
		/*
			If the primary nav is set, then we use that.
			otherwise, we display the default menu
		*/
		if ( has_nav_menu( 'primary-menu' ) ){
			
			ob_start();
			wp_nav_menu(array('theme_location' => 'primary-menu', 
				'menu_class' =>$menu_class,
				'container'=> '',
				'walker'=> $walker_type
			 ) );
			$menu = ob_get_contents();
			ob_end_clean();
			return $menu;

		} else {
		    
		    $menu = '';

		    $menu .= '<ul class="nav nav-pills visible-desktop">';
			$menu .= '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
			if( is_user_logged_in() ){
				$menu .= '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

			}else{

				$menu .= '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
			}
		    $menu .= '</ul>';

		    return $menu;
		} 

	}

	return;
}

function kjd_mobile_nav_button_type( $button_type, $mobilenav_style  ) {

	$output = '';
	$button_class = '';
	$button_misc = get_option('kjd_mobileNav_misc_settings');
	$button_misc = $button_misc['kjd_mobileNav_misc'];

	switch($button_type):
		case 'default':
			$button_class = "btn btn-navbar";

			$button_inner = '';
			$button_inner .= '<span class="icon-bar"></span>';
			$button_inner .= '<span class="icon-bar"></span>';
			$button_inner .= '<span class="icon-bar"></span>';
			break;
		case 'hamburger':
			$button_class = "btn btn-navbar btn-hamburger";

			$button_inner = '';
			$button_inner .= '<span class="icon-bar"></span>';
			$button_inner .= '<span class="icon-bar"></span>';
			$button_inner .= '<span class="icon-bar"></span>';

			break;		
		case 'button':
			$button_class = "btn ".$button_misc['menu_button_color'];
			$button_inner = $button_misc['menu_btn_text'];;
			break;
		case 'text':
			$button_class = "menu-text";
			
			$button_inner = $button_misc['menu_btn_text'];
			break;
		case 'image':
			$button_class = "menu-image";

			$button_inner = 'image';
			break;
		default:
			$button_class = "btn btn-navbar";
			break;		
	endswitch;

	if($mobilenav_style =='sidr'){
		$output .= '<a id="sidr-toggle" class="navbar-menu-btn '.$button_class.'">';
	}else{
		$output .= '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="navbar-menu-btn '.$button_class.'">';
	}
		$output .= $button_inner;
	$output .= '</a>';

	return $output;
}