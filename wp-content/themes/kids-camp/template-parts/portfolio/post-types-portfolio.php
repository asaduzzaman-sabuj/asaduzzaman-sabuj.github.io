<?php
/**
 * The template for displaying portfolio items
 *
 * @package Kids_Camp
 */

$number = get_theme_mod( 'kids_camp_portfolio_number', 5 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

$args = array(
	'orderby'             => 'post__in',
	'ignore_sticky_posts' => 1 // ignore sticky posts
);

$post_list  = array();// list of valid post/page ids

$args['post_type'] = 'jetpack-portfolio';

for ( $i = 1; $i <= $number; $i++ ) {
	$kids_camp_post_id = '';

	$kids_camp_post_id =  get_theme_mod( 'kids_camp_portfolio_cpt_' . $i );	

	if ( $kids_camp_post_id && '' !== $kids_camp_post_id ) {
		// Polylang Support.
		if ( class_exists( 'Polylang' ) ) {
			$kids_camp_post_id = pll_get_post( $kids_camp_post_id, pll_current_language() );
		}

		$post_list = array_merge( $post_list, array( $kids_camp_post_id ) );

	}
}

$args['post__in'] = $post_list;

$args['posts_per_page'] = $number;
$loop     = new WP_Query( $args );

$slider_select = get_theme_mod( 'kids_camp_portfolio_slider', 1 );

if ( $loop -> have_posts() ) :
	while ( $loop -> have_posts() ) :
		$loop -> the_post();

		$post_class = 'hentry';

		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
			<div class="hentry-inner">
				<?php

				$thumbnail = 'kids-camp-collection-portfolio-special';

				if ( has_post_thumbnail() ) {
					$thumb_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail );
				} else {
					$thumb_url = kids_camp_get_no_thumb_image( $thumbnail, 'src' );
				}?>

				<div class="post-thumbnail" style="background-image: url( '<?php echo esc_url( $thumb_url ); ?>' )">
					<a class="cover-link" href="<?php the_permalink(); ?>">
					</a>
				</div>

				<div class="entry-container">
					<div class="inner-wrap">
						<header class="entry-header portfolio-entry-header">
							<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

							<?php echo kids_camp_entry_category_date(); ?>

						</header>
					</div><!-- .inner-wrap -->
				</div><!-- .entry-container -->
			</div><!-- .hentry-inner -->
		</article>
	<?php
		if (  0 === ( $loop->current_post + 1 ) % 5 && ( $loop->current_post + 1 ) < $number ) {
			echo '</div><div class= "grid">';
		}
	endwhile;
	wp_reset_postdata();
endif;
