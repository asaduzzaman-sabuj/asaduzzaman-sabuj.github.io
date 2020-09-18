<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Creativ Kindergarten
 */

/**
 *
 * @hooked creativ_kindergarten_footer_start
 */
do_action( 'creativ_kindergarten_action_before_footer' );

/**
 * Hooked - creativ_kindergarten_footer_top_section -10
 * Hooked - creativ_kindergarten_footer_section -20
 */
do_action( 'creativ_kindergarten_action_footer' );

/**
 * Hooked - creativ_kindergarten_footer_end. 
 */
do_action( 'creativ_kindergarten_action_after_footer' );

wp_footer(); ?>

</body>  
</html>