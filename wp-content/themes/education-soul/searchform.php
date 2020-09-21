<?php
/**
 * Search form
 *
 * @package Education_Soul
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'education-soul' ); ?></span>
		<input class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'education-soul' ); ?>" value="<?php the_search_query(); ?>" name="s" type="search">
	</label>
	<button type="submit" class="search-submit"><span class="search-button-label"><?php echo _x( 'Search', 'submit button', 'education-soul' ); ?></span></button>
</form><!-- .search-form -->

