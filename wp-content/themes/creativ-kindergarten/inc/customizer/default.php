<?php
/**
 * Default theme options.
 *
 * @package Creativ Kindergarten
 */

if ( ! function_exists( 'creativ_kindergarten_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function creativ_kindergarten_get_default_theme_options() {

	$defaults = array();

	$defaults['show_header_contact_info'] 	= true;
    $defaults['header_email']             	= __( 'info@creativthemes.com','creativ-kindergarten' );
    $defaults['header_phone' ]            	= __( 'Phone : 8801 234 567 890','creativ-kindergarten' );
    $defaults['header_location' ]           = __( 'Address : Labartisan 1205 Dhaka','creativ-kindergarten' );
    $defaults['show_header_social_links'] 	= true;
    $defaults['header_social_links']		= array();

    // homepage options
	$defaults['enable_frontpage_content'] 	= true;

	// Featured Slider Section
	$defaults['disable_featured_slider']	= true;
	$defaults['number_of_sr_items']			= 3;
	$defaults['featured_slider_overlay']	= 0.4;
	$defaults['featured_slider_speed']		= 1000;
	$defaults['featured_slider_fontsize']	= 66;
	$defaults['featured_slider_height']		= 300;
	$defaults['sr_content_type']			= 'sr_page';

	// Our Features Section
	$defaults['disable_additional_info_section']	= true;
	$defaults['number_of_column']					= 3;
	$defaults['number_of_items']					= 3;
	$defaults['additional_info_icon_container']		= 100;
	$defaults['additional_info_icon_fontsize']		= 42;
	$defaults['additional_info_title_fontsize']		= 24;
	$defaults['ad_content_type']					= 'ad_page';

	//Featured Courses Section	
	$defaults['disable_courses_section']	= true;
	$defaults['courses_section_title']	   	= esc_html__( 'Our Popular Classes', 'creativ-kindergarten' );
	$defaults['number_of_cs_column']		= 3;
	$defaults['number_of_cs_items']			= 3;
	$defaults['cs_content_type']			= 'cs_page';

	//Cta Section	
	$defaults['disable_cta_section']	   	= true;
	$defaults['cta_small_description']	   	= esc_html__( 'Join Our Kindergarten!', 'creativ-kindergarten' );
	$defaults['cta_button_label']	   	 	= esc_html__( 'Join Now', 'creativ-kindergarten' );
	$defaults['cta_button_url']	   	 		= '#';

	// About us Section
	$defaults['disable_service_section']	= true;
	$defaults['number_of_ss_items']			= 1;
	$defaults['ss_content_type']			= 'ss_page';

	// Blog Section
	$defaults['disable_blog_section']		= true;
	$defaults['blog_title']	   	 			= esc_html__( 'Dont Miss Our Event', 'creativ-kindergarten' );
	$defaults['blog_category']	   			= 0; 
	$defaults['blog_number']				= 3;

	//General Section
	$defaults['readmore_text']				= esc_html__('Read More','creativ-kindergarten');
	$defaults['your_latest_posts_title']		= esc_html__('Blog','creativ-kindergarten');
	$defaults['excerpt_length']				= 40;
	$defaults['layout_options']				= 'right-sidebar';	

	//Footer section 		
	$defaults['copyright_text']				= esc_html__( 'Copyright &copy; All rights reserved.', 'creativ-kindergarten' );

	// Pass through filter.
	$defaults = apply_filters( 'creativ_kindergarten_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'creativ_kindergarten_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function creativ_kindergarten_get_option( $key ) {

		$default_options = creativ_kindergarten_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;