<?php
/**
 * Core functions
 *
 * @package Education_Soul
 */

if ( ! function_exists( 'education_soul_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 0.1
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function education_soul_get_option( $key ) {

		$default_options = education_soul_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array) get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;

if ( ! function_exists( 'education_soul_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 0.1
	 *
	 * @return array Theme options.
	 */
	function education_soul_get_options() {
		$default_options = education_soul_get_default_theme_options();
		$theme_options   = (array) get_theme_mod( 'theme_options' );
		$theme_options   = wp_parse_args( $theme_options, $default_options );

		return $theme_options;
	}

endif;
