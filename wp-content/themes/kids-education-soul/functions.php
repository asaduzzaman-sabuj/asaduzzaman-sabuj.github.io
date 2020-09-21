<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kids_Education_Soul
 */

if ( ! function_exists( 'kids_education_soul_setup' ) ) :
	/**
	 * Loads the child theme textdomain and update notifier.
	 */
	function kids_education_soul_setup() {
	    load_child_theme_textdomain( 'kids-education-soul', get_stylesheet_directory() . '/languages' );
	}
endif;
add_action( 'after_setup_theme', 'kids_education_soul_setup', 11 );

if ( ! function_exists( 'kids_education_soul_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function kids_education_soul_scripts() {
		$theme_version = wp_get_theme()->get( 'Version' );
		$parent_theme_version = wp_get_theme(get_template())->get( 'Version' );

		/* If using a child theme, auto-load the parent theme style. */
		if ( is_child_theme() ) {
			wp_enqueue_style( 'education-soul-style', get_template_directory_uri() . '/style.css', array(), $parent_theme_version );
		}

		/* Always load active theme's style.css. */
		wp_enqueue_style( 'kids-education-soul-style', get_stylesheet_uri(), array(), $theme_version );
	}
endif;
add_action( 'wp_enqueue_scripts', 'kids_education_soul_scripts' );

/**
 * Parent theme override functions
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/override-parent.php';
