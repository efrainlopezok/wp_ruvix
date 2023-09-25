<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
// Shortcode
include_once( get_stylesheet_directory() . '/lib/shortcodes.php' );

//* Plugins
include_once( get_stylesheet_directory() . '/plugins/init.php' );
//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Ruvix' );
define( 'CHILD_THEME_URL', 'http://ruvix.com' );
define( 'CHILD_THEME_VERSION', '0.5.0' );

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . "/lib/javascripts/slick.min.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
    wp_enqueue_script( 'magnific-popup-js', get_stylesheet_directory_uri() . "/lib/javascripts/jquery.magnific-popup.min.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . "/lib/javascripts/custom.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/* # Header Schema
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
function custom_site_title() { 
	$logo = get_field( 'header', 'option' );
	echo '<a href="#" class="mobile-icons"><div></div><div></div><div></div></a><a class="retina logo" href="'.get_bloginfo('url').'" title="HandShake"><img src="'.$logo['logo'].'" alt="logo"/></a>';
    echo '<div class="mobile-menu">';
        echo '<div class="close-mmenu">X</div>';
        echo '<a class="retina logo" href="'.get_bloginfo('url').'" title="HandShake"><img src="'.$logo['logo_menu_mobile'].'" alt="logo"/></a>';
        genesis_widget_area( 'menu-mobile', array(
            'before' => '<div class="mmenu-widget widget-area">',
            'after'  => '</div>',
        ) );
    echo '</div>';
}
add_action( 'genesis_site_title', 'custom_site_title' );

genesis_register_sidebar( array(
    'id' => 'menu-mobile',
    'name' => __( 'Menu Mobile', 'genesis' ),
    'description' => __( 'Custom Widget for Mobile Menu', 'Ruvix' ),
) );

//* Reposition the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

/**
 * Remove Title of Pages
 */
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


// Register Custom Post Type
function custom_post_type1() {

	$labels = array(
		'name'                  => _x( 'Proyectos', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Proyecto', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Proyectos', 'text_domain' ),
		'name_admin_bar'        => __( 'Proyecto', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Proyecto', 'text_domain' ),
		'description'           => __( 'Proyectos', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 3,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-feedback',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'proyecto', $args );

}
add_action( 'init', 'custom_post_type1', 0 );


// Register Custom Post Type
function custom_post_type2() {

	$labels = array(
		'name'                  => _x( 'Equipos', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Equipo', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Equipos', 'text_domain' ),
		'name_admin_bar'        => __( 'Equipo', 'text_domain' ),
		'archives'              => __( 'Item Equipos', 'text_domain' ),
		'attributes'            => __( 'Item Equipos', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Equipo', 'text_domain' ),
		'description'           => __( 'Equipos', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'show_in_admin_bar'     => true,
		'menu_icon'           	=> 'dashicons-businessman',
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'equipo', $args );

}

add_action( 'init', 'custom_post_type2', 0 );

add_action( 'init', 'create_tags_vendor_taxonomy', 0 );
 
function create_tags_vendor_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Tags', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Tags' ),
    'popular_items' => __( 'Popular Tags' ),
    'all_items' => __( 'All Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Tag' ), 
    'update_item' => __( 'Update Tag' ),
    'add_new_item' => __( 'Add New Tag' ),
    'new_item_name' => __( 'New Tag Name' ),
    'separate_items_with_commas' => __( 'Separate Tag with commas' ),
    'add_or_remove_items' => __( 'Add or remove tags' ),
    'choose_from_most_used' => __( 'Choose from the most used Tags' ),
    'menu_name' => __( 'Tags' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('etiquetas','proyecto',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tag-vendor' ),
  ));
}

//* Add Custom Pagination with numbers
function pagination_bar( $custom_query ) {
    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));
        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => __( '<i class="fa fa-angle-left"></i> Prev' ),
			'next_text' => __( 'Next <i class="fa fa-angle-right"></i>' ),
        ));
    }
}

