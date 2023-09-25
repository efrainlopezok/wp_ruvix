<?php

//* Force content-sidebar layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

// Add our custom loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

// add_action( 'genesis_before_content_sidebar_wrap', 'back_blog_top');
function back_blog_top() {
    $img_arrow = get_stylesheet_directory_uri()."/images/arrow-back.png";
    ?>
    <div class="arrow-back">
        <a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo $img_arrow?>" alt="back"> Volver</a>
    </div>
    <?php
}

add_action( 'genesis_before_loop', 'single_blog' );
function single_blog() {
    $img_arrow = get_stylesheet_directory_uri()."/images/arrow-back.png";
    while ( have_posts() ) : the_post();
        echo '<h2 data-aos="zoom-in-up" data-aos-delay="100">'.get_the_title().'</h2>';

        $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
        $img_thumb = '';
        if (has_post_thumbnail()) {
            $img_thumb = $thumb_url[0];
        }else{
            $img_thumb = get_stylesheet_directory_uri()."/images/img-filter.png";
        }
        ?>
        <div class="img-filter" style="background-image: url('<?php echo $img_thumb?>')" data-aos="flip-right" data-aos-delay="300"></div>
        <div class="date-cat">
        <?php the_date('F j, Y'); ?> | <?php
         $c = get_the_category();
         echo $c[0]->cat_name;?>  
        </div>
        <div class="counter-share">
            <?php echo do_shortcode('[Sassy_Social_Share count="1"]'); ?>
        </div>
        <?php
        // echo do_shortcode('[Sassy_Social_Share]'); 
        echo '<div class="post-content" data-aos="zoom-in-up" data-aos-easing="ease-in-back" data-aos-delay="100">';
            the_content();
        echo '</div>';
         // the query
         $the_query = new WP_Query( array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'orderby'    => 'post_date',
            'order'      => 'DESC'
        )); 
        ?>
        <div class="share-post">
            <div class="one-third first">
                <h3>COMPARTE EL ARTÍCULO</h3>
            </div>
            <div class="two-thirds">
                <?php echo do_shortcode('[social_fb_twt_ln]') ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="controls-n-p">
            <div class="one-half first prev-post arrow-ico">
                <span>Anterior</span>
                <?php 
                $prev = get_permalink(get_adjacent_post(false,'',true));
                $next = get_permalink(get_adjacent_post(false,'',false));
                echo '<a class="icon-control" href="'.$prev.'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>';
                previous_post_link('%link');?>
            </div>
            <div class="one-half next-post arrow-ico">
                <span>Siguiente</span>
                <?php 
                echo '<a class="icon-control" href="'.$next.'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>';
                next_post_link('%link');?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if ( $the_query->have_posts() ) : ?>
        <div class="related-post-section">
            <h3 data-aos="zoom-in-up" data-aos-delay="100">ARTÍCULOS RELACIONADOS</h3>
        
            <div class="related-posts">

            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="one-third" data-aos="fade-down" data-aos-delay="400" >
                    <?php if (has_post_thumbnail( $post->ID ) ): ?>
                        <a href="<?php echo get_permalink(); ?>">
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                            <div class="f-post-image" style="background-image: url('<?php echo $image[0]; ?>')"></div>
                            <?php endif; ?>
                            <h4><?php the_title(); ?></h4>
                        </a>
                    </div>
            <?php endwhile; ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>

        <?php else : ?>
        <p><?php __('No News'); ?></p>
        <?php endif; 
        ?>
        <div class="arrow-back only-mobile" style="margin-bottom:0;">
            <a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo $img_arrow?>" alt="back"> Volver</a>
        </div>
        <?php
    endwhile;
} 

// add_action( 'genesis_after_content_sidebar_wrap', 'back_blog_bottom');
function back_blog_bottom() {
    $img_arrow = get_stylesheet_directory_uri()."/images/arrow-back.png";
    ?>
    <div class="arrow-back hide-mobile">
        <a href="<?php echo get_site_url(); ?>/blog"><img src="<?php echo $img_arrow?>" alt="back"> Volver</a>
    </div>
    <?php
}

genesis();