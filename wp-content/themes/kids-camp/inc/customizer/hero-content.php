<?php
/**
 * Hero Content Options
 *
 * @package Kids_Camp
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_camp_hero_cont_options( $wp_customize ) {
	$wp_customize->add_section( 'kids_camp_hero_cont_options', array(
			'title' => esc_html__( 'Hero Content Options', 'kids-camp' ),
			'panel' => 'kids_camp_theme_options',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_hero_cont_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => kids_camp_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'kids-camp' ),
			'section'           => 'kids_camp_hero_cont_options',
			'type'              => 'select',
		)
	);
	
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_hero_cont',
			'default'           => '0',
			'sanitize_callback' => 'kids_camp_sanitize_post',
			'active_callback'   => 'kids_camp_is_hero_cont_active',
			'label'             => esc_html__( 'Page', 'kids-camp' ),
			'section'           => 'kids_camp_hero_cont_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'kids_camp_hero_cont_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'kids_camp_is_hero_cont_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Kids Camp 1.0
	*/
	function kids_camp_is_hero_cont_active( $control ) {
		$enable = $control->manager->get_setting( 'kids_camp_hero_cont_visibility' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return kids_camp_check_section( $enable );
	}
endif;
