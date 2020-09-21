<?php
/**
 * Featured Content options
 *
 * @package Kids_Camp
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_camp_feat_cont_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_feat_cont_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Featured Content Options for Kids Camp Theme, go %1$shere%2$s', 'kids-camp' ),
                '<a href="javascript:wp.customize.section( \'kids_camp_feat_cont\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'feat_cont',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'kids_camp_feat_cont', array(
			'title' => esc_html__( 'Featured Content', 'kids-camp' ),
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

	// Add note to ECT Featured Content Section
    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'active_callback'   => 'kids_camp_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'kids-camp' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'kids_camp_feat_cont',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_feat_cont_option',
			'default'           => 'disabled',
			'active_callback'   => 'kids_camp_is_ect_featured_content_active',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => kids_camp_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'kids-camp' ),
			'section'           => 'kids_camp_feat_cont',
			'type'              => 'select',
		)
	);

    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_feat_cont_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'active_callback'   => 'kids_camp_is_feat_cont_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'kids-camp' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'kids_camp_feat_cont',
            'type'              => 'description',
        )
    );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_feat_cont_number',
			'default'           => 3,
			'sanitize_callback' => 'kids_camp_sanitize_number_range',
			'active_callback'   => 'kids_camp_is_feat_cont_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of items: 20)', 'kids-camp' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'kids-camp' ),
			'section'           => 'kids_camp_feat_cont',
			'type'              => 'number',
		)
	);

	$number = get_theme_mod( 'kids_camp_feat_cont_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		//CPT
		kids_camp_register_option( $wp_customize, array(
				'name'              => 'kids_camp_feat_cont_cpt_' . $i,
				'sanitize_callback' => 'kids_camp_sanitize_post',
				'active_callback'   => 'kids_camp_is_feat_cont_active',
				'label'             => esc_html__( 'Featured Content', 'kids-camp' ) . ' ' . $i ,
				'section'           => 'kids_camp_feat_cont',
				'type'              => 'select',
                'choices'           => kids_camp_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'kids_camp_feat_cont_options', 10 );

/** Active Callback Functions **/
if( ! function_exists( 'kids_camp_is_feat_cont_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Kids Camp 1.0
	*/
	function kids_camp_is_feat_cont_active( $control ) {
		$enable = $control->manager->get_setting( 'kids_camp_feat_cont_option' )->value();

		return ( kids_camp_is_ect_featured_content_active( $control ) &&  kids_camp_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'kids_camp_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'kids_camp_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
