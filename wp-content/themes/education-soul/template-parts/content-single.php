<?php
/**
 * Template part for displaying single posts
 *
 * @package Education_Soul
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<footer class="entry-footer">
		<div class="entry-meta">
		<?php education_soul_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->

	<?php
	/**
	 * Hook - education_soul_single_image.
	 *
	 * @hooked education_soul_add_image_in_single_display -  10
	 */
	do_action( 'education_soul_single_image' );
	?>

	<div class="entry-content-wrapper">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'education-soul' ),
						'after'  => '</div>',
					)
				);
				?>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-wrapper -->

</article><!-- #post-## -->
