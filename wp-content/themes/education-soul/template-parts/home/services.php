<?php
/**
 * Template part for displaying home services section
 *
 * @package Education_Soul
 */

?>
<?php
$services_title  = education_soul_get_option( 'services_title' );
$services_number = absint( education_soul_get_option( 'services_number' ) );
$services_column = education_soul_get_option( 'services_column' );

$service_pages = array();

for ( $i = 0; $i <= $services_number; $i++ ) {
	$page_item = education_soul_get_option( 'services_page_' . $i );
	if ( absint( $page_item ) > 0 ) {
		$service_pages[] = absint( $page_item );
	}
}

if ( ! empty( $service_pages ) ) {
	$service_pages = array_unique( $service_pages );
}
?>
<div id="education-soul-services" class="home-section home-section-services">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( $services_title ); ?></h2>

		<?php if ( ! empty( $service_pages ) ) : ?>
			<?php
			$qargs = array(
				'posts_per_page'      => absint( $services_number ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'orderby'             => 'post__in',
				'post_type'           => 'page',
				'post__in'            => $service_pages,
			);

			// Fetch posts.
			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>
				<div class="services-block-list services-col-<?php echo absint( $services_column ); ?>">
					<div class="inner-wrapper">
					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>

						<div class="services-item">
							<div class="services-item-inner">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'education-soul-thumb' ); ?></a>
								<?php endif; ?>
								<h3 class="service-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div><!-- .services-item-inner -->
						</div><!-- .services-item -->
					<?php endwhile; ?>
					</div> <!-- .inner-wrapper -->
				</div><!-- .services-wrapper -->
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

		<?php else : ?>

			<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
				<p><strong><?php esc_html_e( 'No pages selected to be displayed as services. In Customizer, go to Homepage Sections -> Services to choose pages.', 'education-soul' ); ?></strong></p>
			<?php endif; ?>

		<?php endif; ?>
	</div><!-- .container -->
</div><!-- .home-section-services -->
