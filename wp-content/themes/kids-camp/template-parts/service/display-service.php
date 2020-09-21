<?php
/**
 * The template for displaying services content
 *
 * @package Kids_Camp
 */
?>

<?php
$enable_content = get_theme_mod( 'kids_camp_service_option', 'disabled' );

if ( ! kids_camp_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$kids_camp_title = get_option( 'ect_service_title', esc_html__( 'Services', 'kids-camp' ) );
$subtitle        = get_option( 'ect_service_content' );

$image = '';

?>

<div id="services-section" class="services-section section special <?php echo $image ? ' has-main-image' : ''; ?>" <?php echo $image ? ' style="background-image: url( ' . esc_url( $image ) . ' )"' : ''; ?>>
	<div class="wrapper">
		<?php if ( '' !== $kids_camp_title || $subtitle ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $kids_camp_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $kids_camp_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $subtitle ) : ?>
					<div class="section-description">
						<?php
						$subtitle = apply_filters( 'the_content', $subtitle );
						echo wp_kses_post( str_replace( ']]>', ']]&gt;', $subtitle ) );
						?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper">

			<?php get_template_part( 'template-parts/service/content-service' ); ?>

		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
