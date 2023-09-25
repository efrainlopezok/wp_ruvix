<?php /* Template Name: Custom Blog */ 

//* Force content-sidebar layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

// Add our custom loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'blog_loop' );
function blog_loop() {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $settings = array(
        'posts_per_page' => 6, 
        'post_type' => 'post', 
        'orderby' => 'date', 
        'order' => 'DESC', 
        'paged' => $paged
    );
    $img_arrow = get_stylesheet_directory_uri()."/images/arrow-back.png";
    //$back='<div class="btn-back"><a href="'.get_site_url().'"><img src="'.$img_arrow.'" alt="back"> Volver</a></div>';
    //echo $back;
    $blogViews = get_field('blog_page');
    $list = '<div class="blog-list">';
    $listPageBlog = '';
        $loop = new WP_Query( $settings );
        $counter = 0;
        $counter2 = 0;
        if($loop->have_posts()):
            while ( $loop->have_posts() ) : $loop->the_post();
                $counter++;
                $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-list');
                $img_thumb = '';
                if (has_post_thumbnail()) {
                    $img_thumb = $thumb_url[0];
                }else{
                    $img_thumb = get_stylesheet_directory_uri()."/images/no-image.png";
                }
                if($counter == 1){
                    $list .= '<div class="col-12 container-fb"><div class="first-blog-container">';
                        $list .= '<h2 class="main-title" data-aos="zoom-in-up" data-aos-delay="100">Consejos Para Convertirte en un Inversionista Inmobiliario</h2>';     
                            
                        $list .= '<div class="row">';
                            $list .= '<div class="col-sm-12 col-md-9">';                            
                            $list .= '<p class="contant-blog">Contáctanos</p>'; 
                            $list .= '<h6>ARTICULO DESTACADOS</h6>'; 
                                $list .= '<div class="cnt-post"data-aos="flip-right" data-aos-delay="300">';
                                    $list .= '<div class="date-blog"><span class="date-number">'.get_the_date('d').'</span><br><span class="date-month">'.get_the_date('F').'</span></div>';
                                    $list .= '<div class="image-post" style="background:url('.$img_thumb.');"></div>';
                                    $list .= '<div class="post-cnt-d"><h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3><hr class="space-line"><p>'.get_the_excerpt().'</p></div>';
                                $list .= '</div>';
                            $list .= '</div>';
                            $list .= '<div class="col-sm-12 col-md-3">';
                                $list.='<div class="detail-article-d">';
                                    $list.=  wpbsearchform();
                                    $list.='<h4>'.$blogViews['title_blog'].'</h4>';
                                    $list.='<ul>';
                                    foreach( $blogViews['list_blogs'] as $post){
                                        $list.= '<li><a href="'.$post->guid.'"> <strong> '.$post->post_title.'</strong></a>';
                                        $datePost = date_create($post->post_date);
                                        setlocale(LC_ALL,"es_ES");
                                        $string = date_format($datePost, 'd/m/Y'); 
                                        $date = DateTime::createFromFormat("d/m/Y", $string);
                                        $list.= '<span>'.strftime("%B %d, %Y ",$date->getTimestamp()).'</span></li>';
                                    }
                                    $list.='</ul>';
                                $list.='<div>';

                            $list .= '</div>';
                        $list .= '</div>';
                    $list .= '</div></div>';
                }else{
                    $counter2++;
                    if ($counter==2) {
                        $list .= '<div class=""><div class="row">';
                        $listPageBlog .= '<div class="content-rest-posts "><div class="row">';
                    }
                    if ($counter2 == 1) {
                        $clsf = 'first';
                    }else{
                        $clsf = '';
                    }
                   
                $listPageBlog .= '
                <div class="one-third '.$clsf.'" data-aos="zoom-in-up" data-aos-delay="100">
                    <div class="row">
                    <div class="blog-item-new">
                        <div class="date-s-post"><span class="date-number" >'.get_the_date('d').'</span><br><span class="date-month">'.get_the_date('F').'</span></div>
                        <div class="detail-s-post"><div class="thumbnail-sp color-image-pro" style="background:url('.$img_thumb.');"></div><a href="'.get_the_permalink().'"><h2>'.get_the_title().'</h2></a>
                        <hr>                   
                        <p>'.wp_trim_words(get_the_excerpt(), 21).'</p></div>
                    </div>
                    </div>
                </div>';

                    if ($counter == count($loop)) {
                        $list .= '</div></div>';
                        $listPageBlog .= '</div></div>';
                    }
                    if ($counter2==3) {
                        $counter2=0;
                    }
                }
            endwhile;        
            // do_action( 'genesis_after_endwhile' );
        endif;
         wp_reset_query();
    $list.= '</div>';

    echo '<section class="blog-section">';
        echo '<div class="containers">';
            echo $list;
            echo '<div class="row"><div class="full-w">';
             wp_reset_postdata();
            echo '</div></div>';
        echo '</div>';
    echo '</section>';
    echo $back;

    echo '<section class="list-post">';
     echo  $listPageBlog;
    echo '</section>';
    
    echo '<section class="blog-pagination-pa">';
        pagination_bar( $loop );
    echo '</section>';

}

function wpbsearchform() {
    $form = '<form role="search" class="search-form-blog" method="get" id="searchform" action="' . home_url() . '/buscar-articulos">
        <div>
            <input  type="text" x-webkit-speech="x-webkit-speech" class="speech-input ico-input" value="" name="search"  placeholder="Search" />
            <i class="fa fa-search ico-search" aria-hidden="true"></i>
        <div id="info">
        </div>
        <div class="right">
            <a id="start_button" >
             
            <i id="start_img" class="fa fa-microphone" aria-hidden="true"></i>
            </a>
        </div>
        <div id="results" style="display: none;">
            <span id="final_span" class="final"></span>
            <span id="interim_span" class="interim"></span>
        </div>
        <div class="center"  style="display:none;">
            <div id="div_language" >
                <select id="select_language" onchange="updateCountry()"></select>
                <select id="select_dialect"></select>
            </div>
        </div>
    </div>
    </form>';
    return $form;
}
genesis();