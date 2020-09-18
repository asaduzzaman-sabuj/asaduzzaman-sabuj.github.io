<?php
/**
 * Theme Customizer
 *
 * @package Education_Soul
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 0.1
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_soul_customize_register( $wp_customize ) {
	// Load custom controls.
	include get_template_directory() . '/inc/customizer/control.php';

	$wp_customize->register_control_type( 'Education_Soul_Heading_Control' );
	$wp_customize->register_control_type( 'Education_Soul_Message_Control' );
	$wp_customize->register_control_type( 'Education_Soul_Dropdown_Taxonomies_Control' );
	$wp_customize->register_control_type( 'Education_Soul_Dropdown_Sidebars_Control' );
	$wp_customize->register_control_type( 'Education_Soul_Section_Manager_Control' );
	$wp_customize->register_section_type( 'Education_Soul_Customize_Section_Upsell' );

	// Load customize helpers.
	include get_template_directory() . '/inc/helper/options.php';

	// Load customize sanitize.
	include get_template_directory() . '/inc/customizer/sanitize.php';

	// Load customize callback.
	include get_template_directory() . '/inc/customizer/callback.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Load customize option.
	include get_template_directory() . '/inc/customizer/option.php';

	// Load home sections option.
	include get_template_directory() . '/inc/customizer/home-sections.php';

	// Load slider customize option.
	require get_template_directory() . '/inc/customizer/slider.php';

	// Modify default customizer options.
	$wp_customize->get_control( 'background_color' )->description = __( 'Note: Background Color is applicable only if no image is set as Background Image.', 'education-soul' );

	// Register sections.
	$wp_customize->add_section(
		new Education_Soul_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Education Soul Pro', 'education-soul' ),
				'pro_text' => esc_html__( 'Buy Pro', 'education-soul' ),
				'pro_url'  => 'https://themepalace.com/downloads/education-soul-pro/',
				'priority'  => 1,
			)
		)
	);
}

add_action( 'customize_register', 'education_soul_customize_register' );

/**
 * Customizer partials.
 *
 * @since 0.1
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_soul_customizer_partials( WP_Customize_Manager $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
		return;
	}

	// Load customizer partials callback.
	include get_template_directory() . '/inc/customizer/partials.php';

	// Partial blogname.
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'education_soul_customize_partial_blogname',
		)
	);

	// Partial blogdescription.
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'            => '.site-description',
			'container_inclusive' => false,
			'render_callback'     => 'education_soul_customize_partial_blogdescription',
		)
	);
}

add_action( 'customize_register', 'education_soul_customizer_partials', 99 );

/**
 * Register customizer controls scripts.
 *
 * @since 0.1
 */
function education_soul_customize_controls_register_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_script( 'education-soul-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'jquery', 'customize-controls', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0.0', true );
	wp_enqueue_style( 'education-soul-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css', array(), '1.0.0' );
}

add_action( 'customize_controls_enqueue_scripts', 'education_soul_customize_controls_register_scripts', 0 );
