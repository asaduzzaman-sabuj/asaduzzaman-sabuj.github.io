<?php
/**
 * Slider options.
 *
 * @package Creativ Kindergarten
 */

$default = creativ_kindergarten_get_default_theme_options();

// Featured Slider Section
$wp_customize->add_section( 'section_featured_slider',
	array(
		'title'      => __( 'Featured Slider', 'creativ-kindergarten' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);

// Disable Slider Section
$wp_customize->add_setting('theme_options[disable_featured_slider]', 
	array(
	'default' 			=> $default['disable_featured_slider'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_featured_slider]', 
	array(		
	'label' 	=> __('Disable Slider Section', 'creativ-kindergarten'),
	'section' 	=> 'section_featured_slider',
	'settings'  => 'theme_options[disable_featured_slider]',
	'type' 		=> 'checkbox',	
	)
);

// Number of items
$wp_customize->add_setting('theme_options[number_of_sr_items]', 
	array(
	'default' 			=> $default['number_of_sr_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_sr_items]', 
	array(
	'label'       => __('Number Of Slides', 'creativ-kindergarten'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 3.', 'creativ-kindergarten'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[number_of_sr_items]',		
	'type'        => 'number',
	'active_callback' => 'creativ_kindergarten_slider_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 3,
			'step'	=> 1,
		),
	)
);

// Slider Overlay
$wp_customize->add_setting('theme_options[featured_slider_overlay]', 
	array(
	'default' 			=> $default['featured_slider_overlay'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[featured_slider_overlay]', 
	array(
	'label'       => __('Dark Overlay Opacity', 'creativ-kindergarten'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[featured_slider_overlay]',		
	'type'        => 'range',
	'active_callback' => 'creativ_kindergarten_slider_active',
	'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 1,
			'step'	=> 0.1,
		),
	)
);

// Slider Speed
$wp_customize->add_setting('theme_options[featured_slider_speed]', 
	array(
	'default' 			=> $default['featured_slider_speed'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[featured_slider_speed]', 
	array(
	'label'       => __('Slider Speed', 'creativ-kindergarten'),
	'description' => esc_html__( 'Select Value Between 0 to 8000. Default is 1000.', 'creativ-kindergarten' ),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[featured_slider_speed]',		
	'type'        => 'number',
	'active_callback' => 'creativ_kindergarten_slider_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 8000,
			'style' => 'width: 100px;',
		),
	)
);

// Slider Height
$wp_customize->add_setting('theme_options[featured_slider_height]', 
	array(
	'default' 			=> $default['featured_slider_height'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[featured_slider_height]', 
	array(
	'label'       => __('Slider Height', 'creativ-kindergarten'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[featured_slider_height]',		
	'type'        => 'range',
	'active_callback' => 'creativ_kindergarten_slider_active',
	'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 1000,
			'step'	=> 1,
		),
	)
);

// Slider Font Size
$wp_customize->add_setting('theme_options[featured_slider_fontsize]', 
	array(
	'default' 			=> $default['featured_slider_fontsize'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[featured_slider_fontsize]', 
	array(
	'label'       => __('Slider Title Font Size', 'creativ-kindergarten'),
	'description' => esc_html__( 'Select Value Between 16 to 200. Default is 66.', 'creativ-kindergarten' ),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[featured_slider_fontsize]',		
	'type'        => 'number',
	'active_callback' => 'creativ_kindergarten_slider_active',
	'input_attrs' => array(
			'min'	=> 16,
			'max'	=> 200,
			'style' => 'width: 100px;',
		),
	)
);

$wp_customize->add_setting('theme_options[sr_content_type]', 
	array(
	'default' 			=> $default['sr_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[sr_content_type]', 
	array(
	'label'       => __('Content Type', 'creativ-kindergarten'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[sr_content_type]',		
	'type'        => 'select',
	'active_callback' => 'creativ_kindergarten_slider_active',
	'choices'	  => array(
			'sr_page'	  => __('Page','creativ-kindergarten'),
		),
	)
);

$number_of_sr_items = creativ_kindergarten_get_option( 'number_of_sr_items' );

for( $i=1; $i<=$number_of_sr_items; $i++ ){

	// Additional Information First Page
	$wp_customize->add_setting('theme_options[slider_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'creativ_kindergarten_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[slider_page_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Page #%1$s', 'creativ-kindergarten'), $i),
		'section'     => 'section_featured_slider',   
		'settings'    => 'theme_options[slider_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'creativ_kindergarten_slider_page',
		)
	);
}

