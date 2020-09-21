<?php
/**
 * The template part for displaying content
 *
 * @package Kids_Camp
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
	<div class="post-wrapper">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php
					$columns = kids_camp_get_posts_columns();
					$thumbnail = 'post-thumbnail';

					if ( 'layout-one' === $columns ) {
						$thumbnail = 'kids-camp-blog';
						$layout  = kids_camp_get_theme_layout();

						if ( 'no-sidebar-full-width' === $layout ) {
							$thumbnail = 'kids-camp-slider';
						}
					}

					the_post_thumbnail( $thumbnail );
					?>
				</a>
			</div>
		<?php endif; ?>

		<div class="entry-container">
			<header class="entry-header">
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php esc_html_e( 'Featured', 'kids-camp' ); ?></span>
				<?php endif; ?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php echo kids_camp_entry_header(); ?>

				<?php echo kids_camp_entry_date_author(); ?>

			</header><!-- .entry-header -->

			<!-- <div class="entry-summary">
				<?php the_excerpt(); ?>
			</div> --><!-- .entry-summary -->

			<div class="entry-footer">
				<div class="entry-meta">
					<?php
						kids_camp_edit_link();
					?>
				</div>
			</div>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article><!-- #post-## -->
