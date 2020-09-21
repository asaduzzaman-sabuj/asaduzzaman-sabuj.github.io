<?php
/**
 * Theme Options
 *
 * @package Kids_Camp
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kids_camp_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'kids_camp_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'kids-camp' ),
		'priority' => 130,
	) );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_latest_posts_title',
			'default'           => esc_html__( 'News', 'kids-camp' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'kids-camp' ),
			'section'           => 'kids_camp_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'kids_camp_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'kids-camp' ),
		'panel' => 'kids_camp_theme_options',
		)
	);

	/* Default Layout */
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'kids-camp' ),
			'section'           => 'kids_camp_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'kids-camp' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'kids-camp' ),
			),
		)
	);

	/* Homepage Layout */
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_homepage_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'label'             => esc_html__( 'Homepage Layout', 'kids-camp' ),
			'section'           => 'kids_camp_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'kids-camp' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'kids-camp' ),
			),
		)
	);

	/* Blog/Archive Layout */
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'label'             => esc_html__( 'Blog/Archive Layout', 'kids-camp' ),
			'section'           => 'kids_camp_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'kids-camp' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'kids-camp' ),
			),
		)
	);
	
	/* Single Page/Post Image Layout */
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image Layout', 'kids-camp' ),
			'section'           => 'kids_camp_layout_options',
			'type'              => 'select',
			'choices'           => array(
				'disabled'           => esc_html__( 'Disabled', 'kids-camp' ),
				'post-thumbnail'     => esc_html__( 'Post Thumbnail', 'kids-camp' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'kids_camp_excerpt_options', array(
		'panel'     => 'kids_camp_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'kids-camp' ),
	) );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 20 words', 'kids-camp' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'kids-camp' ),
			'section'  => 'kids_camp_excerpt_options',
			'type'     => 'number',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_excerpt_more_text',
			'default'           => esc_html__( 'Continue Reading', 'kids-camp' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'kids-camp' ),
			'section'           => 'kids_camp_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'kids_camp_search_options', array(
		'panel'     => 'kids_camp_theme_options',
		'title'     => esc_html__( 'Search Options', 'kids-camp' ),
	) );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_search_text',
			'default'           => esc_html__( 'Search', 'kids-camp' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'kids-camp' ),
			'section'           => 'kids_camp_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'kids_camp_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'kids-camp' ),
		'panel'       => 'kids_camp_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'kids-camp' ),
	) );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_front_page_category',
			'sanitize_callback' => 'kids_camp_sanitize_category_list',
			'custom_control'    => 'Kids_Camp_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'kids-camp' ),
			'section'           => 'kids_camp_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'From Our Blog', 'kids-camp' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'kids-camp' ),
			'section'           => 'kids_camp_homepage_options',
		)
	);
	
	// Pagination Options.
	$pagination_type = get_theme_mod( 'kids_camp_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sCatch Infinite Scroll Plugin%2$s with Infinite Scroll module Enabled.', 'kids-camp' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/catch-infinite-scroll/">',
		'</a>'
	);

	$wp_customize->add_section( 'kids_camp_pagination_options', array(
		'description' => $nav_desc,
		'panel'       => 'kids_camp_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'kids-camp' ),
	) );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => kids_camp_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'kids-camp' ),
			'section'           => 'kids_camp_pagination_options',
			'type'              => 'select',
		)
	);

	// For WooCommerce layout: kids_camp_woocommerce_layout, check woocommerce-options.php.
	/* Scrollup Options */
	$wp_customize->add_section( 'kids_camp_scrollup', array(
		'panel'    => 'kids_camp_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'kids-camp' ),
	) );

	/* Scrollup Options */
	$wp_customize->add_section( 'kids_camp_scrollup', array(
		'panel'    => 'kids_camp_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'kids-camp'  ),
	) );

	$action = 'install-plugin';
	$slug   = 'to-top';

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

	// Add note to Scroll up Section
    kids_camp_register_option( $wp_customize, array(
        'name'              => 'kids_camp_to_top_note',
        'sanitize_callback' => 'sanitize_text_field',
        'custom_control'    => 'Kids_Camp_Note_Control',
        'active_callback'   => 'kids_camp_is_to_top_inactive',
        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
        'label'             => sprintf( esc_html__( 'For Scroll Up, install %1$sTo Top%2$s Plugin', 'kids-camp' ),
            '<a target="_blank" href="' . esc_url( $install_url ) . '">',
            '</a>'

        ),
       'section'            => 'kids_camp_scrollup',
        'type'              => 'description',
        'priority'          => 1,
        )
    );

    kids_camp_register_option( $wp_customize, array(
        'name'              => 'kids_camp_to_top_option_note',
        'sanitize_callback' => 'sanitize_text_field',
        'custom_control'    => 'Kids_Camp_Note_Control',
        'active_callback'   => 'kids_camp_is_to_top_active',
        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
		'label'             => sprintf( esc_html__( 'For Scroll Up Options, go %1$shere%2$s', 'kids-camp'  ),
             '<a href="javascript:wp.customize.panel( \'to_top_panel\' ).focus();">',
             '</a>'
        ),
        'section'           => 'kids_camp_scrollup',
        'type'              => 'description',
        )
    );
}
add_action( 'customize_register', 'kids_camp_theme_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'kids_camp_is_to_top_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Kids Camp 0.1
    */
    function kids_camp_is_to_top_inactive( $control ) {
        return ! ( class_exists( 'To_Top' ) );
    }
endif;

if ( ! function_exists( 'kids_camp_is_to_top_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Kids Camp 0.1
    */
    function kids_camp_is_to_top_active( $control ) {
        return ( class_exists( 'To_Top' ) );
    }
endif;

