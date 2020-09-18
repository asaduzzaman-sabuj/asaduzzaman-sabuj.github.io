<?php
/**
 * Implementation of slider feature
 *
 * @package Education_Soul
 */

// Slider details.
add_filter( 'education_soul_filter_slider_details', 'education_soul_get_slider_details' );

if ( ! function_exists( 'education_soul_get_slider_details' ) ) :
	/**
	 * Slider details.
	 *
	 * @since 0.1
	 *
	 * @param array $input Slider details.
	 */
	function education_soul_get_slider_details( $input ) {

		$featured_slider_type           = education_soul_get_option( 'featured_slider_type' );
		$featured_slider_number         = education_soul_get_option( 'featured_slider_number' );
		$featured_slider_read_more_text = education_soul_get_option( 'featured_slider_read_more_text' );

		switch ( $featured_slider_type ) {

			case 'demo-slider':
				$slides = array();
				for ( $i = 0; $i <= 1; $i++ ) {
					$img_arr = array(
						0 => get_template_directory_uri() . '/images/slide' . ( $i + 1 ) . '.jpg',
						1 => 1420,
						2 => 440,
						3 => 0,
					);

					$slides[ $i ]['images']  = $img_arr;
					$slides[ $i ]['title']   = __( 'Slide Title ', 'education-soul' ) . ( $i + 1 );
					$slides[ $i ]['url']     = esc_url( home_url( '/' ) );
					$slides[ $i ]['excerpt'] = __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis metus scelerisque, faucibus risus eu, luctus est.', 'education-soul' );

				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

				break;

			case 'featured-page':
				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
					$id = education_soul_get_option( 'featured_slider_page_' . $i );
					if ( ! empty( $id ) ) {
						$ids[] = absint( $id );
					}
				}
				// Bail if no valid pages are selected.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post_type'      => 'page',
					'post__in'       => $ids,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ), // Show only posts with featured images.
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides    = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array               = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-soul-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = education_soul_the_excerpt( apply_filters( 'education_soul_filter_slider_caption_length', 20 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url']  = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

				break;

			default:
				break;
		}
		return $input;

	}
endif;

if ( ! function_exists( 'education_soul_render_featured_slider' ) ) :
	/**
	 * Render featured slider.
	 *
	 * @since 0.1
	 *
	 * @param array $slider_details Details of slider content.
	 */
	function education_soul_render_featured_slider( $slider_details = array() ) {
		if ( empty( $slider_details ) ) {
			return;
		}

		$featured_slider_transition_effect   = education_soul_get_option( 'featured_slider_transition_effect' );
		$featured_slider_enable_caption      = education_soul_get_option( 'featured_slider_enable_caption' );
		$featured_slider_caption_alignment   = education_soul_get_option( 'featured_slider_caption_alignment' );
		$featured_slider_enable_arrow        = education_soul_get_option( 'featured_slider_enable_arrow' );
		$featured_slider_enable_pager        = education_soul_get_option( 'featured_slider_enable_pager' );
		$featured_slider_enable_autoplay     = education_soul_get_option( 'featured_slider_enable_autoplay' );
		$featured_slider_transition_duration = education_soul_get_option( 'featured_slider_transition_duration' );
		$featured_slider_transition_delay    = education_soul_get_option( 'featured_slider_transition_delay' );

		// Cycle data.
		$slide_data = array(
			'fx'             => esc_attr( $featured_slider_transition_effect ),
			'speed'          => esc_attr( $featured_slider_transition_duration ) * 1000,
			'pause-on-hover' => 'true',
			'loader'         => 'true',
			'log'            => 'false',
			'swipe'          => 'true',
			'auto-height'    => 'container',
		);
		if ( $featured_slider_enable_caption ) {
			$slide_data['caption-template'] = '<div class="container"><div class="caption-wrap"><h3><a href="{{url}}" target="{{target}}">{{title}}</a></h3><p>{{excerpt}}</p>{{buttons}}</div></div>';
		}

		if ( $featured_slider_enable_pager ) {
			$slide_data['pager-template'] = '<span class="pager-box"></span>';
		}
		if ( $featured_slider_enable_autoplay ) {
			$slide_data['timeout'] = absint( $featured_slider_transition_delay ) * 1000;
		} else {
			$slide_data['timeout'] = 0;
		}

		$slide_data['slides'] = 'article';

		$slide_attributes_text = '';
		foreach ( $slide_data as $key => $item ) {

			$slide_attributes_text .= ' ';
			$slide_attributes_text .= ' data-cycle-' . esc_attr( $key );
			$slide_attributes_text .= '="' . esc_attr( $item ) . '"';

		}
		?>
		<div id="featured-slider">

			<div class="cycle-slideshow" id="main-slider" <?php echo $slide_attributes_text; ?>>

				<?php if ( $featured_slider_enable_arrow ) : ?>
					<div class="cycle-prev"><i class="fas fa-angle-left" aria-hidden="true"></i></div>
					<div class="cycle-next"><i class="fas fa-angle-right" aria-hidden="true"></i></div>
				<?php endif; ?>

				<?php if ( $featured_slider_enable_pager ) : ?>
					<div class="cycle-pager"></div>
				<?php endif; ?>

				<?php $cnt = 1; ?>

				<?php foreach ( $slider_details as $key => $slide ) : ?>

					<?php $class_text = ( 1 === $cnt ) ? 'first' : ''; ?>
					<?php
					$target = '_self';
					if ( isset( $slide['new_window'] ) && 1 === $slide['new_window'] && ! empty( $slide['url'] ) ) {
						$target = '_blank';
					}
					$url = 'javascript:void(0);';
					if ( ! empty( $slide['url'] ) ) {
						$url = esc_url( $slide['url'] );
					}

					// Buttons stuff.
					$buttons_markup = '';

					$primary_button_text   = ! empty( $slide['primary_button_text'] ) ? $slide['primary_button_text'] : '';
					$primary_button_url    = ! empty( $slide['primary_button_url'] ) ? $slide['primary_button_url'] : '';
					$secondary_button_text = ! empty( $slide['secondary_button_text'] ) ? $slide['secondary_button_text'] : '';
					$secondary_button_url  = ! empty( $slide['secondary_button_url'] ) ? $slide['secondary_button_url'] : '';

					if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) {
						$buttons_markup .= '<div class="slider-buttons">';
						if ( ! empty( $primary_button_text ) ) {
							$buttons_markup .= '<a href="' . esc_url( $primary_button_url ) . '" class="custom-button slider-button button-primary">' . esc_html( $primary_button_text ) . '</a>';
						}
						if ( ! empty( $secondary_button_text ) ) {
							$buttons_markup .= '<a href="' . esc_url( $secondary_button_url ) . '" class="custom-button slider-button button-secondary">' . esc_html( $secondary_button_text ) . '</a>';
						}
						$buttons_markup .= '</div>';
					}

					?>
					<article class="<?php echo esc_attr( $class_text ); ?>" data-cycle-title="<?php echo esc_attr( $slide['title'] ); ?>"  data-cycle-url="<?php echo esc_url( $url ); ?>"  data-cycle-excerpt="<?php echo esc_attr( $slide['excerpt'] ); ?>" data-cycle-target="<?php echo esc_attr( $target ); ?>" data-cycle-buttons="<?php echo esc_attr( $buttons_markup ); ?>" >

						<?php if ( ! empty( $slide['url'] ) ) : ?>
						<a href="<?php echo esc_url( $slide['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>" >
						<?php endif; ?>

						<img src="<?php echo esc_url( $slide['images'][0] ); ?>" alt="<?php echo esc_attr( $slide['title'] ); ?>" />
						<?php if ( ! empty( $slide['url'] ) ) : ?>
						</a>
						<?php endif; ?>

						<?php if ( $featured_slider_enable_caption ) : ?>
							<?php
							if ( isset( $slide['caption_alignment'] ) && ! empty( $slide['caption_alignment'] ) ) {
								$caption_alignment_class = 'caption-alignment-' . esc_attr( $slide['caption_alignment'] );
							} else {
								$caption_alignment_class = 'caption-alignment-' . esc_attr( $featured_slider_caption_alignment );
							}
							?>
							<div class="cycle-caption <?php echo esc_attr( $caption_alignment_class ); ?>">
								<div class="caption-wrap">
									<h3><a href="<?php echo esc_url( $slide['url'] ); ?>"><?php echo esc_html( $slide['title'] ); ?></a></h3>
									<p><?php echo esc_html( $slide['excerpt'] ); ?></p>
									<?php echo wp_kses_post( $buttons_markup ); ?>
								</div><!-- .cycle-wrap -->
							</div><!-- .cycle-caption -->
						<?php endif; ?>

					</article>

					<?php $cnt++; ?>

				<?php endforeach; ?>

			</div><!-- #main-slider -->

		</div><!-- #featured-slider -->

		<?php

	}

endif;
