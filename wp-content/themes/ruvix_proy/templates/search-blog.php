<?php /* Template Name: Search Blog */ 

//* Force content-sidebar layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

// Add our custom loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'blog_loop' );
function blog_loop() { 
    global $wpdb;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $listProject = null;
    if($searchProject = $_GET['search']){
        $searchProject = '%'.$searchProject.'%';
        $query = "
        SELECT   DISTINCT    *
        FROM        $wpdb->posts
        WHERE       $wpdb->posts.post_title LIKE '$searchProject'
        ORDER BY    $wpdb->posts.post_title
        ";
        $listProjectData = $wpdb->get_results($query);
        foreach($listProjectData as $key => $array){
            $quote_ids[] = $array->ID;
        }
        $settings = array(
            'posts_per_page' => 6, 
            'post_type' => 'post', 
            'orderby' => 'date', 
            'order' => 'DESC', 
            'paged' => $paged,
            'post__in' => $quote_ids
        );

        $listProject = get_posts($settings);
        }
?>
    <section class="article-search">
        <h2 class="title-main">
            Articulos Encontrados
        </h2>
        <div class="row-article">
        <?php
        $loop = new WP_Query( $settings );
        while ( $loop->have_posts() ) : $loop->the_post();
        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'blog-list');
        $img_thumb = '';
        if (has_post_thumbnail()) {
            $img_thumb = $thumb_url[0];
        }else{
            $img_thumb = get_stylesheet_directory_uri()."/images/no-image.png";
        }
        echo '
        <div class="one-third" data-aos="zoom-in-up" data-aos-delay="100" >
            <div class="row">
            <div class="blog-item-new">
                <div class="date-s-post"><span class="date-number">'.get_the_date('d').'</span><br><span class="date-month">'.get_the_date('F').'</span></div>
                <div class="detail-s-post"><div class="thumbnail-sp" style="background:url('.$img_thumb.');"></div><a href="'.get_the_permalink().'"><h2 class="title-article">'.get_the_title().'</h2></a>
                <hr>                   
                <p>'.wp_trim_words(get_the_excerpt(), 21).'</p></div>
            </div>
            </div>
        </div>
        ';
        endwhile;
        if(!$loop->have_posts()){
            echo '<h2>Ninguno</h2>';
        }
         ?>    
         </div>
         <div>
            <?php  
            echo '<section class="blog-pagination-pa">';
                 pagination_bar( $loop );
            echo '</section>';
            ?>
         </div>    
         
    </section>

<?php
}
genesis();