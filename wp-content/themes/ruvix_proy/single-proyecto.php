<?php

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action('genesis_after_header', 'back_list_function');
function back_list_function(){
    echo '<div class="back-to-place">';
        echo '<div class="wrap">';
        echo '<a href="'.get_site_url().'/proyectos/"><img src="'.get_stylesheet_directory_uri().'/images/arrow-back-lg.png"/><span>REGRESAR</span>Conoce nuestros proyectos</a>';
        echo '</div>';
    echo '</div>';
}


add_action( 'genesis_before_loop', 'single_project' );
function single_project() {
    if (have_posts()):
    
        while ( have_posts() ) : the_post();
            //echo '<h2>'.get_the_title().'</h2>';
            $prpoject_id = get_the_ID();
            $icon_room2 = get_stylesheet_directory_uri().'/images/room-black.png';
            $icon_area2 = get_stylesheet_directory_uri().'/images/area-black.png';
            $icon_bath2 = get_stylesheet_directory_uri().'/images/bath-black.png';
            $icon_station2 = get_stylesheet_directory_uri().'/images/station-black.png';
            $tags = wp_get_object_terms( $prpoject_id, 'etiquetas', array( 'fields' => 'names' ) );
            $amenities = get_field( 'amenidades', $prpoject_id );
            
            ?>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF0eTx3RG76FS8Zg60rJwBLxDn0jwbugE"></script>
            <div class="wrap-details">
                <div class="tag-project">
                    <?php 
                        if($tags){
                            foreach($tags as $item){
                                //echo '<span class="tag-text">';
                                //echo $item;
                                //echo '</span>';
                                $type_projects = $item;
                            }
                            if($type_projects){
                                if ($type_projects == 'Verde') {
                                    $class_type = 'verde-i';
                                }elseif($type_projects == 'Entrega Inmediata'){
                                    $class_type = 'ent-i';
                                }elseif($type_projects == 'Blanco'){
                                    $class_type = 'blanco-i';
                                }elseif($type_projects == 'En venta'){
                                    $class_type = 'eventa-i';
                                }elseif($type_projects == 'Casa'){
                                    $class_type = 'casa-i';
                                }elseif($type_projects == 'Departamento'){
                                    $class_type = 'dpto-i';
                                }elseif($type_projects == 'Destacado'){
                                    $class_type = 'dstacd-i';
                                }
                            }
                        }
                    ?>
                </div>
                <div class="image-details slider-ruvix" data-aos="flip-right" data-aos-delay="300">
                    <?php
                    $img_gallery = get_field( 'gallery', $prpoject_id );
                    if($img_gallery) {
                        foreach($img_gallery as $img_item) { ?>
                            <div class="item-img" style="background:url(<?php echo $img_item['url'] ?>);background-size: cover;background-position: center;"></div><?php
                        }
                    }
                    else {
                        if ( has_post_thumbnail() ) {
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' )[0];
                        }else{
                            $large_image_url = get_stylesheet_directory_uri()."/images/img-filter.png";
                        } ?>
                        <div class="item-img"><img src="<?php echo $large_image_url; ?>" alt="house"></div><?php
                    }
                    ?>
                </div>

                <div class="data-details simgle-detail">
                    <div class="row-ruvix">
                        <div class="col-9">
                            <h2><?php echo get_the_title(); ?></h2>
                        </div>
                    </div>
                    <div class="row-ruvix">
                        <div class="col-4">
                            <?php
                            if (get_field('precio', $prpoject_id)) {
                                ?>
                                <p class="text-gray">Precio:</p>
                                <p class="result"> UF 
                                    <?php
                                        $precio = get_field('precio' , $projects_id);
                                        $price = number_format( $precio, 0, ',', '.');
                                        echo $price;
                                    ?>
                                </p>
                                <?php
                            }
                            ?>
                            <?php
                            /*if (get_field('distribucion', $prpoject_id)) {
                                ?>
                                <p class="text-green"><strong>Distribución:</strong></p>
                                <p><?php echo get_field('distribucion', $prpoject_id) ?></p>
                                <?php
                            }*/
                            ?>
                            <?php
                            /*if (get_field('roa', $prpoject_id)) {
                                ?>
                                <p class="text-green"><strong>ROA:</strong></p>
                                <p><?php echo get_field('roa', $prpoject_id) ?></p>
                                <?php
                            }*/
                            ?>
                        </div>
                        <div class="col-4">
                            <?php
                            if(get_field('pie', $prpoject_id)) {
                                ?>
                                <p class="text-gray">Pie</p>
                                <p class="result" ><?php echo get_field('pie', $prpoject_id) ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-4">
                            <?php
                            if(get_field('cuota_mensual', $prpoject_id)) {
                                ?>
                                <p class="text-gray">Cuota mensual
                                    <!-- <span class="text-gray">
                                    <strong>$ 
                                        <?php
                                        $precio = get_field('cuota_mensual' , $projects_id);
                                        $price = number_format( $precio, 0, ',', '.');
                                        echo $price;
                                        ?>
                                    </strong>
                                    </span> -->
                                </p>
                                <p class="result">$
                                <?php
                                        $precio = get_field('cuota_mensual' , $projects_id);
                                        $price = number_format( $precio, 0, ',', '.');
                                        echo $price;
                                        ?>
                                </p>
                                <?php
                            }
                            else{ ?>
                                <p class="text-gray">Cuota mensual
                                <p style="color: #38393A;"><strong>No Aplica</strong>
                                </p>
                            <?php }
                            ?>
                        </div>
                        <!--<div class="col-5" style="padding-right: 0;">
                            <p class="text-light">Desde
                                <span class="text-b">
                                    <strong>UF 
                                        <?php
                                        /*$precio = get_field('desde' , $projects_id);
                                        $price = number_format( $precio, 0, ',', '.');
                                        echo $price;*/
                                        ?>
                                    <!--</strong>
                                </span>
                            </p>
                        </div>-->
                    </div>
                    <div class="row-ruvix">
                        <div class="col-4">
                            <?php
                            if (get_field('entrega_semestre', $prpoject_id)) {
                                ?>
                                <p class="text-gray">Entrega:</p>
                                <p class="result"><?php echo get_field('entrega_semestre', $prpoject_id) ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-4">
                            <?php
                            if (get_field('arriendo', $prpoject_id)) {
                                ?>
                                <p class="text-gray">Arriendo (*):</p>
                                <p class="result"><?php echo get_field('arriendo', $prpoject_id) ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-4">
                            <?php
                            if (get_field('reserva', $prpoject_id)) {
                                ?>
                                <p class="text-gray">Reserva:</p>
                                <p class="result"><?php 
                                    echo get_field('tipo_reserva', $prpoject_id); 
                                    echo ' ';
                                    $precio = get_field('reserva' , $projects_id);
                                    $price = number_format( $precio, 0, ',', '.');
                                    echo $price;
                                    ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row-ruvix description-cols">
                        <div style="display:block;clear:both;width:100%;float:left;"></div>
                        <div class="col-6">
                            <p class="text-light text-img">
                                <img src="<?php echo $icon_room2 ?>" width="15">
                                <?php if(get_field('dormitorios', $prpoject_id) == 1) {
                                    echo '<span>';
                                    echo get_field('dormitorios', $prpoject_id).' Habitación';
                                    echo '</span>';
                                }
                                else {
                                    echo '<span>';
                                    echo get_field('dormitorios', $prpoject_id).' Habitaciones';
                                    echo '</span>';
                                }
                                ?>
                            </p>
                            <p class="text-light text-img">
                                <?php if(get_field('reserva', get_the_ID()) != '') :?>
                                    <!-- <img src="<?php echo $icon_area2 ?>" width="20">
                                    <span><?php  echo get_field('reserva', get_the_ID());  ?></span> -->
                                <?php endif;?>
                                <?php if(get_field('superficie', get_the_ID()) != '') :?>
                                    <img src="<?php echo $icon_area2 ?>" width="20">
                                    <span><?php  echo get_field('superficie', get_the_ID());  ?></span>
                                <?php endif;?>
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="text-light text-img">
                                <img src="<?php echo $icon_bath2 ?>" width="16">
                                <?php if(get_field('banos', $prpoject_id) == 1) {
                                    echo '<span>';
                                    echo get_field('banos', $prpoject_id).' Baño';
                                    echo '</span>';
                                }
                                else {
                                    echo '<span>';
                                    echo get_field('banos', $prpoject_id).' Baños';
                                    echo '</span>';
                                }
                                ?>
                            </p>
                                <?php
                                echo '<p class="text-light text-img '.$class_type.'"><i class="fa fa-calendar"></i><span class="type-proj '.$class_type.'">'.$type_projects.'</span></p>';
                                // if(get_field('estacionamientos', $projects_id)){
                                //         $out .= '<p class="text-light text-img">';
                                //         $out .= '<img src="'.$icon_station2.'" width="26">';
                                //         $out .= '<span>';
                                //         if(get_field('estacionamientos', $prpoject_id) == 1) {
                                //             echo '<span>';
                                //             echo get_field('estacionamientos', $prpoject_id).' Estacionamiento';
                                //             echo '</span>';
                                //         }
                                //         else {
                                //             echo '<span>';
                                //             echo get_field('estacionamientos', $prpoject_id).' Estacionamientos';
                                //             echo '</span>';
                                //         }
                                //     }
                                ?>
                            
                        </div>
                    </div>
                    <div class="row-ruvix">
                        <a href="#project-dialog" class="project-link button-lg button button-green">¡Estoy Interesado!</a>
                        <!-- <div class="col-12"> -->
                            <?php
                            /*if (get_field('capital_inicial', $prpoject_id)) {
                                ?>
                                <p class="text-green"><strong>Capital Inicial:</strong></p>
                                <p><?php echo get_field('capital_inicial', $prpoject_id) ?></p>
                                <?php
                            }*/
                            ?>
                            
                        <!-- </div> -->
                    </div>
                </div>
            </div>

            <!--<div class="extra-text">
                <?php echo get_field('extra_content', $prpoject_id); ?>
            </div>-->


            <div class="wrap-project">
                <div class="row-ruvix locacion-map">
                    <?php
                    if(get_field('locacion', $prpoject_id)){
                        ?>
                        <div class="col-8">
                            <h2>Ubicación</h2>
                            <?php
                            $location = get_field('locacion', $prpoject_id);
                            ?>
                            
                            <div class="location">
                                <div class="acf-map">
                                    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                                </div>
                            </div>
                            <p><?php echo get_field('locacion', $prpoject_id)['address'] ?></p>
                            <script type="text/javascript">
                                function new_map( $el ) {
                                    var $markers = $el.find('.marker');
                                    var args = {
                                        zoom        : 16,
                                        center      : new google.maps.LatLng(0, 0),
                                        mapTypeId   : google.maps.MapTypeId.ROADMAP
                                    };             
                                    var map = new google.maps.Map( $el[0], args);
                                    map.markers = [];
                                    $markers.each(function(){
                                        add_marker( jQuery(this), map );
                                    });
                                    center_map( map );
                                    return map;
                                }
                                function add_marker( $marker, map ) {
                                    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
                                    var marker = new google.maps.Marker({
                                        position    : latlng,
                                        map         : map
                                    });
                                    map.markers.push( marker );
                                    if( $marker.html() )
                                    {
                                        var infowindow = new google.maps.InfoWindow({
                                            content     : $marker.html()
                                        });
                                        google.maps.event.addListener(marker, 'click', function() {
                                            infowindow.open( map, marker );
                                        });
                                    }
                                }
                                function center_map( map ) {
                                    var bounds = new google.maps.LatLngBounds();
                                    jQuery.each( map.markers, function( i, marker ){
                                        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
                                        bounds.extend( latlng );
                                    });
                                    if( map.markers.length == 1 )
                                    {
                                        map.setCenter( bounds.getCenter() );
                                        map.setZoom( 16 );
                                    }
                                    else
                                    {
                                        map.fitBounds( bounds );
                                    }
                                }
                                var map = null;
                                jQuery(document).ready(function(){
                                    jQuery('.acf-map').each(function(){
                                        map = new_map( jQuery(this) );
                                    });
                                });
                            </script>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="col-4">
                        <h2>Características</h2>
                        <?php the_content();
                        if($amenities) {
                            ?>
                            <h2>Amenidades</h2>
                            <div class="row-ruvix">
                                <?php $i = 0;?>
                                <div class="col-6">
                                    <ul class="list-ruvix"> 
                                    <?php foreach( $amenities as $row ) {
                                        $i++;
                                        if($i <= 8) {
                                            ?><li><?php echo $row['amenidad'] ?></li>
                                            <?php
                                        }
                                        else {
                                            break;
                                        }   
                                    } ?>
                                    </ul>
                                </div>
                                <?php $i = 0;?>
                                <div class="col-6">
                                    <ul class="list-ruvix"> 
                                    <?php foreach( $amenities as $row ) {
                                        $i++;
                                        if($i <= 8) {
                                            continue;
                                        }
                                        else {
                                            ?><li><?php echo $row['amenidad'] ?></li>
                                            <?php
                                        }   
                                    } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div> 
            </div>

            <?php
        endwhile;
        endif;
}
add_action( 'genesis_before_footer', 'custom_footer', 5 );
function custom_footer(){
            $list_projects = get_field( 'list_projects', $prpoject_id );
            echo '<div class="section-project" >';
            echo '<div class="wrap">';
            echo '<h3 data-aos="zoom-in-up" data-aos-delay="100">Otros proyectos que te podrían interesar <i class="fa fa-angle-right arrow-next-proj"></i></h3>';
            echo '<div class="slider-lastprojects" id="other_projects">';
            if($list_projects){
                foreach($list_projects as $row) :
                    $projects_id = $row->ID;
                    $icon_room2 = get_stylesheet_directory_uri().'/images/room-black.png';
                    $icon_area2 = get_stylesheet_directory_uri().'/images/area-black.png';
                    $icon_bath2 = get_stylesheet_directory_uri().'/images/bath-black.png';
                    $icon_station2 = get_stylesheet_directory_uri().'/images/station-black.png';
                    $tags = wp_get_object_terms( $projects_id, 'etiquetas', array( 'fields' => 'names' ) );
                    ?><div class="card"  data-aos="fade-down" data-aos-delay="400">
                        <div class="card-header" data-aos="fade-down" data-aos-delay="400">
                            <div class="tag">
                            <?php 
                                if($tags){
                                    foreach($tags as $item){
                                        //echo '<span class="tag-text">';
                                        //echo $item;
                                        //echo '</span>';
                                        $type_projects = $item;
                                    }
                                    if($type_projects){
                                        if ($type_projects == 'Verde') {
                                            $class_type = 'verde-i';
                                        }elseif($type_projects == 'Entrega Inmediata'){
                                            $class_type = 'ent-i';
                                        }elseif($type_projects == 'Blanco'){
                                            $class_type = 'blanco-i';
                                        }elseif($type_projects == 'En venta'){
                                            $class_type = 'eventa-i';
                                        }elseif($type_projects == 'Casa'){
                                            $class_type = 'casa-i';
                                        }elseif($type_projects == 'Departamento'){
                                            $class_type = 'dpto-i';
                                        }elseif($type_projects == 'Destacado'){
                                            $class_type = 'dstacd-i';
                                        }
                                    }
                                }
                            ?>
                            </div>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($projects_id), 'large' )[0];
                                }else{
                                    $large_image_url = get_stylesheet_directory_uri()."/images/img-filter.png";
                                }
                            ?>
                             <div class="project-thumbnail" style="background:url(<?php echo $large_image_url; ?> );"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="<?php echo $class_type; ?>"><?php echo get_the_title($projects_id); ?></h4>

                            <div class="row-ruvix gutter-15">
                                <div class="col-4">
                                    <p class="text-light">Desde</p>
                                    <p> <strong>UF 
                                            <?php
                                            $precio = get_field('desde' , $projects_id);
                                            $price = number_format( $precio, 0, ',', '.');
                                            echo $price;
                                            ?>
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-3">
                                    <?php 
                                       if(get_field('pie', $projects_id)){
                                        echo '<p class="text-light">Pie</p>';
                                        echo '<p><strong>'; 
                                        echo  get_field('pie', $projects_id);
                                        echo '</strong></p>';
                                    }
                                    else{
                                        echo '<p class="text-light">Pie</p>';
                                        echo '<p><strong>'; 
                                        echo  '---';
                                        echo '</strong></p>';
                                    }
                                    ?>
                                </div>
                                <div class="col-5">
                                    <?php 
                                        if(get_field('cuota_mensual', $projects_id)){
                                            echo '<p class="text-light" style="color: #38393A;">Cuota mensual</p>';
                                            echo '<p style="color: #38393A;"><strong>'; 
                                            echo '$ ';
                                            $precio = get_field('cuota_mensual' , $projects_id);
                                            $price = number_format( $precio, 0, ',', '.');
                                            echo $price;
                                            echo '</strong></p>';
                                        }
                                        else{
                                            echo '<p class="text-light" style="color: #38393A;">Cuota mensual</p>';
                                            echo '<p style="color: #38393A;"><strong>'; 
                                            echo 'No Aplica';
                                            echo '</strong></p>';
                                        }
                                    ?>
                                </div>
                            </div>

                            <p class="description-house"><hr></p>
                            
                            <div class="more-details">
                                <div class="row-ruvix gutter-15">
                                    <div class="col-6">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_room2 ?>" width="15">
                                            <?php if(get_field('dormitorios', $projects_id)){
                                                echo '<p class="text-light text-img">
                                                <img src="'.$icon_room2.'" width="15">';
                                                if(get_field('dormitorios', $projects_id) == 1) {
                                                    echo '<span>';
                                                    echo get_field('dormitorios', $projects_id).' Habitación';
                                                    echo '</span>';
                                                }
                                                else {
                                                    echo '<span>';
                                                    echo get_field('dormitorios', $projects_id).' Habitaciones';
                                                    echo '</span>';
                                                }
                                                echo '</p>';
                                            }
                                            ?>
                                        </p>
                                        <!-- <p class="text-light text-img"> -->
                                            <?php 
                                            // if(get_field('superficie', $projects_id)){
                                            //     echo  '<p class="text-light text-img">';
                                            //     echo  '<img src="'.$icon_area2.'" width="20">';
                                            //     echo  '<span>'; 
                                            //     echo  get_field('superficie', $projects_id);
                                            //     echo  '</span></p>';}
                                            ?>
                                        <!-- </p> -->
                                    </div>
                                    <div class="col-6">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_bath2 ?>" width="16">
                                            <?php 
                                            if(get_field('banos', $projects_id)){
                                                echo  '<p class="text-light text-img">
                                                <img src="'.$icon_bath2.'" width="16">';
                                                if(get_field('banos', $projects_id) == 1) {
                                                    echo  '<span>';
                                                    echo  get_field('banos', $projects_id).' Baño';
                                                    echo '</span>';
                                                }
                                                else {
                                                    echo  '<span>';
                                                    echo  get_field('banos', $projects_id).' Baños';
                                                    echo  '</span>';
                                                }
                                                echo  '</p>';
                                            }
                                            ?>
                                        </p>
                                        <?php 
                                            if(get_field('estacionamientos', $projects_id)){
                                                echo '<p class="text-light text-img">';
                                                echo  '<img src="'.$icon_station2.'" width="26">';
                                                echo  '<span>';
                                                echo  get_field('estacionamientos', $projects_id).' Estacion...';
                                                echo  '</span>
                                                </p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                echo '<div class="row-ruvix gutter-15">';
                                $superficie = get_field('superficie',$projects_id);
                                if($superficie):
                                    echo '<div class="col-6"><p class="text-light text-img"><img src="'.$icon_area2.'" width="16"><span>'.$superficie.'</span></p></div>';
                                endif;
                                echo '<div class="col-6"><p class="text-light text-img '.$class_type.'"><i class="fa fa-calendar"></i><span class="type-proj '.$class_type.'">'.$type_projects.'</span></p></div></div>';
                                ?>
                            </div>
                            <a href="<?php echo get_the_permalink($projects_id) ?>" class="button button-orange <?php echo $class_type; ?>">Ver Detalles</a>
                        </div>
                    </div>
                    <?php
                endforeach;
            }else {
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
                    ?><div class="card" data-aos="fade-down" data-aos-delay="400">
                        <div class="card-header">
                            <div class="tag">
                            <?php 
                                if($tags){
                                    foreach($tags as $item){
                                        //echo '<span class="tag-text">';
                                        //echo $item;
                                        //echo '</span>';
                                        $type_projects = $item;
                                    }
                                    if($type_projects){
                                        if ($type_projects == 'Verde') {
                                            $class_type = 'verde-i';
                                        }elseif($type_projects == 'Entrega Inmediata'){
                                            $class_type = 'ent-i';
                                        }elseif($type_projects == 'Blanco'){
                                            $class_type = 'blanco-i';
                                        }elseif($type_projects == 'En venta'){
                                            $class_type = 'eventa-i';
                                        }elseif($type_projects == 'Casa'){
                                            $class_type = 'casa-i';
                                        }elseif($type_projects == 'Departamento'){
                                            $class_type = 'dpto-i';
                                        }elseif($type_projects == 'Destacado'){
                                            $class_type = 'dstacd-i';
                                        }
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
                            <div class="project-thumbnail" style="background:url(<?php echo $large_image_url; ?> );"></div>
                        </div>
                        <div class="card-body">
                            <h4 class="<?php echo $class_type; ?>"><?php echo get_the_title($rand_id_projects); ?></h4>

                            <div class="row-ruvix gutter-15">
                                <div class="col-4">
                                    <p class="text-light">Desde</p>
                                    <p>
                                        <strong>UF 
                                            <?php
                                            $precio = get_field('desde' , $projects_id);
                                            $price = number_format( $precio, 0, ',', '.');
                                            echo $price;
                                            ?>
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-3">
                                    <?php 
                                         if(get_field('pie', $projects_id)){
                                            echo '<p class="text-light">Pie</p>';
                                            echo '<p><strong>'; 
                                            echo  get_field('pie', $projects_id);
                                            echo '</strong></p>';
                                        }
                                        else{
                                            echo '<p class="text-light">Pie</p>';
                                            echo '<p><strong>'; 
                                            echo  '---';
                                            echo '</strong></p>';
                                        }
                                    ?>
                                </div>
                                <div class="col-5">
                                    <?php 
                                         if(get_field('cuota_mensual', $projects_id)){
                                            echo '<p class="text-light" style="color: #38393A;">Cuota mensual</p>';
                                            echo '<p style="color: #38393A;"><strong>'; 
                                            echo '$ ';
                                            $precio = get_field('cuota_mensual' , $projects_id);
                                            $price = number_format( $precio, 0, ',', '.');
                                            echo $price;
                                            echo '</strong></p>';
                                        }
                                        else{
                                            echo '<p class="text-light" style="color: #38393A;">Cuota mensual</p>';
                                            echo '<p style="color: #38393A;"><strong>'; 
                                            echo 'No Aplica';
                                            echo '</strong></p>';
                                        }
                                    ?>
                                </div>
                            </div>

                            <p class="description-house"><hr></p>
                            
                            <div class="more-details">
                                <div class="row-ruvix gutter-15">
                                    <div class="col-6">
                                            <?php if(get_field('dormitorios', $projects_id)){
                                                echo  '<p class="text-light text-img">
                                                <img src="'.$icon_room2.'" width="15">';
                                                if(get_field('dormitorios', $projects_id) == 1) {
                                                    echo '<span>';
                                                    echo get_field('dormitorios', $projects_id).' Habitación';
                                                    echo '</span>';
                                                }
                                                else {
                                                    echo '<span>';
                                                    echo get_field('dormitorios', $projects_id).' Habitaciones';
                                                    echo '</span>';
                                                }
                                                echo '</p>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_bath2 ?>" width="16">
                                            <?php if(get_field('banos', $rand_id_projectsrand_id_projects) == 1) {
                                                echo '<span>';
                                                echo get_field('banos', $rand_id_projectsrand_id_projects).' Baño';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('banos', $rand_id_projectsrand_id_projects).' Baños';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <?php 
                                            if(get_field('estacionamientos', $projects_id)){
                                                echo '<p class="text-light text-img">';
                                                echo  '<img src="'.$icon_station2.'" width="26">';
                                                echo  '<span>';
                                                echo  get_field('estacionamientos', $projects_id).' Estacion...';
                                                echo  '</span>
                                                </p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                echo '<div class="row-ruvix gutter-15">';
                                $superficie = get_field('superficie',$projects_id);
                                if($superficie):
                                    echo '<div class="col-6"><p class="text-light text-img"><img src="'.$icon_area2.'" width="16"><span>'.$superficie.'</span></p></div>';
                                endif;
                                echo '<div class="col-6"><p class="text-light text-img '.$class_type.'"><i class="fa fa-calendar"></i><span class="type-proj '.$class_type.'">'.$type_projects.'</span></p></div>   
                                </div>';
                                ?>
                            </div>
                            <a href="<?php echo get_the_permalink($rand_id_projects) ?>" class="button button-orange <?php echo $class_type; ?>">Ver Detalles</a>
                        </div>
                    </div>
                    <?php
                endwhile;
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
}

genesis();