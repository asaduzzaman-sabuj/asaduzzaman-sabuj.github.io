<?php
/**
 * Template for displaying search forms in Kids Camp
 *
 * @package Kids_Camp
 */
?>

<?php $search_text = get_theme_mod( 'kids_camp_search_text', esc_html__( 'Search', 'kids-camp' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'kids-camp' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( $search_text ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><?php echo kids_camp_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'kids-camp' ); ?></span></button>
</form>
