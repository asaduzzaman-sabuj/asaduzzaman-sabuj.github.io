<?php
/**
 * Customizer partials
 *
 * @package Education_Soul
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 0.1
 *
 * @return void
 */
function education_soul_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site description for the selective refresh partial.
 *
 * @since 0.1
 *
 * @return void
 */
function education_soul_customize_partial_blogdescription() {

	bloginfo( 'description' );

}
