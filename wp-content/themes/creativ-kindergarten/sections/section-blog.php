<?php 
/**
 * Template part for displaying Blog Section
 *
 *@package Creativ Kindergarten
 */
?>
<?php 
	 $blog_title    = creativ_kindergarten_get_option( 'blog_title' );
	 $blog_category = creativ_kindergarten_get_option( 'blog_category' );
	 $blog_number	= creativ_kindergarten_get_option( 'blog_number' );
	 
	 
?> 
    <?php if(!empty($blog_title)):?>
	    <div class="section-header">
            <h2 class="section-title"><span class="shape shape-left"></span><span class="title"><?php echo esc_html($blog_title);?></span><span class="shape shape-right"></span></h2>
        </div><!-- .section-header -->
  	<?php endif;?>
  <div class="section-content col-3">
  	<?php
		$blog_args = array(
			'posts_per_page' =>absint( $blog_number ),				
			'post_type' => 'post',
            'post_status' => 'publish',
            'paged' => 1,
			);

		if ( absint( $blog_category ) > 0 ) {
			$blog_args['cat'] = absint( $blog_category );
		}
		
		// Fetch posts.
		$the_query = new WP_Query( $blog_args );
		
	?>

	<?php if ( $the_query->have_posts() ) : 			
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		    <article>
		    	<div class="post-item">
			      	<?php if(has_post_thumbnail()):?>
				        <div class="featured-image">
				        	<a href="<?php the_permalink();?>"><?php the_post_thumbnail('Creativ Kindergarten-blog');?></a>  
				        </div>
			    	<?php endif?>

			    	<div class="entry-container">
				    	<div class="entry-meta">		         
				            <?php creativ_kindergarten_posted_on();
							creativ_kindergarten_entry_meta(); ?>
				        </div><!-- .entry-meta -->

				        <header class="entry-header">
							<h2 class="entry-title">
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
							</h2>
				        </header>

				        <div class="entry-content">
		 				    <?php
								$excerpt = creativ_kindergarten_the_excerpt( 20 );
								echo wp_kses_post( wpautop( $excerpt ) );
							?>
				        </div><!-- .entry-content -->

				        <?php $readmore_text = creativ_kindergarten_get_option( 'readmore_text' );?>
				        <a href="<?php the_permalink();?>" class="btn"><?php echo esc_html($readmore_text);?></a>
			        </div><!-- .entry-container -->
			    </div><!-- .post-item -->
		    </article>
	    <?php endwhile;?>
	    <?php wp_reset_postdata(); ?>
    <?php endif;?>
  </div>