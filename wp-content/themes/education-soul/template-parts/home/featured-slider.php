<?php
/**
 * Template part for displaying home featured slider section
 *
 * @package Education_Soul
 */

$slider_details = array();
$slider_details = apply_filters( 'education_soul_filter_slider_details', $slider_details );

if ( empty( $slider_details ) ) {
	return;
}

// Render slider now.
education_soul_render_featured_slider( $slider_details );
