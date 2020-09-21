<?php
/**
 * The template for displaying featured content
 *
 * @package Kids_Camp
 */
?>

<?php
$enable_content = get_theme_mod( 'kids_camp_feat_cont_option', 'disabled' );
$classes = '';

if ( ! kids_camp_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$kids_camp_title     = get_option( 'featured_content_title', esc_html__( 'Contents', 'kids-camp' ) );
$sub_title = get_option( 'featured_content_content' );
?>

<div id="featured-content-section" class="section">
	<div class="wrapper">
		<?php if ( '' !== $kids_camp_title || $sub_title ) : ?>
			<div class="section-heading-wrapper featured-section-headline">
				<?php if ( '' !== $kids_camp_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $kids_camp_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="taxonomy-description-wrapper section-subtitle">
						<?php
	                    $sub_title = apply_filters( 'the_content', $sub_title );
	                    echo wp_kses_post( str_replace( ']]>', ']]&gt;', $sub_title ) );
	                    ?>
					</div><!-- .taxonomy-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper featured-content-wrapper layout-three <?php echo esc_attr( $classes ); ?> ">

			<?php get_template_part( 'template-parts/featured-content/content', 'featured' ); ?>

		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
