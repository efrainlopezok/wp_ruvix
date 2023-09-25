<?php /* Template Name: Proyectos Templeate */ 

/** Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Loop version
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_after_header', 'filter_function');
function filter_function(){
   /*  echo '<div class="back-to-place" >';
        echo '<div class="wrap">';
        echo '<a href="'.get_site_url().'"><img src="'.get_stylesheet_directory_uri().'/images/left-arrow.png"/> Volver</a>';
        echo '</div>';
    echo '</div>'; */
    echo '<div class="site-inner">';
    echo '<div class="content-sidebar-wrap">';
        echo '<main class="content">';
            echo do_shortcode('[searchandfilter id="383" show="results"]');
        echo '</main>';
        echo '<aside class="sidebar sidebar-primary widget-area">';
            echo do_shortcode('[searchandfilter id="383"]');
            echo '<div id="filter-dialog" class="zoom-anim-dialog mfp-hide">'.do_shortcode('[searchandfilter id="383"]').'<div class="text-center"><a href="#" class="apply-filters button button-orange">Aplicar filtros</a></div></div>';
        echo '</aside>';
    echo '</div>';
    echo '</div>';
}


//* Remove .site-inner
add_filter( 'genesis_markup_site-inner', '__return_null' );
add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
add_filter( 'genesis_markup_content', '__return_null' );


genesis();
