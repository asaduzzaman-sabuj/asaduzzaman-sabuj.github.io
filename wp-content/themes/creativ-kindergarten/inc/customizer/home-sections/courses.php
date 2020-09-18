<?php
/**
 * Courses options.
 *
 * @package Creativ Kindergarten
 */

$default = creativ_kindergarten_get_default_theme_options();

// Featured Courses Section
$wp_customize->add_section( 'section_home_courses',
	array(
		'title'      => __( 'Our Popular Classes', 'creativ-kindergarten' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Courses Section
$wp_customize->add_setting('theme_options[disable_courses_section]', 
	array(
	'default' 			=> $default['disable_courses_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_courses_section]', 
	array(		
	'label' 	=> __('Disable Courses Section', 'creativ-kindergarten'),
	'section' 	=> 'section_home_courses',
	'settings'  => 'theme_options[disable_courses_section]',
	'type' 		=> 'checkbox',	
	)
);

//Service Blog title
$wp_customize->add_setting('theme_options[courses_section_title]', 
	array(
	'default'           => $default['courses_section_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[courses_section_title]', 
	array(
	'label'       => __('Section Title', 'creativ-kindergarten'),
	'section'     => 'section_home_courses',   
	'settings'    => 'theme_options[courses_section_title]',	
	'active_callback' => 'creativ_kindergarten_blog_active',		
	'type'        => 'text'
	)
);

// Number of Items
$wp_customize->add_setting('theme_options[number_of_cs_column]', 
	array(
	'default' 			=> $default['number_of_cs_column'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_cs_column]', 
	array(
	'label'       => __('Column Per Row', 'creativ-kindergarten'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 3', 'creativ-kindergarten'),
	'section'     => 'section_home_courses',   
	'settings'    => 'theme_options[number_of_cs_column]',		
	'type'        => 'number',
	'active_callback' => 'creativ_kindergarten_courses_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 3,
			'step'	=> 1,
		),
	)
);
// Number of items
$wp_customize->add_setting('theme_options[number_of_cs_items]', 
	array(
	'default' 			=> $default['number_of_cs_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_cs_items]', 
	array(
	'label'       => __('Number Of Items', 'creativ-kindergarten'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 3.', 'creativ-kindergarten'),
	'section'     => 'section_home_courses',   
	'settings'    => 'theme_options[number_of_cs_items]',		
	'type'        => 'number',
	'active_callback' => 'creativ_kindergarten_courses_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 3,
			'step'	=> 1,
		),
	)
);

$wp_customize->add_setting('theme_options[cs_content_type]', 
	array(
	'default' 			=> $default['cs_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'creativ_kindergarten_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[cs_content_type]', 
	array(
	'label'       => __('Content Type', 'creativ-kindergarten'),
	'section'     => 'section_home_courses',   
	'settings'    => 'theme_options[cs_content_type]',		
	'type'        => 'select',
	'active_callback' => 'creativ_kindergarten_courses_active',
	'choices'	  => array(
			'cs_page'	  => __('Page','creativ-kindergarten'),
		),
	)
);

$number_of_cs_items = creativ_kindergarten_get_option( 'number_of_cs_items' );

for( $i=1; $i<=$number_of_cs_items; $i++ ){

	// Courses First Page
	$wp_customize->add_setting('theme_options[courses_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'creativ_kindergarten_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[courses_page_'.$i.']', 
		array(
		'label'       => __('Select Page', 'creativ-kindergarten'),
		'section'     => 'section_home_courses',   
		'settings'    => 'theme_options[courses_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'creativ_kindergarten_courses_page',
		)
	);
}