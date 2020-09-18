<?php 
/**
 * Template part for displaying Services Section
 *
 *@package Creativ Kindergarten
 */

    $ss_content_type     = creativ_kindergarten_get_option( 'ss_content_type' );
    $number_of_ss_items  = creativ_kindergarten_get_option( 'number_of_ss_items' );
    for( $i=1; $i<=$number_of_ss_items; $i++ ) :
        $services_page_posts[] = absint(creativ_kindergarten_get_option( 'services_page_'.$i ) );
    endfor;
    ?>

    <?php if( $ss_content_type == 'ss_page' ) : ?>
    <div class="section-content">
        <?php $args = array (
            'post_type'     => 'page',
            'post_per_page' => count( $services_page_posts ),
            'post__in'      => $services_page_posts,
            'orderby'       =>'post__in',
        );        
        $loop = new WP_Query($args);                        
        if ( $loop->have_posts() ) :
        $i=-1;  
            while ($loop->have_posts()) : $loop->the_post(); $i++;?>
            
            <article>
                <div class="featured-image">
                    <img src="<?php the_post_thumbnail_url( 'full' ); ?>">
                </div><!-- .featured-image -->

                <div class="entry-container">
                    <header class="section-header">
                        <h2 class="section-title"><?php the_title();?></h2>
                    </header>

                    <div class="entry-content">
                        <?php
                            $excerpt = creativ_kindergarten_the_excerpt( 20 );
                            echo wp_kses_post( wpautop( $excerpt ) );
                        ?>
                    </div><!-- .entry-content -->

                    <div class="read-more">
                        <?php $readmore_text = creativ_kindergarten_get_option( 'readmore_text' );?>
                        <a href="<?php the_permalink();?>" class="btn"><?php echo esc_html($readmore_text);?></a>
                    </div><!-- .read-more -->
                </div><!-- .entry-container -->
            </article>

          <?php endwhile;?>
          <?php wp_reset_postdata(); ?>
        <?php endif;?>
    </div>
    <?php endif;