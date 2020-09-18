<?php
/**
 * Template part for displaying home news and events section
 *
 * @package Education_Soul
 */

$news_and_events_ntitle    = education_soul_get_option( 'news_and_events_ntitle' );
$news_and_events_nnumber   = education_soul_get_option( 'news_and_events_nnumber' );
$news_and_events_ncategory = education_soul_get_option( 'news_and_events_ncategory' );
$news_and_events_etitle    = education_soul_get_option( 'news_and_events_etitle' );
$news_and_events_enumber   = education_soul_get_option( 'news_and_events_enumber' );
$news_and_events_ecategory = education_soul_get_option( 'news_and_events_ecategory' );
?>
<div id="education-soul-news-and-events" class="home-section home-section-news-and-events">
	<div class="container">
		<div class="inner-wrapper">
			<div class="recent-news">
				<h2 class="section-title"><?php echo esc_html( $news_and_events_ntitle ); ?></h2>
				<?php
				$qargs = array(
					'posts_per_page'      => absint( $news_and_events_nnumber ),
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
				);

				if ( absint( $news_and_events_ncategory ) > 0 ) {
					$qargs['cat'] = absint( $news_and_events_ncategory );
				}

				// Fetch posts.
				$the_query = new WP_Query( $qargs );
				?>

				<?php if ( $the_query->have_posts() ) : ?>
					<?php
					$carousel_args = array(
						'slidesToShow'   => 2,
						'slidesToScroll' => 1,
						'dots'           => false,
						'prevArrow'      => '<span class="left-arrow carousel-arrow"><i class="fas fa-angle-left" aria-hidden="true"></i></span>',
						'nextArrow'      => '<span class="right-arrow carousel-arrow"><i class="fas fa-angle-right" aria-hidden="true"></i></span>',
						'responsive'     => array(
							array(
								'breakpoint' => 1024,
								'settings'   => array(
									'slidesToShow' => 2,
								),
							),
							array(
								'breakpoint' => 768,
								'settings'   => array(
									'slidesToShow' => 1,
								),
							),
							array(
								'breakpoint' => 480,
								'settings'   => array(
									'slidesToShow' => 1,
								),
							),
						),
					);

					$carousel_args_encoded = wp_json_encode( $carousel_args );
					?>

					<div class="inner-wrapper clear-fix">
						<div class="education-soul-carousel clear-fix" data-slick='<?php echo esc_attr( $carousel_args_encoded ); ?>'>
						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							?>

							<div class="news-post">
								<div class="news-post-inner">
									<?php if ( has_post_thumbnail() ) : ?>
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'education-soul-thumb', array( 'class' => 'aligncenter' ) ); ?></a>
									<?php else : ?>
										<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.png' ); ?>" alt="<?php the_title_attribute(); ?>" /></a>
									<?php endif; ?>

									<div class="news-content">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="entry-meta">
											<span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
											<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
												<span class="comments-link">
													<?php comments_popup_link( 0, 1, '%' ); ?>
												</span>
											<?php endif; ?>
										</div><!-- .entry-meta -->
										<?php
										$excerpt = education_soul_the_excerpt( 20 );
										echo wp_kses_post( wpautop( $excerpt ) );
										?>
									</div><!-- .news-content -->
								</div><!-- .news-post-inner -->
							</div><!-- .news-post -->
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						</div>
					</div><!-- .inner-wrapper -->

				<?php endif; ?>

			</div><!-- .recent-news -->
			<div class="recent-events">
				<h2 class="section-title"><?php echo esc_html( $news_and_events_etitle ); ?></h2>
				<?php
				$qargs = array(
					'posts_per_page'      => absint( $news_and_events_enumber ),
					'no_found_rows'       => true,
					'ignore_sticky_posts' => true,
				);

				if ( absint( $news_and_events_ecategory ) > 0 ) {
					$qargs['cat'] = absint( $news_and_events_ecategory );
				}

				// Fetch posts.
				$the_query = new WP_Query( $qargs );
				?>

				<?php if ( $the_query->have_posts() ) : ?>

					<div class="recent-events-inner">
						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();
							?>

							<div class="event-post">
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'education-soul-thumb', array( 'class' => 'alignleft' ) ); ?></a>
								<?php else : ?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.png' ); ?>" alt="<?php the_title_attribute(); ?>" class="alignleft" /></a>
								<?php endif; ?>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="entry-meta">
										<span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
										<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
											<span class="comments-link">
												<?php comments_popup_link( 0, 1, '%' ); ?>
											</span>
										<?php endif; ?>
									</div><!-- .entry-meta -->
							</div> <!-- .event-post -->

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div><!-- .recent-events-inner -->

				<?php endif; ?>

			</div><!-- .recent-news -->

		</div><!-- .inner-wrapper -->

	</div><!-- .container -->
</div><!-- .home-section-news-and-events -->
