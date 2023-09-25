<?php

function myprefix_button_shortcode( $atts, $content = null ) {
	
	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'url'    => '',
		'title'  => '',
		'target' => '',
        'text'   => '',
        'align'  => 'left',
		'color'  => 'brown',
	), $atts ) );

	// Use text value for items without content
	$content = $text ? $text : $content;

	// Return button with link
	if ( $url ) {

		$link_attr = array(
			'href'   => esc_url( $url ),
			'title'  => esc_attr( $title ),
			'target' => ( 'blank' == $target ) ? '_blank' : '',
			'class'  => 'button button-'.esc_attr( $color ),
		);

		$link_attrs_str = '';

		foreach ( $link_attr as $key => $val ) {

			if ( $val ) {

				$link_attrs_str .= ' '. $key .'="'. $val .'"';

			}

		}


        // return '<p style="text-align: '.$atts['align'].'"><a'. $link_attrs_str .'><span>'. do_shortcode( $content ) .'</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>';
        return '<p style="text-align: '.$atts['align'].'"><a'. $link_attrs_str .'><span>'. do_shortcode( $content ) .'</span></a></p>';

	}

	// No link defined so return button as a span
	else {

		return '<p style="text-align: '.$atts['align'].'"><span class="myprefix-button"><span>'. do_shortcode( $content ) .'</span></span></p>';

	}

}
add_shortcode( 'button', 'myprefix_button_shortcode' );

function myprefix_single_button_shortcode( $atts, $content = null ) {
	
	// Extract shortcode attributes
	extract( shortcode_atts( array(
		'url'    => '',
		'title'  => '',
		'target' => '',
        'text'   => '',
        'color'  => 'white',
        'class'  => '',
	), $atts ) );

	// Use text value for items without content
	$content = $text ? $text : $content;

	// Return button with link
		$link_attr = array(
			'href'   => esc_url( $url ),
			'title'  => esc_attr( $title ),
			'target' => ( 'blank' == $target ) ? '_blank' : '',
			'class'  => 'button button-'.esc_attr( $color ).' button-'.esc_attr($class),
		);

		$link_attrs_str = '';

		foreach ( $link_attr as $key => $val ) {

			if ( $val ) {

				$link_attrs_str .= ' '. $key .'="'. $val .'"';

			}

		}


        // return '<a'. $link_attrs_str .'><span>'. do_shortcode( $content ) .'</span> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>';
        return '<a'. $link_attrs_str .'><span>'. do_shortcode( $content ) .'</span></a>';

	

}
add_shortcode( 'single-button', 'myprefix_single_button_shortcode' );

/**
 * Search H Shortcode
 */
add_shortcode( 'search-h-form', 'search_h_shortcode' );
function search_h_shortcode( $atts, $content = null ) {
    $out = '';
    $out .= '<form action="" method="" class="search-h-form '.$atts['class'].' form-'.$atts['align'].'">';
        $out .= '<input type="text" size="1" maxlength="1" placeholder="*" />';
        $out .= '<input type="text" size="1" maxlength="1" placeholder="*" />';
        $out .= '<input type="text" size="1" maxlength="1" placeholder="*" />';
        $out .= '<span>-</span>';
        $out .= '<input type="text" size="1" maxlength="1" placeholder="*" />';
        $out .= '<input type="text" size="1" maxlength="1" placeholder="*" />';
        $out .= '<input type="text" size="1" maxlength="1" placeholder="*" />';
        $out .= '<input type="submit" value="'.$atts['text-button'].'" class="button button-submit" />';
    $out .= '</form>';
		return $out;
}

/**
 * Video Background
 */
add_shortcode( 'video-play', 'video_play_shortcode' );
function video_play_shortcode( $atts, $content = null ) {
    $out = '';
    $out .= '<div class="video-play">';                    
        $out .= '<img src="'.get_stylesheet_directory_uri().'/images/play@2x.png" width="47" />';
    $out .= '</div>';
    return $out;
}

/**
 * Vertical Slider
 */
