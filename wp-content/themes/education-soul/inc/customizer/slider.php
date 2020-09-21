<?php
/**
 * Theme Options related to slider
 *
 * @package Education_Soul
 */

$default = education_soul_get_default_theme_options();

// Home Section Featured Slider.
$wp_customize->add_section(
	'section_home_featured_slider',
	array(
		'title'      => __( 'Featured Slider', 'education-soul' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
	)
);

// Setting featured_slider_transition_effect.
$wp_customize->add_setting(
	'theme_options[featured_slider_transition_effect]',
	array(
		'default'           => $default['featured_slider_transition_effect'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_transition_effect]',
	array(
		'label'    => __( 'Transition Effect', 'education-soul' ),
		'section'  => 'section_home_featured_slider',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => education_soul_get_featured_slider_transition_effects(),
	)
);

// Setting featured_slider_transition_delay.
$wp_customize->add_setting(
	'theme_options[featured_slider_transition_delay]',
	array(
		'default'           => $default['featured_slider_transition_delay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_transition_delay]',
	array(
		'label'       => __( 'Transition Delay', 'education-soul' ),
		'description' => __( 'in seconds', 'education-soul' ),
		'section'     => 'section_home_featured_slider',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 10,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

// Setting featured_slider_transition_duration.
$wp_customize->add_setting(
	'theme_options[featured_slider_transition_duration]',
	array(
		'default'           => $default['featured_slider_transition_duration'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_transition_duration]',
	array(
		'label'       => __( 'Transition Duration', 'education-soul' ),
		'description' => __( 'in seconds', 'education-soul' ),
		'section'     => 'section_home_featured_slider',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 10,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

// Setting featured_slider_enable_caption.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_caption]',
	array(
		'default'           => $default['featured_slider_enable_caption'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_caption]',
	array(
		'label'    => __( 'Enable Caption', 'education-soul' ),
		'section'  => 'section_home_featured_slider',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_caption_alignment.
$wp_customize->add_setting(
	'theme_options[featured_slider_caption_alignment]',
	array(
		'default'           => $default['featured_slider_caption_alignment'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_caption_alignment]',
	array(
		'label'           => __( 'Caption Alignment', 'education-soul' ),
		'section'         => 'section_home_featured_slider',
		'type'            => 'select',
		'priority'        => 100,
		'choices'         => education_soul_get_slider_caption_alignment_options(),
		'active_callback' => 'education_soul_is_featured_slider_caption_active',
	)
);

// Setting featured_slider_enable_arrow.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_arrow]',
	array(
		'default'           => $default['featured_slider_enable_arrow'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_arrow]',
	array(
		'label'    => __( 'Enable Arrow', 'education-soul' ),
		'section'  => 'section_home_featured_slider',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_enable_pager.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_pager]',
	array(
		'default'           => $default['featured_slider_enable_pager'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_pager]',
	array(
		'label'    => __( 'Enable Pager', 'education-soul' ),
		'section'  => 'section_home_featured_slider',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_enable_autoplay.
$wp_customize->add_setting(
	'theme_options[featured_slider_enable_autoplay]',
	array(
		'default'           => $default['featured_slider_enable_autoplay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_enable_autoplay]',
	array(
		'label'    => __( 'Enable Autoplay', 'education-soul' ),
		'section'  => 'section_home_featured_slider',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting featured_slider_type.
$wp_customize->add_setting(
	'theme_options[featured_slider_type]',
	array(
		'default'           => $default['featured_slider_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_type]',
	array(
		'label'    => __( 'Select Slider Type', 'education-soul' ),
		'section'  => 'section_home_featured_slider',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => education_soul_get_featured_slider_type(),
	)
);

// Setting featured_slider_number.
$wp_customize->add_setting(
	'theme_options[featured_slider_number]',
	array(
		'default'           => $default['featured_slider_number'],
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_number]',
	array(
		'label'           => __( 'No of Slides', 'education-soul' ),
		'description'     => __( 'Enter number between 1 and 10. Save and refresh the page if No of Slides is changed.', 'education-soul' ),
		'section'         => 'section_home_featured_slider',
		'type'            => 'number',
		'priority'        => 100,
		'active_callback' => 'education_soul_is_featured_slider_active_non_demo',
		'input_attrs'     => array(
			'min'   => 1,
			'max'   => 10,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

$featured_slider_number = absint( education_soul_get_option( 'featured_slider_number' ) );

if ( $featured_slider_number > 0 ) {
	for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
		$wp_customize->add_setting(
			"theme_options[featured_slider_page_$i]",
			array(
				'default'           => isset( $default[ 'featured_slider_page_' . $i ] ) ? $default[ 'featured_slider_page_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'education_soul_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control(
			"theme_options[featured_slider_page_$i]",
			array(
				'label'           => __( 'Featured Page', 'education-soul' ) . ' - ' . $i,
				'section'         => 'section_home_featured_slider',
				'type'            => 'dropdown-pages',
				'priority'        => 100,
			)
		);
	} // End for loop.
}

// Setting featured_slider_read_more_text.
$wp_customize->add_setting(
	'theme_options[featured_slider_read_more_text]',
	array(
		'default'           => $default['featured_slider_read_more_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[featured_slider_read_more_text]',
	array(
		'label'           => __( 'Read More Text', 'education-soul' ),
		'section'         => 'section_home_featured_slider',
		'type'            => 'text',
		'priority'        => 100,
	)
);
