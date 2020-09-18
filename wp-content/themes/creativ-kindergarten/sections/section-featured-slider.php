<?php 
/**
 * Template part for displaying Featured Slider Section
 *
 *@package Creativ Kindergarten
 */
    $sr_content_type   = creativ_kindergarten_get_option( 'sr_content_type' );
    $number_of_sr_items = creativ_kindergarten_get_option( 'number_of_sr_items' );
    $featured_slider_overlay = creativ_kindergarten_get_option( 'featured_slider_overlay' );
    $featured_slider_speed   = creativ_kindergarten_get_option( 'featured_slider_speed' );
    $featured_slider_fontsize   = creativ_kindergarten_get_option( 'featured_slider_fontsize' );
    $featured_slider_height   = creativ_kindergarten_get_option( 'featured_slider_height' );
    
    for( $i=1; $i<=$number_of_sr_items; $i++ ) :
        $featured_slider_posts[] = creativ_kindergarten_get_option( 'slider_page_'.$i );
    endfor;
    ?>
    <?php if( $sr_content_type == 'sr_page' ) : ?>
        <div class="featured-slider-wrapper" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": <?php echo esc_html( $featured_slider_speed ); ?>, "dots": true, "arrows":true, "autoplay": true, "fade": false }'>
            <?php $args = array (
                'post_type'     => 'page',
                'post_per_page' => count( $featured_slider_posts ),
                'post__in'      => $featured_slider_posts,
                'orderby'       =>'post__in',
            );   

            $loop = new WP_Query($args);                        
                if ( $loop->have_posts() ) :
                $i=-1;  
                    while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                        <article class="slick-item" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>'); padding: <?php echo esc_html( $featured_slider_height ); ?>px 0;">
                            <div class="overlay" style="opacity: <?php echo esc_html($featured_slider_overlay);?>;"></div>
                            <div class="wrapper">
                                <div class="featured-content-wrapper">
                                    <header class="entry-header">
                                        <h2 class="entry-title" style="font-size: <?php echo esc_html( $featured_slider_fontsize ); ?>px;"><?php the_title();?></h2>
                                    </header>
                                    
                                    <div class="entry-content">
                                        <?php
                                            $excerpt = creativ_kindergarten_the_excerpt( 20 );
                                            echo wp_kses_post( wpautop( $excerpt ) );
                                        ?>
                                    </div><!-- .entry-content -->

                                    <div class="read-more">
                                        <?php $readmore_text = creativ_kindergarten_get_option( 'readmore_text' );?>
                                        <a href="<?php the_permalink();?>" class="btn btn-primary"><?php echo esc_html($readmore_text);?></a>
                                    </div><!-- .read-more -->
                                </div><!-- .featured-content-wrapper -->
                            </div><!-- .wrapper -->
                        </article><!-- .slick-item -->
                    <?php endwhile;?>
                    <?php wp_reset_postdata();
                endif;?>
        </div><!-- .featured-slider-wrapper -->
    <?php endif;