add_shortcode( 'vertical-slider', 'vertical_slider_shortcode' );
function vertical_slider_shortcode( $atts, $content = null ) {
    $out = '';
    if( have_rows('type_of_element') ):
       while ( have_rows('type_of_element') ) : the_row();   
            if( get_row_layout() == 'slider' ):
                $out .= '<div class="hs-slider">';
                    $out .= '<div class="hs-slider-content">';
                        foreach(get_sub_field('vertical_slider') as $item){
                            $out .= '<div class="item-slider" style="background-image: url('.$item['background_slider'].');"></div>';
                        }
                    $out .= '</div>';
                    $out .= '<div class="vertical-content">';
                        $out .= '<div class="wrap">';
                            $out .= '<div class="vertical-limit">';
                                $out .= do_shortcode($content);
                                    $out .= '<div class="vertical-slider">';
                                    foreach(get_sub_field('vertical_slider') as $item){
                                        $out .= '<div class="vertical-slide">';
                                            $out .= '<h6>'.$item['title'].'</h6>';
                                        $out .= '</div>';
                                    }
                                $out .= '</div>';
                            $out .= '</div>';
                        $out .= '</div>';
                    $out .= '</div>';
                $out .= '</div>';
            endif;
        endwhile;
    else :
        $out .= 'You need to select a Slider Element from the Bottom of this page';
    endif;
    
    return $out;
}
/**********************
*   Blog List shortcode
**********************/
add_shortcode('blog-list', 'blog_list_shortcode');
function blog_list_shortcode($atts, $content) {    
    global $post;
    
    $settings = array(
        'posts_per_page' => 3, 
        'post_type' => 'post', 
        'orderby' => 'date', 
        'order' => 'DESC', 
        // 'paged' => get_query_var( 'paged' )
    );

    global $wp_query;
    
    $wp_query = new WP_Query( $settings );
        
    $list = '<div class="blog-list">';
    $wp_query = new WP_Query( $settings );
    if(have_posts()):
        $count = 0;
        while ( have_posts() ) : the_post();
            $count++;
            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'home-blog-section');
            $img_thumb = '';
            if (has_post_thumbnail()) {
                $img_thumb = $thumb_url[0];
            }else{
                $img_thumb = get_stylesheet_directory_uri()."/images/default-img.jpg";
            }
            if($count === 1)
                $first = ' first';
                else
                $first = '';
            $list .= '
            <div class="one-third'.$first.' blog-item">
                <a href="'.get_the_permalink().'">
                    <div class="blog-thumb">
                    <img src=\''.$img_thumb.'\' />
                    </div>
                    <div class="blog-content">
                        <div class="blog-data">
                            <h5>'.get_the_title().'</h5>
                            <span class="date-blog">'.get_the_date('F d, Y').'</span>
                            <span class="link-blog">Read More →</span>
                        </div>
                    </div>
                </a>
            </div>';
        endwhile;        
        do_action( 'genesis_after_endwhile' );
    endif;
    wp_reset_query();
        $list .= do_shortcode('[button color="purple" url="/blog" text="View All" align="center"]');
    $list.= '</div>';

    return $list;
}

/**********************
*   Blog Page shortcode
**********************/
add_shortcode('blog-page', 'blog_page_shortcode');
function blog_page_shortcode($atts, $content) {    
    global $post;
    
    $settings = array(
        'posts_per_page' => 3, 
        'post_type' => 'post', 
        'orderby' => 'date', 
        'order' => 'DESC', 
        // 'paged' => get_query_var( 'paged' )
    );

    global $wp_query;
    
    $wp_query = new WP_Query( $settings );
        
    $list = '<div class="blog-page">';
    $wp_query = new WP_Query( $settings );
    if(have_posts()):
        while ( have_posts() ) : the_post();
            $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'home-blog-section');
            $img_thumb = '';
            if (has_post_thumbnail()) {
                $img_thumb = $thumb_url[0];
            }else{
                $img_thumb = get_stylesheet_directory_uri()."/images/default-img.jpg";
            }
            $list .= '
            <div class="blog-page-item">
                <div class="one-third first">
                    <div class="blog-thumb" style="background-image: url('.$img_thumb.');">
                    </div>
                </div>
                <div class="two-thirds">
                <div class="blog-content">
                    <div class="blog-data">
                        <h5><a href="'.get_the_permalink().'" target="_blank">'.get_the_title().'</a></h5>
                        <span class="date-blog">'.get_the_date('F d, Y').'</span>
                        <p class="blog-excerpt">'.get_the_excerpt().'...</p>
                        <div class="one-half first">
                            <a class="link-blog" href="'.get_the_permalink().'">Read Full Article →</a>
                        </div>
                        <div class="one-half social-links">
                            <a href="https://www.facebook.com/sharer.php?u='.get_the_permalink().'" target="_blank" class="facebook-link"><i class="fa fa-facebook-square"></i></a>
                            <a href="https://twitter.com/share?url='.get_the_permalink().'" target="_blank" class="twitter-link"><i class="fa fa-twitter"></i></a>
                            <a href="https://plus.google.com/share?url='.get_the_permalink().'&title='.get_the_title().'&hl=ru" target="_blank" class="google-plus-link"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
                </div>
            </div>';
        endwhile;        
        do_action( 'genesis_after_endwhile' );
    endif;
    wp_reset_query();
    $list.= '</div>';

    return $list;
}

/**********************
*   Map SVG shortcode
**********************/
add_shortcode('map-svg', 'map_svg_shortcode');
function map_svg_shortcode($atts, $content) {
    $out = '';
    $out .= '<div class="hs-map"><div id="map"></div></div>';
    return $out;
}

/**********************
*   Articulos Destacados
**********************/
add_shortcode('articulos_destacados', 'articulos_destacados_function');
function articulos_destacados_function(){
    $out = '';
    $args = array(
        'post_type' => 'post',
        'showposts' => 6,
    );

    global $wp_query;
    $wp_query = new WP_Query( $args );
    if(have_posts()):
        $out .= '<div class="slider-articulos articulos-relacionados-container">';
        while ( have_posts() ) : the_post();

            $out .= '<div class="articulo-individual" aos-animate" data-aos="fade-down" data-aos-delay="400">';
                $out .= '<h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
                $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
                $img_thumb = '';
                $positionImage = '';
                if (has_post_thumbnail()) {
                    $img_thumb = $thumb_url[0];
                    $positionImage= '';
                }else{
                    $positionImage = 'no-image';
                    $img_thumb = get_stylesheet_directory_uri()."/images/no-image.png";
                }
                $out .= '<div class="image-articulo '.$positionImage.'" style="background:url('.$img_thumb.');"></div>';
                $out .= '<p>'.wp_trim_words(get_the_excerpt(), 18).'</p>';
                $out .= '<div class="rm"><a href="'.get_the_permalink().'">Leer más</a></div>';
            $out .= '</div>';
        endwhile;
        $out .= '</div>';
        wp_reset_query();
    endif;
    return $out;
}




