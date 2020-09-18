<?php
/**
 * Header Media Options
 *
 * @package Kids_Camp
 */

function kids_camp_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'kids-camp' );

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'kids-camp' ),
				'entire-site'            => esc_html__( 'Entire Site', 'kids-camp' ),
				'disable'                => esc_html__( 'Disabled', 'kids-camp' ),
			),
			'label'             => esc_html__( 'Enable on ', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/*Overlay Option for Header Media*/
	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_image_opacity',
			'default'           => '0',
			'sanitize_callback' => 'kids_camp_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              		=> 'kids_camp_header_media_content_position',
			'default'           		=> 'content-center-top',
			'sanitize_callback' 		=> 'kids_camp_sanitize_select',
			'choices'           		=> array(
				'content-center' 		=> esc_html__( 'Center', 'kids-camp' ),
				'content-right'  		=> esc_html__( 'Right', 'kids-camp' ),
				'content-left'   		=> esc_html__( 'Left', 'kids-camp' ),
				'content-center-top'   	=> esc_html__( 'Center Top', 'kids-camp' ),
				'content-center-bottom' => esc_html__( 'Center Bottom', 'kids-camp' ),
			),
			'label'             => esc_html__( 'Content Position', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_text_alignment',
			'default'           => 'text-aligned-center',
			'sanitize_callback' => 'kids_camp_sanitize_select',
			'choices'           => array(
				'text-aligned-right'  => esc_html__( 'Right', 'kids-camp' ),
				'text-aligned-center' => esc_html__( 'Center', 'kids-camp' ),
				'text-aligned-left'   => esc_html__( 'Left', 'kids-camp' ),
			),
			'label'             => esc_html__( 'Text Alignment', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_sub_title',
			'default'           => esc_html__( 'New Arrival', 'kids-camp' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Sub Title', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_title',
			'default'           => esc_html__( 'Furniture Store', 'kids-camp' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'kids-camp' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_url',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'kids-camp' ),
			'section'           => 'header_image',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_media_url_text',
			'default'           => esc_html__( 'View Details', 'kids-camp' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'kids-camp' ),
			'section'           => 'header_image',
		)
	);

	kids_camp_register_option( $wp_customize, array(
			'name'              => 'kids_camp_header_url_target',
			'sanitize_callback' => 'kids_camp_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'kids-camp' ),
			'section'           => 'header_image',
			'custom_control'    => 'Kids_Camp_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'kids_camp_header_media_options' );

