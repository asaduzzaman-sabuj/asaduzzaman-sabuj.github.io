<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Kids_Camp
 */
$number        = get_theme_mod( 'kids_camp_feat_cont_number', 3 );
$post_list     = array();
$no_of_post    = 0;

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

// Get valid number of posts.
$args['post_type'] = 'featured-content';

for ( $i = 1; $i <= $number; $i++ ) {
	$kids_camp_post_id = '';

	$kids_camp_post_id = get_theme_mod( 'kids_camp_feat_cont_cpt_' . $i );

	if ( $kids_camp_post_id && '' !== $kids_camp_post_id ) {
		$post_list = array_merge( $post_list, array( $kids_camp_post_id ) );

		$no_of_post++;
	}
}

$args['post__in'] = $post_list;
$args['orderby']  = 'post__in';

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :

	$loop->the_post();

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry' ); ?>>
		<div class="hentry-inner">
			<?php if ( has_post_thumbnail() ) : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php
				$thumbnail = 'kids-camp-featured-content';

				the_post_thumbnail( $thumbnail );
				?>
			</a>
			<?php endif; ?>

			<div class="entry-container product-container">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>

				<?php
					$excerpt = get_the_excerpt();

					echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
				?>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
endwhile;

wp_reset_postdata();



