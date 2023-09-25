<?php
/**
 * Ruvix Landing
 *
 * 
 *
 * @package Ruvix Landin
 * @author  Ruvix
 * @license GPL-2.0+
 * @link    http://www.ruvix.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );


// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'ruvix_landing_localization_setup' );
function ruvix_landing_localization_setup(){
	load_child_theme_textdomain( 'ruvix-landing', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Ruvix Landing' );
define( 'CHILD_THEME_URL', 'http://www.ruvix.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'ruvix_landing_enqueue_scripts_styles' );
function ruvix_landing_enqueue_scripts_styles() {

	wp_enqueue_style( 'ruvix-landing-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'slick', get_stylesheet_directory_uri().'/css/slick.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri().'/css/custom.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'ruvix-awesome-fonts', get_stylesheet_directory_uri().'/font-awesome/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'slick-js', get_bloginfo( 'stylesheet_directory' ) . '/js/slick.min.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'custom-js', get_bloginfo( 'stylesheet_directory' ) . '/js/custom.js', array( 'jquery' ), '1.0.0' );
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'ruvix-landing-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'ruvix-landing-responsive-menu',
		'genesis_responsive_menu',
		ruvix_landing_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function ruvix_landing_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'ruvix-landing' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'ruvix-landing' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'ruvix-landing' ), 'secondary' => __( 'Footer Menu', 'ruvix-landing' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'ruvix_landing_secondary_menu_args' );
function ruvix_landing_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'ruvix_landing_author_box_gravatar' );
function ruvix_landing_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'ruvix_landing_comments_gravatar' );
function ruvix_landing_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

/** Remove Title & Description **/
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
/** Remove default site title and add custom site title **/
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	echo '<a class="no-retina" href="'.get_bloginfo('url').'" title="Ruvix"><img src="'.get_stylesheet_directory_uri().'/images/logo.png" alt="Ruvix"/></a>';
}
add_action( 'genesis_site_title', 'custom_site_title' );

add_shortcode( 'button' , 'link_func' );

// [link align="center" color="black" target="_self" href="#"]START HERE[/link]
function link_func($atts, $content)	{
	$link 	=	$atts['href'];
	$target =	$atts['target'];
	$color	=	$atts['color'];
	$align	=	$atts['align'];
	return '<p style="text-align:'.$align.'"><a href="'.$link.'" target="'.$target.'" class="color-'.$color.'">'.do_shortcode( $content ).'</a></p>';
}

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

add_shortcode('icons' ,'icons_func' );
function icons_func($atts, $content) {
	return '<a class="icon-'.$atts['icon'].'" href="'.$atts['link'].'"><i class="fa fa-'.$atts['icon'].'" aria-hidden="true"></i> '.$content.'</a>';
}	


/*******************************
*	Add Proyectos
*******************************/
add_action( 'init', 'proyectos_function' ); 
function proyectos_function() {
 
   $labels = array(
    'name' => __( 'Proyectos' ),
    'singular_name' => __( 'Proyecto' ),
    'all_items' => __('All Proyectos'),
    'add_new' => _x('Add new Proyecto', 'Professionalss'),
    'add_new_item' => __('Add new Proyecto'),
    'edit_item' => __('Edit Proyecto'),
    'new_item' => __('New Proyecto'),
    'view_item' => __('View Proyecto'),
    'search_items' => __('Search in Proyectos'),
    'not_found' =>  __('No Proyectos found'),
    'not_found_in_trash' => __('No Proyectos found in trash'), 
    'parent_item_colon' => ''
    );
 
    $args = array(
	    'labels' => $labels,
	    'public' => true,
	    'has_archive' => true,
	    'menu_icon' => 'dashicons-clipboard',
	    'rewrite' => array('slug' => 'proyectos'),
	   // 'taxonomies' => array( 'category', 'post_tag' ),
	    'supports'  => array( 'title', 'thumbnail' , 'editor' )       
    );
 
  register_post_type( 'proyectos', $args);
}

/*******************************
*	Add Consejos
*******************************/
add_action( 'init', 'consejos_function' ); 
function consejos_function() {
 
   $labels = array(
    'name' => __( 'Consejos' ),
    'singular_name' => __( 'Consejo' ),
    'all_items' => __('All Consejos'),
    'add_new' => _x('Add new Consejo', 'Professionalss'),
    'add_new_item' => __('Add new Consejo'),
    'edit_item' => __('Edit Consejo'),
    'new_item' => __('New Consejo'),
    'view_item' => __('View Consejo'),
    'search_items' => __('Search in Consejos'),
    'not_found' =>  __('No Consejos found'),
    'not_found_in_trash' => __('No Consejos found in trash'), 
    'parent_item_colon' => ''
    );
 
    $args = array(
	    'labels' => $labels,
	    'public' => true,
	    'has_archive' => true,
	    'menu_icon' => 'dashicons-format-chat',
	    'rewrite' => array('slug' => 'consejos'),
	   // 'taxonomies' => array( 'category', 'post_tag' ),
	    'supports'  => array( 'title', 'thumbnail' , 'editor' )       
    );
 
  register_post_type( 'consejos', $args);
}





