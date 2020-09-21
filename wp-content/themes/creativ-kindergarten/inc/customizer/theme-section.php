<?php
/**
 * Theme Options.
 *
 * @package Creativ Kindergarten
 */

$default = creativ_kindergarten_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => __( 'Theme Options', 'creativ-kindergarten' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

//For General Option
$wp_customize->add_section('section_general', array(    
'title'       => __('General Option', 'creativ-kindergarten'),
'panel'       => 'theme_option_panel'    
));

//Layout Options
$wp_customize->add_setting('theme_options[layout_options]', 
	array(
	'default' 			=> $default['layout_options'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_select'
	)
);

$wp_customize->add_control(new creativ_kindergarten_Image_Radio_Control($wp_customize, 'theme_options[layout_options]', 
	array(		
	'label' 	=> __('Layout Options', 'creativ-kindergarten'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[layout_options]',
	'type' 		=> 'radio-image',
	'choices' 	=> array(		
		'left-sidebar' 	=> get_template_directory_uri() . '/assets/images/left-sidebar.png',						
		'right-sidebar' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
		'no-sidebar' 	=> get_template_directory_uri() . '/assets/images/no-sidebar.png',
		),	
	))
);

// Setting Read More Text.
$wp_customize->add_setting( 'theme_options[readmore_text]',
	array(
	'default'           => $default['readmore_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_textarea_content',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[readmore_text]',
	array(
	'label'    => __( 'Read More Text', 'creativ-kindergarten' ),
	'section'  => 'section_general',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Setting excerpt_length.
$wp_customize->add_setting( 'theme_options[excerpt_length]', array(
	'default'           => $default['excerpt_length'],
	'sanitize_callback' => 'creativ_kindergarten_sanitize_positive_integer',
) );
$wp_customize->add_control( 'theme_options[excerpt_length]', array(
	'label'       => esc_html__( 'Excerpt Length', 'creativ-kindergarten' ),
	'description' => esc_html__( 'in words', 'creativ-kindergarten' ),
	'section'     => 'section_general',
	'type'        => 'number',
	'input_attrs' => array( 'min' => 1, 'max' => 200, 'style' => 'width: 55px;' ),
) );

// Latest Post Title
$wp_customize->add_section('section_blog_title', 
	array(    
	'title'       => __('Blog Title', 'creativ-kindergarten'),
	'panel'       => 'theme_option_panel'    
	)
);


$wp_customize->add_setting( 'theme_options[your_latest_posts_title]',
	array(
	'default'           => $default['your_latest_posts_title'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_textarea_content',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[your_latest_posts_title]',
	array(
	'label'    => __( 'Blog Title', 'creativ-kindergarten' ),
	'section'  => 'section_blog_title',
	'type'     => 'text',
	'priority' => 100,
	)
);

// Footer Setting Section starts
$wp_customize->add_section('section_footer', 
	array(    
	'title'       => __('Footer Setting', 'creativ-kindergarten'),
	'panel'       => 'theme_option_panel'    
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'creativ_kindergarten_sanitize_textarea_content',
	'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => __( 'Copyright Text', 'creativ-kindergarten' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	'priority' => 100,
	)
);


/** Header Image Settings */
$wp_customize->add_section( 
    'custom_header_image_settings',
    array(
        'capability'  => 'edit_theme_options',
        'title'       => esc_html__( 'Header Image For Inner Pages', 'creativ-kindergarten' ),
        'panel'       => 'theme_option_panel',
    ) 
);

/** Header Image */
$wp_customize->add_setting( 'theme_options[archive_header_image]',
    array(
        'default'           => get_template_directory_uri() . '/assets/images/default-header.jpg',
        'sanitize_callback' => 'creativ_kindergarten_sanitize_image',
    )
);

$wp_customize->add_control( 
    new WP_Customize_Image_Control( $wp_customize, 'theme_options[archive_header_image]',
        array(
            'label'         => esc_html__( 'Header Image For Archive Page', 'creativ-kindergarten' ),
            'description'   => esc_html__( 'Choose Header Image of your choice for Archive Pages. Recommended size for this image is 1920px by 500px.', 'creativ-kindergarten' ),
            'section'       => 'custom_header_image_settings',
            'type'          => 'image',
        )
    )
);

/** Search Header Image */
$wp_customize->add_setting( 'theme_options[search_header_image]',
    array(
        'default'           => get_template_directory_uri() . '/assets/images/default-header.jpg',
        'sanitize_callback' => 'creativ_kindergarten_sanitize_image',
    )
);

$wp_customize->add_control( 
    new WP_Customize_Image_Control( $wp_customize, 'theme_options[search_header_image]',
        array(
            'label'         => esc_html__( 'Header Image For Search Page', 'creativ-kindergarten' ),
            'description'   => esc_html__( 'Choose Header Image of your choice for Search Page. Recommended size for this image is 1920px by 500px', 'creativ-kindergarten' ),
            'section'       => 'custom_header_image_settings',
            'type'          => 'image',
        )
    )
);

/** 404 Header Image */
$wp_customize->add_setting( 'theme_options[404_header_image]',
    array(
        'default'           => get_template_directory_uri() . '/assets/images/default-header.jpg',
        'sanitize_callback' => 'creativ_kindergarten_sanitize_image',
    )
);

$wp_customize->add_control( 
    new WP_Customize_Image_Control( $wp_customize, 'theme_options[404_header_image]',
        array(
            'label'         => esc_html__( 'Header Image For 404 Page', 'creativ-kindergarten' ),
            'description'   => esc_html__( 'Choose Header Image of your choice for 404 Page. Recommended size for this image is 1920px by 500px', 'creativ-kindergarten' ),
            'section'       => 'custom_header_image_settings',
            'type'          => 'image',
        )
    )
);


// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'theme_options[enable_frontpage_content]', array(
	'default'             => $default['enable_frontpage_content'],
	'sanitize_callback'   => 'creativ_kindergarten_sanitize_checkbox',
) );

$wp_customize->add_control( 'theme_options[enable_frontpage_content]', array(
	'label'       	=> esc_html__( 'Enable Content', 'creativ-kindergarten' ),
	'description' 	=> esc_html__( 'Click to enable content on static front page only.', 'creativ-kindergarten' ),
	'section'     	=> 'static_front_page',
	'type'        	=> 'checkbox',
) );