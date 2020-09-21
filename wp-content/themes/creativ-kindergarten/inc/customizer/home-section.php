<?php
/**
 * Home Page Options.
 *
 * @package Creativ Kindergarten
 */

$default = creativ_kindergarten_get_default_theme_options();

// Add Panel.
$wp_customize->add_panel( 'home_page_panel',
	array(
	'title'      => __( 'Front Page Sections', 'creativ-kindergarten' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/**
* Section Customizer Options.
*/
require get_template_directory() . '/inc/customizer/home-sections/slider.php';
require get_template_directory() . '/inc/customizer/home-sections/additional-info.php';
require get_template_directory() . '/inc/customizer/home-sections/services.php';
require get_template_directory() . '/inc/customizer/home-sections/courses.php';
require get_template_directory() . '/inc/customizer/home-sections/cta.php';
require get_template_directory() . '/inc/customizer/home-sections/blog.php';