<?php 
/**
 * Template part for displaying additional_info Section
 *
 *@package Creativ Kindergarten
 */

$ad_content_type                = creativ_kindergarten_get_option( 'ad_content_type' );
$number_of_column               = creativ_kindergarten_get_option( 'number_of_column' );
$number_of_items                = creativ_kindergarten_get_option( 'number_of_items' );
$additional_info_icon_container = creativ_kindergarten_get_option( 'additional_info_icon_container' );
$additional_info_icon_fontsize = creativ_kindergarten_get_option( 'additional_info_icon_fontsize' );
$additional_info_title_fontsize = creativ_kindergarten_get_option( 'additional_info_title_fontsize' );

for( $i=1; $i<=$number_of_items; $i++ ) :
    $additional_info_posts[] = absint(creativ_kindergarten_get_option( 'additional_info_'.$i ) );
endfor;
?>

    <?php if( $ad_content_type == 'ad_page' ) : ?>
        <div class="section-content clear col-<?php echo esc_attr( $number_of_column ); ?>">
            <?php $args = array (
                'post_type' => 'page',
                'post_per_page'  => count( $additional_info_posts ),
                'post__in'       => $additional_info_posts,
                'orderby'        =>'post__in',
            );
            $loop = new WP_Query($args);                        
            if ( $loop->have_posts() ) :
            $i=-1; $j=0;  
                while ($loop->have_posts()) : $loop->the_post(); $i++; $j++;
                $additional_info_icons[$j] = creativ_kindergarten_get_option( 'additional_info_icon_'.$j ); ?>        
                
                <article>
                    <?php if( !empty( $additional_info_icons[$j] ) ) : ?>
                        <div class="icon-container" style="width: <?php echo esc_html($additional_info_icon_container);?>px; height: <?php echo esc_html($additional_info_icon_container);?>px;">
                            <i class="<?php echo esc_attr( $additional_info_icons[$j] )?>" style="font-size: <?php echo esc_html($additional_info_icon_fontsize);?>px;"></i>
                        </div><!-- .icon-container -->
                    <?php endif; ?>
                    
                    <header class="entry-header">
                        <h2 class="entry-title" style="font-size: <?php echo esc_html($additional_info_title_fontsize);?>px;"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                    </header>

                    <div class="entry-content">
                        <?php
                            $excerpt = creativ_kindergarten_the_excerpt( 20 );
                            echo wp_kses_post( wpautop( $excerpt ) );
                        ?>
                    </div><!-- .entry-content -->
                </article>

              <?php endwhile;?>
              <?php wp_reset_postdata(); ?>
            <?php endif;?>
        </div>
    <?php endif;