/*******************************
*	Add proyectos
*******************************/
add_shortcode('carrousel_proyectos', 'carrousel_proyectos_func');
function carrousel_proyectos_func() {
	extract(shortcode_atts(array(      
      'limit' => '0',
      'post_type' => 'proyectos',
      'filters' => false,
      'orderby' => 'date',
      'order'   => 'ASC',
   	), $atts));
   	$out = '';

   	$first = true;
   	query_posts(array('post_type' => $post_type, 'showposts' => -1));
   	if (have_posts()) :
   		
   		$out .= '<div class="proyectos-list-wrap">';
   		
		$out .= '<div class="proyectos-list sponsors-carousel">';
   
   		
	    while (have_posts()) : the_post();
	    	

	    	if($first){
				$out .= '<div class="proyectos-item'.$classfilter.' s-'.get_field('estado').'">';
				$first = false;
			}
			else {
   				$out .= '<div class="proyectos-item'.$classfilter.' s-'.get_field('estado').'">';
   			}

   				$out .= '<div class="proyectos-estado">'.get_field('estado').'</div>';
   				$out .= '<a class="" href="'.get_the_permalink().'">';
				$out .= '<div class="proyectos-image">'.get_the_post_thumbnail(get_the_ID(),'full').'</div>';
				$out .= '</a>';
				$out .= '<div class="proyectos-content">';
					$out .= '<p class="proyectos-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
					if(get_field('descripcion_corta')) {
						$out .= '<div class="content-proyectos">';
						$out .= get_field('descripcion_corta');	
						$out .= '</div>';
					}
					$out .= '<p class="precio"><strong>'.get_field('precio').'</strong></p>';
				$out .= '</div>';

			$out .= '</div>';

		endwhile;
		
		$out .= '</div></div>';
		$out .= '<script>
		jQuery(window).ready(function($){
			$(".proyectos-list").slick({
				infinite: true,
		  		speed: 300,
		  		autoplay: true,
		  		autoplaySpeed: 3000,
				slidesToShow: 3,
		  		slidesToScroll: 1,
		  		arrows: true,
  				prevArrow: "<div><span class=\'dashicons dashicons-arrow-left-alt2\'></span></div>",
  				nextArrow: "<div><span class=\'dashicons dashicons-arrow-right-alt2\'></span></div>",
		  		responsive: [
				    {
				      breakpoint: 980,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 3
				      }
				    },
				    {
				      breakpoint: 600,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				  ]
			});
		});
		</script>';


	endif;
	wp_reset_query();
	return $out;
}



/*******************************
*	Add Consejos
*******************************/
add_shortcode('carrousel_consejos', 'carrousel_consejos_func');
function carrousel_consejos_func() {
	extract(shortcode_atts(array(      
      'limit' => '0',
      'post_type' => 'consejos',
      'filters' => false,
      'orderby' => 'date',
      'order'   => 'ASC',
   	), $atts));
   	$out = '';

   	$first = true;
   	query_posts(array('post_type' => $post_type, 'showposts' => -1));
   	if (have_posts()) :
   		
   		$out .= '<div class="consejos-list-wrap">';
   		
		$out .= '<div class="consejos-list sponsors-carousel">';
   
   		
	    while (have_posts()) : the_post();
	    	
	    	if($first){
				$out .= '<div class="proyectos-item'.$classfilter.' ">';
				$first = false;
			}
			else {
   				$out .= '<div class="proyectos-item'.$classfilter.' ">';
   			}
   				$out .= '<a class="" href="'.get_the_permalink().'">';
				$out .= '<div class="proyectos-image">'.get_the_post_thumbnail(get_the_ID(),'full').'</div>';
				$out .= '</a>';
				$out .= '<div class="proyectos-content">';
					$out .= '<p class="proyectos-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
					if(get_field('descripcion_corta')) {
						$out .= get_field('descripcion_corta');	
					}
				$out .= '</div>';

			$out .= '</div>';

		endwhile;
		
		$out .= '</div></div>';
		$out .= '<script>
		jQuery(window).ready(function($){
			$(".consejos-list").slick({
				infinite: true,
		  		speed: 300,
		  		autoplay: true,
		  		autoplaySpeed: 3000,
				slidesToShow: 3,
		  		slidesToScroll: 1,
		  		arrows: true,
  				prevArrow: "<div><span class=\'dashicons dashicons-arrow-left-alt2\'></span></div>",
  				nextArrow: "<div><span class=\'dashicons dashicons-arrow-right-alt2\'></span></div>",
		  		responsive: [
				    {
				      breakpoint: 980,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 3
				      }
				    },
				    {
				      breakpoint: 600,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				  ]
			});
		});
		</script>';


	endif;
	wp_reset_query();
	return $out;
}
