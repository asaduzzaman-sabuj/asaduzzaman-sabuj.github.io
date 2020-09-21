<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Kids_Camp
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_camp_portfolio_options( $wp_customize ) {
    // Add note to Jetpack Portfolio Section
    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'label'             => sprintf( esc_html__( 'For Portfolio Options for Kids Camp Theme, go %1$shere%2$s', 'kids-camp' ),
                 '<a href="javascript:wp.customize.section( \'kids_camp_portfolio\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'jetpack_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'kids_camp_portfolio', array(
            'panel'    => 'kids_camp_theme_options',
            'title'    => esc_html__( 'Portfolio', 'kids-camp' ),
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
            'name'              => 'kids_camp_portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'active_callback'   => 'kids_camp_is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'kids-camp' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'kids_camp_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_portfolio_option',
			'default'           => 'disabled',
            'active_callback'   => 'kids_camp_is_ect_portfolio_active',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => kids_camp_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'kids-camp' ),
			'section'           => 'kids_camp_portfolio',
			'type'              => 'select',
		)
	);

    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Kids_Camp_Note_Control',
            'active_callback'   => 'kids_camp_is_portfolio_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'kids-camp' ),
                 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'kids_camp_portfolio',
            'type'              => 'description',
        )
    );

    kids_camp_register_option( $wp_customize, array(
            'name'              => 'kids_camp_portfolio_number',
            'default'           => '5',
            'sanitize_callback' => 'kids_camp_sanitize_number_range',
            'active_callback'   => 'kids_camp_is_portfolio_active',
            'label'             => esc_html__( 'Number of items to show', 'kids-camp' ),
            'section'           => 'kids_camp_portfolio',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'kids_camp_portfolio_number', 5 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        kids_camp_register_option( $wp_customize, array(
                'name'              => 'kids_camp_portfolio_cpt_' . $i,
                'sanitize_callback' => 'kids_camp_sanitize_post',
                'active_callback'   => 'kids_camp_is_portfolio_active',
                'label'             => esc_html__( 'Portfolio', 'kids-camp' ) . ' ' . $i ,
                'section'           => 'kids_camp_portfolio',
                'type'              => 'select',
                'choices'           => kids_camp_generate_post_array( 'jetpack-portfolio' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'kids_camp_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'kids_camp_is_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_portfolio_active( $control ) {
        $enable = $control->manager->get_setting( 'kids_camp_portfolio_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( kids_camp_is_ect_portfolio_active( $control ) &&  kids_camp_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'kids_camp_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'kids_camp_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Kids Camp 1.0
    */
    function kids_camp_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
