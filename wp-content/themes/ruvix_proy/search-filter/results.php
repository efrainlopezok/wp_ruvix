<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      http://www.designsandcode.com/
 * @copyright 2014 Designs & Code
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

if ( $query->have_posts() )
{
	$res_f = '';$res = '';
	?>
	<div class="section-project" data-aos="fade-zoom-in">
	<h2 >Conoce nuestros proyectos <a class="clicker-filter" href="#filter-dialog"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/filters-img.png"></a></h2>
		<div class="row-ruvix gutter-15">
		
		<?php
	while ($query->have_posts())
	{
		$query->the_post();
		$projects_id = get_the_ID();
		$icon_room2 = get_stylesheet_directory_uri().'/images/room-black.png';
        $icon_area2 = get_stylesheet_directory_uri().'/images/area-black.png';
        $icon_bath2 = get_stylesheet_directory_uri().'/images/bath-black.png';
        $icon_station2 = get_stylesheet_directory_uri().'/images/station-black.png';
		$tags = wp_get_object_terms( $projects_id, 'etiquetas', array( 'fields' => 'names' ) );
        $type_projects = '';
        if($tags){
            foreach($tags as $item){
                //echo '<span class="tag-text">';
                //echo $item;
                //echo '</span>';
                $type_projects = $item;
            }
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
		?>
		<div class="col-4">
            <div class="card <?php echo $class_type; ?>">
                    <a href="<?php echo get_the_permalink($projects_id) ?>">
                        <div class="card-header">
                            <div class="tag">
                            </div>
                            <?php
                                if ( has_post_thumbnail() ) {
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($projects_id), 'large' )[0];
                                }else{
                                    $large_image_url = get_stylesheet_directory_uri()."/images/img-filter.png";
                                }
                            ?>
                            <div class="project-thumbnail" style="background:url(<?php echo $large_image_url; ?>);"></div>
                            <!--<img src="<?php echo $large_image_url; ?>" alt="house">-->
                        </div>
                        <div class="card-body">
                            <h4 class="<?php echo $class_type;?>"><?php echo get_the_title($projects_id); ?></h4>

                            <div class="row-ruvix gutter-15" >
                                <?php
                                if(get_field('desde', $projects_id)){
                                ?>
                                <div class="col-4" style="padding-right: 0;">
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
                                <?php } ?>
                                
                                <div class="col-3">
                                <?php if(get_field('pie', $projects_id)) : ?>
                                    <p class="text-light">Pie</p>
                                    <p>
                                        <strong><?php echo get_field('pie', $projects_id) ?></strong>
                                    </p>
                                
                                <?php else : ?>
                                        <p class="text-light">Pie</p>
                                        <p>
                                            <strong>---</strong>
                                        </p>
                                <?php endif; ?>
                                </div>
                                <div class="col-5">
                                    <?php if(get_field('cuota_mensual', $projects_id)) :?>
                                            <p class="text-light" style="color: #38393a;">Cuota mensual</p>
                                            <p style="color: #38393a;"><strong>$
                                            <?php
                                            $precio = get_field('cuota_mensual' , $projects_id);
                                            $price = number_format( $precio, 0, ',', '.');
                                            echo $price;
                                            ?>
                                            </strong></p>
                                            
                                    <?php   else :?>
                                            <p class="text-light" style="color: #38393a;">Cuota mensual</p>
                                            <p style="color: #38393a;"><strong>No Aplica</strong></p>
                                    <?php endif; ?>
                                </div>
                                
                            </div>

                            <p class="detail-r"><?php echo wp_trim_words(get_the_excerpt( $projects_id ),16); ?></p>
                            
                            <div class="more-details">
                                <div class="row-ruvix gutter-15">
                                    <div class="col-6">
                                        <?php
                                        if (get_field('dormitorios', $projects_id)) {
                                        ?>
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_room2 ?>" width="15">
                                            <?php if(get_field('dormitorios', $projects_id) == 1) {
                                                echo '<span>';
                                                echo get_field('dormitorios', $projects_id).' Habitación';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('dormitorios', $projects_id).' Habitaciones';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-6">
                                        <?php
                                        if (get_field('banos', $projects_id)) {
                                        ?>
                                        <p class="text-light text-img">
                                            <img src="<?php echo $icon_bath2 ?>" width="16">
                                            <?php if(get_field('banos', $projects_id) == 1) {
                                                echo '<span>';
                                                echo get_field('banos', $projects_id).' Baño';
                                                echo '</span>';
                                            }
                                            else {
                                                echo '<span>';
                                                echo get_field('banos', $projects_id).' Baños';
                                                echo '</span>';
                                            }
                                            ?>
                                        </p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row-ruvix gutter-15">
                                <?php
                                    $superficie = get_field('superficie',$projects_id);
                                    if($superficie):
                                        echo '<div class="col-6"><p class="text-light text-img"><img src="'.$icon_area2.'" width="16"><span>'.$superficie.'</span></p></div>';
                                    endif;
                                ?>
                                    <div class="col-6"><p class="text-light text-img <?php echo $class_type; ?>"><i class="fa fa-calendar"></i><span class="type-proj <?php echo $class_type; ?>"><?php echo $type_projects; ?></span></p></div>
                                </div>
                            </div>
                            <a href="<?php echo get_the_permalink($projects_id) ?>" class="button button-orange <?php echo $class_type; ?>">Ver Detalles</a>
                        </div>
                    </a>
                    </div>
				</div>
			
                    <?php
	}?>
	</div>
		</div><?php

	echo '<div class="pagination"><a href="#" class="myprefix-button color-blue large transparent" style="display:none;"><span>Load More</span></a></div>';
}
else
{	echo '<div class="not-found text-center">';
    echo "No encontramos ninguna propiedad con estas características.";
    echo "<br>"; 
    echo "Contacta a algunos de nuestros asesores y te ayudara a encontrar la propiedad perfecta";
	echo '</div>';
}
?>

