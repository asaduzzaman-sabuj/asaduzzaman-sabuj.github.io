<?php
/**
 * Helper functions related to customizer and options
 *
 * @package Education_Soul
 */

if ( ! function_exists( 'education_soul_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_global_layout_options() {

		$choices = array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'education-soul' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'education-soul' ),
			'three-columns' => esc_html__( 'Three Columns', 'education-soul' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'education-soul' ),
		);
		$output  = apply_filters( 'education_soul_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'education_soul_get_pagination_type_options' ) ) :

	/**
	 * Returns pagination type options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_pagination_type_options() {

		$choices = array(
			'default' => esc_html__( 'Default', 'education-soul' ),
			'numeric' => esc_html__( 'Numeric', 'education-soul' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'education_soul_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_breadcrumb_type_options() {

		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'education-soul' ),
			'simple'   => esc_html__( 'Enabled', 'education-soul' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'education_soul_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'education-soul' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'education-soul' ),
		);
		$output  = apply_filters( 'education_soul_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'education_soul_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 0.1
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @param bool  $show_dimension Enable or disable dimension.
	 * @return array Image size options.
	 */
	function education_soul_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'education-soul' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'education-soul' );
		$choices['medium']    = esc_html__( 'Medium', 'education-soul' );
		$choices['large']     = esc_html__( 'Large', 'education-soul' );
		$choices['full']      = esc_html__( 'Full (original)', 'education-soul' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;


if ( ! function_exists( 'education_soul_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'alignment', 'education-soul' ),
			'left'   => _x( 'Left', 'alignment', 'education-soul' ),
			'center' => _x( 'Center', 'alignment', 'education-soul' ),
			'right'  => _x( 'Right', 'alignment', 'education-soul' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'education_soul_get_slider_caption_alignment_options' ) ) :

	/**
	 * Returns slider caption alignment options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_slider_caption_alignment_options() {

		$choices = array(
			'left'   => esc_html_x( 'Left', 'alignment', 'education-soul' ),
			'center' => esc_html_x( 'Center', 'alignment', 'education-soul' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'education-soul' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'education_soul_get_featured_slider_transition_effects' ) ) :

	/**
	 * Returns the featured slider transition effects.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_featured_slider_transition_effects() {

		$choices = array(
			'fade'       => _x( 'fade', 'transition effect', 'education-soul' ),
			'fadeout'    => _x( 'fadeout', 'transition effect', 'education-soul' ),
			'none'       => _x( 'none', 'transition effect', 'education-soul' ),
			'scrollHorz' => _x( 'scrollHorz', 'transition effect', 'education-soul' ),
		);

		$output = apply_filters( 'education_soul_filter_featured_slider_transition_effects', $choices );

		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;

	}

endif;

if ( ! function_exists( 'education_soul_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_featured_slider_type() {
		$choices = array(
			'featured-page' => __( 'Featured Pages', 'education-soul' ),
			'demo-slider'   => __( 'Demo Slider', 'education-soul' ),
		);

		$output = apply_filters( 'education_soul_filter_featured_slider_type', $choices );

		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;
	}

endif;

if ( ! function_exists( 'education_soul_get_featured_slider_type' ) ) :

	/**
	 * Returns the featured slider type.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_featured_slider_type() {
		$choices = array(
			'featured-page' => __( 'Featured Pages', 'education-soul' ),
			'demo-slider'   => __( 'Demo Slider', 'education-soul' ),
		);

		$output = apply_filters( 'education_soul_filter_featured_slider_type', $choices );

		if ( ! empty( $output ) ) {
			ksort( $output );
		}

		return $output;
	}

endif;

if ( ! function_exists( 'education_soul_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 0.1
	 *
	 * @param int    $min Min.
	 * @param int    $max Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 *
	 * @return array Options array.
	 */
	function education_soul_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string       = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;

	}

endif;

if ( ! function_exists( 'education_soul_get_home_sections_options' ) ) :

	/**
	 * Returns home sections options.
	 *
	 * @since 0.1
	 *
	 * @return array Options array.
	 */
	function education_soul_get_home_sections_options() {

		$choices = array(
			'featured-slider' => array(
				'label'    => __( 'Featured Slider', 'education-soul' ),
				'template' => 'template-parts/home/featured-slider',
			),
			'call-to-action'  => array(
				'label'    => __( 'Call To Action', 'education-soul' ),
				'template' => 'template-parts/home/call-to-action',
			),
			'news-and-events' => array(
				'label'    => __( 'News and Events', 'education-soul' ),
				'template' => 'template-parts/home/news-and-events',
			),
			'services'        => array(
				'label'    => __( 'Services', 'education-soul' ),
				'template' => 'template-parts/home/services',
			),
			'latest-news'     => array(
				'label'    => __( 'Latest News', 'education-soul' ),
				'template' => 'template-parts/home/latest-news',
			),
		);

		$output = apply_filters( 'education_soul_filter_home_sections_options', $choices );
		return $output;

	}

endif;

