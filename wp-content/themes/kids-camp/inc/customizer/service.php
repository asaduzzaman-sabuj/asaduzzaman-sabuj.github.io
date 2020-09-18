<?php
/**
 * Services options
 *
 * @package Kids_Camp
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_camp_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for Foodie World Theme, go %1$shere%2$s', 'kids-camp' ),
                '<a href="javascript:wp.customize.section( \'kids_camp_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'kids_camp_service', array(
			'title' => esc_html__( 'Services', 'kids-camp' ),
			'panel' => 'kids_camp_theme_options',
		)
	);

	$action = 'install-plugin';
    $slug   = 'essential-content-types';

    $install_url = wp_nonce_url(
        add_query_arg(
            array(
                'action' => $action,
                'plugin' => $slug
            ),
            admin_url( 'update.php' )
        ),
        $action . '_' . $slug
    );

    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'active_callback'   => 'kids_camp_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'kids-camp' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'kids_camp_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_service_option',
			'default'           => 'disabled',
			'active_callback'   => 'kids_camp_is_ect_services_active',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => kids_camp_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'kids-camp' ),
			'section'           => 'kids_camp_service',
			'type'              => 'select',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_service_main_image',
			'sanitize_callback' => 'kids_camp_sanitize_image',
			'active_callback'   => 'kids_camp_is_services_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Section Main Image', 'kids-camp' ),
			'section'           => 'kids_camp_service',
			'mime_type'         => 'image',
		)
	);

    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'active_callback'   => 'kids_camp_is_services_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'kids-camp' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'kids_camp_service',
            'type'              => 'description',
        )
    );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_service_number',
			'default'           => 4,
			'sanitize_callback' => 'kids_camp_sanitize_number_range',
			'active_callback'   => 'kids_camp_is_services_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'kids-camp' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'kids-camp' ),
			'section'           => 'kids_camp_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'kids_camp_service_number', 4 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		
		//CPT
		kids_camp_register_option( $wp_customize, array(
				'name'              => 'kids_camp_service_cpt_' . $i,
				'sanitize_callback' => 'kids_camp_sanitize_post',
				'active_callback'   => 'kids_camp_is_services_active',
				'label'             => esc_html__( 'Services', 'kids-camp' ) . ' ' . $i ,
				'section'           => 'kids_camp_service',
				'type'              => 'select',
                'choices'           => kids_camp_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'kids_camp_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'kids_camp_is_services_active' ) ) :
	/**
	* Return true if services content is active
	*
	* @since Kids Camp 1.0
	*/
	function kids_camp_is_services_active( $control ) {
		$enable = $control->manager->get_setting( 'kids_camp_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( kids_camp_is_ect_services_active( $control ) &&  kids_camp_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'kids_camp_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'kids_camp_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
