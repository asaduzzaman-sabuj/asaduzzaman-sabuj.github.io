<?php
/**
 * The template for displaying services image content
 *
 * @package Kids_Camp
 */

$image  = get_theme_mod( 'kids_camp_service_main_image' );
if ( $image ) :
?>
	<div class="special-image">
		<img src="<?php echo esc_url( $image ); ?>"/>
	</div>
<?php endif; ?>
