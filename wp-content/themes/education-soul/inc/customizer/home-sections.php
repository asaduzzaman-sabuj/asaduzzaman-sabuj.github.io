<?php
/**
 * Home Sections Options
 *
 * @package Education_Soul
 */

$default = education_soul_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel(
	'theme_home_sections_panel',
	array(
		'title'      => __( 'Homepage Sections', 'education-soul' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
	)
);

// Home Section Manager.
$wp_customize->add_section(
	'section_home_sections_manager',
	array(
		'title'      => __( 'Manage Sections', 'education-soul' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
	)
);

// Setting homepage_sections.
$wp_customize->add_setting(
	'theme_options[homepage_sections]',
	array(
		'default'           => $default['homepage_sections'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_homepage_sections',
	)
);

$home_sections = education_soul_get_option( 'homepage_sections' );

$hsection_items = array();

$all_section_details = education_soul_get_home_sections_options();

if ( ! empty( $home_sections ) ) {
	foreach ( $home_sections as $key => $value ) {
		if ( $all_section_details[ $value ] ) {
			$hsection_items[ $value ] = $all_section_details[ $value ];
		}
	}
}

$hsection_items = array_merge( $hsection_items, $all_section_details );

$wp_customize->add_control(
	new Education_Soul_Section_Manager_Control(
		$wp_customize,
		'theme_options[homepage_sections]',
		array(
			'label'    => esc_html__( 'Reorder/toggle sections', 'education-soul' ),
			'section'  => 'section_home_sections_manager',
			'settings' => 'theme_options[homepage_sections]',
			'priority' => 1,
			'choices'  => $hsection_items,
		)
	)
);

// Home Section Call To Action.
$wp_customize->add_section(
	'section_home_call_to_action',
	array(
		'title'      => __( 'Call To Action', 'education-soul' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
	)
);

// Setting cta_title.
$wp_customize->add_setting(
	'theme_options[cta_title]',
	array(
		'default'           => $default['cta_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[cta_title]',
	array(
		'label'    => __( 'Title', 'education-soul' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting cta_description.
$wp_customize->add_setting(
	'theme_options[cta_description]',
	array(
		'default'           => $default['cta_description'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[cta_description]',
	array(
		'label'    => __( 'Subtitle', 'education-soul' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting cta_primary_button_text.
$wp_customize->add_setting(
	'theme_options[cta_primary_button_text]',
	array(
		'default'           => $default['cta_primary_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[cta_primary_button_text]',
	array(
		'label'    => __( 'Primary Button Text', 'education-soul' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting cta_primary_button_url.
$wp_customize->add_setting(
	'theme_options[cta_primary_button_url]',
	array(
		'default'           => $default['cta_primary_button_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	'theme_options[cta_primary_button_url]',
	array(
		'label'    => __( 'Primary Button URL', 'education-soul' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting cta_secondary_button_text.
$wp_customize->add_setting(
	'theme_options[cta_secondary_button_text]',
	array(
		'default'           => $default['cta_secondary_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[cta_secondary_button_text]',
	array(
		'label'    => __( 'Secondary Button Text', 'education-soul' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting cta_secondary_button_url.
$wp_customize->add_setting(
	'theme_options[cta_secondary_button_url]',
	array(
		'default'           => $default['cta_secondary_button_url'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	'theme_options[cta_secondary_button_url]',
	array(
		'label'    => __( 'Secondary Button URL', 'education-soul' ),
		'section'  => 'section_home_call_to_action',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting cta_background_image.
$wp_customize->add_setting(
	'theme_options[cta_background_image]',
	array(
		'default'           => $default['cta_background_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'theme_options[cta_background_image]',
		array(
			'label'       => __( 'Background Image', 'education-soul' ),
			'description' => sprintf( __( 'Recommended Size: %1$dpx x %2$dpx', 'education-soul' ), 1940, 200 ),
			'section'     => 'section_home_call_to_action',
			'priority'    => 100,
			'settings'    => 'theme_options[cta_background_image]',
		)
	)
);

// Home Section News and Events.
$wp_customize->add_section(
	'section_home_news_and_events',
	array(
		'title'      => __( 'News and Events', 'education-soul' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
	)
);

// Setting news_and_events_ntitle.
$wp_customize->add_setting(
	'theme_options[news_and_events_ntitle]',
	array(
		'default'           => $default['news_and_events_ntitle'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[news_and_events_ntitle]',
	array(
		'label'    => __( 'News Title', 'education-soul' ),
		'section'  => 'section_home_news_and_events',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting news_and_events_nnumber.
$wp_customize->add_setting(
	'theme_options[news_and_events_nnumber]',
	array(
		'default'           => $default['news_and_events_nnumber'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[news_and_events_nnumber]',
	array(
		'label'       => __( 'No of News', 'education-soul' ),
		'section'     => 'section_home_news_and_events',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

// Setting news_and_events_ncategory.
$wp_customize->add_setting(
	'theme_options[news_and_events_ncategory]',
	array(
		'default'           => $default['news_and_events_ncategory'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Education_Soul_Dropdown_Taxonomies_Control(
		$wp_customize,
		'theme_options[news_and_events_ncategory]',
		array(
			'label'    => __( 'News Category', 'education-soul' ),
			'section'  => 'section_home_news_and_events',
			'settings' => 'theme_options[news_and_events_ncategory]',
			'priority' => 100,
		)
	)
);

// Setting news_and_events_etitle.
$wp_customize->add_setting(
	'theme_options[news_and_events_etitle]',
	array(
		'default'           => $default['news_and_events_etitle'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[news_and_events_etitle]',
	array(
		'label'    => __( 'Events Title', 'education-soul' ),
		'section'  => 'section_home_news_and_events',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting news_and_events_enumber.
$wp_customize->add_setting(
	'theme_options[news_and_events_enumber]',
	array(
		'default'           => $default['news_and_events_enumber'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[news_and_events_enumber]',
	array(
		'label'       => __( 'No of Events', 'education-soul' ),
		'section'     => 'section_home_news_and_events',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

// Setting news_and_events_ecategory.
$wp_customize->add_setting(
	'theme_options[news_and_events_ecategory]',
	array(
		'default'           => $default['news_and_events_ecategory'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Education_Soul_Dropdown_Taxonomies_Control(
		$wp_customize,
		'theme_options[news_and_events_ecategory]',
		array(
			'label'    => __( 'Events Category', 'education-soul' ),
			'section'  => 'section_home_news_and_events',
			'settings' => 'theme_options[news_and_events_ecategory]',
			'priority' => 100,
		)
	)
);

// Home Section Services.
$wp_customize->add_section(
	'section_home_services',
	array(
		'title'      => __( 'Services', 'education-soul' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
	)
);

// Setting services_title.
$wp_customize->add_setting(
	'theme_options[services_title]',
	array(
		'default'           => $default['services_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[services_title]',
	array(
		'label'    => __( 'Title', 'education-soul' ),
		'section'  => 'section_home_services',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting services_column.
$wp_customize->add_setting(
	'theme_options[services_column]',
	array(
		'default'           => $default['services_column'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[services_column]',
	array(
		'label'    => __( 'Columns', 'education-soul' ),
		'section'  => 'section_home_services',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => education_soul_get_numbers_dropdown_options( 3, 4 ),
	)
);

// Setting services_number.
$wp_customize->add_setting(
	'theme_options[services_number]',
	array(
		'default'           => $default['services_number'],
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[services_number]',
	array(
		'label'       => __( 'No of Blocks', 'education-soul' ),
		'description' => __( 'Enter number between 1 and 10. Save and refresh the page if No of Blocks is changed.', 'education-soul' ),
		'section'     => 'section_home_services',
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

$services_number = absint( education_soul_get_option( 'services_number' ) );

if ( $services_number > 0 ) {
	for ( $i = 1; $i <= $services_number; $i++ ) {
		$wp_customize->add_setting(
			"theme_options[services_page_$i]",
			array(
				'default'           => isset( $default[ 'services_page_' . $i ] ) ? $default[ 'services_page_' . $i ] : '',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'education_soul_sanitize_dropdown_pages',
			)
		);
		$wp_customize->add_control(
			"theme_options[services_page_$i]",
			array(
				'label'    => __( 'Page', 'education-soul' ) . ' #' . $i,
				'section'  => 'section_home_services',
				'type'     => 'dropdown-pages',
				'priority' => 100,
			)
		);
	}
}

// Home Section Latest News.
$wp_customize->add_section(
	'section_home_latest_news',
	array(
		'title'      => __( 'Latest News', 'education-soul' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_home_sections_panel',
	)
);

// Setting latest_news_title.
$wp_customize->add_setting(
	'theme_options[latest_news_title]',
	array(
		'default'           => $default['latest_news_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[latest_news_title]',
	array(
		'label'    => __( 'Title', 'education-soul' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'text',
		'priority' => 100,
	)
);

// Setting latest_news_layout.
$wp_customize->add_setting(
	'theme_options[latest_news_layout]',
	array(
		'default'           => $default['latest_news_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[latest_news_layout]',
	array(
		'label'    => __( 'Layout', 'education-soul' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => education_soul_get_numbers_dropdown_options( 1, 2, __( 'Layout', 'education-soul' ) . ' ' ),
	)
);

// Setting latest_news_column.
$wp_customize->add_setting(
	'theme_options[latest_news_column]',
	array(
		'default'           => $default['latest_news_column'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[latest_news_column]',
	array(
		'label'    => __( 'Columns', 'education-soul' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => education_soul_get_numbers_dropdown_options( 3, 4 ),
	)
);

// Setting latest_news_number.
$wp_customize->add_setting(
	'theme_options[latest_news_number]',
	array(
		'default'           => $default['latest_news_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[latest_news_number]',
	array(
		'label'       => __( 'No of Blocks', 'education-soul' ),
		'section'     => 'section_home_latest_news',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 20,
			'step'  => 1,
			'style' => 'width: 55px;',
		),
	)
);

// Setting latest_news_category.
$wp_customize->add_setting(
	'theme_options[latest_news_category]',
	array(
		'default'           => $default['latest_news_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(
	new Education_Soul_Dropdown_Taxonomies_Control(
		$wp_customize,
		'theme_options[latest_news_category]',
		array(
			'label'    => __( 'Select Category', 'education-soul' ),
			'section'  => 'section_home_latest_news',
			'settings' => 'theme_options[latest_news_category]',
			'priority' => 100,
		)
	)
);

// Setting latest_news_featured_image.
$wp_customize->add_setting(
	'theme_options[latest_news_featured_image]',
	array(
		'default'           => $default['latest_news_featured_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[latest_news_featured_image]',
	array(
		'label'    => __( 'Image Size', 'education-soul' ),
		'section'  => 'section_home_latest_news',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => education_soul_get_image_sizes_options( false ),
	)
);

// Setting latest_news_excerpt_length.
$wp_customize->add_setting(
	'theme_options[latest_news_excerpt_length]',
	array(
		'default'           => $default['latest_news_excerpt_length'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'education_soul_sanitize_number_range',
	)
);
$wp_customize->add_control(
	'theme_options[latest_news_excerpt_length]',
	array(
		'label'       => __( 'Excerpt Length', 'education-soul' ),
		'description' => __( 'in words', 'education-soul' ),
		'section'     => 'section_home_latest_news',
		'type'        => 'number',
		'priority'    => 100,
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 200,
			'style' => 'width: 55px;',
		),
	)
);