// popular posts
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count;
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function popular_posts_custom() {

    wpb_set_post_views(get_the_ID());
    $popularpost = new WP_Query( array( 'posts_per_page' => 3, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
   
    ?>
    <div class="popular-posts">
        <h4>ARTÍCULOS DESTACADOS</h4>
        <ul>
        <?php while ( $popularpost->have_posts() ) : $popularpost->the_post();
            echo '<li>';
                echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
                echo '<span>'.get_the_date().'</span>';
            echo '</li>';
        endwhile;?>
        </ul>
    </div>
<?php
}
add_shortcode('popular_post', 'popular_posts_custom'); 


//Home Slider
add_action( 'genesis_after_header', 'row_sections' );
function row_sections() {
    $hero  	=	get_field('hero'); 
    if($hero):
        if($hero_slide = $hero['hero_slide']):
        echo '<section class="slider-ruvix">';
			foreach($hero_slide as $slide){
                $slide_type = $slide['slide_type'];
				if($slide_type == 'content') {
                    $background_image = $slide['hero_background'];
                    $content = $slide['hero_txt'];
                    ?>
                    <div class="item-slider item-align" style="background-image: url(<?php echo $background_image; ?>);">
                        <div class="container">
                            <div class="slider-content--hero">
                                <?php
                                echo $content; 
                                ?>
                            </div>
                        </div>    
                    </div>
                    <?php
				} else {
                    $background_image = $slide['background_image'];
                    $icon_room = get_stylesheet_directory_uri().'/images/room.png';
                    $icon_area = get_stylesheet_directory_uri().'/images/area.png';
                    $icon_bath = get_stylesheet_directory_uri().'/images/bath.png';
                    $icon_station = get_stylesheet_directory_uri().'/images/station.png';
                    $choose_project = $slide['choose_project'];
                    $locacion = get_field('locacion', $choose_project->ID)['address'];
                    $tags2 = wp_get_object_terms( $choose_project->ID, 'etiquetas', array( 'fields' => 'names' ) );

                    ?>
                    <div class="item-slider item-align-end" style="background-image: url(<?php echo $background_image; ?>);">
                        <div class="container">
                            <div class="slider-content--hero2">
                                <div class="row-ruvix">
                                    <div class="col-2">
                                        <?php 
                                        if($tags2){
                                            foreach($tags2 as $item){
                                                echo '<span class="tag-text">';
                                                echo $item;
                                                echo '</span>';
                                            }
                                        }
                                        ?>
                                        <p class="text-b-white"><?php echo $locacion?></p>
                                    </div>
                                    <div class="col-5">
                                        <p class="text-b-white"><?php echo get_the_title($choose_project->ID) ?></p>
                                        <p class="text-white"><?php echo wp_trim_words(get_the_excerpt( $choose_project->ID ), 23); ?></p>
                                    </div>
                                    <div class="col-2">
                                        <p class="text-white text-img">
                                            <img src="<?php echo $icon_room ?>" width="15">
                                            <?php if(get_field('dormitorios', $choose_project->ID) == 1) {
                                                echo '<span>';
                                                echo get_field('dormitorios', $choose_project->ID).' habitación';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('dormitorios', $choose_project->ID).' habitaciones';
                                                echo '</span>';
                                            }?>
                                        </p>
                                        <p class="text-white text-img">
                                            <?php if(get_field('superficie', get_the_ID()) != '') :?>
                                                <img src="<?php echo $icon_area2 ?>" width="20">
                                                <span><?php  echo get_field('superficie', get_the_ID());  ?></span>
                                            <?php endif;?>
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <p class="text-white text-img">
                                            <img src="<?php echo $icon_bath ?>" width="16">
                                            <?php if(get_field('banos', $choose_project->ID) == 1) {
                                                echo '<span>';
                                                echo get_field('banos', $choose_project->ID).' baño';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('banos', $choose_project->ID).' baños';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="text-white text-img">
                                            <img src="<?php echo $icon_station ?>" width="26">
                                            <?php if(get_field('estacionamientos', $choose_project->ID) == 1) {
                                                echo '<span>';
                                                echo get_field('estacionamientos', $choose_project->ID).' Estacionamiento';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('estacionamientos', $choose_project->ID).' Estacionamientos';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-1">
                                        <a class="button button-orange button-lg" href="<?php echo get_the_permalink($choose_project->ID) ?>">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
				}
			}
        endif;
        echo '</section>';
	endif;
    echo '<div id="contact-dialog" class="zoom-anim-dialog mfp-hide">';
        echo '<div>'.do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]').'</div>';
    echo '</div>';
    echo '<div id="project-dialog" class="zoom-anim-dialog mfp-hide">';
        echo '<div>'.do_shortcode('[gravityform id=2 title=false description=false ajax=true tabindex=49]').'</div>';
    echo '</div>';
}

add_shortcode( 'last_projects' , 'project_function' );
function project_function() {
    $a = shortcode_atts( array(
        'posts'             =>  '4',
    ), $atts );
    // arguments, adjust as needed
    $args = array(
        'post_type'      => 'proyecto',
        'posts_per_page' => $a['posts'],
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'         => 'post_date',
        'order'             => 'DESC',
    );
    $out    =    '';
     
    global $wp_query;
    $wp_query = new WP_Query( $args );
    ob_start();
    if ( have_posts() ) :
        $i = 1;
        $first = 'first'; ?>
        <section class="section-project">
            <div class="row-ruvix gutter-15">
        <?php while ( have_posts() ) : the_post(); 

            $first = '';  
            $icon_room2 = get_stylesheet_directory_uri().'/images/room-black.png';
            $icon_area2 = get_stylesheet_directory_uri().'/images/area-black.png';
            $icon_bath2 = get_stylesheet_directory_uri().'/images/bath-black.png';
            $icon_station2 = get_stylesheet_directory_uri().'/images/station-black.png';
            $tags = wp_get_object_terms( get_the_ID(), 'etiquetas', array( 'fields' => 'names' ) );
            ?>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        <div class="tag">
                        <?php 
                            if($tags){
                                foreach($tags as $item){
                                    echo '<span class="tag-text">';
                                    echo $item;
                                    echo '</span>';
                                }
                            }
                        ?>
                        </div>
                        <?php
                            if ( has_post_thumbnail() ) {
                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0];
                            }else{
                                $large_image_url = get_stylesheet_directory_uri()."/images/img-filter.png";
                            }
                        ?>
                        <img src="<?php echo $large_image_url; ?>" alt="house">
                    </div>
                    <div class="card-body">
                        <h4><?php echo get_the_title(); ?></h4>

                        <div class="row-ruvix gutter-15">
                            <div class="col-3">
                                <p class="text-light">Desde</p>
                                <p>
                                    <strong><?php echo get_field('desde', get_the_ID()) ?></strong>
                                </p>
                            </div>
                            <div class="col-3">
                                <p class="text-light">Pie</p>
                                <p>
                                    <strong><?php echo get_field('pie', get_the_ID()) ?></strong>
                                </p>
                            </div>
                            <div class="col-6">
                                <p class="text-light" style="color: #667b35;">Cuota mensual</p>
                                <p style="color: #667b35;">
                                    <strong><?php echo get_field('cuota_mensual', get_the_ID()) ?></strong>
                                </p>
                            </div>
                        </div>

                        <p><?php echo wp_trim_words(get_the_excerpt( ),16); ?></p>
                        
                        <div class="more-details">
                            <div class="row-ruvix gutter-15">
                                <div class="col-7">
                                    <p class="text-light text-img">
                                        <img src="<?php echo $icon_room2 ?>" width="15">
                                        <?php if(get_field('dormitorios', get_the_ID()) == 1) {
                                            echo '<span>';
                                            echo get_field('dormitorios', get_the_ID()).' habitación';
                                            echo '</span>';
                                        }
                                        else {
                                            echo '<span>';
                                            echo get_field('dormitorios', get_the_ID()).' habitaciones';
                                            echo '</span>';
                                        }
                                        ?>
                                    </p>
                                    <p class="text-light text-img">
                                        <?php if(get_field('superficie', get_the_ID()) != '') :?>
                                            <img src="<?php echo $icon_area2 ?>" width="20">
                                            <span><?php  echo get_field('superficie', get_the_ID());  ?></span>
                                        <?php endif;?>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="text-light text-img">
                                        <img src="<?php echo $icon_bath2 ?>" width="16">
                                        <?php if(get_field('banos', get_the_ID()) == 1) {
                                            echo '<span>';
                                            echo get_field('banos', get_the_ID()).' baño';
                                            echo '</span>';
                                        }
                                        else {
                                            echo '<span>';
                                            echo get_field('banos', get_the_ID()).' baños';
                                            echo '</span>';
                                        }
                                        ?>
                                    </p>
                                    <p class="text-light text-img">
                                        <img src="<?php echo $icon_station2 ?>" width="26">
                                        <span><?php echo get_field('estacionamientos', get_the_ID()).' Estacion...' ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo get_the_permalink() ?>" class="button button-orange">Ver más</a>
                    </div>
                </div>
            </div>
        <?php
        endwhile;?>
            </div>
        </section>
    <?php endif;
    wp_reset_query();
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}
//Featured Projects 
add_shortcode( 'carousel_projects', 'featured_function' );
function featured_function() {
    $out = '';
    $prpoject_id = get_the_ID(); 
            ?>
            <?php
            $list_projects = get_field( 'proy_destacados', $prpoject_id );
            //$list_projects = get_field( 'list_projects', $prpoject_id );
            echo '<div class="section-project featured-proy">';
            echo '<h3>Proyectos destacados <i class="fa fa-angle-right arrow-next-proj"></i></h3>';
            //echo '<a href="http://localhost/wp-ruvix/proyectos/">Ver Todos los proyectos <i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
            echo '<div class="slider-lastprojects">';
            if($list_projects){
                foreach($list_projects as $row) :
                    $projects_id = $row->ID;
                    $icon_room2 = get_stylesheet_directory_uri().'/images/room-black.png';
                    $icon_area2 = get_stylesheet_directory_uri().'/images/area-black.png';
                    $icon_bath2 = get_stylesheet_directory_uri().'/images/bath-black.png';
                    $icon_station2 = get_stylesheet_directory_uri().'/images/station-black.png';
                    $tags = wp_get_object_terms( $projects_id, 'etiquetas', array( 'fields' => 'names' ) );
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="tag">
                            <?php 
                                if($tags){
                                    foreach($tags as $item){
                                        echo '<span class="tag-text">';
                                        echo $item;
                                        echo '</span>';
                                    }
                                }
                            ?>
                            </div>
                            <?php
                                if ( get_post_thumbnail_id($projects_id) ) {
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($projects_id), 'large' )[0];
                                }else{
                                    $large_image_url = get_stylesheet_directory_uri()."/images/img-filter.png";
                                }
                            ?>
                            <img src="<?php echo $large_image_url; ?>" alt="house">
                        </div>
                        <div class="card-body">
                            <h4><?php echo get_the_title($projects_id); ?></h4>

                            <div class="row-ruvix gutter-15">
                                <div class="col-3">
                                    <p class="text-light">Desde</p>
                                    <p>
                                        <strong><?php echo get_field('desde', $projects_id) ?></strong>
                                    </p>
                                </div>
                                <div class="col-3">
                                    <p class="text-light">Pie</p>
                                    <p>
                                        <strong><?php echo get_field('pie', $projects_id) ?></strong>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="text-light" style="color: #667b35;">Cuota mensual</p>
                                    <p style="color: #667b35;">
                                        <strong><?php echo get_field('cuota_mensual', $projects_id) ?></strong>
                                    </p>
                                </div>
                            </div>

                            <p><?php echo wp_trim_words(get_the_excerpt( $projects_id ),16); ?></p>
                            
                            <div class="more-details">
                                <div class="row-ruvix gutter-15">
                                    <div class="col-7">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_room2 ?>" width="15">
                                            <?php if(get_field('dormitorios', $projects_id) == 1) {
                                                echo '<span>';
                                                echo get_field('dormitorios', $projects_id).' habitación';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('dormitorios', $projects_id).' habitaciones';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="text-light text-img">
                                            <?php if(get_field('superficie', get_the_ID()) != '') :?>
                                                    <img src="<?php echo $icon_area2 ?>" width="20">
                                                    <span><?php  echo get_field('superficie', get_the_ID());  ?></span>
                                            <?php endif;?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_bath2 ?>" width="16">
                                            <?php if(get_field('banos', $projects_id) == 1) {
                                                echo '<span>';
                                                echo get_field('banos', $projects_id).' baño';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('banos', $projects_id).' baños';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_station2 ?>" width="26">
                                            <span><?php echo get_field('estacionamientos', $projects_id).' Estacion...' ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo get_the_permalink($projects_id) ?>" class="button button-orange">Ver más</a>
                        </div>
                    </div>
                    <?php
                endforeach;
                wp_reset_query();
            }
            else {
                /* $a = shortcode_atts( array(
                    'posts' => '4',
                ), $atts ); */

                $args = array( 
                    'post_type'      => 'proyecto',
                    /* 'posts_per_page' => $a['posts'], */
                    'orderby'        => 'rand',
                );

                $loop = new WP_Query( $args );
                
                while ( $loop->have_posts() ) : $loop->the_post();
                    $rand_id_projects = get_the_ID();
                    $icon_room2 = get_stylesheet_directory_uri().'/images/room-black.png';
                    $icon_area2 = get_stylesheet_directory_uri().'/images/area-black.png';
                    $icon_bath2 = get_stylesheet_directory_uri().'/images/bath-black.png';
                    $icon_station2 = get_stylesheet_directory_uri().'/images/station-black.png';
                    $tags = wp_get_object_terms( $rand_id_projects, 'etiquetas', array( 'fields' => 'names' ) );
                    ?><div class="card">
                        <div class="card-header">
                            <div class="tag">
                            <?php 
                                if($tags){
                                    foreach($tags as $item){
                                        echo '<span class="tag-text">';
                                        echo $item;
                                        echo '</span>';
                                    }
                                }
                            ?>
                            </div>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($rand_id_projects), 'large' )[0];
                                }else{
                                    $large_image_url = get_stylesheet_directory_uri()."/images/img-filter.png";
                                }
                            ?>
                            <img src="<?php echo $large_image_url; ?>" alt="house">
                        </div>
                        <div class="card-body">
                            <h4><?php echo get_the_title($rand_id_projects); ?></h4>

                            <div class="row-ruvix gutter-15">
                                <div class="col-3">
                                    <p class="text-light">Desde</p>
                                    <p>
                                        <strong><?php echo get_field('desde', $rand_id_projects) ?></strong>
                                    </p>
                                </div>
                                <div class="col-3">
                                    <p class="text-light">Pie</p>
                                    <p>
                                        <strong><?php echo get_field('pie', $rand_id_projects) ?></strong>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p class="text-light" style="color: #667b35;">Cuota mensual</p>
                                    <p style="color: #667b35;">
                                        <strong><?php echo get_field('cuota_mensual', $rand_id_projects) ?></strong>
                                    </p>
                                </div>
                            </div>

                            <p><?php echo wp_trim_words(get_the_excerpt( $rand_id_projects ),16); ?></p>
                            
                            <div class="more-details">
                                <div class="row-ruvix gutter-15">
                                    <div class="col-6">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_room2 ?>" width="15">
                                            <?php if(get_field('dormitorios', $rand_id_projectsrand_id_projects) == 1) {
                                                echo '<span>';
                                                echo get_field('dormitorios', $rand_id_projectsrand_id_projects).' habitación';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('dormitorios', $rand_id_projectsrand_id_projects).' habitaciones';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="text-light text-img">
                                            <?php if(get_field('superficie', get_the_ID()) != '') :?>
                                                    <img src="<?php echo $icon_area2 ?>" width="20">
                                                    <span><?php  echo get_field('superficie', get_the_ID());  ?></span>
                                            <?php endif;?>
                                            
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_bath2 ?>" width="16">
                                            <?php if(get_field('banos', $rand_id_projectsrand_id_projects) == 1) {
                                                echo '<span>';
                                                echo get_field('banos', $rand_id_projectsrand_id_projects).' baño';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('banos', $rand_id_projectsrand_id_projects).' baños';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_station2 ?>" width="26">
                                            <span><?php echo get_field('estacionamientos', $rand_id_projectsrand_id_projects).' Estacion...' ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo get_the_permalink($rand_id_projects) ?>" class="button button-orange">Ver más</a>
                        </div>
                    </div>
                    <?php
                endwhile;

                wp_reset_query();
            }

            echo '</div>';
            echo '</div>';
} 


add_shortcode( 'last_posts' , 'all_posts_function' );
function all_posts_function() {
    $a = shortcode_atts( array(
        'posts'             =>  '3',
    ), $atts );
    // arguments, adjust as needed
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $a['posts'],
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'         => 'post_date',
        'order'             => 'DESC',
    );
    $out    =    '';
     
    global $wp_query;
    $wp_query = new WP_Query( $args );
    ob_start();
    if ( have_posts() ) :
        $first = 'first'; 
        echo '<div class="blog-section"> <div class="blog-list">';
        while ( have_posts() ) : the_post(); 
            $first = '';
            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-list');
            $img_thumb = '';
            if (has_post_thumbnail()) {
                $img_thumb = $thumb_url[0];
            }else{
                $img_thumb = get_stylesheet_directory_uri()."/images/image-default.png";
            }
            ?><div class="blog-item">
                <a href="<?php echo get_the_permalink() ?>"><img src="<?php echo $img_thumb?>" class="thumbnail-post"></a>
                <a href="<?php echo get_the_permalink() ?>"><h2><?php echo get_the_title() ?></h2></a>                        
                <p><?php echo wp_trim_words(get_the_excerpt( ),19); ?></p>
            </div>            
            <?php 
        endwhile; 
        echo '</div>';
        echo '</div>';
    endif;
    wp_reset_query();
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}

add_shortcode( 'our_team' , 'function_team' );
function function_team() {
    $a = shortcode_atts( array(
        'posts'             =>  '4',
    ), $atts );
    // arguments, adjust as needed
    $args = array(
        'post_type'      => 'equipo',
        'posts_per_page' => $a['posts'],
        'post_status'    => 'publish',
        // 'orderby'         => 'menu_order',
        'orderby'         => 'post_date',
        'order'             => 'DESC',
    );
    $out    =    '';
     
    global $wp_query;
    $wp_query = new WP_Query( $args );
    ob_start();
    if ( have_posts() ) :
        $first = 'first'; 
        echo '<div class="row-ruvix">';
        while ( have_posts() ) : the_post(); 
            $first = '';
            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-list');
            $img_thumb = '';
            if (has_post_thumbnail()) {
                $img_thumb = $thumb_url[0];
            }else{
                $img_thumb = get_stylesheet_directory_uri()."/images/image-default.png";
            }
            ?><div class="col-3">
                <div class="team-ruvix">
                    <img src="<?php echo $img_thumb?>">
                    <div class="team-details">
                        <h4><?php echo get_the_title() ?></h4>
                        <p><?php echo get_field('cargo', get_the_ID())?></p>
                        <a target="_blank" href="<?php echo get_field('linkedin', get_the_ID())?>"><i class="fa fa-linkedin-square"></i></a>                         
                    </div>               
                </div>
            </div>            
            <?php 
        endwhile; 
        echo '</div>';
    endif;
    wp_reset_query();
    $out = ob_get_contents();
    ob_end_clean();
    return $out;
}

/* Excerpt Dots */
function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_shortcode('current_title','current_title_title');
function current_title_title(){
    $out = '';
    $out .= '<strong>'.get_the_title().'</strong>';
    return $out;
}


/* apí google map*/
/* function my_acf_google_map_api( $api ){
	
	$api['key'] = 'xxx';
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api'); */