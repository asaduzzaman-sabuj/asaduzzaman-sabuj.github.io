<?php
/**
 * Featured Slider Options
 *
 * @package Kids_Camp
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_camp_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'kids_camp_featured_slider', array(
			'panel' => 'kids_camp_theme_options',
			'title' => esc_html__( 'Featured Slider', 'kids-camp' ),
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => kids_camp_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'kids-camp' ),
			'section'           => 'kids_camp_featured_slider',
			'type'              => 'select',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'kids_camp_sanitize_number_range',

			'active_callback'   => 'kids_camp_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'kids-camp' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'kids-camp' ),
			'section'           => 'kids_camp_featured_slider',
			'type'              => 'number',
		)
	);

	$slider_number = get_theme_mod( 'kids_camp_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		// Page Sliders
		kids_camp_register_option( $wp_customize, array(
				'name'              =>'kids_camp_slider_page_' . $i,
				'sanitize_callback' => 'kids_camp_sanitize_post',
				'active_callback'   => 'kids_camp_is_slider_active',
				'label'             => esc_html__( 'Page', 'kids-camp' ) . ' # ' . $i,
				'section'           => 'kids_camp_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'kids_camp_slider_options' );

/**
 * Returns an array of featured content show registered
 *
 * @since Kids Camp 1.0
 */
function kids_camp_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'kids-camp' ),
		'full-content' => esc_html__( 'Full Content', 'kids-camp' ),
		'hide-content' => esc_html__( 'Hide Content', 'kids-camp' ),
	);
	return apply_filters( 'kids_camp_content_show', $options );
}


/**
 * Returns an array of featured content show registered
 *
 * @since Kids Camp 1.0
 */
function kids_camp_meta_show() {
	$options = array(
		'show-meta'      => esc_html__( 'Show Meta', 'kids-camp' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'kids-camp' ),
	);
	return apply_filters( 'kids_camp_meta_show', $options );
}

/** Active Callback Functions */

if( ! function_exists( 'kids_camp_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Kids Camp 1.0
	*/
	function kids_camp_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'kids_camp_slider_option' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( kids_camp_check_section( $enable ) );
	}
endif;
