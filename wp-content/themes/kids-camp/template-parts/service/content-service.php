<?php
/**
 * The template for displaying services posts on the front page
 *
 * @package Kids_Camp
 */

$number     = get_theme_mod( 'kids_camp_service_number', 4 );
$post_list  = array();
$no_of_post = 0;

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

// Get valid number of posts.
$args['post_type'] = 'ect-service';

$image_display = absint( $number / 2 ) - 1;

$j = 0;

for ( $i = 1; $i <= $number; $i++ ) {
	$kids_camp_post_id = '';

	$kids_camp_post_id = get_theme_mod( 'kids_camp_service_cpt_' . $i );

	if ( $kids_camp_post_id ) {
		$post_list = array_merge( $post_list, array( $kids_camp_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby']  = 'post__in';

$args['posts_per_page'] = $no_of_post;

if ( ! $no_of_post ) {
	return;
}

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :

	$loop->the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php

					// Default value if there is no first image
					$image = '<img class="wp-post-image" src="' . trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-70x70.jpg" >';

					if ( $media_id = get_post_meta( $post->ID, 'ect-alt-featured-image', true ) ) {
						$title_attribute = the_title_attribute( 'echo=0' );
						// Get alternate thumbnail from CPT meta.
						echo wp_get_attachment_image( $media_id, 'kids-camp-testimonial', false,  array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
					} elseif ( has_post_thumbnail() ) {
						the_post_thumbnail( 'kids-camp-testimonial' );
					} else {
						// Get the first image in page, returns false if there is no image.
						$first_image = kids_camp_get_first_image( get_the_ID(), 'kids-camp-testimonial', '' );

						// Set value of image as first image if there is an image present in the page.
						if ( $first_image ) {
							$image = $first_image;
						}

						echo $image;
					}
					?>
				</a>
			</div>

			<div class="entry-container">
				<header class="entry-header">
						<div class="entry-category">
							<?php kids_camp_entry_category(); ?>
						</div>
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>

					<div class="entry-meta">
						<?php kids_camp_entry_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header>

				<?php
					$excerpt = get_the_excerpt();

					echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
				?>
			</div><!-- .entry-container -->
		</div> <!-- .hentry-inner -->
	</article> <!-- .article -->
	<?php
	// Display Main Image.
	if ( $j === $image_display ) {
		get_template_part( 'template-parts/service/main-image' );
	}

	$j++;
endwhile;

wp_reset_postdata();



