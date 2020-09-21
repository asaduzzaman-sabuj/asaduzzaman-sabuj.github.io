<?php
/**
 * Template part for displaying home call to action section
 *
 * @package Education_Soul
 */

?>
<?php
	$cta_title                 = education_soul_get_option( 'cta_title' );
	$cta_description           = education_soul_get_option( 'cta_description' );
	$cta_primary_button_text   = education_soul_get_option( 'cta_primary_button_text' );
	$cta_primary_button_url    = education_soul_get_option( 'cta_primary_button_url' );
	$cta_secondary_button_text = education_soul_get_option( 'cta_secondary_button_text' );
	$cta_secondary_button_url  = education_soul_get_option( 'cta_secondary_button_url' );
?>
<div id="education-soul-call-to-action" class="home-section home-section-call-to-action">
	<div class="container">
		<div class="cta-content">
			<h2 class="section-title"><?php echo esc_html( $cta_title ); ?></h2>
			<div class="cta-content-text">
				<?php echo wp_kses_post( wpautop( $cta_description ) ); ?>
			</div><!-- .cta-content-text -->
		</div><!-- .cta-content -->
		<div class="cta-buttons">
			<a href="<?php echo esc_url( $cta_primary_button_url ); ?>" class="custom-button cta-btn"><?php echo esc_html( $cta_primary_button_text ); ?></a>
			<a href="<?php echo esc_url( $cta_secondary_button_url ); ?>" class="custom-button cta-btn custom-wire"><?php echo esc_html( $cta_secondary_button_text ); ?></a>
		</div><!-- .cta-buttons -->
	</div><!-- .container -->
</div><!-- .home-section-call-to-action -->
