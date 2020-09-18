<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Education_Soul
 */

	/**
	 * Hook - education_soul_action_after_content.
	 *
	 * @hooked education_soul_content_end - 10
	 */
	do_action( 'education_soul_action_after_content' );
?>

	<?php
	/**
	 * Hook - education_soul_action_before_footer.
	 *
	 * @hooked education_soul_add_footer_bottom_widget_area - 5
	 * @hooked education_soul_footer_start - 10
	 */
	do_action( 'education_soul_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - education_soul_action_footer.
	   *
	   * @hooked education_soul_footer_copyright - 10
	   */
	  do_action( 'education_soul_action_footer' );
	?>
	<?php
	/**
	 * Hook - education_soul_action_after_footer.
	 *
	 * @hooked education_soul_footer_end - 10
	 */
	do_action( 'education_soul_action_after_footer' );
	?>

<?php
	/**
	 * Hook - education_soul_action_after.
	 *
	 * @hooked education_soul_page_end - 10
	 * @hooked education_soul_footer_goto_top - 20
	 */
	do_action( 'education_soul_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
