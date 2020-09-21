<?php 
/**
 * Template part for displaying Courses Section
 *
 *@package Creativ Kindergarten
 */
    $cs_content_type    = creativ_kindergarten_get_option( 'cs_content_type' );
    $number_of_cs_column= creativ_kindergarten_get_option( 'number_of_cs_column' );
    $number_of_cs_items = creativ_kindergarten_get_option( 'number_of_cs_items' );
    $courses_section_title      = creativ_kindergarten_get_option( 'courses_section_title' );

    for( $i=1; $i<=$number_of_cs_items; $i++ ) :
        $courses_page_posts[] = absint(creativ_kindergarten_get_option( 'courses_page_'.$i ) );
    endfor;
    ?>

    <?php if(!empty($courses_section_title)):?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($courses_section_title);?></h2>
        </div><!-- .section-header -->
    <?php endif;?>

    <?php if( $cs_content_type == 'cs_page' ) : ?>
        <div class="section-content clear col-<?php echo esc_attr( $number_of_cs_column ); ?>">
            <?php $args = array (
                'post_type'     => 'page',
                'post_per_page' => count( $courses_page_posts ),
                'post__in'      => $courses_page_posts,
                'orderby'       =>'post__in',
            );        
            $loop = new WP_Query($args);                        
            if ( $loop->have_posts() ) :
            $i=-1;  
                while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                
                <article>
                    <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                    <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                    </div>

                    <div class="entry-container">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
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