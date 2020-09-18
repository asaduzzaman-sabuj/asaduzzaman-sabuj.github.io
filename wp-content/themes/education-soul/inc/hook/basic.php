<?php
/**
 * Basic theme functions
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Education_Soul
 */

if ( ! function_exists( 'education_soul_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 0.1
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function education_soul_implement_excerpt_length( $length ) {

		$excerpt_length = education_soul_get_option( 'excerpt_length' );
		if ( empty( $excerpt_length ) ) {
			$excerpt_length = $length;
		}
		return apply_filters( 'education_soul_filter_excerpt_length', absint( $excerpt_length ) );

	}

endif;

if ( ! function_exists( 'education_soul_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 0.1
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function education_soul_implement_read_more( $more ) {

		$flag_apply_excerpt_read_more = apply_filters( 'education_soul_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more;
		}

		$output         = $more;
		$read_more_text = education_soul_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$output = ' <a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '</a>';
			$output = apply_filters( 'education_soul_filter_read_more_link', $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'education_soul_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 0.1
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function education_soul_content_more_link( $more_link, $more_link_text ) {

		$flag_apply_excerpt_read_more = apply_filters( 'education_soul_filter_excerpt_read_more', true );
		if ( true !== $flag_apply_excerpt_read_more ) {
			return $more_link;
		}

		$read_more_text = education_soul_get_option( 'read_more_text' );
		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}
		return $more_link;

	}

endif;

if ( ! function_exists( 'education_soul_custom_body_class' ) ) :

	/**
	 * Custom body class.
	 *
	 * @since 0.1
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function education_soul_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		// Global layout.
		$global_layout = education_soul_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_soul_filter_theme_global_layout', $global_layout );

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
				$input[] = 'three-columns-enabled';
				break;

			default:
				break;
		}

		return $input;

	}
endif;

add_filter( 'body_class', 'education_soul_custom_body_class' );

if ( ! function_exists( 'education_soul_customize_theme_global_layout' ) ) :

	/**
	 * Customize theme global layout.
	 *
	 * @since 0.1
	 *
	 * @param string $layout Layout.
	 */
	function education_soul_customize_theme_global_layout( $layout ) {
		global $post;

		// Check if single.
		if ( $post && is_singular( array( 'post', 'page' ) ) ) {
			$post_options = get_post_meta( $post->ID, 'education_soul_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$layout = esc_attr( $post_options['post_layout'] );
			}
		}

		if ( is_page_template( 'tpl-frontpage.php' ) || is_page_template( 'tpl-builders.php' ) || is_page_template( 'tpl-full-width.php' ) ) {
			$layout = 'no-sidebar';
		}

		return $layout;
	}

endif;

add_filter( 'education_soul_filter_theme_global_layout', 'education_soul_customize_theme_global_layout', 11, 1 );

if ( ! function_exists( 'education_soul_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 0.1
	 */
	function education_soul_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = education_soul_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_soul_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'education_soul_custom_content_width' );

if ( ! function_exists( 'education_soul_hook_read_more_filters' ) ) :

	/**
	 * Hook read more filters.
	 *
	 * @since 0.1
	 */
	function education_soul_hook_read_more_filters() {
		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {
			add_filter( 'excerpt_length', 'education_soul_implement_excerpt_length', 999 );
			add_filter( 'the_content_more_link', 'education_soul_content_more_link', 10, 2 );
			add_filter( 'excerpt_more', 'education_soul_implement_read_more' );
		}
	}

endif;

add_action( 'wp', 'education_soul_hook_read_more_filters' );

if ( ! function_exists( 'education_soul_exclude_category_in_blog_page' ) ) :

	/**
	 * Exclude category in blog page.
	 *
	 * @since 0.1
	 *
	 * @param WP_Query $query WP_Query object.
	 */
	function education_soul_exclude_category_in_blog_page( $query ) {
		if ( $query->is_home() && $query->is_main_query() ) {
			$exclude_categories = education_soul_get_option( 'exclude_categories' );
			if ( ! empty( $exclude_categories ) ) {
				$cats_exploded = explode( ',', $exclude_categories );
				$cats          = array();
				if ( ! empty( $cats_exploded ) ) {
					foreach ( $cats_exploded as $c ) {
						if ( absint( $c ) > 0 ) {
							$cats[] = absint( $c );
						}
					}
					if ( ! empty( $cats ) ) {
						$string_exclude = '';
						$string_exclude = '-' . implode( ',-', $cats );
						$query->set( 'cat', $string_exclude );
					}
				}
			}
		}

		return $query;
	}

endif;

add_filter( 'pre_get_posts', 'education_soul_exclude_category_in_blog_page' );
