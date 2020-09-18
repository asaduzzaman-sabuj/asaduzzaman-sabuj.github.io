<?php
/**
 * Call to action options.
 *
 * @package Creativ Kindergarten
 */

$default = creativ_kindergarten_get_default_theme_options();

// Call to action section
$wp_customize->add_section( 'section_cta',
	array(
		'title'      => __( 'Call To Action', 'creativ-kindergarten' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Cta Section
$wp_customize->add_setting('theme_options[disable_cta_section]', 
	array(
	'default' 			=> $default['disable_cta_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_cta_section]', 
	array(		
	'label' 	=> __('Disable Call to action section', 'creativ-kindergarten'),
	'section' 	=> 'section_cta',
	'settings'  => 'theme_options[disable_cta_section]',
	'type' 		=> 'checkbox',	
	)
);

// Cta Small Font Description
$wp_customize->add_setting('theme_options[cta_small_description]', 
	array(
	'default' 			=> $default['cta_small_description'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_small_description]', 
	array(
	'label'       => __('CTA Small Font Description', 'creativ-kindergarten'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_small_description]',
	'active_callback' => 'creativ_kindergarten_cta_active',		
	'type'        => 'textarea'
	)
);

// Cta Button Text
$wp_customize->add_setting('theme_options[cta_button_label]', 
	array(
	'default' 			=> $default['cta_button_label'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_button_label]', 
	array(
	'label'       => __('Button Label', 'creativ-kindergarten'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_button_label]',	
	'active_callback' => 'creativ_kindergarten_cta_active',	
	'type'        => 'text'
	)
);
// Cta Button Url
$wp_customize->add_setting('theme_options[cta_button_url]', 
	array(
	'default' 			=> $default['cta_button_url'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_button_url]', 
	array(
	'label'       => __('Button Url', 'creativ-kindergarten'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_button_url]',	
	'active_callback' => 'creativ_kindergarten_cta_active',	
	'type'        => 'url'
	)
);