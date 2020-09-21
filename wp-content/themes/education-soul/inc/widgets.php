<?php
/**
 * Theme widgets
 *
 * @package Education_Soul
 */

// Load widget base.
require_once get_template_directory() . '/lib/widget-base/class-widget-base.php';

if ( ! function_exists( 'education_soul_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 0.1
	 */
	function education_soul_load_widgets() {
		// Social widget.
		register_widget( 'Education_Soul_Social_Widget' );

		// Featured Page widget.
		register_widget( 'Education_Soul_Featured_Page_Widget' );

		// Recent Posts widget.
		register_widget( 'Education_Soul_Recent_Posts_Widget' );
	}

endif;

add_action( 'widgets_init', 'education_soul_load_widgets' );

if ( ! class_exists( 'Education_Soul_Social_Widget' ) ) :

	/**
	 * Social widget Class.
	 *
	 * @since 0.1
	 */
	class Education_Soul_Social_Widget extends Education_Soul_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 0.1
		 */
		function __construct() {

			$opts   = array(
				'classname'                   => 'education_soul_widget_social',
				'description'                 => __( 'Displays social icons.', 'education-soul' ),
				'customize_selective_refresh' => true,
			);
			$fields = array(
				'title' => array(
					'label' => __( 'Title:', 'education-soul' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
			);

			if ( false === has_nav_menu( 'social' ) ) {
				$fields['message'] = array(
					'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', 'education-soul' ),
					'type'  => 'message',
					'class' => 'widefat',
				);
			}

			parent::__construct( 'education-soul-social', __( 'ES: Social', 'education-soul' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 0.1
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . $params['title'] . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'container'      => false,
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'item_spacing'   => 'discard',
					)
				);
			}

			echo $args['after_widget'];

		}
	}
endif;

if ( ! class_exists( 'Education_Soul_Featured_Page_Widget' ) ) :

	/**
	 * Featured page widget Class.
	 *
	 * @since 0.1
	 */
	class Education_Soul_Featured_Page_Widget extends Education_Soul_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 0.1
		 */
		function __construct() {

			$opts = array(
				'classname'                   => 'education_soul_widget_featured_page',
				'description'                 => __( 'Displays single featured Page or Post.', 'education-soul' ),
				'customize_selective_refresh' => true,
			);

			$fields = array(
				'title'                    => array(
					'label' => esc_html__( 'Title:', 'education-soul' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'featured_page'            => array(
					'label'            => esc_html__( 'Select Page:', 'education-soul' ),
					'type'             => 'dropdown-pages',
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'education-soul' ),
				),
				'content_type'             => array(
					'label'   => esc_html__( 'Show Content:', 'education-soul' ),
					'type'    => 'select',
					'default' => 'full',
					'options' => array(
						'excerpt' => esc_html__( 'Excerpt', 'education-soul' ),
						'full'    => esc_html__( 'Full', 'education-soul' ),
					),
				),
				'excerpt_length'           => array(
					'label'       => esc_html__( 'Excerpt Length:', 'education-soul' ),
					'description' => esc_html__( 'Applies when Excerpt is selected in Show Content option.', 'education-soul' ),
					'type'        => 'number',
					'css'         => 'max-width:60px;',
					'default'     => 40,
					'min'         => 1,
					'max'         => 400,
				),
				'featured_image'           => array(
					'label'   => esc_html__( 'Featured Image:', 'education-soul' ),
					'type'    => 'select',
					'options' => education_soul_get_image_sizes_options(),
				),
				'featured_image_alignment' => array(
					'label'   => esc_html__( 'Image Alignment:', 'education-soul' ),
					'type'    => 'select',
					'default' => 'center',
					'options' => education_soul_get_image_alignment_options(),
				),
			);

			parent::__construct( 'education-soul-featured-page', __( 'ES: Featured Page', 'education-soul' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 0.1
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {
			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
			}
			?>

			<?php if ( absint( $params['featured_page'] ) > 0 ) : ?>

				<?php
				$qargs = array(
					'p'              => absint( $params['featured_page'] ),
					'posts_per_page' => 1,
					'no_found_rows'  => true,
					'post_type'      => 'page',
				);

				$the_query = new WP_Query( $qargs );
				?>

				<?php if ( $the_query->have_posts() ) : ?>

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>

						<div class="featured-page-widget entry-content">
							<?php if ( 'disable' !== $params['featured_image'] && has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( esc_attr( $params['featured_image'] ), array( 'class' => 'align' . esc_attr( $params['featured_image_alignment'] ) ) ); ?></a>
							<?php endif; ?>
							<?php if ( 'excerpt' === $params['content_type'] ) : ?>
								<?php
								$excerpt = education_soul_the_excerpt( absint( $params['excerpt_length'] ) );
								echo wp_kses_post( wpautop( $excerpt ) );
								?>
							<?php else : ?>
								<?php the_content(); ?>
							<?php endif; ?>
						</div><!-- .featured-page-widget -->

					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				<?php endif; // End if have_posts(). ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];
		}
	}
endif;

if ( ! class_exists( 'Education_Soul_Recent_Posts_Widget' ) ) :

	/**
	 * Recent posts widget Class.
	 *
	 * @since 0.1
	 */
	class Education_Soul_Recent_Posts_Widget extends Education_Soul_Widget_Base {

		/**
		 * Sets up a new widget instance.
		 *
		 * @since 0.1
		 */
		function __construct() {

			$opts   = array(
				'classname'                   => 'education_soul_widget_recent_posts',
				'description'                 => __( 'Displays recent posts.', 'education-soul' ),
				'customize_selective_refresh' => true,
			);
			$fields = array(
				'title'          => array(
					'label' => __( 'Title:', 'education-soul' ),
					'type'  => 'text',
					'class' => 'widefat',
				),
				'post_category'  => array(
					'label'           => __( 'Select Category:', 'education-soul' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => __( 'All Categories', 'education-soul' ),
				),
				'post_number'    => array(
					'label'   => __( 'Number of Posts:', 'education-soul' ),
					'type'    => 'number',
					'default' => 4,
					'css'     => 'max-width:60px;',
					'min'     => 1,
					'max'     => 100,
				),
				'featured_image' => array(
					'label'   => __( 'Featured Image:', 'education-soul' ),
					'type'    => 'select',
					'default' => 'thumbnail',
					'options' => education_soul_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
				),
				'image_width'    => array(
					'label'       => __( 'Image Width:', 'education-soul' ),
					'type'        => 'number',
					'description' => __( 'px', 'education-soul' ),
					'css'         => 'max-width:60px;',
					'adjacent'    => true,
					'default'     => 60,
					'min'         => 1,
					'max'         => 150,
				),
				'disable_date'   => array(
					'label'   => __( 'Disable Date', 'education-soul' ),
					'type'    => 'checkbox',
					'default' => false,
				),
			);

			parent::__construct( 'education-soul-recent-posts', __( 'ES: Recent Posts', 'education-soul' ), $opts, array(), $fields );

		}

		/**
		 * Outputs the content for the current widget instance.
		 *
		 * @since 0.1
		 *
		 * @param array $args     Display arguments.
		 * @param array $instance Settings for the current widget instance.
		 */
		function widget( $args, $instance ) {

			$params = $this->get_params( $instance );

			echo $args['before_widget'];

			if ( ! empty( $params['title'] ) ) {
				echo $args['before_title'] . esc_html( apply_filters( 'widget_title', $params['title'] ) ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => absint( $params['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $params['post_category'] ) > 0 ) {
				$qargs['cat'] = $params['post_category'];
			}

			$the_query = new WP_Query( $qargs );
			?>

			<?php if ( $the_query->have_posts() ) : ?>

				<?php global $post; ?>

				<div class="recent-posts-wrapper">

					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>

						<div class="recent-posts-item">

							<?php if ( 'disable' !== $params['featured_image'] ) : ?>
									<div class="recent-posts-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php if ( has_post_thumbnail() ) : ?>
												<?php
												$img_attributes = array(
													'class' => 'alignleft',
													'style' => 'max-width:' . esc_attr( $params['image_width'] ) . 'px;',
												);
												the_post_thumbnail( esc_attr( $params['featured_image'] ), $img_attributes );
												?>
											<?php else : ?>
												<img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image-square.png' ); ?>" alt="<?php the_title_attribute(); ?>" class="alignleft" style="max-width:<?php echo esc_attr( absint( $params['image_width'] ) ); ?>px;" />
											<?php endif; ?>
										</a>
									</div><!-- .recent-posts-thumb -->
							<?php endif; ?>
							<div class="recent-posts-text-wrap">
								<h3 class="recent-posts-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3><!-- .recent-posts-title -->

								<?php if ( false === $params['disable_date'] ) : ?>
									<div class="recent-posts-meta">
										<?php if ( false === $params['disable_date'] ) : ?>
											<span class="recent-posts-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php endif; ?>
									</div><!-- .recent-posts-meta -->
								<?php endif; ?>

							</div><!-- .recent-posts-text-wrap -->

						</div><!-- .recent-posts-item -->

					<?php endwhile; ?>

				</div><!-- .recent-posts-wrapper -->

				<?php wp_reset_postdata(); // Reset. ?>

			<?php endif; ?>

			<?php
			echo $args['after_widget'];

		}
	}
endif;
